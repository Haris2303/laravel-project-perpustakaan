<x-dashboard-layout>
    <div class="p-4 sm:ml-64">
        <div class="py-5 w-1/2 shadow-lg px-5 roudned-xl">
            <h1 class="text-xl font-bold my-5">Pembayaran Denda</h1>
            <form action="/dashboard/returneds/payment/{{ $returned->id }}" method="post">

                @method('PUT')
                @csrf
                <!-- Waktu Dikembalikan -->
                <div>
                    <p>Denda yang harus dibayarkan sebesar {{ round($returned->late_payment / 100) }}k</p>
                </div>

                <button type="submit" class="w-full py-2 rounded text-white mt-5 bg-slate-700">Terbayar</button>
                <a href="/dashboard/returneds" class="text-white">
                    <div class="w-full py-2 rounded mt-2 bg-slate-900 text-center">
                        Kembali
                    </div>
                </a>
            </form>
        </div>
    </div>
</x-dashboard-layout>
