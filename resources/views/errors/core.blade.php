@extends('template.layout')

@section('app_title',env('APP_NAME'))
@section('container')
    <!-- begin:: Content -->
    <div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="my-vue">
        <div class="form-group" row>
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>
        </div>
    </div>
@stop