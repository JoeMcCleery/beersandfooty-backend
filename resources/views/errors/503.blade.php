@extends('errors::minimal')

@section('title', __('Beers and Footy - Site in Maintenance...'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Site in Maintenance...'))

@section('Header')
    <h1>
        Beers and Footy - API
    </h1>
    <img src="/images/beersandfooty_logo_01.png" height="150px">
@endsection
