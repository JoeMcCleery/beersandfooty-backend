@extends('errors::minimal')

@section('title', __('Beers and Footy - Page Not Found'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'Page Not Found'))

@section('Header')
    <h1>
        Beers and Footy - API
    </h1>
    <img src="/images/beersandfooty_logo_01.png" height="150px" />
@endsection
