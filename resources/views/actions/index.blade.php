    <x-layout.main>
        <div class="container">
            <div class="card">
                <header class="card-header has-background-info">
                    <p class="card-header-title has-text-white">Actionlist Gemba Walks</p>
                </header>
                <div class="card-content">
                    @if (session('success'))
                        <div class="notification is-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="notification is-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="notification is-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('importFailures'))
                        <div class="notification is-danger">
                            <h4 class="subtitle is-5">Import Failures:</h4>
                            <ul>
                                @foreach (session('importFailures') as $failure)
                                    <li>Row {{ $failure->row() }}: {{ implode(', ', $failure->errors()) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="buttons">
                        <a href="{{ route('download.template') }}" class="button is-link">Download Template</a>
                        <button class="button is-warning" onclick="document.getElementById('importModal').classList.add('is-active')">Import</button>
                        <button class="button is-success" onclick="document.getElementById('exportModal').classList.add('is-active')">Export All</button>
                    </div>

                    <div class="table-container">
                        <table class="table is-striped is-fullwidth">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date raised</th>
                                    <th>Due date</th>
                                    <th>Location</th>
                                    <th>Manager</th>
                                    <th>Completed at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($actionLists as $actionList)
                                    <tr>
                                        <td>{{$actionList->title}}</td>
                                        <td>{{ $actionList->date_raised }}</td>
                                        <td>{{ $actionList->due_date }}</td>
                                        <td>{{ $actionList->location }}</td>
                                        <td>{{ $actionList->manager }}</td>
                                        <td>
                                            @if($actionList->date_complete)
                                                {{ $actionList->date_complete }}
                                            @else
                                                Not completed
                                            @endif
                                        </td>
                                        <td>
                                            <a class="button is-link is-small" href="{{route('gembas.show',['gemba' => $actionList->gemba_id])}}">Gemba Walk</a>
                                            <a class="button is-link is-small" href="{{ route('actions.show', $actionList) }}">Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Import Modal -->
        <div id="importModal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Import Excel File</p>
                    <button class="delete" aria-label="close" onclick="document.getElementById('importModal').classList.remove('is-active')"></button>
                </header>
                <section class="modal-card-body">
                    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="field">
                            <label class="label">Choose Excel File</label>
                            <div class="control">
                                <input type="file" name="excel" class="input" required>
                            </div>
                        </div>
                        <footer class="modal-card-foot">
                            <button type="button" class="button" onclick="document.getElementById('importModal').classList.remove('is-active')">Close</button>
                            <button type="submit" class="button is-link">Import</button>
                        </footer>
                    </form>
                </section>
            </div>
        </div>

        <!-- Export Modal -->
        <div id="exportModal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Confirm Export</p>
                    <button class="delete" aria-label="close" onclick="document.getElementById('exportModal').classList.remove('is-active')"></button>
                </header>
                <section class="modal-card-body">
                    <p>Are you sure you want to export all action lists?</p>
                </section>
                <footer class="modal-card-foot">
                    <button type="button" class="button" onclick="document.getElementById('exportModal').classList.remove('is-active')">Close</button>
                    <a href="{{ route('export.all') }}" class="button is-link">Export</a>
                </footer>
            </div>
        </div>
    </x-layout.main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Check if there are any navbar burgers
            if ($navbarBurgers.length > 0) {
                // Add a click event on each of them
                $navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {
                        // Get the target from the "data-target" attribute
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);

                        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');
                    });
                });
            }
        });
    </script>
</body>
</html>
