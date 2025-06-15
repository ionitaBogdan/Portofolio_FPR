<x-layout.main>
    <div id="multistep-form">
        <form action="{{ route('gembas.update', $gemba) }}" method="POST">
            @csrf
            @method('PATCH')
            <!-- Step 1 -->
            <div class="box step-1">
                <div class="field">
                    <label for="location" class="label">Location</label>
                    <div class="control">
                        <div class="select">
                            <select name="location" required>
                                <option value="" disabled selected hidden>Choose a location</option>
                                @foreach(['Office Building A', 'Factory Floor B', 'Warehouse C', 'Retail Store D', 'Distribution Center E', 'Workshop F'] as $location)
                                    <option value="{{ $location }}" {{ $gemba->location == $location ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label for="status" class="label">Status</label>
                    <div class="control">
                        <div class="select">
                            <select name="status" required>
                                <option value="" disabled selected hidden>Change status</option>
                                @foreach(['Open', 'Closed'] as $status)
                                    <option value="{{ $status }}" {{ $gemba->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
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
                                    <option value="{{ $manager->id }}" {{ $gemba->manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button type="button" class="button full-width-button next-step">Next</button>
            </div>

            <!-- Step 2 -->
            <div class="box step-2" style="display: none;">
                <div class="field">
                    <label for="date" class="label">Date</label>
                    <input class="input" type="datetime-local" name="date" value="{{ $gemba->date }}" required>
                </div>
                <div class="content">
                    @if ($gemba->getmembers()->count() > 0)
                        Members:
                        <ul>
                            @foreach ($gemba->getmembers()->get() as $name)
                                <li>{{ $name->first_name }} {{ $name->last_name }}</li>
                            @endforeach
                            <li>
                                <a href="{{ route('names.create', $gemba) }}" class="button is-rounded button is-small button is-info">+</a>
                            </li>
                        </ul>
                    @else
                        <p>No members added</p>
                        <a href="{{ route('names.create', $gemba) }}" class="button is-rounded button is-small button is-info">+</a>
                    @endif
                </div>
                <button type="button" class="button full-width-button prev-step">Previous</button>
                <button type="button" class="button full-width-button next-step">Next</button>
            </div>

            <!-- Step 3 -->
            <div class="box step-3" style="display: none;">
                <div class="content">
                    @if ($gemba->getactions()->count() > 0)
                        <a href="{{ route('actions.create', $gemba) }}" class="button is-small button is-info">Add new action</a>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Raised</th>
                                    <th>Improvements</th>
                                    <th>Location</th>
                                    <th>Manager</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($gemba->getactions()->get() as $actionList)
                                    <tr>
                                        <td>{{ $actionList->title }}</td>
                                        <td>{{ $actionList->date_raised }}</td>
                                        <td>{{ $actionList->improvements }}</td>
                                        <td>{{ $actionList->location }}</td>
                                        <td>{{ $actionList->manager }}</td>
                                        <td>{{ $actionList->status }}</td>
                                        <td>
                                            <a href="{{ route('actions.edit', ['gemba' => $gemba, 'actionList' => $actionList]) }}" class="button is-small button is-info">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No action  linked to this Gemba.</p>
                        <a href="{{ route('actions.create', $gemba) }}" class="button is-small button is-info">Add new action</a>
                    @endif
                </div>
                <button type="submit" class="button full-width-button">Submit</button>
                <button type="button" class="button full-width-button prev-step">Previous</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const steps = document.querySelectorAll('.box');
            let currentStep = 0;

            const showStep = (stepIndex) => {
                steps.forEach((step, index) => {
                    step.style.display = index === stepIndex ? 'block' : 'none';
                });
            };

            const nextStep = () => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            };

            const prevStep = () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            };

            // Initial display setup
            showStep(currentStep);

            document.querySelectorAll('.next-step').forEach(button => {
                button.addEventListener('click', nextStep);
            });

            document.querySelectorAll('.prev-step').forEach(button => {
                button.addEventListener('click', prevStep);
            });
        });
    </script>
</x-layout.main>
