@extends('admin.layouts.master')

@section('content')
    <main class="main-content">
        @include('admin.layouts.errors')
        <div class="row">
            @if (\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-info">
                    <div>{{session('message')}}</div>
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    @yield('core')
                </div>
            </div>
        </div>
    </main>
@endsection


@section('scripts')
    <script>
        $('.form-select').select2();
    </script>
@endsection
