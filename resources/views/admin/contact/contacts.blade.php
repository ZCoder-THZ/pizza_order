
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


  



                {{-- <div class="d-flex">
                    <button class="btn btn-sm me-4 btn-outline-warning">Pending</button>
                    <button class="btn btn-sm me-4 btn-outline-success">Accept</button>
                    <button class="btn btn-sm me-4 btn-outline-danger">Reject</button>
                </div> --}}
           
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>

                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Conact Date</th>
                      
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($contacts as $contact )

                            <tr class="tr-shadow" style="margin-bottom: 2px !important">
                              <td class="col-3">{{ $contact->name }}</td>
                              <td class="col-3">{{ $contact->email }}</td>
                              <td class="col-3">{{ $contact->message }}</td>
                              <td class="col-3">{{ $contact->created_at->format('D M Y') }}</td>
                           
                            </tr>

                            <tr class="spacer"></tr>
                            @endforeach



                          


                        </tbody>
                    </table>



                </div>
                <!-- END DATA TABLE -->
                <div class="mt-3">
                    {{$contacts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
