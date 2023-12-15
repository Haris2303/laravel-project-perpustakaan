<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Member;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index(): View
    {
        $members = Member::all();
        $data = [
            'title' => 'Kelola Member',
            'members' => $members
        ];

        return view('dashboard.member.index', $data);
    }

    public function store(Request $request): JsonResponse
    {
        DB::transaction(function () use ($request) {

            $credentialUser = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'min:8'],
                'password_confirmation' => ['required', 'min:8']
            ]);

            $credentialMember = $request->validate([
                'member_code' => ['required', 'string'],
                'gender' => ['required', 'min:1'],
                'address' => ['required', 'max:200'],
                'telp' => ['required', 'string', 'max:16']
            ]);

            $user = new User($credentialUser);
            $user->save();

            $credentialMember['user_id'] = $user->id;
            $credentialMember['admin_id'] = Auth::user()->id;

            $member = new Member($credentialMember);
            $member->save();
        });

        return response()->json([
            'message' => 'success'
        ])->setStatusCode(201);
    }
}
