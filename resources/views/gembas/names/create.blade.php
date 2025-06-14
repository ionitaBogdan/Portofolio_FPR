<x-layout.main>
    <div class="box">
        <form action="{{ route('names.store', ['gemba' => $gemba_id]) }}" method="POST">
            @csrf
            <div class="field">
                <label for="first_name" class="label">First Name</label>

                <input class="input" type="text" name="first_name"
                       placeholder="No name added">
            </div>
            <div class="field">
                <label for="last_name" class="label">Last Name</label>

                <input class="input" type="text" name="last_name"
                       placeholder="No name added">
            </div>
            <input type="hidden" name="gemba_id" value="{{ $gemba_id }}">
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-layout.main>
