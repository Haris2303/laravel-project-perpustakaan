<x-dashboard-layout>
    <div class="p-4 sm:ml-64">
        <div class="py-5 w-1/2 shadow-lg px-5 roudned-xl">
            <h1 class="text-xl font-bold my-5">Tambah Data Buku</h1>
            <form action="/dashboard/books" method="post" enctype="multipart/form-data">
                @csrf
                {{-- image --}}
                <div>
                    <x-input-label for="cover" :value="__('Cover')" />
                    <x-text-input id="cover" class="block mt-1 w-full" type="file" name="cover" :value="old('cover')"
                        required autofocus autocomplete="cover" />
                    <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                </div>
                <!-- isbn -->
                <div class="mt-4">
                    <x-input-label for="isbn" :value="__('ISBN')" />
                    <x-text-input id="isbn" class="block mt-1 w-full" type="text" name="isbn"
                        :value="old('isbn')" required autofocus autocomplete="isbn" />
                    <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                </div>

                <!-- title -->
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Judul')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                        :value="old('title')" required autofocus autocomplete="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="genre" :value="__('Genre')" class="mb-2" />
                    <div class="flex gap-5">
                        @foreach ($genres as $genre)
                            <div>
                                <input type="checkbox" name="genres[]" id="{{ $genre->id }}"
                                    value="{{ $genre->id }}"
                                    class="mr-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <x-input-label for="{{ $genre->id }}" :value="__($genre->name)" class="inline" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- publication_year -->
                <div class="mt-4">
                    <x-input-label for="publication_year" :value="__('Tahun Publis')" />
                    <x-text-input id="publication_year" class="block mt-1 w-full" type="text" name="publication_year"
                        :value="old('publication_year')" required autofocus autocomplete="publication_year" />
                    <x-input-error :messages="$errors->get('publication_year')" class="mt-2" />
                </div>

                <!-- Quantity -->
                <div class="mt-4">
                    <x-input-label for="quantity" :value="__('Jumlah Buku')" />
                    <x-text-input id="quantity" class="block mt-1 w-full" type="text" name="quantity"
                        :value="old('quantity')" required autofocus autocomplete="quantity" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>

                <!-- Author -->
                <div class="mt-4">
                    <x-input-label for="author" :value="__('Penulis')" />
                    <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                        :value="old('author')" required autofocus autocomplete="author" />
                    <x-input-error :messages="$errors->get('author')" class="mt-2" />
                </div>

                <!-- Publisher -->
                <div class="mt-4">
                    <x-input-label for="publisher" :value="__('Penerbit')" />
                    <x-text-input id="publisher" class="block mt-1 w-full" type="text" name="publisher"
                        :value="old('publisher')" required autofocus autocomplete="publisher" />
                    <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea name="description" id="description"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        rows="5" required autofocus autocomplete="description">
                        {{ old('description') }}
                    </textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Shell Code -->
                <div class="mt-4">
                    <x-input-label for="shell_code" :value="__('Kode Rak')" />
                    <x-text-input id="shell_code" class="block mt-1 w-full" type="text" name="shell_code"
                        :value="old('shell_code')" required autofocus autocomplete="shell_code" placeholder="4 karakter" />
                    <x-input-error :messages="$errors->get('shell_code')" class="mt-2" />
                </div>

                <button type="submit" class="w-full py-2 rounded text-white mt-5 bg-slate-700">Tambah</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>
