<?php

namespace App\Http\Controllers;

use App\Models\Gemba;
use App\Models\User;
use App\Models\ActionList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GembaController extends Controller
{
    public function index()
    {
        $gembas = Gemba::orderBy('date', 'desc')->take(10)->get();
        return view('gembas.index', compact('gembas'));
    }

    public function generateGembaReport(Request $request)
    {
        $startDate = $request->query('start');
        $endDate = $request->query('end');

        $gembas = Gemba::with('names')->whereBetween('date', [$startDate, $endDate])->get();
        return view('gembas.report', ['gembas' => $gembas, 'startDate' => $startDate, 'endDate' => $endDate]);
    }

    public function create()
    {
        $managers = User::role('manager')->get();
        return view('gembas.create', compact('managers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required',
            'team_lead' => 'required',
            'date' => 'required|date',
            'manager_id' => 'required|exists:users,id',
        ]);

        $validated['color'] = getLocationColor($validated['location']);
        $gemba = Gemba::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Gemba successfully created');
    }

    public function show(Gemba $gemba)
    {
        return view('gembas.show', compact('gemba'));
    }

    public function edit(Gemba $gemba)
    {
        Log::info('Attempting to edit gemba.', [
            'user_id' => auth()->user()->id,
            'gemba_id' => $gemba->id,
            'gemba_manager_id' => $gemba->manager_id,
        ]);

        try {
            $this->authorize('update', $gemba);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'You are not authorised');
        }

        $managers = User::role('manager')->get();
        return view('gembas.edit', compact('gemba', 'managers'));
    }

    public function update(Request $request, Gemba $gemba)
    {
        Log::info('Attempting to update gemba.', [
            'user_id' => auth()->user()->id,
            'gemba_id' => $gemba->id,
            'gemba_manager_id' => $gemba->manager_id,
        ]);

        try {
            $this->authorize('update', $gemba);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'You are not authorised');
        }

        $validated = $request->validate([
            'location' => 'required',
            'status' => 'required',
            'date' => 'required|date',
            'manager_id' => 'required|exists:users,id',
        ]);

        $color = getLocationColor($validated['location']) ?? '#ededed';

        $gemba->update([
            'location' => $validated['location'],
            'status' => $validated['status'],
            'date' => $validated['date'],
            'manager_id' => $validated['manager_id'],
            'color' => $color,
        ]);

        ActionList::where('gemba_id', $gemba->id)->update(['manager_id' => $request->manager_id]);

        return redirect()->route('gembas.show', $gemba)->with('success', 'Gemba successfully updated');
    }

    public function delete(Gemba $gemba)
    {
        return view('gembas.delete', compact('gemba'));
    }

    public function destroy(Gemba $gemba)
    {
        $gemba->delete();
        return redirect()->route('gembas.index')->with('success', 'Gemba successfully deleted');
    }

    public function processForm(Request $request)
    {
        $week = $request->input('week');
        $startOfWeek = Carbon::now()->setISODate(substr($week, 0, 4), substr($week, 6))->startOfWeek();
    }
}
