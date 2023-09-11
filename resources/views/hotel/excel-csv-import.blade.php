@extends('main.header')
@section('content')
<div id="app">
    <div class="container mt-5">


        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card">

            <div class="card-header font-weight-bold">
                <h2 class="float-left">Import Excel</h2>
            </div>

            <div class="card-body">

                <form id="excel-csv-import-form" method="POST" action="{{ url('/hotel/importExcel') }}"
                    accept-charset="utf-8" enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="file" name="file" placeholder="Choose file">
                            </div>
                            @error('file')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
@endsection




