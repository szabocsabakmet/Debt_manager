@extends('layout') @section('title') Szerkesztés @endsection @section('content')
<h1>Tartozás szerkesztése</h1>

<form method="POST" action="/debts/{{$debt->id}}">
    @method('PATCH') @csrf
    <div class="form-group">
        <label for="who">Tartozó Felhasználó</label>
        <select class="form-control" name="who" required>
            @foreach ($users as $user)
            <option @if ($debt->get_payer_email($debt->payer_id)==$user->email) selected @endif>{{$user->email}}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="money">Tartozás összege</label>
        <input class="form-control" type="number" name="money" value="{{$debt->money}}">
    </div>
    <div class="form-group">
        <label for="description">Megjegyzés</label>
        <textarea class="form-control" name="description" rows="3" required>{{$debt->description}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Mentés</button>
</form>
<form method="POST" action="/debts/{{$debt->id}}">
    @csrf @method('DELETE')
    <button type="submit" class="btn btn-danger">Tartozás törlése(Végleges)</button>
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </div>
    @endif
</form>

@endsection
