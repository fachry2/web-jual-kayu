@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard <b>ADMIN</b></div>

                    <div class="panel-body">
                    @component('components.who')
                    @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
