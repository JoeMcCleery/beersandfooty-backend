@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                You are logged in!
            </div>
        </div>
        <passport-clients class="col-12"></passport-clients>
        <passport-authorized-clients class="col-12"></passport-authorized-clients>
        <passport-personal-access-tokens class="col-12"></passport-personal-access-tokens>
    </div>
</div>
@endsection
