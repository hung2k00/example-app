@include('main.header')
    <div class="content">
        @yield('content')
    </div>
    <div id="app">
        <category-create></category-create>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
