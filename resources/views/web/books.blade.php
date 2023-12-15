<x-app-layout>
    <div class="mt-5 mx-auto text-center">
        <h1 class="text-2xl font-bold">Halo, {{ auth()->user()->name }}</h1>
        <p class="w-1/2 mx-auto mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore minima explicabo
            quia
            nihileius.</p>
        <div class="mt-5">
            <input type="text" name="search" placeholder="Cari buku.."
                class="w-96 h-9 px-5 focus:border-none rounded-full border border-green-400 shadow-lg bg-gray-200">
        </div>
    </div>
</x-app-layout>
