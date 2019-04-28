@extends('layout') @section('title') Archiváltak @endsection @section('content')

<h1>Archivált Tartozások</h1>
<table class="table">
    <thead>
        <tr>
            <th>Tartozó</th>
            <th>Összeg</th>
            <th>Megjegyzés</th>
            <th>Állapot</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($debts as $item)
        <tr>
            <td scope="row">{{$item->get_payer_email($item->payer_id)}}</td>
            <td>{{$item->money}}</td>
            <td>{{$item->description}}</td>
            <td>Rendezve</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h1>Archivált Tartozásaim </h1>
<table class="table">
    <thead>
        <tr>
            <th>Kinek tartozom</th>
            <th>Összeg</th>
            <th>Megjegyzés</th>
            <th>Állapot</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($negdebts as $item)
        <tr>
            <td scope="row">{{$item->get_payer_email($item->owner_id)}}</td>
            <td>{{$item->money}}</td>
            <td>{{$item->description}}</td>
            <td>Rendezve</td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
