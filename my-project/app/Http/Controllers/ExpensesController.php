<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseResource;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Throwable;

class ExpensesController extends Controller
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
        $item = Expenses::find($request->id);
        if ($item) {
            return response()->json(['success' => true, 'item' => new ExpenseResource($item)]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'amount' => 'required|numeric',
                'split_option' => 'required|numeric',
                'description' => 'required|string',
                'group_id' => 'required|numeric',
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Wrong data!'], 412);
        }

        $item = new Expenses();
        $item->group_id = $request->group_id;
        $item->amount = $request->amount;
        $item->description = $request->description;
        $item->split_option_id = $request->split_option_id;
        $item->save();

        if ($item) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
}
