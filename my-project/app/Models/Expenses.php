<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(User::class, 'group_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'expenses_id', 'id');
    }
    public function option()
    {
        return $this->belongsTo(SplitOptions::class, 'split_option_id', 'id');
    }
}
