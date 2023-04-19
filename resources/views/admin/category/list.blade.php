
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
                        <a href="{{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Category
                            </button>
                        </a>
                      
                    </div>
                </div>
               @if (session('categorySuccess'))
               <div class="offset-8 col-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('categorySuccess')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            </div>
               @endif

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
                <h3 class="text-secondary">Seach Key : <span class="text-danger"> {{request('key')}}</span></h3>
                <h3 class="mr-3">Total : {{$categories->total()}}</h3>
            </div>
            <div class="col-3 offset-9">
                <form action="{{route('category#list')}}" method="GET">
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


                @if (count($categories)!=0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category )

                            <tr class="tr-shadow">
                                <td>{{$category->id}}</td>
                                <td>
                                    <span class="block-email">{{$category->name}}</span>
                                </td>

                                <td>{{$category->created_at->format('j-F-Y')}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="fa-solid fa-eye"></i>
                                        </button> --}}
                                        <a href="{{route('category#edit',$category->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="{{route('category#delete',$category->id)}}" style="cursor: pointer" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>

                            <tr class="spacer"></tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{
                            $categories->links()
                        }}
                    </div>
                    @else
                    <h3 class="text-secondary text-center mt-4">NO Categories</h3>
                    @endif

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>




@endsection
