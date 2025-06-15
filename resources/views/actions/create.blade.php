<x-layout.main>
<div class="container">
    <form action="{{ route('actions.store',['gemba' => $gemba_id]) }}" method="POST">
        @csrf
        <div class="columns mt-6 mb-6">
            <div class="column">
                <h1 class="title is-2">Create a new action</h1>
            </div>
        </div>
        <div class="box">
            <h2 class="subtitle is-6 is-italic">
                Please fill out all the form fields and click 'Submit'
            </h2>

            <div class="field">
                <label for="date_raised" class="label">Date Raised</label>
                <div class="control">
                    <input type="date" name="date_raised" value="{{ old('date_raised') }}"
                           class="input" required>
                    @error('date_raised')<p>{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="field">
                <label for="due_date" class="label">Due Date</label>
                <div class="control">
                    <input type="date" name="due_date" value="{{ old('due_date') }}"
                           class="input" required>
                    @error('due_date')<p>{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="field">
                <label for="improvements" class="label">Improvements</label>
                <div class="control">
                    <textarea name="improvements" placeholder="Enter improvements here"
                              class="textarea" required>{{ old('improvements') }}</textarea>
                    @error('improvements')<p>{{ $message }}</p>@enderror
                </div>
            </div>

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
                    @error('location')<p>{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="field">
                <label for="title" class="label">Title</label>
                <input class="input" type="text" name="title"
                       placeholder="Add title to the action">
            </div>
            <div class="field">
                <label for="manager" class="label">Manager</label>
                <div class="control">
                    <div class="select">
                        <select name="manager">
                                <option value="{{$gemba_id}}" disabled selected hidden>Choose the team leader</option>
                                <option value="Jasmine Patel">Jasmine Patel</option>
                                <option value="Ethan Carter">Ethan Carter</option>
                                <option value="Maya Johnson">Maya Johnson</option>
                                <option value="Xavier Ramirez">Xavier Ramirez</option>
                                <option value="Isabella Chang">Isabella Chang</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="gemba_id" value="{{ $gemba_id }}">
            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-primary">Save</button>
                </div>
                <div class="control">
                    <a href="{{ Session::get('previous_url', route('gembas.index')) }}" class="button is-light">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
</x-layout.main>

