<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash_register_id',
        'type',
        'category',
        'description',
        'amount',
        'transaction_date',
        'reference',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date'
    ];

    public function cashRegister()
    {
        return $this->belongsTo(CashRegister::class);
    }
}