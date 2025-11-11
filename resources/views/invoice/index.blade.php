@extends('layouts.app')

@section('title', 'Gestion des Factures - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion des Factures</h1>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Liste des Factures</h2>
                <a href="{{ route('invoices.create') }}" class="btn btn-primary">Créer une Facture</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Client</th>
                            <th>Réservation</th>
                            <th>Date</th>
                            <th>Échéance</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>{{ $invoice->guest->first_name }} {{ $invoice->guest->last_name }}</td>
                            <td>Réservation #{{ $invoice->reservation->id }}</td>
                            <td>{{ $invoice->invoice_date->format('d/m/Y') }}</td>
                            <td>{{ $invoice->due_date ? $invoice->due_date->format('d/m/Y') : 'N/A' }}</td>
                            <td>{{ number_format($invoice->total_amount, 0, ',', ' ') }} FCFA</td>
                            <td>
                                @if($invoice->status == 'pending')
                                    <span class="badge bg-warning">En attente</span>
                                @elseif($invoice->status == 'paid')
                                    <span class="badge bg-success">Payée</span>
                                @elseif($invoice->status == 'overdue')
                                    <span class="badge bg-danger">En retard</span>
                                @elseif($invoice->status == 'cancelled')
                                    <span class="badge bg-secondary">Annulée</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection