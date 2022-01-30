<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    public function expense()
    {
        return $this->belongsTo(Expenses::class, 'expenses_id', 'id');
    }
}
