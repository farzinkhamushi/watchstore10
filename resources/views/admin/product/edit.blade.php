@extends('admin.layouts.master')
@section('content')
    <main class="main-content">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ویرایش محصول</h6>
                    <form method="POST" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام فارسی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$product->title}}" class="form-control text-left" dir="rtl" name="title">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام انگلیسی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$product->title_en}}" class="form-control text-left" dir="rtl" name="title_en">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">قیمت محصول</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control text-left" dir="rtl" name="price" value="{{$product->price}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">تعداد محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="count" value="{{$product->count}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">گارانتی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="guaranty" value="{{$product->guaranty}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">تخفیف محصول</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control text-left" dir="rtl" name="discount" value="{{$product->discount}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">توضیحات محصول</label>
                            <div class="col-sm-10">
                                <textarea dir="rtl" class="form-control" id="description" name="description" rows="10" cols="30" value="{{$product->description}}"></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" @if($product->is_special) checked @endif class="custom-control-input" id="customCheck" dir="rtl" name="is_special">
                                    <label  class="custom-control-label" for="customCheck">فروش شگفت انگیز</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label  class="col-form-label">تاریخ انقضای فروش شگفت انگیز</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="text-left form-control" dir="rtl" id="special_expiration" name="special_expiration" value="{{\Hekmatinasser\Verta\Verta::instance($product->special_expiration)}}">
                            </div>
                        </div>

                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">دسته بندی</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="category_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach($categories as $key => $value)
                                        @if($product->category_id == $key)
                                            <option selected="selected" value="{{$key}}">{{$value}}</option>
                                        @endif
                                            <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">برند</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="brand_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach($brands as $key => $value)
                                        @if($product->brand_id == $key)
                                            <option selected="selected" value="{{$key}}">{{$value}}</option>
                                        @endif
                                            <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">انتخاب رنگ</label>
                            <div class="col-sm-10">
                                <select class="form-select" multiple="" name="colors[]"
                                    style="width: 100%;text-align: right"
                                    data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach ($colors as $key => $value)
                                        @if( in_array( $key , $product->colors()->pluck('id')->toArray() ) )
                                            <option selected value="{{$key}}">{{$value}}</option>
                                        @else
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="image"> آپلود عکس </label>
                            <input  class="col-sm-10" type="file" class="form-control-file" id="image" name="image" value="{{$product->image}}">
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

@section('scripts')
    <script>
        $('.form-select').select2();
        var customOptions = {
                placeholder: "روز / ماه / سال"
                , twodigit: false
                , closeAfterSelect: true
                , nextButtonIcon: "fa fa-arrow-circle-right"
                , previousButtonIcon: "fa fa-arrow-circle-left"
                , buttonsColor: "#5867dd"
                , markToday: true
                , markHolidays: true
                , highlightSelectedDay: true
                , sync: true
                , gotoToday: true
            }
            kamaDatepicker('special_expiration', customOptions);

            if ($('#description').length) {
                CKEDITOR.replace('description');
            }
    </script>
@endsection
