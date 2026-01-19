<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Income extends Model
{
    protected $fillable = ['source', 'description', 'amount', 'income_date', 'proof_image', 'notes', 'created_by'];

    protected $casts = [
        'income_date' => 'date',
        'amount' => 'integer',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
