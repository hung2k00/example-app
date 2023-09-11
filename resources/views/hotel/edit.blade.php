@include('main.header')
    <div class="content">
        @yield('content')
    </div>
    <div id="app">
        <hotel-edit :hotels="{{ $hotels }}" :categories="{{ $categories }}"></hotel-edit>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>

