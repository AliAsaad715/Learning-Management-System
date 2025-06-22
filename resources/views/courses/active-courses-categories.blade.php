@props(['categories'])

<div class="tab-content">
    @foreach($categories as $category)
        <x-category-card-active :category="$category" alt="category image"/>
    @endforeach
</div>