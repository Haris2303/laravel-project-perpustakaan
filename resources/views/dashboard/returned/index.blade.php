<x-dashboard-layout>
    <div class="sm:ml-72 mt-10">
        <div class="w-[19rem] flex gap-10 shadow-md p-7 mb-10">
            <div class="w-20 h-20 rounded-full">
                <svg class="flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path
                        d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                </svg>
            </div>
            <div class="flex flex-col justify-end items-end">
                <span class="text-3xl text-gray-900 font-bold">{{ $returneds->count() }}</span>
                <span class="text-gray-700">Jumlah Pengembalian</span>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="px-4 py-3 mb-4 rounded-lg bg-green-300 mr-5" role="alert">
                <span class="font-medium text-sm text-green-800">{{ session('success') }}</span>
            </div>
        @endif
        <div class="w-40 mb-3">
            <a href="/dashboard/returneds/create" class="bg-gray-600 text-white py-1 px-5 rounded-lg">Tambah</a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mr-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-md text-gray-700 capitalize bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="border-b-2">
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Judul Buku
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Pinjam dan Kembali
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Buku Diterima
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Toleransi Telat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Denda
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returneds as $returned)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $returned->borrowing->book->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $returned->borrowing->loan_date }} -- {{ $returned->borrowing->return_date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $returned->return_date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ round((strtotime($returned->time_returned) - strtotime($returned->borrowing->lateness)) / 3600) }}
                                jam
                            </td>
                            <td class="px-6 py-4">
                                {!! $returned->late_payment
                                    ? '<a href="/dashboard/returneds/payment/' .
                                        $returned->id .
                                        '" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Bayar ' .
                                        round($returned->late_payment / 100) .
                                        'k</a>'
                                    : 'Tidak ada denda' !!}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="/dashboard/returned/{{ $returned->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> |
                                <form action="/dashboard/returned/{{ $returned->id }}" method="post" class="inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
