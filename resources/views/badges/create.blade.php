@extends('layouts.header')

@section('title', 'Create New Badge')

@section('content')
<div class="badge-create-container">
    <h1 class="badge-create-title">Create New Badge</h1>
    
    <form class="badge-form" method="POST" action="{{ route('badges.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Group Field -->
        <div class="form-group">
            <label for="group" class="form-label">Group</label>
            <input type="text" 
                id="group" 
                name="group" 
                @class(['form-input', 'is-invalid' => $errors->has('group')])
                value="{{ old('group') }}"
                required>
            @error('group')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Level Field (visible only if not preselected) -->
        @if(isset($preselected_level))
            <input type="hidden" name="level" value="{{ $preselected_level }}">
        @else
            <div class="form-group">
                <label for="level" class="form-label">Level</label>
                <select id="level" name="level" class="form-input" required>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('level') == $i ? 'selected' : '' }}>Level {{ $i }}</option>
                    @endfor
                </select>
            </div>
        @endif

        <!-- Description Field -->
        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" 
                    name="description" 
                    @class(['form-input', 'is-invalid' => $errors->has('description')])
                    rows="3"
                    required>{{ old('description') }}</textarea>
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
                value="{{ old('goal') }}"
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
            <input type="file" 
                id="image_url" 
                name="image_url" 
                @class(['form-input-file', 'is-invalid' => $errors->has('image_url')])
                accept="image/*"
                required>
            @error('image_url')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Hidden Admin ID Field -->
        <input type="hidden" name="created_by" value="{{ auth()->user()->id}}">

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
            <button type="submit" class="form-submit">Create Badge</button>
        </div>
    </form>
</div>
@include('layouts.footer')
@endsection