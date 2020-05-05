@extends('errors::minimal')

@section('title', __('Beers and Footy - Page Not Found'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'Page Not Found'))

<div class="flex-center" style="min-height: 150px; width: 100%; flex-direction: column;">
    <h1>
        Beers and Footy - API
    </h1>
    <img src="/images/beersandfooty_logo_01.png" height="150px">
    <a href="/" title="Home" >API Home</a>
</div>

