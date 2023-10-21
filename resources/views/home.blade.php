@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="col-lg-12">
        <div class="row g-2">
            <div class="col-md-2 border-end border-2 p-3" id="sidenav" style="height:100vh">
                <ul class="p-0 text-center text-dark text-lg-start nav" style="min-height: 50vh">
                    @include('layouts.includes.sideBar')
                    
                </ul>
            </div>
            

            <div class="col-md-10 mt-3 p-3">
                <div class="card">
                    <h4 class="card-header bg-primary text-light">Hello {{ auth()->user()->name }}</h4>

                    <div class="card-body">


                    </div>
                </div>
            </div>
            
        </div>
    </div>

</div>
@endsection
