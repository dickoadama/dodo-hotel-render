@extends('layouts.app')

@section('title', 'Détails de la Facture - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Détails de la Facture</h1>
                <div>
                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Modifier</a>
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Retour</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Facture #{{ $invoice->invoice_number }}</h2>
                            <p><strong>Date:</strong> {{ $invoice->invoice_date->format('d/m/Y') }}</p>
                            <p><strong>Échéance:</strong> {{ $invoice->due_date ? $invoice->due_date->format('d/m/Y') : 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p><strong>Statut:</strong> 
                                @if($invoice->status == 'pending')
                                    <span class="badge bg-warning">En attente</span>
                                @elseif($invoice->status == 'paid')
                                    <span class="badge bg-success">Payée</span>
                                @elseif($invoice->status == 'overdue')
                                    <span class="badge bg-danger">En retard</span>
                                @elseif($invoice->status == 'cancelled')
                                    <span class="badge bg-secondary">Annulée</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Client</h4>
                            <p><strong>Nom:</strong> {{ $invoice->guest->first_name }} {{ $invoice->guest->last_name }}</p>
                            <p><strong>Email:</strong> {{ $invoice->guest->email ?? 'N/A' }}</p>
                            <p><strong>Téléphone:</strong> {{ $invoice->guest->phone ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Réservation</h4>
                            <p><strong>Numéro:</strong> Réservation #{{ $invoice->reservation->id }}</p>
                            <p><strong>Chambre:</strong> {{ $invoice->reservation->room->room_number }} ({{ $invoice->reservation->room->hotel->name }})</p>
                            <p><strong>Check-in:</strong> {{ $invoice->reservation->check_in_date->format('d/m/Y') }}</p>
                            <p><strong>Check-out:</strong> {{ $invoice->reservation->check_out_date->format('d/m/Y') }}</p>
                            @if($invoice->reservation->room->hotel->geographical_location)
                                <p><strong>Situation géographique:</strong> {{ $invoice->reservation->room->hotel->geographical_location }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Articles</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Quantité</th>
                                            <th>Prix unitaire</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoice->items as $item)
                                        <tr>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->unit_price, 0, ',', ' ') }} FCFA</td>
                                            <td>{{ number_format($item->total_price, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 offset-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Sous-total</th>
                                        <td>{{ number_format($invoice->subtotal, 0, ',', ' ') }} FCFA</td>
                                    </tr>
                                    <tr>
                                        <th>TVA</th>
                                        <td>{{ number_format($invoice->tax_amount, 0, ',', ' ') }} FCFA</td>
                                    </tr>
                                    <tr>
                                        <th><strong>Total</strong></th>
                                        <td><strong>{{ number_format($invoice->total_amount, 0, ',', ' ') }} FCFA</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if($invoice->notes)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4>Notes</h4>
                            <p>{{ $invoice->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection