<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Income extends Model
{
    protected $fillable = ['items', 'total_amount', 'income_date', 'proof_image', 'notes', 'created_by'];

    protected $casts = [
        'income_date' => 'date',
        'total_amount' => 'integer',
        'items' => 'array', // Cast JSON ke array
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
