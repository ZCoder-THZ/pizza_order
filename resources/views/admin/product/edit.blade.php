
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
                    {{-- @if (session('updateSuccess'))
                    <div class="col-3 offset-7">
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                         <strong>{{session('updateSuccess')}}</strong>
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                     </div>
                    @endif --}}
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="ms-5 mt-2">

                                    <a onclick="history.back()" style="text-decoration: none" id="">  <i class="fa fa-arrow-left text-dark"></i></a>
                                </div>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Pizza Details</h3>
                                </div>
                                <hr>

                            <div class="row">
                                <div class="col-3 offset-2">



                                    <img src="{{asset('storage/'.$pizza->image)}}" />

                                </div>

                                <div class="col-7  ">

                                    <h3 class="my-3 btn btn-danger d-block w-25 ">{{$pizza->name}}</h3>
                                    <span class="my-3  btn btn-dark"><i class="fa-solid fs-5 me-1 fa-money-bill-1-wave "></i>{{$pizza->price}}</span>
                                    <span class="my-3  btn btn-dark"><i class="fa-solid fs-5 me-1 fa-clock "></i>{{$pizza->waiting_time}}</span>
                                    <span class="my-3  btn btn-dark"><i class="fa-solid fs-5 me-1 fa-eye me-2"></i>{{$pizza->view_count}}</span>
                                    <span class="my-3 btn btn-dark"><i class="fa-solid fs-5 fa-user-clock me-2"></i>{{$pizza->created_at->format('j F y')}}</span>
                                    <span class="my-3 btn btn-dark"><i class="fa-solid fs-5 fa-clone me-2"></i>{{$pizza->category_name}}</span>

                                    <div class="my-3"><i class="fa-solid  fs-5 fa-comment me-2 "></i>detail</div>
                                    <div class="">
                                        {{$pizza->description}}
                                    </div>


                                </div>

                            </div>





                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection




