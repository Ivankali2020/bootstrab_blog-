@extends('layouts.master')
@section('title','EditCategories')
@section('content')
    <div class="container p-0">
        <div class="row ">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h3>User List Table</h3>
                        <form   action="{{ route('category.update',$value->id) }}" method="post" class="d-flex justify-content-between  my-3 ">
                            @csrf
                            @method('put')
                            {{-- this is edit --}}
                           <div class="d-flex flex-grow-1 ">
                               <input type="text" value="{{ $value->title }}" name="title" class="w-25 form-control mr-4 " required >
                               <button class="btn btn-primary ">Edit</button>
                               @error('title')
                               <small class="table-danger d-inline-block  mb-0 mx-3 p-2  alert-danger alert  ">{{ $message }}</small>
                               @enderror
                           </div>
                            <div class="align-self-end ">
                                <a href="{{ route('category.index') }}" class="btn btn-outline-primary"><i class="fa fa-plus "></i></a>
                            </div>

                        </form>

                        @include('Category.table')
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footer')

    <script>
        $(document).ready(function (){
            $('.deleteBtn').click(function (e){
                e.preventDefault();
                console.log('hlell');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons:true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delForm').submit();
                    }
                })
            })
        })
    </script>

@endsection

