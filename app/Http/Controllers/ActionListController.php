<?php

namespace App\Http\Controllers;

use App\Models\Gemba;
use Illuminate\Http\Request;
use App\Models\ActionList;
use App\Imports\ActionListImport;
use App\Exports\ActionListExport;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ActionListController extends Controller
{
    public function index()
    {
        $actionLists = ActionList::all();
        return view('actions.index', compact('actionLists'));
    }

    public function create(Gemba $gemba)
    {
        Session::put('previous_url', url()->previous());
        return view('actions.create', [
            'gemba_id' => $gemba->id
        ]);
    }

    public function store(Request $request, Gemba $gemba)
    {
        $validated = $request->validate([
            'date_raised' => 'required|date',
            'location' => 'required|string',
            'improvements' => 'required|string',
            'gemba_id' => 'required|exists:gembas,id',
            'due_date' => 'required|date',
            'title' => 'required|string',
        ]);

        $validated['manager_id'] = $gemba->manager_id;

        $actionList = ActionList::create($validated);

        return redirect(Session::get('previous_url'))->with('success', 'Action List successfully created');
    }

    public function show(ActionList $actionList)
    {
        return view('actions.show', [
            'actionList' => $actionList
        ]);
    }

    public function edit(ActionList $actionList)
    {
        Session::put('previous_url', url()->previous());
        return view('actions.edit', [
            'actionList' => $actionList
        ]);
    }

    public function update(Request $request, ActionList $actionList)
    {
        $validated = $request->validate([
            'location' => 'required',
            'improvements' => 'required',
            'status' => 'required',
            'date_complete' => 'nullable|date',
        ]);

        $actionList->update($validated);

        return redirect()->route('actions.show', $actionList)
            ->with('success', 'Action List successfully updated');
    }

    public function editComment(ActionList $actionList)
    {
        Session::put('previous_url', url()->previous());
        return view('actions.editComment', [
            'actionList' => $actionList
        ]);
    }

    public function updateComment(Request $request, ActionList $actionList)
    {
        $validated = $request->validate([
            'date_complete' => 'nullable|date',
            'comment' => 'nullable|string',
            'comment_img' => 'nullable|image',
            'activity_transport' => 'nullable|string',
            'activity_inv' => 'nullable|string',
            'activity_motion' => 'nullable|string',
            'activity_waiting' => 'nullable|string',
            'activity_overprocess' => 'nullable|string',
            'activity_overproduct' => 'nullable|string',
            'activity_defect' => 'nullable|string',
            'activity_skills' => 'nullable|string'
        ]);

        if ($request->hasFile('comment_img')) {
            if ($actionList->comment_img) {
                Storage::disk('public')->delete($actionList->comment_img);
            }

            $filePath = $request->file('comment_img')->store('comment_images', 'public');
            $validated['comment_img'] = $filePath;
        }

        $actionList->update($validated);

        return redirect()->route('actions.show', $actionList)
            ->with('success', 'Comment successfully updated');
    }

    public function destroy(ActionList $actionList)
    {
        $actionList->delete();

        return redirect()->route('actions.index')
            ->with('success', 'Action List successfully deleted');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx'
        ]);

        try {
            Excel::import(new ActionListImport, $request->file('excel'));
            return redirect()->route('actions.index')
                ->with('success', 'Action List successfully imported');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->route('actions.index')
                ->with('importFailures', $failures);
        } catch (\Exception $e) {
            return redirect()->route('actions.index')
                ->with('error', 'There was an error importing the file: ' . $e->getMessage());
        }
    }

    public function exportExcel()
    {
        return Excel::download(new ActionListExport, 'action_list.xlsx');
    }

    public function downloadTemplate()
    {
        $filePath = storage_path('app/templates/action_list_template.xlsx');
        return response()->download($filePath, 'action_list_template.xlsx');
    }
}
