<nav
    class="xl:w-3/4 mt-5 mx-auto py-2 shadow rounded-lg bg-green-300 flex justify-around sm:flex-row flex-col sm:text-start text-center sm:gap-0 gap-3">
    <!-- Primary Navigation Menu -->
    <a href="" class="hover:text-gray-600 transition-all">List Buku</a>
    <a href="" class="hover:text-gray-600 transition-all">Peminjaman Buku</a>
    <a href="" class="hover:text-gray-600 transition-all">About</a>
    @if (auth()->user()->is_admin)
        <a href="/dashboard/members" class="hover:text-gray-600 transition-all">Dashboard</a>
    @endif
    <form action="/logout" method="post">
        @csrf
        <button href="" class="hover:text-gray-600 transition-all">Logout</button>
    </form>
</nav>
