<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Demo Laravel mix Vue</title>
</head>

<body>
    <header class="flex justify-center content-center gap-16 bg-red-300 h-16">
        <div class="py-4">
            <a href="{{ url('/') }}" class="flex gap-2">
                <i class="fa-solid fa-house mt-3 fa-xl" style="color: #cbd0d7;"></i>
                <p class="header_p text-xl text-green-200">Home</p>
            </a>
        </div>
        <div class="py-4">
            <a href="{{ url('/category') }}">
                <p class="header_p text-xl text-green-200">Category</p>
            </a>
        </div>
        <div class="py-4">
            <a href="{{ url('/hotel') }}">
                <p class="header_p text-xl text-green-200">Hotel</p>
            </a>
        </div>
        @if (Auth::check())
            <div class="py-4">
                <a href="{{ route('account.logout') }}" onclick="logout()">
                    <p class="header_p text-xl text-green-200">Logout</p>
                </a>
            </div>
            <div class="py-4">
                <a href="{{ route('change_pass') }}">
                    <p class="header_p text-xl text-green-200">Change Password </p></a>
            </div>
        @else
            <div class="py-4">
                <a href="{{ route('login') }}" id="showPopup">
                    <p class="header_p text-xl text-green-200">Login</p>
                </a>
            </div>
            <div class="py-4">
                <a href="{{ route('register') }}">
                    <p class="header_p text-xl text-green-200">Register</p>
                </a>
            </div>
        @endif
    </header>
    <div id="content">
        @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
