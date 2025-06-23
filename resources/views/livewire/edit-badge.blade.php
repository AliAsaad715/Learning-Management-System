<div class="badge-edit-container">
    <h1 class="badge-edit-title">Edit Badge</h1>
    
    <form wire:submit="update" class="badge-form">    
        <!-- Group Field -->
        <div class="form-group">
            <label for="group" class="form-label">Group</label>
            <input wire:model="group"
                type="text" 
                id="group" 
                @class(['form-input', 'is-invalid' => $errors->has('group')])>
            @error('group')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    
        <!-- Level Field -->
        <div class="form-group">
            <label for="level" class="form-label">Level</label>
            <select wire:model="level"
                    id="level" 
                    @class(['form-input', 'is-invalid' => $errors->has('level')])>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">Level {{ $i }}</option>
                @endfor
            </select>
            @error('level')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    
        <!-- Description Field -->
        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea wire:model="description"
                    id="description" 
                    @class(['form-input', 'is-invalid' => $errors->has('description')])
                    rows="3">
            </textarea>
            @error('description')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    
        <!-- Goal Field -->
        <div class="form-group">
            <label for="goal" class="form-label">Goal</label>
            <input wire:model="goal"
                type="number" 
                id="goal" 
                @class(['form-input', 'is-invalid' => $errors->has('goal')])
                min="1"
                max="32767">
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
            <input wire:model="image_url"
                type="file" 
                id="image_url" 
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
