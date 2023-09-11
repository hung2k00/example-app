@include('main.header')
    <div class="content">
        @yield('content')
    </div>
    <div id="app">
        <category-edit :categories="{{ $categories }}"></category-edit>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
