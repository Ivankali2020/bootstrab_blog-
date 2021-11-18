@extends('layouts.master')
@section('title','DataTable ')
@section('style')
    <style>
        table tbody{
            overflow-scrolling: auto;
        }
        .pagination{
            margin-bottom: 0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container p-0">
        <div class="row ">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body ">
                        <h3 class="mb-3 "> <i class="fa fa-list-alt "></i> Article List</h3>
                        @foreach($articles as $article)
                            <form id="delForm{{ $article->id }}"   action="{{ route('article.destroy',$article->id) }}" class="d-inline-block " method="post">
                                @csrf
                                @method("DELETE")
                            </form>
                        @endforeach
                        <table class="table table-bordered table-hover" id="example">
                            <thead class="table-danger ">
                            <tr>
                                <th>#</th>
                                <th>Article</th>
                                <th class="no-sort">Category</th>
                                <th>Action</th>
                                <th>Uptime</th>
                            </tr>
                            </thead>
                            <tbody >

{{--                            @foreach($articles as $article)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $article->id }}</td>--}}
{{--                                    <td>--}}

{{--                                    </td>--}}
{{--                                    <td>{{ $article->category->title }}</td>--}}
{{--                                    <td>{{ $article->user->name }}</td>--}}
{{--                                    <td>--}}
{{--                                        --}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <small> <i class="fa fa-calendar-alt mr-2 "></i>   {{ $article->created_at->format('d-m-Y ') }}</small>--}}
{{--                                        <br>--}}
{{--                                        <small><i class="fa fa-clock mr-2 "></i>{{ $article->created_at->format('h:i a ') }}</small>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}



                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "processing": true,
                "serverSide": true,
                'ajax': "{{ route('dataTable.show') }}",
                "columns": [
                    { "data": "id" , 'name' : 'id' },
                    { "data": "title" , "name" : 'title' },
                    { "data": "category" , "name" : 'category' ,'sortable' : false ,'searchable' : true },
                    { "data": "action" , "name" : 'action' },
                    { "data": "hello" , "name" : 'hello' ,'sortable' : false},
                ],
                columnDefs : [
                    { targets : 'no-sort' , searchable : true } //fucking s is so noisy
                ],

            } );
        } );
        $(document).ready(function (){

            askConfirm =  (x) => {
                console.log('hlell');
                Swal.fire({
                    title: x,
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons:true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delForm'+x).submit();
                    }
                })
            }

        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

@endsection
