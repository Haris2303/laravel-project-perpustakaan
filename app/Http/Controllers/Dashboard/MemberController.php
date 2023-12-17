<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Contracts\View\View;
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

    public function create(): View
    {
        $data = [
            'title' => 'Tambah Member'
        ];

        return view('dashboard.member.create', $data);
    }

    public function store(Request $request): RedirectResponse
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

        return redirect('/dashboard/members')->with('success', 'Data Member berhasil ditambahkan!');
    }

    public function edit($member_code): View
    {
        $member = Member::where('member_code', $member_code)->first();
        $data = [
            'title' => 'Edit Member',
            'member' => $member
        ];

        return view('dashboard.member.edit', $data);
    }

    public function update(Request $request, $member_code): RedirectResponse
    {
        // validation rules
        $rules = [
            'name' => ['required'],
            'gender' => 'required',
            'address' => 'required',
            'telp' => ['required', 'numeric'],
        ];

        $request->validate($rules);

        $member = Member::where('member_code', $member_code)->first();

        User::where('id', $member->user_id)->update([
            'name' => $request->name
        ]);

        Member::where('member_code', $member_code)->update([
            'gender' => $request->gender,
            'address' => $request->address,
            'telp' => $request->telp
        ]);

        return redirect('/dashboard/members')->with('success', 'Data Member berhasil diedit!');
    }

    public function delete($member_code): RedirectResponse
    {
        $user_id = Member::where('member_code', $member_code)->first()->user_id;

        Member::where('user_id', $user_id)->delete();
        User::where('id', $user_id)->delete();

        return redirect('/dashboard/members')->with('success', 'Data Member berhasil dihapus');
    }
}
