<div>
    <div class="table" tabindex="8">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">جستجو زبان</label>
            <div class="col-sm-10">
                <input type="text" class="form-control text-left" dir="rtl" wire:model.live="search">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead class="thead-light">
            <tr>
                <th class="text-center align-middle text-primary">ردیف</th>
                <th class="text-center align-middle text-primary">پرچم</th>
                <th class="text-center align-middle text-primary">زبان مورد نظر</th>
                <th class="text-center align-middle text-primary">ویرایش</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($app_languages as $key => $app_language)
                <tr>
                    <td class="text-center align-middle">{{$app_languages->firstItem() + $key}}</td>
                    <td class="text-center align-middle">
                        <figure class="avatar avatar">
                            <img src="{{url('images/admin/app-languages/'.$app_language->flag)}}"
                                 class="rounded-circle"
                                 style="width: 55px;height: 55px;"
                                 alt="image">
                        </figure>
                    </td>
                    <td class="text-center align-middle">{{$app_language->language}}</td>
                    <td class="text-center align-middle">
                        <a class="btn btn-outline-info" href="{{route('app-languages.edit',$app_language->id)}}">
                            ویرایش
                        </a>
                    </td>



                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="margin: 40px !important;"
             class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
            {{$app_languages->appends(Request::except('page'))->links()}}
        </div>

    </div>

</div>
