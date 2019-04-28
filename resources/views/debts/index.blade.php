@extends('layout') @section('title') Debts maganer @endsection @section('content')

<h1>Szerkesztés</h1>
<table class="table">
    <thead>
        <tr>
            <th>Tartozó</th>
            <th>Összeg</th>
            <th>Megjegyzés</th>
            <th>Állapot</th>
            <th>Szerkesztés</th>
            <th>Jóváhagyás</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($debts as $item)
        {{-- @if ($item->completed===0) --}}
        <tr>
            <td scope="row">{{$item->get_payer_email($item->payer_id)}}</td>
            <td>{{$item->money}}</td>
            <td>{{$item->description}}</td>
            <td>Függőben</td>
                {{-- @if ($item->completed===1)
                <p>Rendezve</p>
                @else
                <p>Függőben</p>
                @endif
            </td> --}}
            <td><a class="btn btn-primary" href="/debts/{{$item->id}}/edit" role="button">Szerkeszt</a></td>
            <td><a class="btn btn-success" href="/debts/{{$item->id}}/complete" role="button">Jóváhagy</a></td>
        </tr>
        {{-- @endif --}}
         @endforeach
    </tbody>
</table>
<table class="table">
    <h3>Tartozásaim részletezése</h3>
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
        {{-- @if ($item->completed===0) --}}
        <tr>
            <td scope="row">{{$item->get_payer_email($item->owner_id)}}</td>
            <td>{{$item->money}}</td>
            <td>{{$item->description}}</td>
            <td>Függőben</td>
                {{-- @if ($item->completed===1)
                <p>Rendezve</p>
                @else
                <p>Függőben</p>
                @endif
            </td> --}}
            <td></td>
            <td></td>
        </tr>
        {{-- @endif --}}
        @endforeach
    </tbody>
</table>
@endsection
