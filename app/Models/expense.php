<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Expense extends Model
{
    protected $fillable = ['category', 'description', 'amount', 'expense_date', 'receipt_image', 'notes', 'created_by'];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'integer',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
