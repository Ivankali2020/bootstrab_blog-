@extends('layouts.master')
@section('title','Categories')
@section('content')
    <div class="container p-0">
        <div class="row ">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5>{{ $article->title}}</h5>
                        <div class="mb-3">
                            <small class="mr-3 font-weight-bolder  text-primary "> <i class="fa fa-layer-group  mr-2 "></i>   {{ $article->category->title }}</small>
                            <small class="mr-3 font-weight-bolder  text-success "> <i class="fa fa-calendar-alt mr-2 "></i>   {{ $article->created_at->format('d-m-Y ') }}</small>
                            <small class="mr-3 font-weight-bolder  text-info "><i class="fa fa-clock mr-2 "></i>{{ $article->created_at->format('h:i a ') }}</small>
                        </div>
                        <div class="text-black-50 my-5 "   style="text-align: justify ">
                           @php
                           echo html_entity_decode($article->description);
                           @endphp
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-5  ">
                         <div class="">
                             @if(\Illuminate\Support\Facades\Auth::user()->id == $article->user_id || \Illuminate\Support\Facades\Auth::user()->role == '0' )

                             <a href="{{ route('article.edit',$article->id) }}" class="btn mr-3  btn-outline-warning">Edit</a>
                             <form id="delForm"   action="{{ route('article.destroy',[$article->id,'page'=>$page]) }}" class="d-inline-block " method="post">
                                 @csrf
                                 @method('DELETE')
                                 <button type="button" onclick="askConfirm('{{$article->title}}')" class="btn btn-outline-primary deleteBtn">Delete</button>
                             </form>

                                 @endif
                         </div>
                            <div class="body">
                                {{ $article->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footer')

    <script>

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
                    $('#delForm').submit();
                }
            })
        }


    </script>

@endsection
