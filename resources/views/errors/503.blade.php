@extends('errors::minimal')

@section('title', __('Site in Maintenance...'))
@section('code', '503')
<div class="flex-center" style="min-height: 300px; width: 100%; position: absolute; flex-direction: column;">
    <h1>
        Beers and Footy - API
    </h1>
    <img src="/images/beersandfooty_logo_01.png" height="250px">
    @section('message', __($exception->getMessage() ?: 'Site in Maintenance...'))
</div>

