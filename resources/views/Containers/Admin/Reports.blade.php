@extends('voyager::master')

@section('page_title', 'Order System')


@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
             Reports
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
<script src="/js/reports.js"></script>
@stop