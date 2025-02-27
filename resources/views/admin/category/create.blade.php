@extends('admin.layouts.master')
@section('content')
    <main class="main-content">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد دسته بندی</h6>
                    <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام دسته بندی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title">
                            </div>
                        </div>

                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">دسته پدر</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="parent_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option selected="selected" value="0">دسته اصلی</option>
                                    @foreach($categories as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="image"> آپلود عکس </label>
                            <input  class="col-sm-10" type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <div class="form-group row">
                            <button name="submit" type="submit" class="btn btn-success btn-uppercase">
                                <i class="ti-check-box m-r-5"></i> ذخیره
                            </button>

                        </div>
                    </form>
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
