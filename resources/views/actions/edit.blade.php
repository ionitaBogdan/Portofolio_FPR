<x-layout.main>
    <div class="container">
        <form action="{{ route('actions.update', $actionList) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="columns mt-6 mb-6">
                <div class="column">
                    <h1 class="title is-2">Edit Action</h1>
                </div>
            </div>

            <div class="box">
                <h2 class="subtitle is-6 is-italic">
                    Please fill out all the form fields and click 'Submit'
                </h2>

                <div class="field">
                    <label for="date_complete" class="label">Date has been completed </label>
                    <div class="control">
                        <input type="date" name="date_complete" placeholder="Enter the date the action has been completed here"
                               value="{{ old('date_complete', $actionList->date_complete) }}"
                               class="input">
                        @error('date_complete')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="improvements" class="label">Improvements</label>
                    <div class="control">
                        <textarea name="improvements" placeholder="Enter improvements here"
                                  class="textarea" required>{{ old('improvements', $actionList->improvements) }}</textarea>
                        @error('improvements')
                        <div class="has-text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="location" class="label">Location</label>
                    <div class="control">
                        <div class="select">
                            <select name="location">
                                <option value="" disabled selected hidden>Choose a location</option>
                                @foreach(['Office Building A', 'Factory Floor B', 'Warehouse C',
                                'Retail Store D', 'Distribution Center E', 'Workshop F'] as $location)
                                    <option value="{{ $location }}" {{ $actionList->location == $location ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('location')<p>{{ $message }}</p>@enderror
                    </div>
                </div>


                <div class="field">
                    <label for="status" class="label">Status</label>
                    <div class="control">
                        <div class="select">
                            <select name="status">
                                <option value="" disabled selected hidden>Change status</option>
                                @foreach(['Open', 'Closed'] as $status)
                                    <option value="{{ $status }}" {{ $actionList ->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-info">Save</button>
                    </div>
                    <div class="control">
                        <a type="button" href="{{ Session::get('previous_url', route('gembas.index')) }}" class="button is-light">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout.main>
<script>
        // Burger menu functionality
        document.addEventListener('DOMContentLoaded', () => {
            const burgerIcon = document.querySelector('.navbar-burger');
            const navbarMenu = document.querySelector('.navbar-menu');

            burgerIcon.addEventListener('click', () => {
                burgerIcon.classList.toggle('is-active');
                navbarMenu.classList.toggle('is-active');
            });
        });
    </script>
