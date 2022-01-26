<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'amount',
        'split_option_id',
        'group_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function option()
    {
        return $this->belongsTo(SplitOptions::class, 'split_option_id', 'id');
    }
}
