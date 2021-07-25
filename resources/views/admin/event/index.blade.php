@extends('layouts.lte')

@section('content')



<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add new Event</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form method="get" action="{{url('/admin/event/add')}}">
          <input type="submit" value="Add new Event"  name="add" class="btn btn-primary">
        </form>

        

        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

      

        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Liste Events</div>

                        <div class="card-body">
                        <table id="users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Event name</th>
                                <th>Event message</th>
                                <th>Event picture</th>
                                <th>Event date</th>
                                <th>Event vendor</th>
                                <th>Event number of coupons </th>
                                <th>View coupons </th>
                                <th>Event status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event_info as $event)
                                <tr>
                                    <td><a href="{{url('/admin/event/edit/'.$event->event_id)}}">{{$event->name}}</a></td>
                                    <td>{{$event->message_event}}</td>
                                    <td><a href="{{$event->picture_event}}" target="_blank"><img src="{{$event->picture_event}}" width=50 ></a></td>
                                    <td>{{$event->date_event}}</td>
                                    @if($event->vendor_id!=0)
                                    <td>{{$event->first_name}} {{$event->last_name}}  <a href="{{url('/admin/event/change/'.$event->event_id)}}">change vendor</a></td>
                                    @else
                                    <td><a href="{{url('/admin/event/link/'.$event->event_id)}}">Link to a vendor</a></td>
                                    @endif
                                    <td>{{$event->nbr}}</td>
                                    <td><a href="{{url('/admin/event/coupon/'.$event->event_id)}}">List coupons</a></td>
                                    @if($event->status == 0)
                                    <td><span class="right badge badge-danger">No</span></td>
                                    @else
                                    <td><span class="right badge badge-success">Activated</span></td>
                                    @endif
                                    <td>
                                            <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        Action
                                                      </button>
                                                      <ul class="dropdown-menu">
                                                        <li class="dropdown-item"><a href="{{url('/admin/event/edit/'.$event->event_id)}}">Edit</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/event/delete/'.$event->event_id)}}" onclick="return confirm('Are you sure you want to Remove?');">Remove</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/event/activate/'.$event->event_id)}}">Activate</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/event/desactivate/'.$event->event_id)}}">Desactivate</a></li>
                                                      </ul>
                                                    </div>

                                    </td>
                                </tr>
                                @endforeach
                                <tbody>
                        </table>
        
                        <div class="card-body">
                          
                        </div>
                        </div>
                    </div>
                </div>
            </div>
  
@endsection
@section('script')
<script>
function ConfirmDelete()
{
  var x = confirm("Are you sure you want to delete?");
  if (x)
      return true;
  else
    return false;
}
    
        $(function () {
          $("#users").DataTable();
         
        });
      </script>
@endsection
