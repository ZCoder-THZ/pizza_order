@extends('user.layouts.master')
@section('content')
<div class="row">
    <div class="col-6 offset-3">
        @if (session('messageSuccess'))
        <div class=" col-12">
         <div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>{{session('messageSuccess')}}</strong>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
         </div>



        @endif
        <form action="{{route('user#sendMessage')}}" method="post" novalidate="novalidate">
            @csrf
             <div class="form-group">
                 <label  class="control-label mb-1">Name</label>
                 <input id="cc-pament" name="userName" value="{{ Auth::user()->name }}" type="text" class="form-control">
    
             </div>
             <div class="form-group">
                 <label  class="control-label mb-1">Email</label>
                 <input id="cc-pament" name="userEmail" value="{{ Auth::user()->email }}" type="text" class="form-control">

                
             </div>
             <div class="form-group">
                 <label  class="control-label mb-1">Message</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control" ></textarea>
             </div>

             <div>
                 <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                     <span id="payment-button-amount">Contact</span>
                     
                 </button>
             </div>
         </form>
    </div>
</div>
@endsection
