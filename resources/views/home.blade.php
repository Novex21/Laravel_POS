@extends('layouts.app')

@section('content')

    <div class="card">
        <h4 class="card-header bg-primary text-light">Hello {{ auth()->user()->name }}</h4>

        <div class="card-body">


        </div>
    </div>

@endsection
