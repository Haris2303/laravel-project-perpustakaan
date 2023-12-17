<x-dashboard-layout>
    <div class="p-4 sm:ml-64">
        <div class="py-5 w-1/2 shadow-lg px-5 roudned-xl">
            <h1 class="text-xl font-bold my-5">Edit Data Member</h1>
            <form action="/dashboard/member/{{ $member->member_code }}" method="post">
                @method('put')
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full mb-3" type="text" name="name"
                        value="{{ old('name', $member->user->name) }}" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Gender -->
                <div class="mt-4">
                    <x-input-label for="gender" :value="__('Gender')" />
                    <input type="radio" name="gender" id="l" value="L"
                        @if (old('gender') == 'L' || $member->gender == 'L') @checked(true) @endif @required(true)>
                    <label for="l" class="mr-3">Laki Laki</label>
                    <input type="radio" name="gender" id="p" value="P"
                        @if (old('gender') == 'P' || $member->gender == 'P') @checked(true) @endif @required(true)>
                    <label for="p">Perempuan</label>
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                        :value="old('address', $member->address)" required autofocus autocomplete="member-code" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Telp -->
                <div class="mt-4">
                    <x-input-label for="telp" :value="__('Telp')" />
                    <x-text-input id="telp" class="block mt-1 w-full" type="text" name="telp"
                        :value="old('telp', $member->telp)" required autofocus autocomplete="member-code" />
                    <x-input-error :messages="$errors->get('telp')" class="mt-2" />
                </div>

                <button type="submit" class="w-full py-2 rounded text-white mt-5 bg-slate-700">Simpan</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>
