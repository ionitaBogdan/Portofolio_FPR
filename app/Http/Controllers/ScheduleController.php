<?php

namespace App\Http\Controllers;

use App\Models\Gemba;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentDate = now();
        $startDate = $currentDate->copy()->subMonths(6)->startOfWeek();
        $endDate = $currentDate->copy()->addMonths(6)->endOfWeek();

        $locationFilter = $request->input('location');
        $teamLeadFilter = $request->input('team_lead');
        $weekFilter = $request->input('week');
        $quarterFilter = $request->input('quarter');

        $weeks = [];
        $currentWeek = $startDate->copy();

        while ($currentWeek->lessThanOrEqualTo($endDate)) {
            $startOfWeek = $currentWeek->copy();
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            $query = Gemba::whereBetween('date', [$startOfWeek, $endOfWeek]);

            if ($locationFilter) {
                $query->where('location', $locationFilter);
            }

            if ($teamLeadFilter) {
                $query->where('team_lead', $teamLeadFilter);
            }

            if ($quarterFilter) {
                $year = $currentDate->year;
                switch ($quarterFilter) {
                    case '1':
                        $startQuarter = Carbon::createFromDate($year, 1, 1)->startOfDay();
                        $endQuarter = Carbon::createFromDate($year, 3, 31)->endOfDay();
                        break;
                    case '2':
                        $startQuarter = Carbon::createFromDate($year, 4, 1)->startOfDay();
                        $endQuarter = Carbon::createFromDate($year, 6, 30)->endOfDay();
                        break;
                    case '3':
                        $startQuarter = Carbon::createFromDate($year, 7, 1)->startOfDay();
                        $endQuarter = Carbon::createFromDate($year, 9, 30)->endOfDay();
                        break;
                    case '4':
                        $startQuarter = Carbon::createFromDate($year, 10, 1)->startOfDay();
                        $endQuarter = Carbon::createFromDate($year, 12, 31)->endOfDay();
                        break;
                }
                $query->whereBetween('date', [$startQuarter, $endQuarter]);
            }

            // Apply week filter if specified
            if ($weekFilter) {
                try {
                    $weekStart = Carbon::parse($weekFilter)->startOfWeek();
                    $weekEnd = $weekStart->copy()->endOfWeek();
                    $query->whereBetween('date', [$weekStart, $weekEnd]);
                } catch (\Exception $e) {
                    // Handle invalid week format
                }
            }

            $gemba = $query->first();

            if (!$gemba) {
                if (!$locationFilter && !$teamLeadFilter && !$weekFilter && !$quarterFilter) {
                    $gemba = new Gemba();
                    $gemba->id = 'null';
                    $gemba->date = $startOfWeek;
                    $gemba->location = '';
                    $gemba->team_lead = '';
                    $gemba->status = 'Not exist';
                    $gemba->color = '#ededed';
                }
            } else if (is_null($gemba->color)) {
                $gemba->color = getLocationColor($gemba->location);
                $gemba->save();
            }

            if ($gemba) {
                $weeks[] = $gemba;
            }

            $currentWeek->addWeek();
        }

        if ($weekFilter) {
            try {
                $weekStart = Carbon::parse($weekFilter)->startOfWeek();
                $weekEnd = $weekStart->copy()->endOfWeek();
                $weeks = array_filter($weeks, function($week) use ($weekStart, $weekEnd) {
                    return $week->date->between($weekStart, $weekEnd);
                });
            } catch (\Exception $e) {
            }
        }

        $perPage = 13;
        $currentPage = $request->input('page', 1);
        $totalFilteredBlocks = count($weeks);
        $pagedWeeks = array_slice($weeks, ($currentPage - 1) * $perPage, $perPage);

        $paginator = new LengthAwarePaginator(
            $pagedWeeks,
            $totalFilteredBlocks,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Get unique locations and team leads for the filters
        $locations = Gemba::distinct('location')->pluck('location')->toArray();
        $locationColors = [];

        foreach ($locations as $location) {
            $locationColors[$location] = getLocationColor($location);
        }

        $team_leads = Gemba::distinct('team_lead')->pluck('team_lead')->toArray();

        return view('schedules.index', [
            'gembas' => $paginator,
            'locations' => $locations,
            'locationColors' => $locationColors,
            'team_leads' => $team_leads,
            'locationFilter' => $locationFilter,
            'teamLeadFilter' => $teamLeadFilter,
            'weekFilter' => $weekFilter,
            'quarterFilter' => $quarterFilter,
        ]);
    }

    public function show($id)
    {
    }

    /**
     * Show the form for creating a new Gemba with pre-selected date.
     */
    public function createWithDate($date)
    {
        $managers = User::role('manager')->get(); // Assuming you are using Spatie's Laravel Permission package
        return view('gembas.create-with-date', compact('date', 'managers'));
    }


}
