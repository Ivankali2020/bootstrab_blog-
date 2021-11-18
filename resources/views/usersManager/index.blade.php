@extends('layouts.master')

@section('content')
    <div class="container p-0">
        <div class="row ">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h3>User List Table</h3>
                        <table class="table table-striped table-md-responsive table-bordered table-hover">
                            <thead class="table-primary ">
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Email</td>

                                <td>Control</td>
                                <td>Role</td>

                                <td>Created_at</td>
                                <td>Updated_at</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $arr = ['Admin','User']
                            @endphp
                                @foreach($users as $user)

                                    <tr class="@if($user->isBaned == 1 ) table-danger text-danger  border-danger @endif">
                                        <td>{{ $user->id  }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>

                                        <td class="text-nowrap ">
                                          @if($user->isBaned == 0)

                                                @if( $user->role != '0')
                                                    <form class="d-inline-block" id="upgrade{{ $user->id }}" action="{{ route('adminUpgrade') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $user->id }}" name="id">
                                                        <button onclick="askConfirm({{ $user->id }})" type="button" class="btn btn-outline-info">Admin</button>
                                                    </form>
                                                    <form class="d-inline-block" id="ban{{ $user->id }}" action="{{ route('banuser') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $user->id }}" name="id">
                                                        <button onclick="askBan({{ $user->id }})" type="button" class="btn btn-outline-info">Ban</button>
                                                    </form>

                                                @endif
{{--                                                //that is for all//--}}
                                                <button onclick="changePassword({{$user->id}},'{{$user->name}}')" class="btn text-dark btn-outline-warning">Change Password</button>

                                            @else
                                                <form  id="unBan{{ $user->id }}" action="{{ route('unBan') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $user->id }}" name="id">
                                                    <button onclick="askunBan({{ $user->id }})" type="button" class="btn d-block w-100 btn-outline-success">Unban User</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>{{ $arr[$user->role] }}</td>
                                        <td class="text-nowrap ">
                                            <small class="text-muted">
                                                <i class="fa fa-calendar  mr-2"></i>
                                                {{ $user->created_at->format('d M Y')  }}
                                                <br>
                                                <i class="fa fa-clock mr-2"></i>
                                                {{ $user->created_at->format('H:i a') }}
                                            </small>
                                        </td>
                                        <td class="text-nowrap ">
                                            <small class="text-muted">
                                                <i class="fa fa-calendar  mr-2"></i>
                                                {{ $user->updated_at->format('d M Y')  }}
                                                <br>
                                                <i class="fa fa-clock mr-2"></i>
                                                {{ $user->updated_at->format('H:i a') }}
                                            </small>
                                        </td>
                                    </tr>

                                @endforeach
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
        function changePassword(id,name){
            let url = "{{ route('changePassword') }}";
            Swal.fire({
                title: 'Change Password '+name,
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                    required : 'required',
                    minlength : 8
                },
                showCancelButton: true,
                confirmButtonText: 'Change',
                showLoaderOnConfirm: true,
                preConfirm: function (newPassword){
                $.post(url,{
                    'id' : id,
                    'password' : newPassword,
                    '_token' : '{{ csrf_token() }}' //this is must be here post method for AJAX
                  }).done(function (data){
                      console.log(data.success);
                      if(data.statusCode == 200){
                          Swal.fire('Oops...',data.success,'success');
                      }else {
                          console.log(data);
                          Swal.fire('Oops...','Something Was Wrong!','error');
                      }
                 })
                }

            })
        }
        function askConfirm(id){
            Swal.fire({
                title: 'Are you sure to <br> upgrade admin this user?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#upgrade" + id).submit();
                }
            })
        }

        function askunBan(id){
            Swal.fire({
                title: 'Are you sure to <b>UnBan</b>  this user?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#unBan"+id).submit();
                }
            })
        }


        function askBan(id){
            Swal.fire({
                title: 'Are you sure to <b> Ban </b> this user?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#ban" + id).submit();
                }
            })
        }
    </script>

    @endsection
