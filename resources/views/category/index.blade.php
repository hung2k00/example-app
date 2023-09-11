@include('main.header')
    <div class="content">
        @yield('content')
    </div>
    <div id="app" class="bg-orange-300">
        <category-list></category-list>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>

