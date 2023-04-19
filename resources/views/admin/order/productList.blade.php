
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
                            <h2 class="title-1">Order List</h2>

                        </div>
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


                <div class="table-responsive table-responsive-data2">
                    <a href="{{ route('admin#orderList') }}" class="text-dark">back</a>
                    <div class="card mt-4">
                        <div class="card-header shadow-sm">
                            <h3>Order info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user"></i>Customer Name </div>
                                <div class="col"><i class="fa-solid fa-user"></i>{{ strtoupper($orderList[0]->user_name) }} </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user"></i>Order Code </div>
                                <div class="col"><i class="fa-solid fa-user"></i> {{ 
                                $orderList[0]->order_code}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user"></i>Order Date</div>
                                <div class="col"><i class="fa-solid fa-user"></i>  {{ 
                                    $orderList[0]->created_at->format('j F Y')}} </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                           
                                <th>User Name</th>
                                <td>Product Name</td>
                                <td>Product Image</td>
                                <th>Order Date </th>
                                <th>Qty </th>
                                <th>Amount</th>
                      
                            </tr>
                        </thead>
                        <tbody id="dataList">
                         @foreach ($orderList as $orderItem )
                         <tr class="tr-shadow">
                            <td class="col-0"></td>
                         
                             <td class="">{{ $orderItem->user_name }}</td>
                             <td class="">{{ $orderItem->product_name }}</td>
                             <td class="col-2">
                                <img src="{{asset('storage/'.$orderItem->product_image)}}"  class="img-thumbnail shadow-sm" alt="">
                             </td> 
                             <td class="">{{ $orderItem->created_at->format('d : m : y') }}</td>
                             <td class="">{{ $orderItem->qty }}</td>
                             <td class="">{{ $orderItem->total }}</td>

                         </tr>
                             
                         @endforeach



                            <tr class="spacer"></tr>


                        </tbody>
                    </table>



                </div>
                <!-- END DATA TABLE -->
                <div class="mt-3">
                    {{-- {{$orders->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')

@endsection