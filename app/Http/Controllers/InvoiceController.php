<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Guest;
use App\Models\Reservation;

class InvoiceController extends Controller
{
    public function __construct()
    {
        // Only admin and employee can manage invoices
        $this->middleware('permission:manage-invoices')->only([
            'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with(['guest', 'reservation'])->latest()->paginate(10);
        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guests = Guest::all();
        $reservations = Reservation::with('room')->get();
        return view('invoice.create', compact('guests', 'reservations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'reservation_id' => 'required|exists:reservations,id',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after:invoice_date',
            'notes' => 'nullable|string',
            'tax_amount' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.total_price' => 'required|numeric|min:0',
        ]);

        // Calculer le sous-total
        $subtotal = 0;
        foreach ($request->items as $item) {
            $subtotal += $item['total_price'];
        }

        // Calculer le total
        $total = $subtotal + $request->tax_amount;

        // Générer un numéro de facture unique
        $invoiceNumber = 'INV-' . date('Y') . '-' . str_pad(Invoice::count() + 1, 5, '0', STR_PAD_LEFT);

        // Créer la facture
        $invoice = Invoice::create([
            'reservation_id' => $request->reservation_id,
            'guest_id' => $request->guest_id,
            'invoice_number' => $invoiceNumber,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'subtotal' => $subtotal,
            'tax_amount' => $request->tax_amount,
            'total_amount' => $total,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        // Créer les articles de la facture
        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['total_price'],
            ]);
        }

        return redirect()->route('invoices.index')
            ->with('success', 'Facture créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['guest', 'reservation.room.hotel', 'items']);
        return view('invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $invoice->load('items');
        $guests = Guest::all();
        $reservations = Reservation::with('room')->get();
        return view('invoice.edit', compact('invoice', 'guests', 'reservations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'reservation_id' => 'required|exists:reservations,id',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after:invoice_date',
            'notes' => 'nullable|string',
            'tax_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,overdue,cancelled',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.total_price' => 'required|numeric|min:0',
        ]);

        // Calculer le sous-total
        $subtotal = 0;
        foreach ($request->items as $item) {
            $subtotal += $item['total_price'];
        }

        // Calculer le total
        $total = $subtotal + $request->tax_amount;

        // Mettre à jour la facture
        $invoice->update([
            'reservation_id' => $request->reservation_id,
            'guest_id' => $request->guest_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'subtotal' => $subtotal,
            'tax_amount' => $request->tax_amount,
            'total_amount' => $total,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        // Supprimer les anciens articles
        $invoice->items()->delete();

        // Créer les nouveaux articles
        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['total_price'],
            ]);
        }

        return redirect()->route('invoices.index')
            ->with('success', 'Facture mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        // Supprimer les articles de la facture
        $invoice->items()->delete();
        
        // Supprimer la facture
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Facture supprimée avec succès.');
    }
}