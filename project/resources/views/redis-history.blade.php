@extends('layouts.app')
@section('content')
    <h1>Redis history</h1>
    <table class="redisHistory table table-striped">
        <thead>
        <tr>
            <th scope="col">Key</th>
            <th scope="col">Processed</th>
            <th scope="col">Status</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $item)
            <tr>
                <td>{{$key}}</td>
                <td>{{$item['processed']}}</td>
                <td>{{$item['status']}}</td>
                <td>{{$item['start_at']}}</td>
                <td>{{$item['end_at']}}</td>
            </tr>
        @endforeach
    </table>
@endsection
