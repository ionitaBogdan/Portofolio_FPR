<x-layout.main>
    <div class="box">
        <form action="{{route('gembas.store')}}" method="POST">
            @csrf
            <div class="field">
                <label for="location" class="label">Location</label>
                <div class="control">
                    <div class="select">
                        <select name="location">
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
                        <select name="team_lead">
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
                <label for="date" class="label">Date</label>
                <input class="input" type="date" name="date" placeholder="Enter the date of the Gemba walk">


            </div>
            <style>
                .full-width-button {
                    left: 0;
                    width: 100%;
                    background-color: lightskyblue;
                    text-align: center;
                    padding: 10px;
                }
            </style>
            <div class="control">
                <button class="button full-width-button">Submit</button>
            </div>
        </form>
    </div>
</x-layout.main>
