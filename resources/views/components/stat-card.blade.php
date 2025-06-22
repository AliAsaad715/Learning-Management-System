@props(['cardName', 'iconName', 'count', 'alt'])

<div class="stat-card courses">
    <div class="card-icon">
        <div class="icon-backdrop"></div>
        <div class="icon-wrapper">
            <img src="{{asset('build/assets/img/' . $iconName)}}" alt="{{$alt}}">
        </div>
    </div>
    <h3 class="card-title">{{ $cardName }}</h3>
    <div class="card-value">{{$count}}</div>
</div>