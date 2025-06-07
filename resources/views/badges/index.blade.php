@extends('layouts.header')

@section('title', 'Badge Explorer')

@section('content')
<div class="badge-explorer">
    <div class="explorer-header">
        <h1 class="explorer-title">BADGE EXPLORER</h1>
        <a href="{{ route('badges.create') }}" class="create-badge-btn">
            <i class="fas fa-plus"></i> CREATE BADGE
        </a>
    </div>
    
    <div class="badge-levels">
        <!-- Bronze Level -->
        <div class="level-container bronze">
            <h2 class="level-title">BRONZE</h2>
            <div class="badge-grid">
                @foreach($bronzeBadges as $badge)
                <a href="{{ route('badges.show', $badge->id) }}" class="badge-card">
                    <div class="badge-icon">
                        <img src="{{ asset('build/assets/img/badges/' . $badge->image_url) }}" alt="{{ $badge->description }}">
                    </div>
                    <h3 class="badge-name">{{ $badge->group }}</h3>
                    <p class="badge-description">{{ $badge->description }}</p>
                    {{-- <div class="badge-cost">{{ $badge->goal }} POINTS</div> --}}
                </a>
                @endforeach
                
                <!-- Add Badge Card -->
                <a href="{{ route('badges.create') }}?level=1" class="badge-card add-badge-card">
                    <div class="add-badge-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h3 class="add-badge-text">ADD BRONZE BADGE</h3>
                </a>
            </div>
        </div>

        <!-- Silver Level -->
        <div class="level-container silver">
            <h2 class="level-title">SILVER</h2>
            <div class="badge-grid">
                @foreach($silverBadges as $badge)
                <a href="{{ route('badges.show', $badge->id) }}" class="badge-card">
                    <div class="badge-icon">
                        <img src="{{ asset('build/assets/img/badges/' . $badge->image_url) }}" alt="{{ $badge->description }}">
                    </div>
                    <h3 class="badge-name">{{ $badge->group }}</h3>
                    <p class="badge-description">{{ $badge->description }}</p>
                    {{-- <div class="badge-cost">{{ $badge->goal }} POINTS</div> --}}
                </a>
                @endforeach
                
                <!-- Add Badge Card -->
                <a href="{{ route('badges.create') }}?level=2" class="badge-card add-badge-card">
                    <div class="add-badge-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h3 class="add-badge-text">ADD SILVER BADGE</h3>
                </a>
            </div>
        </div>

        <!-- Gold Level -->
        <div class="level-container gold">
            <h2 class="level-title">GOLD</h2>
            <div class="badge-grid">
                @foreach($goldBadges as $badge)
                <a href="{{ route('badges.show', $badge->id) }}" class="badge-card">
                    <div class="badge-icon">
                        <img src="{{ asset('build/assets/img/badges/' . $badge->image_url) }}" alt="{{ $badge->description }}">
                    </div>
                    <h3 class="badge-name">{{ $badge->group }}</h3>
                    <p class="badge-description">{{ $badge->description }}</p>
                    {{-- <div class="badge-cost">{{ $badge->goal }} POINTS</div> --}}
                </a>
                @endforeach
                
                <!-- Add Badge Card -->
                <a href="{{ route('badges.create') }}?level=3" class="badge-card add-badge-card">
                    <div class="add-badge-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h3 class="add-badge-text">ADD GOLD BADGE</h3>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection