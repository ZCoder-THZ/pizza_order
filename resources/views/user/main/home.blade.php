@extends('user.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filter by Categories</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">

                        <label class="mt-2" for="price-all">Categories</label>
                        <span class="badge border font-weight-normal">{{count($categories)}}</span>
                    </div>

                    <hr>
                    <div class="d-flex align-items-center justify-content-between mb-3  text-white px-3 py-1">

                        <a class="text-dark" href="{{route('user#home')}}" for="price-all">All</a>
                    </div>
                    @foreach ($categories as $category )
                    <div class="d-flex align-items-center justify-content-between mb-3 shadow-sm pt-2">
                        <a class="text-dark" href="{{route('user#filter',$category->id)}}" for="price-all">{{$category->name}}</a>


                    </div>
                    @endforeach
                </form>
            </div>


            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a  href="{{ route('user#cartList') }}"type="button" class="btn btn-dark position-relative">
                            
                                <i class="fa-solid fa-cart-shopping"></i> 
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                               
                                    {{ count($cart) }}
                                </span>
                            </a>
                            <a  href="{{ route('user#history') }}"type="button" class="btn btn-dark position-relative">
                            
                                <i class="fa-solid fa-clock-rotate-left"></i> History
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                     
                                    {{ count($history) }}
                                </span>
                            </a>
                            <a  href="{{ route('user#contactPage') }}"type="button" class="btn btn-dark position-relative">
                            
                                <i class="fa-solid fa-clock-rotate-left"></i> Contact
                               
                            </a>
                         
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div> --}}
                                <select class="form-control" name="sorting" id="sortingOption">
                                    <option value="">Choose one option</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="row" id="dataList">
                 @if (count($pizzas)!=0)
                 @foreach ($pizzas as $pizza )
                 <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                      <div class="product-item bg-light mb-4" id='myForm'>
                 <div class="product-img position-relative overflow-hidden">
                     <img style="height:250px" class="img-fluid w-100" src="{{asset('storage/'.$pizza->image)}}" alt="">
                      <div class="product-action">
                         <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                         <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$pizza->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                     </div>
                 </div>
                 <div class="text-center py-4">
                     <a class="h6 text-decoration-none text-truncate" href="">{{$pizza->name}}</a>
                     <div class="d-flex align-items-center justify-content-center mt-2">
                         <h5>{{$pizza->price}} kyats</h5>
                     </div>
                     {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                     {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                         <small class="fa fa-star text-primary mr-1"></small>
                         <small class="fa fa-star text-primary mr-1"></small>
                         <small class="fa fa-star text-primary mr-1"></small>
                         <small class="fa fa-star text-primary mr-1"></small>
                         <small class="fa fa-star text-primary mr-1"></small>
                     </div> --}}
                 </div>
                </div>

             </div>
                @endforeach

                @else
                <p class="text-center col-6 fs-1 offset-3 py-5 shadow-sm ">There is no pizza <i class="fa-solid fa-pizza-slice"></i></p>
                 @endif

                </span>

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
@endsection
@section('scriptSource')
<script>
    $('#sortingOption').change(function(){
        $eventOption=$('#sortingOption').val();


        if($eventOption=='asc'){
              $.ajax({
            method:'get',
            url:'/user/ajax/pizzaList',
            data:{'status':'asc'},
            dataType:'json',
            success:function (response){
                $list='',
              $data=response;
            //     for($i=0;$i<response.length;$i++){
            //         // console.log(response[$i].name)
            //        $list+= `
            //        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
            //     <div class="product-item bg-light mb-4" >
            //     <div class="product-img position-relative overflow-hidden">
            //         <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="">
            //          <div class="product-action">
            //             <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
            //             <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
            //         </div>
            //     </div>
            //     <div class="text-center py-4">
            //         <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
            //         <div class="d-flex align-items-center justify-content-center mt-2">
            //             <h5>${response[$i].price} kyats</h5>
            //         </div>

            //     </div>
            //    </div>
            //    </div>
            //     `;
            //     }
            //   $('#dataList').html($list);
                // console.log($list)

              $data.forEach($data=>{
                $list+=`
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4" id='myForm'>
                <div class="product-img position-relative overflow-hidden">
                    <img style="height:250px" class="img-fluid w-100" src="{{asset('storage/${$data.image}')}}" alt="">
                     <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">${$data.name}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${$data.price} kyats</h5>
                    </div>

                </div>
               </div>
               </div>
                `;

              }
              );
              $('#dataList').html($list);


            }
        })
        }else if($eventOption=='desc'){
            $.ajax({
            method:'get',
            url:'/user/ajax/pizzaList',
            data:{'status':'desc'},
            dataType:'json',
            success:function (response){
                $list='',
              $data=response;
                for($i=0;$i<response.length;$i++){
                    // console.log(response[$i].name)
                   $list+= `
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">

                <div class="product-item bg-light mb-4" id='myForm'>
                <div class="product-img position-relative overflow-hidden">
                    <img style="height:250px" class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="">
                     <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${response[$i].price} kyats</h5>
                    </div>

                </div>
               </div>
               </div>
                `;
                }
              $('#dataList').html($list);

            }
        })
        }
    })
</script>
@endsection
