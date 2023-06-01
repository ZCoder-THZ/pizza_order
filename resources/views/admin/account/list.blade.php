
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
    <h2 class="title-1">Admin List</h2>

    </div>
    </div>
    <div class="table-data__tool-right">
    <a href="{{route('category#createPage')}}">
    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
    <i class="zmdi zmdi-plus"></i>add item
    </button>
    </a>
    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
    </button>
    </div>
    </div>



            <div class="d-flex justify-content-between my-3">
                <h3 class="text-secondary">Seach Key :{{request('key')}} <span class="text-danger"> </span></h3>
                <h3 class="mr-3">Total :{{$admin->total()}} </h3>
            </div>
            <div class="col-3 offset-9">
                <form action="{{route('admin#list')}}" method="GET">
                    @csrf
                <div class="d-flex">
                    <input placeholder="search" type="text" name="key" id="" value="{{request('key')}}" class="form-control">
                    <button style="width: 40px" class="bg btn-dark" type="submit">
                        <i class="fa-solid fa-magnifying-glass">
                        </i>
                    </button>
                </div>
                </form>
            </div>



                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($admin as $ad )

                            <tr class="tr-shadow">
                                <td class="col-2">
                                @if ($ad->image==null)
                                 @if ($ad->gender=='female')
                                 <img src="{{asset('image/default-female.jpeg')}}" class="img-thumbnail shadow-sm" alt="" />
                                 @else
                                 <img src="{{asset('image/default-user.png')}}" class="img-thumbnail shadow-sm" alt="" />

                                 @endif
                                @else
                                <img src="{{asset('storage/'.$ad->image)}}" class="img-thumbnail shadow-sm" alt="">

                                @endif
                            </td>
                                <td>
                                    <span class="block-email">{{$ad->name}}</span>
                                </td>
                                <td>
                                    <span class="block-email">{{$ad->email}}</span>
                                </td>
                                <td>
                                    <span class="block-email">{{$ad->phone}}</span>
                                </td>
                                <td>
                                    <span class="block-email">{{$ad->gender}}</span>
                                </td>
                                <td>
                                    <span class="block-email">{{$ad->address}}</span>
                                </td>

                                <input type="hidden" name="" value="{{ $ad->id }}" id="userId">
                                <td >
                                    <div class="table-data-feature">
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="fa-solid fa-eye"></i>
                                        </button> --}}
                                        {{-- <a href="{{route('category#edit',$ad->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a> --}}
                                        @if (Auth::user()->id != $ad->id)


                                        {{-- <a href="{{route('admin#adminChangeRole',$ad->id)}}" style="cursor: pointer" class="item me-3" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <button type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Change the role">
                                            <i class="fa-solid fa-person-circle-minus">

                                            </i>
                                          </button>
                                        </a> --}}

                                    <select name="role" class="form-control me-3 statusChange" id="">
                                        <option value="user"  @if ($ad->role=='user')
                                            selected
                                        @endif>User</option>
                                        <option value="admin"  @if ($ad->role=='admin')
                                            selected
                                        @endif>Admin</option>
                                    </select>
                                    {{-- **************************** --}}
                                        <a href="{{route('admin#delete',$ad->id)}}" style="cursor: pointer" class="item me-3" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <button type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>

                                              </button>
                                        </a>
                                        @endif

                                    </div>
                                </td>
                                <td>{{$ad->created_at->format('j-F-Y')}}</td>

                            </tr>

                            <tr class="spacer"></tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{
                            $admin->links()
                        }}
                    </div>

                    <h3 class="text-secondary text-center mt-4">NO Categories</h3>

                </div>
                <!-- END DATA TABLE -->
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
            url:'admin/updateRole',
            data:$data,
            dataType:'json'
            });
            location.reload()
    })
    })
 </script>
@endsection