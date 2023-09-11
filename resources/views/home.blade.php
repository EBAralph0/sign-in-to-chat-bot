@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{ __('You are logged in!') }}
    <h1>Enroler un client</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="form-group mb-1">
            <label for="firstName">Nom(s)</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="{{ old('firstName') }}">
        </div>
        <div class="form-group mb-1">
            <label for="lastName">Prenom(s)</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="{{ old('lastName') }}">
        </div>
        <div class="form-group mb-1">
            <label for="sex">Sexe</label>
            <select class="form-control" name="sex" id="sex" value="{{ old('sex') }}">
              <option>Homme</option>
              <option>Femme</option>
            </select>
        </div>
        <div class="form-group mb-1">
            <label for="whatsapp">Numero de telephone Whatsapp</label>
            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}">
        </div>
        <div class="form-group mb-1">
            <label for="telephone">Numero de telephone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}">
        </div>
        <div class="form-group mb-1">
            <label for="accountNumber">Numero de compte</label>
            <input type="text" class="form-control" id="accountNumber" name="accountNumber" value="{{ old('accountNumber') }}">
        </div>
        <div class="form-group mb-1">
            <label for="typeAuth">Mode d'authentification</label>
            <select class="form-control" name="typeAuth" id="typeAuth" value="{{ old('typeAuth') }}">
              <option>SMS</option>
              <option>Mail</option>
            </select>
        </div>
        <!-- Ajoutez ici d'autres champs du formulaire -->
        <button type="" class="btn btn-primary m-2">Enroler</button>
        <button type="reset" class="btn btn-secondary m-2">Annuler</button>
    </form>
                
</div>
@endsection
