<x-layout.main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>All Users</h3>

                        @if($errors->any())
                            <div class="notification is-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="filter-form" method="GET" action="{{ route('admin.dashboard') }}" class="mb-3">
                            <!-- Filter Controls -->
                            <div class="columns is-mobile is-multiline">
                                <!-- Search Input -->
                                <div class="column is-full-mobile is-one-quarter-tablet">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" name="search" placeholder="Search users..." value="{{ request('search') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Sort By Select -->
                                <div class="column is-full-mobile is-one-quarter-tablet">
                                    <div class="field">
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select name="sort_by" id="sort_by">
                                                    <option value="">{{ __('Sort By') }}</option>
                                                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                                                    <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sort Order Select -->
                                <div class="column is-full-mobile is-one-quarter-tablet">
                                    <div class="field">
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select name="sort_order" id="sort_order">
                                                    <option value="">{{ __('Sort Order') }}</option>
                                                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Apply Filters Button -->
                                <div class="column is-full-mobile is-one-quarter-tablet">
                                    <div class="field">
                                        <div class="control">
                                            <button type="button" class="button is-primary is-fullwidth" id="apply-filters">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden Inputs for Sort By and Sort Order -->
                            <input type="hidden" id="sort_by_hidden" name="sort_by" value="{{ request('sort_by') }}">
                            <input type="hidden" id="sort_order_hidden" name="sort_order" value="{{ request('sort_order') }}">
                        </form>

                        <div class="table-container">
                            <table class="table is-fullwidth is-striped is-hoverable">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                @if (!$user->hasRole('admin'))
                                                    <div class="select is-fullwidth">
                                                        <select name="roles[{{ $user->id }}]" id="roleSelect_{{ $user->id }}">
                                                            <option value="worker" {{ $user->roles->contains('name', 'worker') ? 'selected' : '' }}>Worker</option>
                                                            <option value="manager" {{ $user->roles->contains('name', 'manager') ? 'selected' : '' }}>Manager</option>
                                                        </select>
                                                    </div>
                                                    <button class="button is-primary is-small ml-2" onclick="changeRole({{ $user->id }})">Change Role</button>
                                                @else
                                                    {{ implode(', ', $user->roles()->pluck('name')->toArray()) }}
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @unless($user->hasRole('admin'))
                                                    <!-- Delete User Button with Modal -->
                                                    <button class="button is-small is-danger" data-target="#confirmDeleteModal_{{ $user->id }}">Delete</button>

                                                    <!-- Confirmation Modal -->
                                                    <div id="confirmDeleteModal_{{ $user->id }}" class="modal">
                                                        <div class="modal-background"></div>
                                                        <div class="modal-card">
                                                            <header class="modal-card-head">
                                                                <p class="modal-card-title">Confirm Delete</p>
                                                                <button class="delete" aria-label="close"></button>
                                                            </header>
                                                            <section class="modal-card-body">
                                                                Are you sure you want to delete {{ $user->name }} ({{ $user->email }})?
                                                            </section>
                                                            <footer class="modal-card-foot">
                                                                <form action="{{ route('admin.deleteUser', $user) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="button is-danger">Delete</button>
                                                                    <button type="button" class="button" aria-label="close">Cancel</button>
                                                                </form>
                                                            </footer>
                                                        </div>
                                                    </div>
                                                    <!-- End Confirmation Modal -->
                                                @endunless
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
    </div>

    <style>
        .table-container {
            overflow-x: auto;
        }
    </style>

    <script>
        // Function to change user role
        function changeRole(userId) {
            const roleSelect = document.getElementById(`roleSelect_${userId}`);
            const newRole = roleSelect.value;

            // Send an AJAX request to update the user role
            fetch(`/admin/change-role/${userId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ role: newRole })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(error => { throw error; });
                }
                return response.json();
            })
            .then(data => {
                // Optionally, you can update the UI to reflect the role change
                console.log('Role change successful:', data);
                // Show a success message
                alert('Role changed successfully!');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to change role. Please try again.');
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const applyFilters = document.getElementById('apply-filters');
            const form = document.getElementById('filter-form');

            applyFilters.addEventListener('click', () => {
                const sortBy = document.getElementById('sort_by').value;
                const sortOrder = document.getElementById('sort_order').value;
                document.getElementById('sort_by_hidden').value = sortBy;
                document.getElementById('sort_order_hidden').value = sortOrder;
                form.submit();
            });

            // Modal functionality
            const deleteButtons = document.querySelectorAll('.is-danger');
            const modals = document.querySelectorAll('.modal');
            const modalCloses = document.querySelectorAll('.modal .delete, .modal [aria-label="close"], .modal .button[aria-label="close"], .modal .modal-background');

            // Add event listeners to show modals
            deleteButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetModalId = button.getAttribute('data-target');
                    const targetModal = document.querySelector(targetModalId);
                    targetModal.classList.add('is-active');
                });
            });

            // Add event listeners to close modals
            modalCloses.forEach(close => {
                close.addEventListener('click', () => {
                    modals.forEach(modal => {
                        modal.classList.remove('is-active');
                    });
                });
            });

            // Add event listener to cancel button inside modal
            document.querySelectorAll('.modal .button[aria-label="close"]').forEach(cancelButton => {
                cancelButton.addEventListener('click', () => {
                    modals.forEach(modal => {
                        modal.classList.remove('is-active');
                    });
                });
            });

            // Burger menu functionality
            const burger = document.querySelector('.navbar-burger');
            const menu = document.querySelector('.navbar-menu');

            burger.addEventListener('click', () => {
                burger.classList.toggle('is-active');
                menu.classList.toggle('is-active');
            });
        });
    </script>
</x-layout.main>
