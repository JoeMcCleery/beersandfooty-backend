@extends('errors::minimal')

@section('title', __('Beers and Footy - Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))

@section('Header')
    <h1>
        Beers and Footy - API
    </h1>
    <img src="/images/beersandfooty_logo_01.png" height="150px">
@endsection
