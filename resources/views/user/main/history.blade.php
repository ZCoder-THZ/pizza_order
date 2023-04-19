@extends('user.layouts.master')
@section('content')



    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table id="data-table" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                       
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $order )
                        <tr>
                            <td class="align-middle">{{ $order->created_at->format('j : F : Y')}}</td>
                            <td class="align-middle">{{ $order->order_code}}</td>
                            <td class="align-middle">{{ $order->total_price}}</td>
                            <td class="align-middle">
                                @if ($order->status==0)
                                    <button class="btn btn-sm shadow-sm btn-warning me-2"><i class="fa-solid fa-hourglass-start me-2"></i>Pending ..</button>
                                @elseif($order->status=1)
                                     <button class="btn btn-sm shadow-sm btn-success"><i class="fa-solid fa-check me-2"></i> Success</button>
                                @elseif ($order->status==2)
                                     <button class="btn btn-sm shadow-sm btn-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Rejected</button>

                                @endif
                            </td>
                            
                        </tr>
                     
                            
                        @endforeach
                   
                    </tbody>
                </table>
                <div class="mt-3">{{ $orders->links() }}</div>
            </div>
       
        </div>
    </div>
    <!-- Cart End -->
    
@endsection
