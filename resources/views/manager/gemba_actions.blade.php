<x-layout.main>
<div class="container">
    <div class="columns is-centered">
        <div class="column is-12">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Actions for Gemba: {{ $gemba->location }}</p>
                </header>
                <div class="card-content">
                    <table class="table is-fullwidth is-striped is-hoverable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Due Date</th>
                                <th>Improvements</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($actions as $action)
                                <tr>
                                    <td>{{ $action->title }}</td>
                                    <td>{{ $action->due_date }}</td>
                                    <td>{{ $action->improvements }}</td>
                                    <td>{{ $action->status }}</td>
                                    <td>
                                        <a href="{{ route('actions.edit', $action) }}" class="button is-small is-info">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout.main>
