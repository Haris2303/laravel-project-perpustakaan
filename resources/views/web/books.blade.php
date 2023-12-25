<x-app-layout>
    <div class="xl:w-3/4 mx-auto mb-20">
        <div class="mt-5 text-center">
            <h1 class="text-2xl font-bold">Halo, {{ auth()->user()->name }}</h1>
            <p class="w-1/2 mx-auto mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore minima
                explicabo
                quia
                nihileius.</p>
            <div class="mt-5">
                <input type="text" name="search" placeholder="Cari buku.."
                    class="w-96 h-9 px-5 focus:border-none rounded-full border border-green-400 shadow-lg bg-gray-200">
            </div>

            <div class="text-start mt-10 mb-5">
                <h3 class="text-lg">List Buku Terbaru</h3>
            </div>

            <div class="flex md:flex-row flex-col text-start gap-7">
                @foreach ($books as $item)
                    <div class="lg:w-1/4">
                        <a href="/book/">
                            <img src="/img/cover/{{ $item->cover }}" alt="" class="w-full object-cover">
                        </a>
                        <div class="px-1">
                            <div class="mt-2 font-bold text-xl">
                                <h3>{{ $item->title }}</h3>
                            </div>
                            <div class="mt-1">
                                <h4>{{ $item->description }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
