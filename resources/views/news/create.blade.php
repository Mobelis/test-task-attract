@extends('layouts.app')

@section('title'){{$title}}@endsection

@section('content')
    {!! Form::open(['route' => 'news.store']) !!}
        @include('news._form')
    {!! Form::close()!!}
@endsection