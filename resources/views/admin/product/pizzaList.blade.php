
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
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
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


            <div class="d-flex justify-content-between my-3">
                <h3 class="text-secondary">Seach Key : <span class="text-danger"> </span></h3>
                <h3 class="mr-3">Total :{{$pizzas->total()}}</h3>
            </div>
            <div class="col-3 offset-9">
                <form action="{{route('product#list')}}" method="GET">
                    @csrf
                <div class="d-flex">
                    <input placeholder="search" type="text" name="key" id="" class="form-control">
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

                                <th>IMAGE</th>
                                <th>NAME</th>
                                <th>PRICE</th>
                                <th>CATEGORY</th>
                                <th>VIEW COUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pizzas as $pizza )

                            <tr class="tr-shadow">
                                <td class="col-2"><img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm" alt=""></td>
                                <td class="col-3">
                                    <span class="block-email">{{$pizza->name}}</span>
                                </td>
                                <td class="col-2">
                                    <span>{{$pizza->price}}</span>
                                </td>
                                <td class="col-2">
                                    <span>{{$pizza->category_name}}</span>
                                </td>
                                <td class="col-2">
                                    <span><i class="fa-solid fa-eye"></i>{{$pizza->view_count}}</span>
                                </td>

                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('product#edit',$pizza->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{route('product#updatePage',$pizza->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="{{route('product#delete',$pizza->id)}}" style="cursor: pointer" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>

                            <tr class="spacer"></tr>
                            @endforeach



                            <tr class="spacer"></tr>


                        </tbody>
                    </table>



                </div>
                <!-- END DATA TABLE -->
                <div class="mt-3">
                    {{$pizzas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
