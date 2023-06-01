
@extends('admin.layouts.master')
@section('title','Category Page')




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
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Create Pizza Form</h3>
                                </div>
                                <hr>
                                <form action="{{route('product#create')}}" method="post" enctype='multipart/form-data' novalidate="novalidate">
                                   @csrf
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="pizzaName" value="{{old('pizzaName')}}" type="text" class="form-control @error('pizzaName')
                                            is-invalid
                                        @enderror" aria-required="true" aria-invalid="false" placeholder="Pizza Name...">
                                        @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- Category --}}
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory"class="form-control @error('pizzaCategory')
                                        is-invalid
                                    @enderror" id="" >
                                            @foreach ($categories as $c)
                                                <option value="{{$c->id}}" >{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        {{-- description  --}}
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Description</label>
                                        <textarea id="cc-pament"  name="pizzaDescription" type="text" class="form-control @error('pizzaDescription')
                                            is-invalid
                                        @enderror" aria-required="true" aria-invalid="false" placeholder="enter pizza description..">{{old('pizzaDescription')}}</textarea>
                                        @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    </div>
                                    {{-- image --}}
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Image</label>
                                        <input id="cc-pament" name="pizzaImage" type="file" class="form-control @error('pizzaImage')
                                            is-invalid
                                        @enderror" aria-required="true" aria-invalid="false" >
                                        @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- waiting time --}}
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Waiting time</label>
                                        <input id="cc-pament" name="pizzaWaitingTime" type="number" value="{{old('pizzaWaitingTime')}}" class="form-control @error('pizzaWaitingTime')
                                            is-invalid
                                        @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza Waiting time">
                                        @error('pizzaWaitingTime')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- Price --}}
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice')}}" class="form-control @error('pizzaPrice')
                                            is-invalid
                                        @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza price">
                                        @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>





                                        <div class="d-grid gap-2 col-6 mx-auto mt-3">
                                            <button id="payment-button" type="submit " class="btn btn-primary my-auto">
                                                <span id="payment-button-amount">Create</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                          </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection




