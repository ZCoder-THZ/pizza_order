
@extends('admin.layouts.master')
@section('title','Category Page')




@section('content')


<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                 
                </div>
                @if (session('deleteSuccess'))
                <div class="offset-8 col-4">
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>{{session('deleteSuccess')}}</strong>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
             </div>
             @endif

             <div class="col-6">
                <h3>{{ count($users) }}</h3>
             </div>

    


                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>User Name</th>
                                <th>Email </th>
                                <th>Gender  </th>
                                <th>Phone </th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($users as $user )
                            <tr>
                                <td class="col-1">
                                    @if ($user->image==null)
                                    @if ($user->gender=='female')
                                    <img  src="{{asset('image/default-female.jpeg')}}" class="" alt="" />
                                     @else
                                      <img  src="{{asset('image/default-user.png')}}" class="" alt="" />

                                     @endif
                                    @else
                                    <img  src="{{asset('storage/'.$user->image)}}" />

                                    @endif
                                </td>
                                <input type="hidden" name="" id="userId" value="{{ $user->id }}">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>
                              
                                    <select name="role" class="form-control statusChange" id="">
                                        <option value="user"  @if ($user->role=='user')
                                            selected
                                        @endif>User</option>
                                        <option value="admin"  @if ($user->role=='admin')
                                            selected
                                        @endif>Admin</option>
                                    </select>
                                </td>
                                <td><a href="{{ route('admin#deleteAccount',$user->id) }}" class="btn btn-danger">Delete</a></td>

                                
                            </tr>
                                
                            @endforeach



                            <tr class="spacer"></tr>


                        </tbody>
                    </table>



                </div>
                <!-- END DATA TABLE -->
                <div class="mt-3">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
 <script>
     $(document).ready(function(){
   
    //  ****************************************************************
    $('.statusChange').change(function(){
        $currentStatus=$(this).val();
        $parentNode=$(this).parents('tr');
        $userId=$parentNode.find('#userId').val();
        console.log('status Change',$userId);
        $data={
            
            'userId':$userId,
            'role':$currentStatus
        }
        $.ajax({
            method:'get',
            url:'http://127.0.0.1:8000/user/change/role',
            data:$data,
            dataType:'json'
            });
            location.reload()
    })
    })
 </script>
@endsection