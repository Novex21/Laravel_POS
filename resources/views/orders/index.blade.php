@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <livewire:order/>
    </div>

    <style>
        .modal.right.custom .modal-dialog.custom {
            top: 0;
            right: 0;
            margin-right: 1vh;
            /* position: absolute; */
        }
    </style>

@endsection


