<x-dashboard-layout>
    <div class="sm:ml-72 mt-10">
        <div class="w-[19rem] flex gap-10 shadow-md p-7 mb-10">
            <div class="w-20 h-20 rounded-full">
                <svg class="flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                    <path
                        d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                </svg>
            </div>
            <div class="flex flex-col justify-end items-end">
                <span class="text-3xl text-gray-900 font-bold">{{ $books->count() }}</span>
                <span class="text-gray-700">Jumlah Buku</span>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="px-4 py-3 mb-4 rounded-lg bg-green-300 mr-5" role="alert">
                <span class="font-medium text-sm text-green-800">{{ session('success') }}</span>
            </div>
        @endif
        <div class="w-40 mb-3">
            <a href="/dashboard/books/create" class="bg-gray-600 text-white py-1 px-5 rounded-lg">Tambah</a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mr-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-md text-gray-700 capitalize bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="border-b-2">
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $book->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $book->description }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="/dashboard/book/{{ $book->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> |
                                <form action="/dashboard/book/{{ $book->id }}" method="post" class="inline">
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
