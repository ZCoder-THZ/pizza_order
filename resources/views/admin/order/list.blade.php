
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


            <div class="d-flex justify-content-between my-3">
                <h3 class="text-secondary">Seach Key : <span class="text-danger"> </span></h3>
                <h3 class="mr-3">Total :{{count($orders)}}</h3>
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



                {{-- <div class="d-flex">
                    <button class="btn btn-sm me-4 btn-outline-warning">Pending</button>
                    <button class="btn btn-sm me-4 btn-outline-success">Accept</button>
                    <button class="btn btn-sm me-4 btn-outline-danger">Reject</button>
                </div> --}}
                <form action="{{ route('admin#changeStatus') }}" method="get">
                    @csrf

                    <div class="  col-2">
                        <label for="" class="">Order Status</label>
                        <select  id="orderStatus" name="orderStatus" class="form-control " id="">
                            <option class=""  value=""
                             >All</option>
                            <option class="" value="0"  @if (request('orderStatus')=='0')
                                selected
                            @endif
                             >Pending</option>
                            <option class="" value="1"  @if (request('orderStatus')=='1')
                                selected
                            @endif
                             >Success</option>
                            <option class="" value="2"  @if (request('orderStatus')=='2')
                                selected
                            @endif
                             >Failed</option>
                        
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-dark">Submit</button>
                </form>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>

                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Order Date </th>
                                <th>Order Code </th>
                                <th>Amountt</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orders as $order )
                         

                                <tr class="tr-shadow" style="margin-bottom: 2px !important">
                                    <input type="hidden" name="" value="{{ $order->id }}" class="orderId">
                                    <td class="">{{ $order->user_id }}</td>
                                    <td class="">
                                        @if ($order->user_name=='')
                                            <span class="text-danger">User Deleted</span>
                                        @else 
                                        {{ $order->user_name }} 
                                        @endif
                                    </td>
                                    <td class="">{{ $order->created_at->format('j F Y') }}</td>
                                    <td class="">
                                        <a href="{{ 
                                                route('admin#listInfo',$order->order_code)
                                            }}">{{ $order->order_code }}</a>
                                    </td>
                                    <td class="amount">{{ $order->total_price }}Kyats</td>
                                    <td class="">
                                        <select name="status" class="form-control statusChange" id="">
                                            <option class="" value="0" @if ($order->status==0)
                                                selected
                                            @endif >Pending</option>
                                            <option class="" value="1" @if ($order->status==1)
                                                selected
                                            @endif >Success</option>
                                            <option class="" value="2" @if ($order->status==2)
                                                selected
                                            @endif >Failed</option>
                                        
                                        </select>
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
                    {{-- {{$orders->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
 <script>
     $(document).ready(function(){
    //  $('#orderStatus').change(function(){
    //     $status=$('#orderStatus').val();
    //     // ***********************************
     
    //     $.ajax({
    //         method:'get',
    //         url:'/order/ajax/status',
    //         data:{
    //           'status':$status
    //         },
    //         dataType:'json', 
    //         success:function (response){
    //             $months= ["January","February","March","April","May","June","July",
    //         "August","September","October","November","December"];
    //             $list='',
                
    //             response.forEach(response => {
    //               $dbDate=new Date(response.created_at)
    //               $finalDate=$months[$dbDate.getMonth()]+'_'+$dbDate.getDate()+'_'+$dbDate.getFullYear();
    //                 $statusMessage='';  
    //               if(response.status==0){
    //                     $statusMessage=`
    //                     <select name="status" class="form-control statusChange" id="">
    //                                     <option class="" value="0" selected >Pending</option>
    //                                     <option class="" value="1" >Success</option>
    //                                     <option class="" value="2" >Failed</option>`
    //                 }else if(response.status==1){
    //                     $statusMessage=`
    //                     <select name="status" class="form-control statusChange " id="">
    //                                     <option class="" value="0">Pending</option>
    //                                     <option class="" value="1" selected >Success</option>
    //                                     <option class="" value="2" >Failed</option>`
    //                 }else if(response.status==2){
    //                     $statusMessage=`
    //                     <select name="status" class="form-control statusChange" id="">
    //                                     <option class="" value="0">Pending</option>
    //                                     <option class="" value="1" selected >Success</option>
    //                                     <option class="" value="2">Failed</option>`
    //                 }
    //               $list+= `
    //               <tr class="tr-shadow" style="margin-bottom: 2px !important">
    //                 <input type="hidden" name="" value="${response.id}" class="orderId">

    //                            <td class=""> ${response.user_id} </td>
    //                            <td class=""> ${response.user_name} </td>
    //                            <td class=""> ${$finalDate} </td>
    //                            <td class=""> ${response.order_code} </td>
    //                            <td class=""> ${response.total_price} </td>
    //                            <td class="">
                                   
    //                                   ${$statusMessage}
                          
    //                             </td>
                                    
                                   
                          
    //                            </td>

    //                        </tr>
    //            `;
    //           });
    //         // 
    //           $('#dataList').html($list);

    //         }
    //     })
    //  })

    //  ****************************************************************
    $('.statusChange').change(function(){
        $currentStatus=$(this).val();
        $parentNode=$(this).parents('tr');
        $orderId=$parentNode.find('.orderId').val();
        console.log('status Change');
        $data={
            'status':$currentStatus,
            'orderId':$orderId
        }
        $.ajax({
            method:'get',
            url:'/order/ajax/change/status',
            data:$data,
            dataType:'json'
            });
            window.location.href='/order/list'
    })
    })
 </script>
@endsection