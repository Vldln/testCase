<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function expenses()
    {
        // if (Auth::id() !== $this->first()->user_id) {
        //     $DateRequest = User::find(Auth::id())->invites()->where('groups_id', $this->first()->id)->first()->created_at;
        //     return $this->hasMany(Expenses::class, 'group_id', 'id')->where('created_at', ">", $DateRequest);
        // } else {
        //     return $this->hasMany(Expenses::class, 'group_id', 'id');
        // }

        $userMember = Groups::find($this->first()->id)->members()->where('id', Auth::id());
        if (Auth::id() !== $this->first()->user_id || $userMember) {
            return $this->hasMany(Expenses::class, 'group_id', 'id');
        }
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'requests', 'groups_id', 'member_id');
    }
}
