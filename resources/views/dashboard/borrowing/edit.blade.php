<x-dashboard-layout>
    <div class="p-4 sm:ml-64">
        <div class="py-5 w-1/2 shadow-lg px-5 roudned-xl">
            <h1 class="text-xl font-bold my-5">Tambah Data Peminjaman</h1>
            <form action="/dashboard/borrowing/{{ $borrowing->id }}" method="post">
                @method('PUT')
                @csrf
                <!-- Member -->
                <div>
                    <x-input-label for="member" :value="__('Pilih Member')" />
                    <select name="member_id" id="member"
                        class="mr-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option disabled>-- Pilih Member --</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}"
                                {{ $member->id === $borrowing->member_id ? 'selected' : '' }}>
                                {{ $member->member_code }} | {{ $member->user->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('member_id')" class="mt-2" />
                </div>

                <!-- Book -->
                <div class="mt-4">
                    <x-input-label for="book" :value="__('Pilih Buku')" />
                    <select name="book_id" id="book"
                        class="mr-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}"
                                {{ $book->id === $borrowing->book_id ? 'selected' : '' }}>{{ $book->isbn }} |
                                {{ $book->title }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                </div>

                <!-- Tanggal Peminjaman -->
                <div class="mt-4">
                    <x-input-label for="peminjaman" :value="__('Tanggal Peminjaman')" />
                    <x-text-input id="peminjaman" class="block mt-1 w-full" type="date" name="loan_date"
                        :value="old('peminjaman')" required autofocus autocomplete="peminjaman" />
                    <x-input-error :messages="$errors->get('peminjaman')" class="mt-2" />
                </div>

                <!-- Tanggal Pengembalian -->
                <div class="mt-4">
                    <x-input-label for="pengembalian" :value="__('Tanggal Pengembalian')" />
                    <x-text-input id="pengembalian" class="block mt-1 w-full" type="date" name="return_date"
                        :value="old('pengembalian')" required autofocus autocomplete="pengembalian" />
                    <x-input-error :messages="$errors->get('pengembalian')" class="mt-2" />
                </div>

                <!-- Waktu Keterlambatan -->
                <div class="mt-4">
                    <x-input-label for="lateness" :value="__('Waktu Keterlambatan')" />
                    <x-text-input id="lateness" class="block mt-1 w-full" type="time" name="lateness"
                        :value="old('lateness')" required autofocus autocomplete="lateness" />
                    <x-input-error :messages="$errors->get('lateness')" class="mt-2" />
                </div>

                <button type="submit" class="w-full py-2 rounded text-white mt-5 bg-slate-700">Edit</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>
