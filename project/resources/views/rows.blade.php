@extends('layouts.app')
@section('content')
    <h1>Rows</h1>
    <div class="row">
        <pre>{!! var_export($rows, 1) !!}</pre>
    </div>
@endsection
