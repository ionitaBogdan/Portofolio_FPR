<x-layout.main>
    <h1 class="is-size-1 is-italic has-text-centered">Schedule</h1>
    <div class="container">
        <form method="GET" action="{{ route('schedules.index') }}" id="filter-form">
            <div class="field is-grouped">
                <div class="control">
                    <label class="label">Location</label>
                    <div class="select is-fullwidth">
                        <select name="location" onchange="this.form.submit()">
                            <option value="">All Locations</option>
                            @foreach ($locations as $location)
                                <option  value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                    {{ $location }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="control" style="margin-left: 1rem;">
                    <label class="label">Team Leader</label>
                    <div class="select">
                        <select name="team_lead" onchange="this.form.submit()">
                            <option value="">All Team Leaders</option>
                            @foreach ($team_leads as $team_lead)
                                <option value="{{ $team_lead }}" {{ request('team_lead') == $team_lead ? 'selected' : '' }}>{{ $team_lead }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="control" style="margin-left: 1rem;">
                    <label class="label">Quarter</label>
                    <div class="select">
                        <select name="quarter" onchange="this.form.submit()">
                            <option value="">All Quarters</option>
                            <option value="1" {{ request('quarter') == 1 ? 'selected' : '' }}>Q1 (Jan - Mar)</option>
                            <option value="2" {{ request('quarter') == 2 ? 'selected' : '' }}>Q2 (Apr - Jun)</option>
                            <option value="3" {{ request('quarter') == 3 ? 'selected' : '' }}>Q3 (Jul - Sep)</option>
                            <option value="4" {{ request('quarter') == 4 ? 'selected' : '' }}>Q4 (Oct - Dec)</option>
                        </select>
                    </div>
                </div>
                <div class="control" style="margin-left: 1rem;">
                    <label for="week" class="label">Week</label>
                    <input class="input" type="week" name="week" value="{{ request('week') }}" onchange="this.form.submit()">
                </div>
            </div>
            <input type="hidden" name="page" value="{{ request('page', 1) }}">
        </form>

        <div class="field">
            <div class="tags">
                @foreach ($locations as $location)
                    @php
                        $color = $locationColors[$location] ?? '#ededed';
                    @endphp
                    <span class="tag" style="background-color: {{ $color }};">{{ $location }}</span>
                @endforeach
            </div>
        </div>

        <div class="field is-grouped is-grouped-right">
            <button class="button is-warning is-light">
                <a href="{{ route('gembas.create') }}">Create</a>
            </button>
        </div>

        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <div class="columns is-mobile is-vcentered">
                    <div class="column">
                        <strong>Month | Week</strong>
                    </div>
                </div>
                @foreach ($gembas as $gemba)
                    @if(request('location') == '' || request('location') == $gemba->location)
                        <div class="columns is-mobile is-vcentered">
                            <div class="column date-m-w">
                                <h2 class="has-text-black">{{ $gemba->date->format('F') }} | {{ $gemba->date->weekOfYear }}</h2>
                            </div>
                        </div>
                    @endif
                    <div class="columns is-mobile is-vcentered">
                        <div class="column is-full">
                            @if($gemba->status == 'Not exist')
                                <a href="{{ route('gembas.create-with-date', ['date' => $gemba->date->format('Y-m-d')]) }}" class="notification is-padding-4 is-block custom-hover not-exist" style="background-color: {{ $gemba->color }};">
                                    <p class="has-text-centered is-size-5 has-text-grey">Schedule a new Gemba walk</p>
                                </a>

                            @else
                                @php
                                    $overlayClass = $gemba->status === 'Closed' ? 'closed-overlay' : '';
                                @endphp
                                <a href="{{ route('gembas.show', $gemba) }}" class="notification is-padding-4 is-block custom-hover {{ $overlayClass }} has-text-grey-darker is-size-5" style="background-color: {{ $gemba->color }};">
                                    {{ $gemba->location }}
                                    <div class="column is-full is-size-6">{{ $gemba->team_lead }}</div>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                    @if ($gembas->currentPage() > 1)
                        <a class="pagination-previous" href="{{ $gembas->previousPageUrl() }}">Previous</a>
                    @endif
                    @if ($gembas->hasMorePages())
                        <a class="pagination-next" href="{{ $gembas->nextPageUrl() }}">Next page</a>
                    @endif
                    <ul class="pagination-list">
                        @for ($page = 1; $page <= $gembas->lastPage(); $page++)
                            <li>
                                <a class="pagination-link {{ $gembas->currentPage() == $page ? 'is-current' : '' }}" href="{{ $gembas->url($page) }}">{{ $page }}</a>
                            </li>
                        @endfor
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <style>
        .custom-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .custom-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .notification.closed-overlay {
            position: relative;
        }
        .notification.closed-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.35);
            pointer-events: none;
        }
        .pagination-links {
            text-align: center;
            margin-top: 20px;
        }
        .pagination-button {
            border: none;
            background: none;
            color: inherit;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</x-layout.main>
