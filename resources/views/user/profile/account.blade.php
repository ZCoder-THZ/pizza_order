
@extends('user.layouts.master')
@section('title','Edit Account Page')




@section('content')
        <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="row">


    </div>
     <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                @if (session('updateSuccess'))
                <div class=" col-3 offset-8">
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>{{session('updateSuccess')}}</strong>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                 </div>



                @endif
              <div class="col-3 offset-8">
                            <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                    </div>
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Update the account Info</h3>
                                </div>
                                <hr>
                                <form action="{{route('user#accountChange',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{-- image --}}
                                    <div class="row">

                                        <div class="col-4 offset-1">
                                            @if (Auth::user()->image==null)
                                            <img src="{{asset('image/default-user.png')}}"  class=" col-12 img-thumbnail shadow-sm " alt="" />
                                            @else
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" class=" col-12 img-thumbnail shadow-sm "/>

                                            @endif
                                            <div class="input-group mt-4 col-12">

                                                <input type="file"  name="image" class="form-control  @error('image')
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
                                                    <input id="cc-pament" value="{{old('name',Auth::user()->name)}}" name="name" type="text" class="form-control @error('name')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter  User Name">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <br>
                                                {{-- email --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Email</label>
                                                    <input id="cc-pament" value="{{old('name',Auth::user()->email)}}" name="email" type="email" class="form-control @error('email')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter User Email">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- Phone --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Phone</label>
                                                    <input id="cc-pament" value="{{old('name',Auth::user()->phone)}}" name="phone" type="text" class="form-control @error('phone')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter User phone">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{--GEnder --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Gender</label>
                                                    <select name="gender" id="" class="form-control  @error('gender')
                                                    is-invalid
                                                @enderror">
                                                        <option value="">Choose Gender</option>
                                                        <option value="male" @if (Auth::user()->gender=='male')
                                                            selected
                                                        @endif>Male</option>
                                                        <option value="female" @if (Auth::user()->gender=='female')
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
                                                    <textarea id="cc-pament" name="address"  class="form-control @error('address')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter User Address">{{old('name',Auth::user()->address)}}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- row --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Role</label>
                                                    <input id="cc-pament" value="{{old('name',Auth::user()->role)}}" name="role" type="text" class="form-control

                                                  " disabled aria-required="true" aria-invalid="false" placeholder="Role">

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




