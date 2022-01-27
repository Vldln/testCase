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

class GroupsController extends Controller
{
    public function single(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Wrong data!'], 412);
        }

        $item = Groups::find($request->id);
        if ($item) {
            return response()->json(['success' => true, 'item' => new GroupResource($item)]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:300|min:2',
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Wrong data!'], 412);
        }

        $item = new Groups;
        $item->name = $request->name;
        $item->user_id = Auth::id();
        $item->save();

        if ($item) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function delete(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'numeric',
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Wrong data!'], 412);
        }

        $item = Groups::find($request->id);


        if ($item->user_id === Auth::id()) {
            $item->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
    public function update(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'numeric',
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Wrong data!'], 412);
        }

        $item = Groups::find($request->id);
        if ($item && $item->user_id === Auth::id()) {
            $item->name = $request->name;
            $item->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
    public function index(Request $request)
    {
        $items = Groups::with('members')->paginate();

        if ($items) {
            return response()->json(['success' => true, 'items' => new GroupCollection($items)]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function invite(Request $request)
    {
        $items = Groups::paginate();
        if ($items) {
            return response()->json(['success' => true, 'items' => new GroupCollection($items)]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
    public function expenses(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Wrong data!'], 412);
        }
    }
    public function members(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Wrong data!'], 412);
        }

        $item = Groups::find($request->id)->members();
        if ($item) {
            return response()->json(['success' => true, 'item' => new GroupResource($item)]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
}
