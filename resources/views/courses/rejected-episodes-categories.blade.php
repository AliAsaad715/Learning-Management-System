@props(['categories'])

<div class="tab-content">
    @foreach($categories as $category)
        <x-category-card-rejected :category="$category" alt="category image"/>
    @endforeach
</div>