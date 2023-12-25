<x-dashboard-layout>
    <div class="p-4 sm:ml-64">
        <div class="py-5 w-1/2 shadow-lg px-5 roudned-xl">
            <h1 class="text-xl font-bold my-5">Tambah Data Pengembalian</h1>
            <form action="/dashboard/borrowings" method="post">
                @csrf
                <!-- Peminjaman -->
                <div class="mt-4">
                    <x-input-label for="book" :value="__('Pilih Peminjaman')" />
                    <select name="book_id" id="book"
                        class="mr-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @foreach ($borrowings as $borrowing)
                            <option value="{{ $borrowing->id }}">{{ $borrowing->member->member_code }} |
                                {{ $borrowing->book->title }} -- {{ $borrowing->loan_date }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('borrowing_id')" class="mt-2" />
                </div>

                <!-- Tanggal Pengembalian -->
                <div class="mt-4">
                    <x-input-label for="return_date" :value="__('Tanggal Pengembalian')" />
                    <x-text-input id="return_date" class="block mt-1 w-full" type="date" name="return_date"
                        :value="old('return_date')" required autofocus autocomplete="return_date" />
                    <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
                </div>

                <!-- Waktu Dikembalikan -->
                <div class="mt-4">
                    <x-input-label for="time_returned" :value="__('Waktu Dikembalikan')" />
                    <x-text-input id="time_returned" class="block mt-1 w-full" type="time" name="time_returned"
                        :value="old('time_returned')" required autofocus autocomplete="time_returned" />
                    <x-input-error :messages="$errors->get('time_returned')" class="mt-2" />
                </div>

                <button type="submit" class="w-full py-2 rounded text-white mt-5 bg-slate-700">Tambah</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>
