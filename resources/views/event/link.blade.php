@extends('layouts.lte')

@section('content')
<div class="container">

    <div class="col-md-12">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{strtoupper($event->name)}}</h3>
            <h5 class="widget-user-desc">{{$event->created_at}} </h5>
          </div>
          <div class="widget-user-image">
            <img  src="{{ asset('dist/img/user1-128x128.jpg')}}" alt="User Avatar">
            <br />Status : 
            @if($event->status == 0)
            <span class="right badge badge-danger">Not activated</span>
            @else
            <span class="right badge badge-success">Activated</span>
            @endif
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-3 border-right">
                <div class="description-block">
                  <h5 class="description-header">Date Event</h5>
                  <span class="description-text">{{$event->date_event}}</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-6 border-right">
                <div class="description-block">
                  <h5 class="description-header">Message Event : </h5>
                  <span class="description-text">{{$event->message_event}}</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
             
      
               <!-- /.col -->
               <div class="col-sm-3 border-right">
                <div class="description-block">
                  <h5 class="description-header">Start Date</h5>
                  <span class="description-text">{{$event->created_at}}</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <!-- /.col -->
              
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      
   
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{url('/event/link')}}" > 
                        {{csrf_field()}}
                        
                        
                    <input type="hidden" class="form-control" name="event_id" id="event_id" value="{{$event_id}}"  >
                    @if(isset($vendor_id))
                    <input type="hidden" class="form-control" name="vendor_change" id="vendor_change" value="{{$vendor_id}}"  >
                    @endif

                        <div class="form-group">
                            <label for="name">Vendor name : </label>
                            <select id="vendor_id" name="vendor_id" class="form-control select2bs4">
                                <option value="0" selected="selected">Choose a vendor</option>
                                @foreach($vendors as $vendor)
                                @if(isset($vendor_id) && $vendor->user_id == $vendor_id)
                                <option value ="{{$vendor->user_id}}" selected>{{$vendor->firstname}} {{$vendor->lastname}}</option>
                                @else
                                <option value ="{{$vendor->user_id}}" >{{$vendor->firstname}} {{$vendor->lastname}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                   
                        
                        
                   
                        <input type="submit" value="Save"  name="update" id="submit" class="btn btn-primary">
                  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() { 
    $('.select2bs4').select2({
    theme: 'bootstrap4'
  });
});



 </script> 

  @endsection

