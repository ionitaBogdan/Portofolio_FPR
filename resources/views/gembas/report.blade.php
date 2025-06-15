@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="title">Gemba Report</h1>
        <h2 class="subtitle">From {{ $startDate }} to {{ $endDate }}</h2>
        @if ($gembas->count() > 0)
            <table class="table is-striped">
                <thead>
                <tr>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Team Lead</th>
                    <th>Members</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($gembas as $gemba)
                    <tr>
                        <td>{{ $gemba->location }}</td>
                        <td>{{ $gemba->date->format('Y-m-d') }}</td>
                        <td>{{ $gemba->status }}</td>
                        <td>{{ $gemba->team_lead }}</td>
                        <td>
                            @foreach ($gemba->names as $name)
                                {{ $name->first_name }} {{ $name->last_name }}@if (!$loop->last), @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p><strong> No Gemba data available for the selected date range.</strong></p>
        @endif
    </div>
@endsection
