<x-dashboard-layout>
    <div class="p-4 sm:ml-64">
        <div class="py-5 w-1/2 shadow-lg px-5 roudned-xl">
            <h1 class="text-xl font-bold my-5">Edit Data Genre</h1>
            <form action="/dashboard/genre/{{ $genre->id }}" method="post">
                @method('put')
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $genre->name)"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                        :value="old('description', $genre->description)" required autofocus autocomplete="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <button type="submit" class="w-full py-2 rounded text-white mt-5 bg-slate-700">Simpan</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>
