@extends('layouts.master')

@section('title')
    <title>{{__('header.home_title')}}</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('data_field_name.home.dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('data_field_name.home.message') }}!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
