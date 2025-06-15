<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ActionList</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .btn.btn-success,
        .btn.btn-info,
        .btn.btn-primary {
            background-color: #d3d3d3 !important;
            color: #000000 !important;
            border-color: #d3d3d3 !important;
        }

        .mainheader {
            display: flex;
            position: relative;
            font: italic 1.2rem "Fira Sans", serif;
        }

        .portfolio-home {
            font-size: 65px;
            color: #01B0F1;
            margin-right: 50%;
            padding-left: 90px;
            text-decoration: none;
        }

        nav,
        .profilehome,
        .dashboardhome,
        .bloghome,
        .faqhome,
        .linkhome {
            display: inline-block;
            text-decoration: none;
            margin-right: 18px;
            color: black;
        }

        #portfolio-faq {
            margin-right: 50%;
            padding-left: -150px;
            padding-bottom: 80px;
            font-size: 65px;
            padding-top: 44px;
            text-decoration: none;
            font-weight: bold;
            color: #682839;
        }

        .card-header {
            background-color: #01B0F1 !important;
            color: #fff;
            padding: 10px 10px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            text-align: center;
        }

        .card-body {
            padding: 0.5% !important;
            padding-left: 7%;
            min-height: calc(100vh - 230px);
            overflow-y: auto;
        }

        .table {
            font-size: 20px;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table td {
            word-wrap: break-word;
        }

        .modal-body {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

        .modal-content {
            max-height: calc(100vh - 100px);
            overflow-y: auto;
        }

        .table {
            font-size: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            font-size: inherit;
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .button-7,
        .form-container,
        .button-export {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .button-7 {
            background-color: #0095ff;
            border: 1px solid transparent;
            border-radius: 3px;
            box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            font-family: -apple-system, system-ui, "Segoe UI", "Liberation Sans", sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.15385;
            margin: 0;
            outline: none;
            padding: 8px .8em;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            white-space: nowrap;
        }

        .button-8 {
            background-color: #0095ff;
            border: 1px solid transparent;
            border-radius: 3px;
            box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            font-family: -apple-system, system-ui, "Segoe UI", "Liberation Sans", sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.15385;
            margin: 0;
            outline: none;
            padding: 8px .8em;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            white-space: nowrap;
        }

        .button-9 {
            background-color: #FF4433;
            border: 1px solid transparent;
            border-radius: 3px;
            box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            font-family: -apple-system, system-ui, "Segoe UI", "Liberation Sans", sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.15385;
            margin: 0;
            outline: none;
            padding: 8px .8em;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            white-space: nowrap;
        }

        .button-10 {
            background-color: #FF0000;
            border: 1px solid transparent;
            border-radius: 3px;
            box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            font-family: -apple-system, system-ui, "Segoe UI", "Liberation Sans", sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.15385;
            margin: 0;
            outline: none;
            padding: 8px .8em;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            white-space: nowrap;
        }

        .button-7:hover,
        .button-7:focus {
            background-color: #07c;
        }

        .button-7:focus {
            box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
        }

        .button-7:active {
            background-color: #0064bd;
            box-shadow: none;
        }

        .button-export,
        .form-container {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }

        .form-container:hover {
            background-color: #8B4000 !important;
        }

        .button-export:hover {
            background-color: #45a049;
        }

        .form-container {
            display: inline-block;
            background-color: #FFA500 !important;
        }

        .form-container input[type="file"] {
            margin-right: 10px;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container input[type="submit"] {
            background-color: #f0ad4e;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background-color: #ec971f;
        }

        .container-fluid {
            max-width: 90% !important;
            margin: 0 auto;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .alert {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .alert h4 {
            margin-top: 0;
            color: inherit;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <x-layout.main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Actionlist Gemba Walks</h2>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('importFailures'))
                            <div class="alert alert-danger">
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
                        <div class="d-flex">
                            <div>
                                <a href="{{ route('download.template') }}" class="button-7">Download Template</a>
                            </div>
                            <div>
                                <button type="button" class="form-container" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
                                <button type="button" class="button-export" data-bs-toggle="modal" data-bs-target="#exportModal">Export All</button>
                            </div>
                        </div>
                        <a href="{{ route('export.all') }}" class="button-export">Export All</a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date raised</th>
                                    <th>Due date</th>
                                    <th>Location</th>
                                    <th>Manager</th>
                                    <th>Completed at</th>
                                    <th>Actions</th>
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
                                            @endif</td>
                                        <td style="white-space: nowrap;">
                                            <a class="button-7" href="{{route('gembas.show',['gemba' => $actionList->gemba_id])}}">Gemba Walk</a>
                                            <a class="button-7" href="{{ route('actions.show', $actionList) }}">Show</a>
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

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Excel File</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="excel" class="">Choose Excel File</label>
                            <input type="file" name="excel" class="form-control" id="excel" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="button-9" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="button-7">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Confirm Export</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to export all action lists?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button-9" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('export.all') }}" class="button-7">Export</a>
                </div>
            </div>
        </div>
    </div>

    </x-layout.main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

