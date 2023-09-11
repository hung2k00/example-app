@extends('main.header')
@section('content')
    <div id="app">
        <category-edit :categories="{{ $categories }}"></category-edit>
    </div>
@endsection
