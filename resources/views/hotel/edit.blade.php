@extends('main.header')
@section('content')
    <div id="app">
        <hotel-edit :hotels="{{ $hotels }}" :categories="{{ $categories }}"></hotel-edit>
    </div>
@endsection
