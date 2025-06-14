<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;


class ItemController extends Controller
{
    public function destroy($id)
    {
        $item = Item::findOrFail($id); // Ensure the item exists
        $item->delete(); // Delete the item

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
