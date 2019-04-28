@extends('layout') @section('title') Debts maganer @endsection @section('content')

<h1>Tartozások (felém)</h1>
<table class="table">
    <thead>
        <tr>
            <th>Tartozó</th>
            <th>Összeg</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($sumdebts as $item)
        <tr>
            <td scope="row">{{$item->email}}</td>
            <td>{{$item->money}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<table class="table">
    <h1>Tartozásaim (mások felé)</h1>
    <thead>
        <tr>
            <th>Kinek tartozom</th>
            <th>Összeg</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($sumnegdebts as $item)
        <tr>
            <td scope="row">{{$item->email}}</td>
            <td>{{$item->money}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
