@props(['badge'])

<a href="{{ route('badges.show', $badge->id) }}" class="badge-card">
    <div class="badge-icon">
        <img src="{{ asset('build/assets/img/badges/' . $badge->image_url) }}" alt="{{ $badge->description }}">
    </div>
    <h3 class="badge-name">{{ $badge->group }}</h3>
    <p class="badge-description">{{ $badge->description }}</p>
</a>