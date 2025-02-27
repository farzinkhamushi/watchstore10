@extends('admin.page-blade-view')

@section('core')
    <h6 class="card-title">ایجاد برند</h6>
    <form method="POST" action="{{route('brands.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">نام برند</label>
            <div class="col-sm-10">
                <input type="text" class="form-control text-left" dir="rtl" name="title">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="image"> آپلود عکس </label>
            <input class="col-sm-10" type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group row">
            <button name="submit" type="submit" class="btn btn-success btn-uppercase">
                <i class="ti-check-box m-r-5"></i> ذخیره
            </button>

        </div>
    </form>
@endsection
