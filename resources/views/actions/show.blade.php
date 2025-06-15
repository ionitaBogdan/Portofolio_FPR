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
        }

        .card-body {
            padding-left: 5%;
            height: 400px;
            overflow-y: auto;
        }

        .button-7 {
            background-color: #0095ff;
            border: 1px solid transparent;
            border-radius: 3px;
            box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: -apple-system,system-ui,"Segoe UI","Liberation Sans",sans-serif;
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

        .table {
            font-size: 20px;
            table-layout: fixed;
            width: 100%;
        }

        .table th,
        .table td {
            font-size: inherit;
            max-height: 100px;
            overflow-y: auto;
            word-wrap: break-word;
        }

        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }

        .button-export {
            margin-left:92% !important;
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .button-export:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <x-layout.main>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 style="padding-left: 45%; font-size: 30px;">Action</h2>
                    </div>
                    <br>
                    <a href="{{ route('export') }}" class="button-export">Export</a>
                    <div class="card-body">
                        <br/>
                        <br/>
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
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$actionList->title}}</td>
                                        <td>{{ $actionList->date_raised }}</td>
                                        <td>{{ $actionList->improvements }}</td>
                                        <td>{{ $actionList->location }}</td>
                                        <td>{{ $actionList->manager }}</td>
                                        <td>{{ $actionList->status }}</td>
                                        <td>
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
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 style="padding-left: 45%; font-size: 30px;">Comment</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date Complete</th>
                                    <th>Comment</th>
                                    <th>Image</th>
                                </tr>
                                </thead>
                                <tr>
                                    <td>{{ $actionList->date_complete }}</td>
                                    <td>{{ $actionList->comment }}</td>
                                    <td>{{ $actionList->comment_img }}</td>
                                    <td>
                                    <a href="{{ route('actions.editComment', $actionList) }}" class="button-7">Add comment</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 style="padding-left: 45%; font-size: 30px;">Activity</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
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
                                        <a href="{{ route('actions.editComment', $actionList) }}" class="button-7">Edit activity</a>
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
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <br>
                            <div class="control">
                                <a type="button" href="{{ route('actions.index') }}" class="button is-light">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-layout.main>
</body>
</html>
