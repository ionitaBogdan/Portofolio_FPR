<x-layout.main>
    <div class="container">
        <form action="{{ route('actions.updateComment', $actionList) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="columns mt-6 mb-6">
                <div class="column">
                    <h1 class="title is-2">Add comment</h1>
                </div>
            </div>

            <div class="box">
                <h2 class="subtitle is-6 is-italic">
                    Please add date and comment and click 'Submit'
                </h2>

                <div class="field">
                    <label for="date_complete" class="label">Date Complete</label>
                    <div class="control">
                        <input type="date" name="date_complete" placeholder="Enter the date completed here"
                               value="{{ old('date_complete', $actionList->date_complete) }}"
                               class="input">
                        @error('date_complete')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="comment" class="label">Comment</label>
                    <div class="control">
                        <textarea name="comment" placeholder="Enter comments here"
                                  class="textarea">{{ old('comment', $actionList->comment) }}</textarea>
                        @error('comment')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="comment_img" class="label">Comment Image</label>
                    <div class="control">
                        <input type="file" name="comment_img" class="input">
                        @error('comment_img')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="activity_transport" class="label">
                        <img src="{{ asset('assets/activity_1.png') }}" alt="activity image" style="width: 40px; height: 40px;">
                        Transport
                    </label>
                    <div class="control">
                        <textarea name="activity_transport" placeholder="Enter transport details"
                                  class="textarea">{{ old('activity_transport', $actionList->activity_transport) }}</textarea>
                        @error('activity_transport')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="activity_inv" class="label">
                        <img src="{{ asset('assets/activity_2.png') }}" alt="activity image" style="width: 40px; height: 40px;">
                        Inventory
                    </label>
                    <div class="control">
                        <textarea name="activity_inv" placeholder="Enter inventory details"
                                  class="textarea">{{ old('activity_inv', $actionList->activity_inv) }}</textarea>
                        @error('activity_inv')<p>{{ $message }}</p>@enderror
                    </div>

                <div class="field">
                    <label for="activity_motion" class="label">
                        <img src="{{ asset('assets/activity_3.png') }}" alt="activity image" style="width: 40px; height: 40px;">
                        Motion
                    </label>
                    <div class="control">
                        <textarea name="activity_motion" placeholder="Enter motion details"
                                  class="textarea">{{ old('activity_motion', $actionList->activity_motion) }}</textarea>
                        @error('activity_motion')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="activity_waiting" class="label">
                        <img src="{{ asset('assets/activity_4.png') }}" alt="activity image" style="width: 40px; height: 40px;">
                        Waiting
                    </label>
                    <div class="control">
                        <textarea name="activity_waiting" placeholder="Enter waiting details"
                                  class="textarea">{{ old('activity_waiting', $actionList->activity_waiting) }}</textarea>
                        @error('activity_waiting')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="activity_overprocessing" class="label">
                        <img src="{{ asset('assets/activity_5.png') }}" alt="activity image" style="width: 40px; height: 40px;">
                        Overprocessing
                    </label>
                    <div class="control">
                        <textarea name="activity_overprocess" placeholder="Enter overprocessing details"
                                  class="textarea">{{ old('activity_overprocess', $actionList->activity_overprocess) }}</textarea>
                        @error('activity_overprocess')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="activity_overproduction" class="label">
                        <img src="{{ asset('assets/activity_6.png') }}" alt="activity image" style="width: 40px; height: 40px;">
                        Overproduction
                    </label>
                    <div class="control">
                        <textarea name="activity_overproduct" placeholder="Enter overproduction details"
                                  class="textarea">{{ old('activity_overproduct', $actionList->activity_overproduct) }}</textarea>
                        @error('activity_overproduct')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="activity_defects" class="label">
                        <img src="{{ asset('assets/activity_7.png') }}" alt="activity image" style="width: 40px; height: 40px;">
                        Defects
                    </label>
                    <div class="control">
                        <textarea name="activity_defect" placeholder="Enter defect details"
                                  class="textarea">{{ old('activity_defect', $actionList->activity_defect) }}</textarea>
                        @error('activity_defect')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="activity_skills" class="label">
                        <img src="{{ asset('assets/activity_8.png') }}" alt="activity image" style="width: 40px; height: 40px;">
                        Skills
                    </label>
                    <div class="control">
                        <textarea name="activity_skills" placeholder="Enter skills details"
                                  class="textarea">{{ old('activity_skills', $actionList->activity_skills) }}</textarea>
                        @error('activity_skills')<p>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary">Save</button>
                    </div>
                    <div class="control">
                    <a type="button" href="{{ route('actions.show', ['actionList' => $actionList->id]) }}" class="button is-light">
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
