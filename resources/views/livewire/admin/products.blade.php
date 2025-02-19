<div>

    <div class="table overflow-auto" tabindex="8">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">عنوان جستجو</label>
            <div class="col-sm-10">
                <input type="text" class="form-control text-left" dir="rtl" wire:model.live="search">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead class="thead-light">
            <tr>
                <th class="text-center align-middle text-primary">ردیف</th>
                <th class="text-center align-middle text-primary">عکس</th>
                <th class="text-center align-middle text-primary">نام محصول</th>
                <th class="text-center align-middle text-primary">قیمت</th>
                <th class="text-center align-middle text-primary">تعداد</th>
                <th class="text-center align-middle text-primary">تخفیف</th>
                <th class="text-center align-middle text-primary">گالری</th>
                <th class="text-center align-middle text-primary">ویژگی ها</th>
                <th class="text-center align-middle text-primary">ویرایش</th>
                <th class="text-center align-middle text-primary">حذف</th>
                <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $key => $product)


                <tr>
                    <td class="text-center align-middle">{{$products->firstItem() + $key}}</td>
                    <td class="text-center align-middle">
                        <figure class="avatar avatar">
                            <img src="{{url('images/admin/products/'.$product->image)}}"
                                 class="rounded-circle"
                                 style="width: 55px;height: 55px;"
                                 alt="image">
                        </figure>
                    </td>
                    <td class="text-center align-middle">{{$product->title}}</td>
                    <td class="text-center align-middle">{{$product->price}}</td>
                    <td class="text-center align-middle">{{$product->count}}</td>
                    <td class="text-center align-middle">{{$product->discount}}</td>

                    <td class="text-center align-middle">
                        <a class="btn btn-outline-info" href="{{route('create.product.gallery',$product->id)}}">
                            گالری
                        </a>
                    </td>

                    <td class="text-center align-middle">
                        <a class="btn btn-outline-info text-center align-middle" href="{{route('create.product.properties',$product->id)}}">
                            <div>ویژگی ها</div>
                        </br>
                            <span>
                                @foreach ($product->properties as $key => $product_property)
                                    @if ($key>0)
                                    ,
                                    @endif
                                    {{$product_property->title}}
                                @endforeach
                            </span>
                        </a>
                    </td>

                    <td class="text-center align-middle">
                        <a class="btn btn-outline-info" href="{{route('products.edit',$product->id)}}">
                            ویرایش
                        </a>
                    </td>

                    <td class="text-center align-middle">
                        <a class="btn btn-outline-danger" wire:click="deleteProduct({{$product->id}})">
                            حذف
                        </a>
                    </td>

                    <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($product->created_at)->format('%B %d, %Y')}}</td>
                </tr>
            @endforeach
        </table>
        <div style="margin: 40px !important;"
             class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
            {{$products->appends(Request::except('page'))->links()}}
        </div>
    </div>


</div>
@section('scripts')
    <script>
        window.addEventListener('deleteProduct',event=>{
            Swal.fire({
                title:'Are you sure?',
                text: "You won't be able to revert this! ",
                icon:'warning',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText:'Yes delete it !'
            }).then((result) => {
                if(result.isConfirmed){
                    Livewire.dispatch('destroyProduct',[event.detail.id]);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
@endsection
