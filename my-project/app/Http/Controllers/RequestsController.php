<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Models\Groups;
use App\Models\Requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Throwable;

class RequestsController extends Controller
{

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|string',
                'groups_id' => 'required|numeric',

            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Wrong data!'], 412);
        }

        $member = User::where('email', $request->email)->first();

        if ($member) {
            $existRequests = Requests::where([['groups_id', $request->groups_id], ['member_id', $member->id]])->first();
        } else {
            dd('существует запрос');
            return response()->json(['success' => false], 404);
        }

        if (Auth::user()->email != $request->email && !$existRequests) {
            $item = new Requests;
            $item->user_id = Auth::id();
            $item->member_id = $member->id;
            $item->groups_id = $request->groups_id;
            $item->status = 1;
            $item->save();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
