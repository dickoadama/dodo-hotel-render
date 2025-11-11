<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashRegister;

class CashRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashRegisters = CashRegister::all();
        return view('cashregister.index', compact('cashRegisters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cashregister.create');
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
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'balance' => 'required|numeric|min:0',
            'is_active' => 'required|boolean'
        ]);

        CashRegister::create($request->all());

        return redirect()->route('cash-registers.index')
            ->with('success', 'Caisse créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CashRegister $cashRegister)
    {
        $cashRegister->load('transactions');
        return view('cashregister.show', compact('cashRegister'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CashRegister $cashRegister)
    {
        return view('cashregister.edit', compact('cashRegister'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashRegister $cashRegister)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'balance' => 'required|numeric|min:0',
            'is_active' => 'required|boolean'
        ]);

        $cashRegister->update($request->all());

        return redirect()->route('cash-registers.index')
            ->with('success', 'Caisse mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashRegister $cashRegister)
    {
        $cashRegister->delete();

        return redirect()->route('cash-registers.index')
            ->with('success', 'Caisse supprimée avec succès.');
    }
}