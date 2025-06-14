<?php

namespace App\Http\Controllers;

use App\Models\Gemba;
use App\Models\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class NameController extends Controller
{
    public function create(Gemba $gemba)
    {
        Session::put('previous_url', url()->previous());
        return view('gembas.names.create', [
            'gemba_id'=>$gemba->id
        ]);
    }
    public function store(Request $request,Gemba $gemba)
    {
        // Validate the request
        $validated = $request->validate([
           'first_name'=>'required',
            'last_name'=>'required',
            'gemba_id'=>'required'

        ]);


        $name = Name::create($validated);

        return redirect(Session::get('previous_url'))->with('success', 'Member name successfully created');
    }
}
