@extends('layouts.master')
@section('title','Categories')
@section('content')
    <div class="container p-0">
        <div class="row ">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h3>Category  List Table</h3>
                        <form action="{{ route('category.store') }}" method="post" class="delForm form-inline my-3 ">
                            @csrf
                            <input type="text" name="title" class="form-control mr-4 " required > <button class="btn   btn-primary ">Create</button>
                            @error('title')
                            <small class="table-danger mb-0 mx-3 p-2  alert-danger alert  ">{{ $message }}</small>
                            @enderror
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
