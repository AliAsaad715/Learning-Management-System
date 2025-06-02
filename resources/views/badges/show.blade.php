@extends('layouts.header')

@section('title', 'View Badge')

@section('content')
<div class="badge-show-container">
    <div class="badge-header">
        <h1 class="badge-title-show">Badge Details</h1>
        <div class="badge-actions">
            <a href="{{route('badges.edit', $badge->id)}}" class="btn-edit">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{route('badges.destroy', $badge->id)}}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="badge-card-show">
        <div class="badge-image-container">
            <img src="{{ asset('build/assets/img/badges/' . $badge->image_url) }}" alt="{{ $badge->description }}" class="badge-image-show">
        </div>
        
        <div class="badge-details">
            <div class="detail-group">
                <span class="detail-label">Group:</span>
                <span class="detail-value">{{ $badge->group }}</span>
            </div>
            
            <div class="detail-group">
                <span class="detail-label">Level:</span>
                <span class="detail-value">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $badge->level)
                            <i class="fas fa-star filled-star"></i>
                        @else
                            <i class="far fa-star empty-star"></i>
                        @endif
                    @endfor
                    (Level {{ $badge->level }})
                </span>
            </div>
            
            <div class="detail-group">
                <span class="detail-label">Description:</span>
                <span class="detail-value">{{ $badge->description }}</span>
            </div>
            
            <div class="detail-group">
                <span class="detail-label">Goal:</span>
                <span class="detail-value">{{ number_format($badge->goal) }}</span>
            </div>
            
            <div class="detail-group">
                <span class="detail-label">Created by:</span>
                <span class="detail-value">{{ $admin_name }}</span>
            </div>

        </div>
    </div>
</div>
@include('layouts.footer')
@endsection