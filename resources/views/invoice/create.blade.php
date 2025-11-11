@extends('layouts.app')

@section('title', 'Créer une Facture - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Créer une Facture</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="guest_id" class="form-label">Client</label>
                            <select class="form-control" id="guest_id" name="guest_id" required>
                                <option value="">Sélectionnez un client</option>
                                @foreach($guests as $guest)
                                    <option value="{{ $guest->id }}" {{ old('guest_id') == $guest->id ? 'selected' : '' }}>
                                        {{ $guest->first_name }} {{ $guest->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reservation_id" class="form-label">Réservation</label>
                            <select class="form-control" id="reservation_id" name="reservation_id" required>
                                <option value="">Sélectionnez une réservation</option>
                                @foreach($reservations as $reservation)
                                    <option value="{{ $reservation->id }}" {{ old('reservation_id') == $reservation->id ? 'selected' : '' }}>
                                        Réservation #{{ $reservation->id }} - {{ $reservation->room->room_number }} ({{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="invoice_date" class="form-label">Date de facture</label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="{{ old('invoice_date', date('Y-m-d')) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Date d'échéance</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="tax_amount" class="form-label">Montant TVA (FCFA)</label>
                    <input type="number" class="form-control" id="tax_amount" name="tax_amount" value="{{ old('tax_amount', 0) }}" step="1" min="0">
                </div>

                <h3>Articles de la facture</h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="invoice-items">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control item-description" name="items[0][description]" required></td>
                                <td><input type="number" class="form-control item-quantity" name="items[0][quantity]" value="1" min="1" required></td>
                                <td><input type="number" class="form-control item-price" name="items[0][unit_price]" step="1" min="0" required></td>
                                <td><input type="number" class="form-control item-total" name="items[0][total_price]" readonly></td>
                                <td><button type="button" class="btn btn-danger remove-item">Supprimer</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success" id="add-item">Ajouter un article</button>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 offset-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Sous-total</th>
                                    <td><span id="subtotal">0</span> FCFA</td>
                                </tr>
                                <tr>
                                    <th>TVA</th>
                                    <td><span id="tax-display">0</span> FCFA</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><span id="total">0</span> FCFA</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Créer la facture</button>
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let itemIndex = 1;

        // Ajouter un article
        document.getElementById('add-item').addEventListener('click', function() {
            const tbody = document.querySelector('#invoice-items tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" class="form-control item-description" name="items[${itemIndex}][description]" required></td>
                <td><input type="number" class="form-control item-quantity" name="items[${itemIndex}][quantity]" value="1" min="1" required></td>
                <td><input type="number" class="form-control item-price" name="items[${itemIndex}][unit_price]" step="1" min="0" required></td>
                <td><input type="number" class="form-control item-total" name="items[${itemIndex}][total_price]" readonly></td>
                <td><button type="button" class="btn btn-danger remove-item">Supprimer</button></td>
            `;
            tbody.appendChild(newRow);
            itemIndex++;
            attachEventListeners();
        });

        // Supprimer un article
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                if (document.querySelectorAll('#invoice-items tbody tr').length > 1) {
                    e.target.closest('tr').remove();
                    calculateTotals();
                }
            }
        });

        // Attacher les événements de calcul
        function attachEventListeners() {
            document.querySelectorAll('.item-quantity, .item-price').forEach(input => {
                input.addEventListener('input', calculateTotals);
            });
        }

        // Calculer les totaux
        function calculateTotals() {
            let subtotal = 0;

            document.querySelectorAll('#invoice-items tbody tr').forEach(row => {
                const quantity = parseFloat(row.querySelector('.item-quantity').value) || 0;
                const price = parseFloat(row.querySelector('.item-price').value) || 0;
                const total = quantity * price;
                
                row.querySelector('.item-total').value = total.toFixed(0);
                subtotal += total;
            });

            const tax = parseFloat(document.getElementById('tax_amount').value) || 0;
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = subtotal.toFixed(0);
            document.getElementById('tax-display').textContent = tax.toFixed(0);
            document.getElementById('total').textContent = total.toFixed(0);
        }

        // Attacher les événements initiaux
        attachEventListeners();
        document.getElementById('tax_amount').addEventListener('input', calculateTotals);
    });
</script>
@endsection