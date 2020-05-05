@extends('errors::minimal')

@section('title', __('Beers and Footy - Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))

@section('Header')
    <h1>
        Beers and Footy - API
    </h1>
    <img src="/images/beersandfooty_logo_01.png" height="150px">
@endsection
