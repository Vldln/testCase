<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Models\Groups;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Throwable;

class UsersController extends Controller
{

    public function ownerGroups(Request $request)
    {
        $items = User::find(Auth::id())->groupsOwner()->with('members')->paginate();

        if ($items) {
            return response()->json(['success' => true, 'items' => new GroupCollection($items)]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
    public function memberGroups(Request $request)
    {
        $items = User::find(Auth::id())->groupsMember()->with('members')->paginate();

        if ($items) {
            return response()->json(['success' => true, 'items' => new GroupCollection($items)]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
}
