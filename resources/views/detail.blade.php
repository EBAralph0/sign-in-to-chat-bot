@extends('layouts.app')

@section('content')
<style>
.my_card{
    width: 49%;
    border-radius:12px;
    background-color: white;
    padding: 16px;
    display: flex;
    flex-direction: column;
    border-color: gainsboro;
    border-style: groove
}
.detail_label{
    font-size:x-large
}
.content_card{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px
}
</style>
<div class="container">
    <div class="content_card">
        <div class="my_card">
            <label for="">Information sur le client</label>
            <label class="detail_label">Nom(s) : {{ $client->lastName }}</label> 
            <label class="detail_label">Prenom(s) : {{ $client->firstName }}</label> 
            <label class="detail_label">Telephone : {{ $client->telephone }}</label> 
            <label class="detail_label">Sexe : {{ $client->sex }}</label> 
        </div>
        <div class="my_card">
            <label for="">Information sur l'enrolement</label>
            <label class="detail_label">Mode d'authentification : {{ $client->typeAuth }}</label> 
            <label class="detail_label">Statut : {{ $client->status }}</label> 
            <label class="detail_label">Whatsapp : {{ $client->whatsapp }}</label> 
            <label class="detail_label">Numero de compte : {{ $client->accountNumber }}</label> 
        </div>
    </div>
    <div class="content_card mt-5">
        <form action="{{ route('clients.validate', $client->id) }}" method="POST" class="d-inline">
            @csrf
            @method('POST')
            <button class="btn btn-success btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir valider cette demande ?')">Valider</button>
        </form>
        <form action="{{ route('clients.reject', $client->id) }}" method="POST" class="d-inline">
            @csrf
            @method('POST')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir rejeter  demande ?')">Rejeter</button>
        </form>
        <a class="btn btn-secondary btn-sm" href="{{ route('clients.index') }}">Retour</a>
    </div>
    
</div>

@endsection
