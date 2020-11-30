@extends('voyager::master')

@section('page_title', 'Clients')


@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
             Code Checker
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
                            <app-route ></app-route>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script src="/js/code_checker.js"></script>
@stop