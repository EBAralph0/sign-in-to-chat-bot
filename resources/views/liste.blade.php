@extends('layouts.app')
<style>
    .page-item.active .page-link{
        z-index: 3;
        color: #fff !important  ;
        background-color: #00ACD6 !important;
        border-color: #00ACD6 !important;
        border-radius: 50%;
        padding: 6px 12px;
    }
    .page-link{
        z-index: 3;
        color: #00ACD6 !important;
        background-color: #fff;
        border-color: #007bff;
        border-radius: 50%;
        padding: 6px 12px !important;
    }
    .page-item:first-child .page-link{
        border-radius: 30% !important;
    }
    .page-item:last-child .page-link{
        border-radius: 30% !important;   
    }
    .pagination li{
        padding: 3px;
    }
    .disabled .page-link{
        color: #212529 !important;
        opacity: 0.5 !important;
    }
</style>
@section('content')

<div class="container">

    <h1>Liste des demandes</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-success mb-3">Ajouter une demande</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>@sortablelink('lastName','Nom ↕️')</th>
                <th>Prénom</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->lastName }}</td>
                    <td>{{ $client->firstName }}</td>
                    @if($client->status=="waiting")
                    <td>En attente</td>
                    @elseif($client->status=="valid")
                    <td>Accepté</td>
                    @elseif($client->status=="reject")
                    <td>Rejeté</td>
                    @else
                    <td>---</td>
                    @endif
                    <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">Consulter</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $clients->links('vendor.pagination.custom') !!}
    </div>
</div>

@endsection