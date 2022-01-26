<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\TextUI\XmlConfiguration\Group;

class Requests extends Model
{
    use HasFactory;
    protected $fillable = [
        'groups_id',
        'user_id',
        'member_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Groups::class, 'groups_id', 'id');
    }

    public function members()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
}
