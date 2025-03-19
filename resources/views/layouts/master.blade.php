<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EnvoByte Task</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


    <header class="bg-green-600 p-5 flex justify-around items-center">
        <div>
            <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-white">EnvoByte Task</h1>
        </div>
        <div>
            <div class="relative flex justify-center items-center">

                    <input type="text" placeholder="Search product..." id="searchInput"
                        class="search-input">
                    <i class="fa fa-search absolute left-3 top-3 text-white"></i>
                    <button class="mx-2 text-xl text-white bg-green-700 rounded px-4 p-1" onclick="searchProduct()">search</button>
                    <button onclick="openCart()" class="bg-green-400 text-white px-4 py-2 rounded-md hover:bg-green-500">
                        🛒 Cart (<span id="cartCount">0</span>)
                    </button>
            </div>
        </div>
    </header>
    <div class="min-h-[75vh]">
        @yield('content')
    </div>

    <footer class="bg-green-600 text-white p-5">
        <div class="container mx-auto text-center">
            <h1 class="text-lg font-semibold">All rights reserved &copy; 2025 Omor Faruk</h1>
        </div>
    </footer>
    <script src="{{ asset('assets/js/script.js') }}"></script>


</body>

</html>
