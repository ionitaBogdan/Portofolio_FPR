<x-layout.main>
<div class="container">
    <div class="columns is-centered">
        <div class="column is-12">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Manager Dashboard</p>
                </header>
                <div class="card-content">
                    <h3 class="title is-4">Assigned Gembas</h3>
                    <div class="table-container">
                        <table class="table is-fullwidth is-striped is-hoverable">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Team Leader</th>
                                    <th>Members</th>
                                    <th>Actions</th>
                                    <th>Manager</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($gembas->isNotEmpty())
                                    @foreach($gembas as $gemba)
                                        <tr>
                                            <td>{{ $gemba->location }}</td>
                                            <td>{{ $gemba->date }}</td>
                                            <td>{{ $gemba->team_lead }}</td>
                                            <td>
                                                @foreach ($gemba->getmembers as $member)
                                                    {{ $member->first_name }} {{ $member->last_name }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('manager.gemba.actions', $gemba) }}" class="button is-small is-info">View Actions</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('manager.gemba.update', $gemba) }}" method="POST" class="is-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="field has-addons">
                                                        <div class="control">
                                                            <div class="select is-fullwidth">
                                                                <select name="manager_id" class="select2">
                                                                    @foreach($managers as $manager)
                                                                        <option value="{{ $manager->id }}" {{ $manager->id == $gemba->manager_id ? 'selected' : '' }}>
                                                                            {{ $manager->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control">
                                                            <button type="submit" class="button is-small is-info">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>{{ $gemba->status }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="has-text-centered">No gembas assigned.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <header class="card-header">
                    <p class="card-header-title">Assigned Actions</p>
                </header>
                <div class="card-content">
                    <div class="table-container">
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
                                @if(isset($gemba) && $gemba->actions->isNotEmpty())
                                    @foreach($gemba->actions as $action)
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
                                @else
                                    <tr>
                                        <td colspan="5" class="has-text-centered">No assigned actions available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</x-layout.main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const burgerIcon = document.getElementById('burger');
        const navLinks = document.getElementById('nav-links');

        burgerIcon.addEventListener('click', () => {
            burgerIcon.classList.toggle('is-active');
            navLinks.classList.toggle('is-active');
        });
    });
</script>
