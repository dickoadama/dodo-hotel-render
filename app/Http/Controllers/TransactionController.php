<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\CashRegister;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Transaction::with('cashRegister');
        
        // Filtres
        if ($request->cash_register_id) {
            $query->where('cash_register_id', $request->cash_register_id);
        }
        
        if ($request->type) {
            $query->where('type', $request->type);
        }
        
        if ($request->start_date) {
            $query->where('transaction_date', '>=', $request->start_date);
        }
        
        if ($request->end_date) {
            $query->where('transaction_date', '<=', $request->end_date);
        }
        
        // Tri par date décroissante
        $query->orderBy('transaction_date', 'desc');
        
        $transactions = $query->paginate(10);
        
        // Récupérer toutes les caisses pour le filtre
        $cashRegisters = CashRegister::all();
        
        // Calculer les totaux
        $totalQuery = clone $query;
        $totalIncome = $totalQuery->where('type', 'income')->sum('amount');
        $totalExpense = $totalQuery->where('type', 'expense')->sum('amount');
        $netBalance = $totalIncome - $totalExpense;
        
        return view('transaction.index', compact(
            'transactions', 
            'cashRegisters', 
            'totalIncome', 
            'totalExpense', 
            'netBalance'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cashRegisters = CashRegister::all();
        return view('transaction.create', compact('cashRegisters'));
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
            'cash_register_id' => 'required|exists:cash_registers,id',
            'type' => 'required|in:income,expense',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string'
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('cashRegister');
        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $cashRegisters = CashRegister::all();
        return view('transaction.edit', compact('transaction', 'cashRegisters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'cash_register_id' => 'required|exists:cash_registers,id',
            'type' => 'required|in:income,expense',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string'
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction supprimée avec succès.');
    }
}