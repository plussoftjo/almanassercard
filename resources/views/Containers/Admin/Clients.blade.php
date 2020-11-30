@extends('voyager::master')

@section('page_title', 'Clients')


@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
             Clients
        </h1>
    </div>
    
@stop

@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div id="app">
                            <app-route :users="{{$users}}"></app-route>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script src="/js/clients.js"></script>
@stop