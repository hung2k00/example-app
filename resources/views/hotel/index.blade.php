@include('main.header')
<div class="content">
    @yield('content')
</div>
<div id="app">
    <hotel-list class="relative">
    </hotel-list>
</div>
<script src="{{ mix('js/app.js') }}"></script>

