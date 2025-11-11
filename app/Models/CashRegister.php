<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'balance',
        'is_active'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Méthode pour calculer le total des entrées
    public function getTotalIncomeAttribute()
    {
        return $this->transactions()
            ->where('type', 'income')
            ->sum('amount');
    }

    // Méthode pour calculer le total des dépenses
    public function getTotalExpenseAttribute()
    {
        return $this->transactions()
            ->where('type', 'expense')
            ->sum('amount');
    }

    // Méthode pour obtenir le solde actuel
    public function getCurrentBalanceAttribute()
    {
        return $this->balance + $this->total_income - $this->total_expense;
    }
}