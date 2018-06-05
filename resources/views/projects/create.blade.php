@extends('common.template')

@section('heading')
    Create Project
@stop

@section('content')

    {!! Form::open(['route' => ['projects.store']]) !!}

    @include('projects.partials.form')

@stop
