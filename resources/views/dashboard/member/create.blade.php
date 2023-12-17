<x-dashboard-layout>
    <div class="p-4 sm:ml-64">
        <div class="py-5 w-1/2 shadow-lg px-5 roudned-xl">
            <h1 class="text-xl font-bold my-5">Tambah Data Member</h1>
            <form action="/dashboard/members" method="post">
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Member Code-->
                <div class="mt-4">
                    <x-input-label for="member_code" :value="__('Member Code')" />
                    <x-text-input id="member_code" class="block mt-1 w-full" type="text" name="member_code"
                        :value="old('member_code')" required autofocus autocomplete="member-code" />
                    <x-input-error :messages="$errors->get('member_code')" class="mt-2" />
                </div>

                <!-- Gender -->
                <div class="mt-4">
                    <x-input-label for="gender" :value="__('Gender')" />
                    <input type="radio" name="gender" id="l" value="L"
                        @if (old('gender') == 'L') @checked(true) @endif @required(true)>
                    <label for="l" class="mr-3">Laki Laki</label>
                    <input type="radio" name="gender" id="p" value="P"
                        @if (old('gender') == 'P') @checked(true) @endif @required(true)>
                    <label for="p">Perempuan</label>
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                        :value="old('address')" required autofocus autocomplete="member-code" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Telp -->
                <div class="mt-4">
                    <x-input-label for="telp" :value="__('Telp')" />
                    <x-text-input id="telp" class="block mt-1 w-full" type="text" name="telp"
                        :value="old('telp')" required autofocus autocomplete="member-code" />
                    <x-input-error :messages="$errors->get('telp')" class="mt-2" />
                </div>

                <button type="submit" class="w-full py-2 rounded text-white mt-5 bg-slate-700">Daftar</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>
