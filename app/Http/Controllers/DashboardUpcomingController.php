<?php
namespace App\Http\Controllers;

use App\Models\DashboardGemba;
use App\Models\DashboardName;
use App\Models\Gemba;
use Illuminate\Http\Request;

class DashboardUpcomingController extends Controller
{
    public function index()
    {
        // Get the data from the two tables
        $dataGemba = DashboardGemba::select('id', 'location', 'date')->get();
        $dataSchedule = DashboardName::select('id', 'first_name', 'last_name')->get();
  
// Count the number of completed and outstanding gembas
$completedGembas = Gemba::where('status', 'Closed')->count();
$outstandingGembas = Gemba::where('status', 'Open')->count();
      
            // Combine the data into a single array
        $combinedData = [
            'dataGemba' => $dataGemba,
            'dataSchedule' => $dataSchedule
        ];

return view('welcome', ['combinedData' => $combinedData, 'completedGembas' => $completedGembas, 'outstandingGembas' => $outstandingGembas]);
}

public function fetchGembaData(Request $request)
{
$startDate = $request->query('start');
$endDate = $request->query('end');

// Fetch filtered data based on date range
$completedGembas = Gemba::where('status', 'Closed')
->whereBetween('date', [$startDate, $endDate])
->count();

$outstandingGembas = Gemba::where('status', 'Open')
->whereBetween('date', [$startDate, $endDate])
->count();

return response()->json([
'completedGembas' => $completedGembas,
'outstandingGembas' => $outstandingGembas,
]);
}
}
