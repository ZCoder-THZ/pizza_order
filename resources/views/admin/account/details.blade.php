
@extends('admin.layouts.master')
@section('title','Account Details Page')




@section('content')
        <!-- MAIN CONTENT-->
<div class="main-content">


     <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
              <div class="col-3 offset-8">
                            <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>

                    </div>
                    @if (session('updateSuccess'))
                    <div class="col-3 offset-7">
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                         <strong>{{session('updateSuccess')}}</strong>
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                     </div>
                    @endif
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Account Info</h3>
                                </div>
                                <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image==null)
                                    @if (Auth::user()->gender=='female')
                                    <img src="{{asset('image/default-female.jpeg')}}" class="" alt="" />
                                     @else
                                      <img src="{{asset('image/default-user.png')}}" class="" alt="" />

                                     @endif
                                    @else
                                    <img src="{{asset('storage/'.Auth::user()->image)}}" />

                                    @endif
                                </div>

                                <div class="col-5 offset-1  ">
                                    <h4 class="mt-3"><i class="fa-solid fa-user-pen me-2"></i>{{Auth::user()->name}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-envelope me-2"></i>{{Auth::user()->email}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-phone me-2"></i>{{Auth::user()->phone}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-address-card me-2"></i>{{Auth::user()->address}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-mars-and-venus me-2"></i>{{Auth::user()->gender}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-user-clock me-2"></i>{{Auth::user()->created_at->format('j - F - Y')}}</h4>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-4 offset-2">
                                    <a href="{{route('admin#edit')}}
                                    ">
                                    <button class="btn btn-dark">
                                        <i class="fa-solid fa-pen-to-square mr-2"></i>Edit Profile
                                    </button>
                                </a>
                                </div>
                            </div>




                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection




