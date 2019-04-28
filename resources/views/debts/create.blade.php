@extends('layout') @section('title') Hozzáad @endsection @section('content')

<h1>Új tartozás felvétele</h1>
<form method="POST" action="/debts">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="who">Tartozó Felhasználó</label>
        <select class="form-control" name="who" required>
            @foreach ($users as $user)
            <option>{{$user->email}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="money">Tartozás összege</label>
        <input type="number" class="form-control" name="money" placeholder="Pl: 1987 HUF" required value="{{old('money')}}">
    </div>
    <div class="form-group">
        <label for="description">Megjegyzés</label>
        <textarea class="form-control" name="description" rows="3" required value="{{old('description')}}">Tartozás leírása</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Felvétel</button>
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </div>
    @endif
</form>

@endsection
