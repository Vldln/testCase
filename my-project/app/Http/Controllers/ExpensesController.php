<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseResource;
use App\Models\Expenses;
use App\Models\Transactions;
use App\Models\Groups;
use App\Models\SplitOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                'split_option_id' => 'required|numeric',
                'description' => 'required|string',
                'group_id' => 'required|numeric',
                'members' => 'nullable',
                'exact_user' => 'numeric|nullable',
                'recipient_id' => 'numeric',

            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Wrong data!'], 412);
        }

        $item = new Expenses();
        $item->group_id = $request->group_id;
        $item->amount = $request->amount;
        $item->description = $request->description;
        $item->percent = $request->percent;
        $item->split_option_id = $request->split_option_id;
        $item->user_id = Auth::id();

        $item->save();

        // $groupMembers = Groups::find($request->group_id)->members;
        $split_option = SplitOptions::find($request->split_option_id)->name;

        if ($split_option === "EXACT") {
            $transaction = new Transactions;
            $transaction->recipient_id = $request->exact_user;
            $transaction->expenses_id = $item->id;
            $transaction->pay_amount = $request->amount;
            $transaction->user_id = Auth::id();
        } else {
            foreach ($request->members as $user) {
                if ($user['id'] !== Auth::id()) {
                    $transaction = new Transactions;
                    $transaction->recipient_id = Auth::id();
                    $transaction->expenses_id = $item->id;
                    $transaction->groups_id = $request->group_id;
                    $transaction->user_id = $user['id'];
                    if ($split_option === "PERCENT") {
                        $transaction->pay_amount = ($request->amount * (1 - ($user['percent'] / 100)));
                    } else {
                        $transaction->pay_amount = $request->amount  / count($request->members) + 1;
                    }
                    $transaction->save();
                }
            }
        }


        if ($item) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
}
