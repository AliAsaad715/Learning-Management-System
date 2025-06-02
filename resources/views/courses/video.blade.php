@extends('layouts.header')

@section('title', $episode->title)

@section('content')
    <div class="video-episode-container">
        <!-- Video Player Section -->
        <div class="video-main-section">
            <div class="video-player-wrapper">
                <iframe src="{{$episode->video_url}}" frameborder="0" allowfullscreen></iframe>
            </div>
            
            <div class="video-actions-container">
                <div class="video-stats-container">
                    @if($episode->trashed() || !$episode->published) 
                       <span class="requested-word">Requested:</span> <span class="date">{{\Carbon\Carbon::parse($episode->publishing_request_date)->format('M d, Y')}}</span>
                    @else
                        <div class="video-like-btn" aria-label="Like this episode">
                            <i class="far fa-thumbs-up"></i>
                            <span class="video-like-count">{{$episode->likes}}</span>
                        </div>
                        <span class="video-views-count"><i class="fas fa-eye"></i> {{$episode->views}} views</span>
                        <span class="video-publish-date"><i class="far fa-calendar-alt"></i><span class="published-word">Published:</span> <span class="date">{{\Carbon\Carbon::parse($episode->publishing_date)->format('M d, Y')}}</span></span>        
                    @endif
                    @if($episode->quiz)
                        <a href="{{route('courses.quiz', ['episode_id' => $episode->id])}}" class="video-quiz-btn">
                            <i class="fas fa-question-circle"></i> Start Quiz
                        </a>   
                    @endif
                </div>
            </div>
            
            <h1 class="video-title">{{$episode->title}}</h1>
        </div>
        
        <!-- Comments Section -->
        <div class="video-comments-section">
            <h2>Comments <span class="video-comment-count">({{count($episode->comments)}})</span></h2>
            <div class="video-commnts-internal-container">
                @if(!$episode->trashed() && $episode->published)
                    <div class="video-comments-list">
                        @foreach ($episode->comments as $comment)
                            <div class="video-comment-item">
                                <div class="video-comment-header">
                                    <div class="video-comment-user">
                                        @if($comment->user->profile_image_url)
                                            <img src="{{asset('build/assets/img/profiles/' . $comment->user->profile_image_url)}}" alt="User Image" class="video-user-avatar">
                                        @else
                                            <img src="{{asset('build/assets/img/anonymous_icon.png')}}" alt="User Image" class="video-user-avatar">
                                        @endif
                                        <span class="video-username">{{$comment->user->first_name}} {{$comment->user->last_name}}</span>
                                    </div>
                                    <div class="video-comment-meta">
                                        <span class="video-comment-like"><i class="far fa-thumbs-up"></i> {{$comment->likes}}</span>
                                        @php
                                            $commentTimestamp = strtotime($comment->comment_date);
                                            $ago = time() - $commentTimestamp;
    
                                            // Time intervals in seconds
                                            $minute = 60;
                                            $hour = 60 * $minute;
                                            $day = 24 * $hour;
                                            $week = 7 * $day;
                                            $month = 30 * $day; // Approximate (30 days)
                                            $year = 365 * $day; // Approximate (365 days)
    
                                            if ($ago < $minute) {
                                                $comment_ago = ($ago < 10) ? "Just now" : $ago . " seconds ago";
                                            } elseif ($ago < $hour) {
                                                $minutes = floor($ago / $minute);
                                                $comment_ago = $minutes == 1 ? "1 minute ago" : "$minutes minutes ago";
                                            } elseif ($ago < $day) {
                                                $hours = floor($ago / $hour);
                                                $comment_ago = $hours == 1 ? "1 hour ago" : "$hours hours ago";
                                            } elseif ($ago < $week) {
                                                $days = floor($ago / $day);
                                                $comment_ago = $days == 1 ? "1 day ago" : "$days days ago";
                                            } elseif ($ago < $month) {
                                                $weeks = floor($ago / $week);
                                                $comment_ago = $weeks == 1 ? "1 week ago" : "$weeks weeks ago";
                                            } elseif ($ago < $year) {
                                                $months = floor($ago / $month);
                                                $comment_ago = $months == 1 ? "1 month ago" : "$months months ago";
                                            } else {
                                                $years = floor($ago / $year);
                                                $comment_ago = $years == 1 ? "1 year ago" : "$years years ago";
                                            }
                                        @endphp
                                        <span class="video-comment-date">{{$comment_ago}}</span>
                                    </div>
                                </div>
                                
                                <p class="video-comment-text">{{$comment->content}}</p>
                                
                                <!-- Replies Section with toggle -->
                                @if(count($comment->replies) > 0)
                                    <details class="video-replies-details">
                                        <summary class="video-replies-toggle">
                                            <span class="video-replies-count">{{count($comment->replies)}}</span> replies
                                            <i class="fas fa-chevron-down"></i>
                                        </summary>
                                        <div class="video-replies-container">
                                            <div class="video-replies-list">
                                                @foreach ($comment->replies as $reply)
                                                    <div class="video-reply-item">
                                                        <div class="video-comment-header">
                                                            <div class="video-comment-user">
                                                                @if($reply->user->profile_image_url)
                                                                    <img src="{{asset('build/assets/img/profiles/' . $reply->user->profile_image_url)}}" alt="User Image" class="video-user-avatar">
                                                                @else
                                                                    <img src="{{asset('build/assets/img/anonymous_icon.png')}}" alt="User Image" class="video-user-avatar">
                                                                @endif
                                                                <span class="video-username">{{$reply->user->first_name}} {{$reply->user->last_name}}</span>
                                                            </div>
                                                            <div class="video-comment-meta">
                                                                <span class="video-comment-like"><i class="far fa-thumbs-up"></i> {{$reply->likes}}</span>
                                                                @php
                                                                    $replyTimestamp = strtotime($reply->reply_date);
                                                                    $ago = time() - $replyTimestamp;
    
                                                                    // Time intervals in seconds
                                                                    $minute = 60;
                                                                    $hour = 60 * $minute;
                                                                    $day = 24 * $hour;
                                                                    $week = 7 * $day;
                                                                    $month = 30 * $day; // Approximate (30 days)
                                                                    $year = 365 * $day; // Approximate (365 days)
    
                                                                    if ($ago < $minute) {
                                                                        $reply_ago = ($ago < 10) ? "Just now" : $ago . " seconds ago";
                                                                    } elseif ($ago < $hour) {
                                                                        $minutes = floor($ago / $minute);
                                                                        $reply_ago = $minutes == 1 ? "1 minute ago" : "$minutes minutes ago";
                                                                    } elseif ($ago < $day) {
                                                                        $hours = floor($ago / $hour);
                                                                        $reply_ago = $hours == 1 ? "1 hour ago" : "$hours hours ago";
                                                                    } elseif ($ago < $week) {
                                                                        $days = floor($ago / $day);
                                                                        $reply_ago = $days == 1 ? "1 day ago" : "$days days ago";
                                                                    } elseif ($ago < $month) {
                                                                        $weeks = floor($ago / $week);
                                                                        $reply_ago = $weeks == 1 ? "1 week ago" : "$weeks weeks ago";
                                                                    } elseif ($ago < $year) {
                                                                        $months = floor($ago / $month);
                                                                        $reply_ago = $months == 1 ? "1 month ago" : "$months months ago";
                                                                    } else {
                                                                        $years = floor($ago / $year);
                                                                        $reply_ago = $years == 1 ? "1 year ago" : "$years years ago";
                                                                    }
                                                                @endphp
                                                                <span class="video-comment-date">{{$reply_ago}}</span>
                                                            </div>
                                                        </div>
                                                        <p class="video-comment-text">{{$reply->content}}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </details>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else 
                    <div class="episode-comments-unavailable">
                        <div class="episode-comments-unavailable-icon">
                            <i class="fas fa-comment-slash"></i>
                        </div>
                        <div class="episode-comments-unavailable-message">
                            @if(!$episode->published)
                            Comments will be available once the episode is published
                            @else
                            No comments yet. Be the first to comment!
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection