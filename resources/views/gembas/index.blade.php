<x-layout.main>
<div class="columns">
    <div class="column">
        <h2 class="title">Open Gemba walks</h2>
        @foreach($gembas as $gemba)
            @if($gemba->status=='Open')
            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <p>

                                <a href="{{route('gembas.show',$gemba)}}">
                                    <strong> {{ $gemba->location }}</strong>
                                </a>
                            <br>
                            <small>Date: {{ $gemba->date }}</small>

                        </p>
                    </div>
                </div>
            </article>
            @endif
        @endforeach
    </div>

    <div class="column">
        <h2 class="title">Gembas in Progress</h2>
        @foreach($gembas as $gemba)
            @if($gemba->status=='In Progress')
                <article class="media">
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <a href="{{route('gembas.show',$gemba)}}">
                                    <strong> {{ $gemba->location }}</strong>
                                </a>
                                <br>
                                <small>Date: {{ $gemba->date }}</small>
                            </p>
                        </div>
                    </div>
                </article>
            @endif
        @endforeach
    </div>
    <div class="column">
        <h2 class="title">Closed Gembas</h2>
        @foreach($gembas as $gemba)
            @if($gemba->status=='Closed')
                <article class="media">
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <a href="{{route('gembas.show',$gemba)}}">
                                    <strong> {{ $gemba->location }}</strong>
                                </a>
                                <br>
                                <small>Date: {{ $gemba->date }}</small>
                            </p>
                        </div>
                    </div>
                </article>
            @endif
        @endforeach
    </div>
</div>
</x-layout.main>
