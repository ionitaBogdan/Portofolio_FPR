<x-layout.main>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .full-width-button {
            width: 100%;
            background-color: lightskyblue;
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-size: 16px;
        }

        .content {
            margin: 10px 0;
            width: 100%;
            text-align: center;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .button.is-small {
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
            margin-top: 10px;
            text-decoration: none;
            color: white;
        }

        .button.is-info {
            background-color: #3498db;
        }

        .button.is-rounded {
            border-radius: 50%;
        }
    </style>

    <div class="container">
        <a href="{{ route('gembas.edit', $gemba) }}" class="full-width-button button is-info">Update the Gemba walk</a>

        <div class="content">
           <strong>Location:</strong>  {{ $gemba->location }}
        </div>

        <div class="content">
            <strong>Date:</strong> {{ $gemba->date }}
        </div>

        <div class="content">
            <strong>Team Leader:</strong> {{ $gemba->team_lead }}
        </div>

        <div class="content">
            @if ($gemba->getmembers()->count() > 0)
                <strong>Members:</strong>
                    @foreach ($gemba->getmembers()->get() as $name)
                        <p>{{ $name->first_name }} {{ $name->last_name }}</p>
                    @endforeach
                <a href="{{ route('names.create', $gemba) }}" class="button is-rounded button is-small button is-info">+</a>
            @else
               <p> <strong>No members added</strong></p>
                <a href="{{ route('names.create', $gemba) }}" class="button is-rounded button is-small button is-info">+</a>
            @endif
        </div>

        @if ($gemba->getactions()->count() > 0)
            <a href="{{ route('actions.create', $gemba) }}" class="button is-small button is-info">Add new action</a>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Due date</th>
                        <th>Improvements</th>
                        <th>Manager</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($gemba->getactions()->get() as $actionList)
                        <tr>
                            <td>{{ $actionList->title }}</td>
                            <td>{{ $actionList->due_date }}</td>
                            <td>{{ $actionList->improvements }}</td>
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
            <p>No action linked to this Gemba.</p>
            <a href="{{ route('actions.create', $gemba) }}" class="button is-small button is-info">Add new action</a>
        @endif

        <div class="content">
           <strong>Status: {{ $gemba->status }}</strong>
        </div>
    </div>

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
</x-layout.main>
