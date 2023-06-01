
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
                                    <h3 class="text-center title-2">Update the account Info</h3>
                                </div>
                                <hr>
                                <form action="{{route('product#update',$pizza->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{-- pizzaImage --}}
                                    <div class="row">

                                        <div class="col-4 offset-1">

                                            <img src="{{asset('storage/'.$pizza->image)}}" />


                                            <div class="input-group mt-4 col-12">

                                                <input type="file"  name="pizzaImage" class="form-control  @error('pizzaImage')
                                                is-invalid
                                            @enderror" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                            @error('pizzaImage')
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
                                                    <label  class="control-label mb-1">Pizza Name</label>
                                                    <input id="cc-pament" value="{{old('PizzaName',$pizza->name)}}" name="pizzaName" type="text" class="form-control @error('pizzaName')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter  Admin Name">
                                                    @error('pizzaName')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{--description --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Description</label>
                                                    <textarea cols="40" rows="10" id="cc-pament" name="pizzaDescription" type="text" class="form-control @error('pizzaDescription')
                                                    is-invalid
                                                @enderror">{{old('pizzaDescription',$pizza->description)}}
                                                    </textarea>
                                                    @error('pizzaDescription')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                                </div>
                                                {{-- price --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Price</label>
                                                    <input id="cc-pament" value="{{old('pizzaPrice',$pizza->price)}}" name="pizzaPrice" type="number" class="form-control @error('pizzaPrice')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                                    @error('pizzaPrice')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- waiting time--}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Waiting time</label>
                                                    <input id="cc-pament" value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}" name="pizzaWaitingTime" type="number" class="form-control @error('pizzaWaitingTime')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin phone">
                                                    @error('pizzaWaitingTime')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- view count --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">View Count</label>
                                                    <input id="cc-pament" value="{{old('view_count',$pizza->view_count)}}" name="view_count" type="number" class="form-control " disabled aria-required="true" aria-invalid="false" placeholder="Enter Admin phone">

                                                </div>
                                                {{-- category --}}
                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Category</label>
                                                    <select name="pizzaCategory" id="" class="form-control  @error('pizzaCategory')
                                                    is-invalid
                                                @enderror">
                                                        <option value="">Choose pizza Category</option>
                                                        @foreach ($categories as $category )
                                                        <option value="{{$category->id}}" @if ($category->id==$pizza->category_id)
                                                            selected
                                                        @endif>{{$category->name}}</option>

                                                        @endforeach

                                                    </select>
                                                    @error('pizzaCategory')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label  class="control-label mb-1">Created at</label>
                                                   <input type="text" value="{{$pizza->created_at->format('j F y')}}" disabled class="form-control">

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




