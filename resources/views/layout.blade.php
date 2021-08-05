<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Post-it Lister">
        <meta name="keywords" content="HTML CSS JavaScript">
        <meta name="author" content="Kelechi Nwa-uwa">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Post-it Lister</title>
        <link rel="stylesheet" href="../css/app.css">
    </head>
    <body>
        <header class="h-24 bg-gray-400">
            <div class="flex">
                <h1 class="text-4xl mt-6 m-auto text-center hover:text-gray-800"><a href="/">Post-it Max</a></h1>
                <div class="flex flex-col space-y-2 items-baseline p-5 pr-6">
                    @if (Session::get('user'))
                    <a href="#" class="w-full">Hi, {{Session::get('user')}}</a>
                    <a href="/logout" class="w-full hover:text-white">Logout</a>
                    @else
                    <a href="/login" class="w-full hover:text-white">Login</a>
                    <a href="/register" class="w-full hover:text-white">Register</a>
                    @endif
                </div>
            </div>
        </header>

        <div>
            @yield('content')
        </div>

        <footer>
            @yield('footer')
        </footer>
    </body>
</html>