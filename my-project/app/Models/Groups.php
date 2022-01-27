<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requests()
    {
        return $this->hasMany(Requests::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'requests', 'groups_id', 'member_id');
    }
}
