@include('main.header')
    <div class="content">
        @yield('content')
    </div>
    <div id="app">
        <hotel-create></hotel-create>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>

