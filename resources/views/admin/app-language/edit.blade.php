@extends('admin.page-blade-view')

@section('core')
    <h6 class="card-title">ویرایش زبان مورد نظر</h6>
    <form method="POST" action="{{route('app-languages.update',$app_language->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group row">
            <figure class="avatar avatar">
                <img src="{{url('images/admin/app-languages/'.$app_language->flag)}}"
                     class="rounded-circle"
                     style="width: 55px;height: 55px;"
                     alt="image">
            </figure>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">زبان مورد نظر</label>
            <div class="col-sm-10">
                <input type="text" class="form-control text-left" dir="rtl" name="language" value="{{$app_language->language}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="flag">عکس برند</label>
            <input class="col-sm-10 form-control-file" type="file" id="image" name="flag">
        </div>
        <div class="form-group row">
            <button name="submit" type="submit" class="btn btn-success btn-uppercase">
                <i class="ti-check-box m-r-5"></i> ذخیره
            </button>

        </div>
    </form>
@endsection
