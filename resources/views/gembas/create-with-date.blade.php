<x-layout.main>
    <h1 class="is-size-1 is-italic has-text-centered">Create Gemba Walk</h1>
    <div class="container">
        <form method="POST" action="{{ route('gembas.store') }}">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">

            <div class="field">
                <label for="location" class="label">Location</label>
                <div class="control">
                    <div class="select">
                        <select name="location" required>
                            <option value="" disabled selected hidden>Choose a location</option>
                            <option value="Office Building A">Office Building A</option>
                            <option value="Factory Floor B">Factory Floor B</option>
                            <option value="Warehouse C">Warehouse C</option>
                            <option value="Retail Store D">Retail Store D</option>
                            <option value="Distribution Center E">Distribution Center E</option>
                            <option value="Workshop F">Workshop F</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label for="team_lead" class="label">Team Leader</label>
                <div class="control">
                    <div class="select">
                        <select name="team_lead" required>
                            <option value="" disabled selected hidden>Choose the team leader</option>
                            <option value="Jasmine Patel">Jasmine Patel</option>
                            <option value="Ethan Carter">Ethan Carter</option>
                            <option value="Maya Johnson">Maya Johnson</option>
                            <option value="Xavier Ramirez">Xavier Ramirez</option>
                            <option value="Isabella Chang">Isabella Chang</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label for="manager_id" class="label">Manager</label>
                <div class="control">
                    <div class="select">
                        <select name="manager_id" required>
                            <option value="" disabled selected hidden>Choose a manager</option>
                            @foreach($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="control">
                <button type="submit" class="button is-primary">Create</button>
            </div>
        </form>
    </div>
</x-layout.main>
