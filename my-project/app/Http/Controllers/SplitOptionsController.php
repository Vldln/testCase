<?php

namespace App\Http\Controllers;

use App\Http\Resources\SplitOptionCollection;
use App\Models\SplitOptions;
use Illuminate\Http\Request;

class SplitOptionsController extends Controller
{
    public function index(Request $request)
    {
        $items = SplitOptions::all();

        if ($items) {
            return response()->json(['success' => true, 'items' => new SplitOptionCollection($items)]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
}
