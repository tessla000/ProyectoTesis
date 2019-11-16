@extends('layouts.app')
@section('title', 'Terra Nostra')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    @auth
                    {{ Auth::user()->name }}
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
