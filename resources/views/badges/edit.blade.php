@extends('layouts.header')

@section('title', 'Edit Badge')

@section('content')
<div class="badge-edit-container">
    <h1 class="badge-edit-title">Edit Badge</h1>
    
    <form class="badge-form" method="POST" action="{{ route('badges.update', $badge->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <!-- Group Field -->
        <div class="form-group">
            <label for="group" class="form-label">Group</label>
            <input type="text" 
                   id="group" 
                   name="group" 
                   @class(['form-input', 'is-invalid' => $errors->has('group')])
                   value="{{ old('group', $badge->group) }}"
                   required>
            @error('group')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    
        <!-- Level Field -->
        <div class="form-group">
            <label for="level" class="form-label">Level</label>
            <select id="level" 
                    name="level" 
                    @class(['form-input', 'is-invalid' => $errors->has('level')])
                    required>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('level', $badge->level) == $i ? 'selected' : '' }}>Level {{ $i }}</option>
                @endfor
            </select>
            @error('level')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    
        <!-- Description Field -->
        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" 
                      name="description" 
                      @class(['form-input', 'is-invalid' => $errors->has('description')])
                      rows="3"
                      required>{{ old('description', $badge->description) }}</textarea>
            @error('description')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    
        <!-- Goal Field -->
        <div class="form-group">
            <label for="goal" class="form-label">Goal</label>
            <input type="number" 
                   id="goal" 
                   name="goal" 
                   @class(['form-input', 'is-invalid' => $errors->has('goal')])
                   value="{{ old('goal', $badge->goal) }}"
                   min="1"
                   max="32767"
                   required>
            @error('goal')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image Upload Field -->
        <div class="form-group">
            <label for="image_url" class="form-label">Badge Image</label>
            <div class="current-image">
                <img src="{{ asset("build/assets/img/badges/$badge->image_url") }}" alt="Current badge image" width="100">
                <span>Current Image</span>
            </div>
            <input type="file" 
                   id="image_url" 
                   name="image_url" 
                   @class(['form-input-file', 'is-invalid' => $errors->has('image_url')])
                   accept="image/*">
            @error('image_url')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    
        @if($errors->any())
            <div class="form-errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-actions">
            <button type="submit" class="form-submit">Update Badge</button>
        </div>
    </form>
</div>
@include('layouts.footer')
@endsection