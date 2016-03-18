
@extends('layouts.app')

@section('title')
    @if($news)
        {{ $news->title }}
        @if(!Auth::guest() && ($news->author_id == Auth::user()->id))
            <button class="btn" style="float: right"><a href="{{ url('edit/'.$news->slug)}}">Edit Post</a></button>
        @endif
    @else
        Page does not exist
    @endif
@endsection

@section('title-meta')
    <p>{{ $news->created_at->format('M d,Y \a\t h:i a') }}@if($news->user) By <a href="{{ url('/user/'.$news->user_id)}}">{{ $news->user->name }}</a>@endif</p>
@endsection

@section('content')

    @if($news)
        <div>
            {!! $news->content !!}
        </div>
        <div>
            <h2>Leave a comment</h2>
        </div>
        @if(Auth::guest())
            <p>Login to Comment</p>
        @else
            <div class="panel-body">
                <form method="post" action="/comment/add">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="news_id" value="{{ $news->id }}">
                    <input type="hidden" name="slug" value="{{ $news->slug }}">
                    <div class="form-group">
                        <textarea required="required" placeholder="Enter comment here" name = "text" class="form-control"></textarea>
                    </div>
                    <input type="submit" name='post_comment' class="btn btn-success" value = "{{trans('base.form-submit-add')}}"/>
                </form>
            </div>
        @endif

        <div>
            @if($comments)
                <ul style="list-style: none; padding: 0">
                    @foreach($comments as $comment)
                        <li class="panel-body">
                            <div class="list-group">
                                <div class="list-group-item">
                                    @if($comment->user)
                                        <h3>{{ $comment->user->name }}</h3>
                                    @else
                                        <h3>Bot</h3>
                                    @endif
                                    <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                                </div>
                                <div class="list-group-item">
                                    <p>{{ $comment->text }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @else
        404 error
    @endif

@endsection