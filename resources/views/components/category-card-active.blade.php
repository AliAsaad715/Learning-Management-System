@props(['category', 'alt'])

<div class="category-card">
    <h2 class="category-title">{{$category->title}}</h2>
    <div class="category-container">
        <div class="topics-container">
            @foreach($category->topics as $topic)
                <x-topic-button :href="route('courses.active_courses', ['cate' => $category->id, 'topic' => $topic->id])" class="topic-tag">
                    {{ $topic->title }}
                </x-topic-button>
            @endforeach
        </div>
        <div class="category-img">
            <img src="{{ asset('build/assets/img/categories/' . $category->image_url)}}" alt="{{$alt}}">
        </div>
    </div>
</div>