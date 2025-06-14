@php
    $dataGemba = $combinedData['dataGemba'] ?? [];
    $dataSchedule = $combinedData['dataSchedule'] ?? [];
    $maxLength = max(count($dataGemba), count($dataSchedule));
@endphp

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('myChart').getContext('2d');
        let myChart;
        let selectedStartDate = null;
        let selectedEndDate = null;

        function updateChart(completedGembas, outstandingGembas) {
            if (myChart) {
                myChart.data.datasets[0].data = [completedGembas, outstandingGembas];
                myChart.update();
            } else {
                myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Completed Gemba', 'Outstanding Gemba'],
                        datasets: [{
                            label: 'Gemba Progress',
                            data: [completedGembas, outstandingGembas],
                            backgroundColor: ['#4C86F5', '#D3D3D3'],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            tooltip: {
                                enabled: true
                            }
                        }
                    }
                });
            }
        }

        flatpickr("#dateRangeFilter", {
            mode: "range",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates) {
                selectedStartDate = selectedDates[0];
                selectedEndDate = selectedDates[1];

                // Perform AJAX request to fetch data based on selected date range
                fetch(`/fetch-gemba-data?start=${selectedStartDate.toISOString().split('T')[0]}&end=${selectedEndDate.toISOString().split('T')[0]}`)
                    .then(response => response.json())
                    .then(data => {
                        updateChart(data.completedGembas, data.outstandingGembas);
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }
        });

        document.getElementById('generateReportButton').addEventListener('click', function() {
            if (selectedStartDate && selectedEndDate) {
                window.open(`/generate-gemba-report?start=${selectedStartDate.toISOString().split('T')[0]}&end=${selectedEndDate.toISOString().split('T')[0]}`, '_blank');
            } else {
                alert('Please select a date range first.');
            }
        });

        // Initial chart rendering with default data
        updateChart(@json($completedGembas ?? 0), @json($outstandingGembas ?? 0));
    });
</script>

<x-layout.main>
    <div class="container">
        <div class="columns">
            <!-- Left column for dashboard table -->
            <div class="column is-two-thirds">
                <h2 class="title is-2 is-italic">Dashboard</h2>
                @if ($maxLength > 0)
                    <table class="table is-striped is-fullwidth">
                        <thead>
                        <tr>
                            <th>Location</th>
                            <th>Date</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for ($i = 0; $i < min(5, $maxLength); $i++)
                            <tr>
                                  <td>
                                @isset($dataGemba[$i])
                                    <a href="{{ route('gembas.show', ['gemba' => $dataGemba[$i]->id]) }}">
                                        {{ $dataGemba[$i]->location }}
                                    </a>
                                @else
                                    &nbsp;<p> - </p>
                                @endisset
                            </td>
                            <td>
                                @isset($dataGemba[$i])
                                    <a href="{{ route('gembas.show', ['gemba' => $dataGemba[$i]->id]) }}">
                                        {{ $dataGemba[$i]->date }}
                                    </a>
                                @else
                                    &nbsp;<p> - </p>
                                @endisset
                            </td>
                            <td>
                                @isset($dataSchedule[$i])
                                    <a href="{{ route('schedules.index', ['id' => $dataSchedule[$i]->id]) }}">
                                        {{ $dataSchedule[$i]->first_name }}
                                    </a>
                                @else
                                    &nbsp;<p> - </p>
                                @endisset
                            </td>
                            <td>
                                @isset($dataSchedule[$i])
                                    <a href="{{ route('schedules.index', ['id' => $dataSchedule[$i]->id]) }}">
                                        {{ $dataSchedule[$i]->last_name }}
                                    </a>
                                @else
                                    &nbsp;<p> - </p>
                                @endisset
                            </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                @else
                    <p>No Gemba Data and Schedule available.</p>
                @endif
            </div>

            <!-- Right column for chart and filter -->
            <div class="column is-one-third">
                <div class="box">
                    <h1 class="title has-text-centered">Gemba Progress Overview</h1>
                    <div class="field" style="text-align: center;">
                        <label class="label" for="dateRangeFilter">Select Date Range:</label>
                        <div class="control">
                            <input type="text" id="dateRangeFilter" class="input is-primary" placeholder="Select Date Range" readonly="readonly" style="width: 80%; margin: auto;">
                        </div>
                    </div>
                    <div class="box" style="width: 100%; height: 400px; margin: auto;">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div style="text-align: center; margin-top: 20px;">
                        <button id="generateReportButton" class="button is-info">View Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.main>
