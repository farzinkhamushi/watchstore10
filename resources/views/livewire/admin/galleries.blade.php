<div class="mt-5 row">
    @foreach($galleries as $gallery)
        <div class="p-2 col-md-4 d-flex justify-content-around align-items-center border-danger">
            <img src="{{url('/images/admin/products/'.$gallery->image)}}" style="width:100px" alt="" srcset="">
            <div>
                <button class="btn btn-info"><i wire:click="deleteGallery({{$product_id}},{{$gallery->id}})" class="fa fa-trash"></i></button>
            </div>
        </div>
    @endforeach
</div>

@section('scripts')
    <script>
        window.addEventListener('destroyGallery',event=>{
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
                    Livewire.dispatch('destroyGallery',[event.detail.product_id,event.detail.id]);
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
