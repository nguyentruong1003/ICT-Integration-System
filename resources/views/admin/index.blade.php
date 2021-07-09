@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display: flex">
                    <!-- <div class="card-body"> -->
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- {{ __('Command List:') }} -->
                    <!-- </div> -->
                <!-- {{ __('Administrator') }} -->
                <h4 style="color: red">Administrator</h4>
                    <ul>
                        <li class="nav navbar nav-tabs"><a href="./users_info">DANH SÁCH NGƯỜI DÙNG</a></li>
                        <li class="nav navbar nav-tabs"><a href="./units_info">DANH SÁCH ĐƠN VỊ</a></li>
                        
                    </ul>
                </div>

                <!-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Command List:') }}
                </div> -->

                <!-- <div>
                    <ul>
                        <li class="nav navbar nav-tabs"><a href="./users_info">DANH SÁCH NGƯỜI DÙNG</a></li>
                        <li class="nav navbar nav-tabs"><a href="./units_info">DANH SÁCH ĐƠN VỊ</a></li>
                        
                    </ul>
                </div> -->
            </div>
            
            @yield('list')
        </div>
    </div>
</div>
@endsection
