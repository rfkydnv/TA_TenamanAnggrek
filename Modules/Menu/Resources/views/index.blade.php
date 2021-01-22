@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title','')

@section('container')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('menu.name') !!}
    </p>
@stop
