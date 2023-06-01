
@extends('admin.layouts.master')
@section('title','Edit Account Page')




@section('content')
        <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="row">


</div>
<div class="section__content section__content--p30">
<div class="container-fluid">
            <div class="row">
              <div class="col-3 offset-8">
             <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                    </div>
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Role</h3>
                                </div>
                                <hr>
                                <form action="{{route('admin#updateRole',$account->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{-- image --}}
                                    <div class="row">

                                        <div class="col-4 offset-1">
                                            @if ($account->image==null)
                                            <img  src="{{asset('image/default-user.png')}}"  class=" col-12 img-thumbnail shadow-sm " alt="" />
                                            @else
                                            <img src="{{asset('storage/'.$account->image)}}" />

                                            @endif
                                            <div class="input-group mt-4 col-12">

                                                <input type="file" disabled  name="image" class="form-control  @error('image')
                                                is-invalid
                                            @enderror" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                              </div>
                                            <input  type="submit" class="btn btn-dark mt-4 col-12" value="Update">
                                        </div>


                                        <div class="row col-6 ">
                                            {{-- name --}}

                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Name</label>
                                                    <input disabled id="cc-pament" value="{{old('name',$account->name)}}" name="name" type="text" class="form-control @error('name')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter  Admin Name">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- email --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Email</label>
                                                    <input disabled id="cc-pament" value="{{old('name',$account->email)}}" name="email" type="email" class="form-control @error('email')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- Phone --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Phone</label>
                                                    <input disabled id="cc-pament" value="{{old('name',$account->phone)}}" name="phone" type="text" class="form-control @error('phone')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin phone">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{--GEnder --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Gender</label>
                                                    <select name="gender" id="" disabled class="form-control   @error('gender')
                                                    is-invalid
                                                @enderror">
                                                        <option value="">Choose Gender</option>
                                                        <option value="male" @if ($account->gender=='male')
                                                            selected
                                                        @endif>Male</option>
                                                        <option value="female" @if ($account->gender=='female')
                                                            selected
                                                        @endif>Female</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>

                                                {{-- Address --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Address</label>
                                                    <textarea disabled id="cc-pament" name="address"  class="form-control @error('address')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Address">{{old('name',$account->address)}}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- row --}}
                                                 {{--GEnder --}}
                                                 <div class="form-group">
                                                    <label  class="control-label mb-1">Gender</label>
                                                    <select name="role" id=""  class="form-control   @error('gender')
                                                    is-invalid
                                                @enderror">

                                                        <option value="admin" @if ($account->role=='admin')
                                                            selected
                                                        @endif>Admin</option>
                                                        <option value="user" @if ($account->role=='female')
                                                            selected
                                                        @endif>User</option>
                                                    </select>

                                                </div>

                                            </div>
                                    </div>


                                </form>






                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection




