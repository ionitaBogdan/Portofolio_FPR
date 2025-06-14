
    <x-layout.main>
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <div class="card">
                    <div class="card-header has-background-info">
                        <h2 class="card-header-title has-text-white">Actionlist Gemba Walks</h2>
                    </div>
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
                                <h4>Import Failures:</h4>
                                <ul>
                                    @foreach (session('importFailures') as $failure)
                                        <li>Row {{ $failure->row() }}: {{ implode(', ', $failure->errors()) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br/>
                        <br/>
                        <div class="buttons">
                            <a href="{{ route('download.template') }}" class="button is-info">Download Template</a>
                            <button type="button" class="button is-warning" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
                            <button type="button" class="button is-success" data-bs-toggle="modal" data-bs-target="#exportModal">Export All</button>
                        </div>
                        <br/>
                        <div class="table-container">
                            <table class="table is-striped is-bordered is-fullwidth">
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
                                        <td style="white-space: nowrap;">
                                            <a class="button is-link is-small" href="{{route('gembas.show',['gemba' => $actionList->gemba_id])}}">Gemba Walk</a>
                                            <a class="button is-link is-small" href="{{ route('actions.show', $actionList) }}">Show</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <div class="card">
                    <div class="card-header has-background-info">
                        <h2 class="card-header-title has-text-white">Comment</h2>
                    </div>
                    <div class="card-content">
                        <div class="table-container">
                            <table class="table is-striped is-bordered is-fullwidth">
                                <thead>
                                    <tr>
                                        <th>Date Complete</th>
                                        <th>Comment</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $actionList->date_complete }}</td>
                                        <td>{{ $actionList->comment }}</td>
                                        <td>{{ $actionList->comment_img }}</td>
                                        <td>
                                            <a href="{{ route('actions.editComment', $actionList) }}" class="button is-link is-small">Add comment</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <div class="card">
                    <div class="card-header has-background-info">
                        <h2 class="card-header-title has-text-white">Activity</h2>
                    </div>
                    <div class="card-content">
                        <div class="table-container">
                            <table class="table is-striped is-bordered is-fullwidth">
                                <thead>
                                    <tr>
                                        <th>Transportation</th>
                                        <th>Inventory</th>
                                        <th>Motion</th>
                                        <th>Waiting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $actionList->activity_transport }}</td>
                                        <td>{{ $actionList->activity_inv }}</td>
                                        <td>{{ $actionList->activity_motion }}</td>
                                        <td>{{ $actionList->activity_waiting }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th>Overprocessing</th>
                                        <th>Overproduction</th>
                                        <th>Defects</th>
                                        <th>Skills</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $actionList->activity_overprocess }}</td>
                                        <td>{{ $actionList->activity_overproduct }}</td>
                                        <td>{{ $actionList->activity_defect }}</td>
                                        <td>{{ $actionList->activity_skills }}</td>
                                        <td>
                                            <a href="{{ route('actions.editComment', $actionList) }}" class="button is-link is-small">Edit activity</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="control">
                            <a type="button" href="{{ route('actions.index') }}" class="button is-link is-small">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-layout.main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
