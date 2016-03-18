@extends('layouts.app')

@section('title')
    {{$title}}
@endsection

@section('content')

    @if ( !$news->count() )
        There is no post till now. Login and write a new post now!!!
    @else
        <div class="">
            @foreach( $news as $item )
                <div class="list-group">
                    <div class="list-group-item">
                        <h3><a href="{{ url('/news/'.$item->slug) }}">{{ $item->title }}</a>
                            @if(!Auth::guest() && ($item->user_id == Auth::user()->id))
                                @if($item->published == '1')
                                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$item->slug)}}">Edit Post</a></button>
                                @else
                                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$item->slug)}}">Edit Draft</a></button>
                                @endif
                            @endif
                        </h3>
                        <p>{{ $item->created_at->format('M d,Y \a\t h:i a') }} @if ($item->user )By <a href="{{ url('/user/'.$item->user_id)}}">{{ $item->user->name }}</a> @endif</p>

                    </div>
                    <div class="list-group-item">
                        <article>
                            {!! str_limit($item->content, $limit = 1500, $end = '....... <a href='.url("/".$item->slug).'>Read More</a>') !!}
                        </article>
                    </div>
                </div>
            @endforeach
            {!! $news->render() !!}
        </div>
    @endif
@endsection
