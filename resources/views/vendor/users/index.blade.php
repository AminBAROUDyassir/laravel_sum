@extends('layouts.lte')

@section('content')

<div class="col-md-12">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-info">
        <h3 class="widget-user-username">{{strtoupper ($vendor->firstname)}} {{strtoupper ($vendor->lastname)}}  </h3>
        <h5 class="widget-user-desc">{{$vendor->created_at}} </h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="{{ asset('dist/img/user1-128x128.jpg')}}" alt="User Avatar">
        <br />Status : 
        @if($vendor->status == 0)
        <span class="right badge badge-danger">Not activated</span>
        @else
        <span class="right badge badge-success">Activated</span>
        @endif
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">Address</h5>
              <span class="description-text">{{$vendor->address}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">Email</h5>
              <span class="description-text">{{$vendor->email}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">Phone</h5>
              <span class="description-text">{{strtoupper ($vendor->phone)}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
  
           <!-- /.col -->
           <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">Start Date</h5>
              <span class="description-text">{{$vendor->created_at}}</span>
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


<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add new user to vendor</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form method="get" action="{{url('/vendor/user/add')}}">
          <input type="submit" value="Add user"  name="add" class="btn btn-primary">
        </form>

        

        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

      

        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Liste users</div>

                        <div class="card-body">
                        <table id="users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>Activated</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($VendorUser as $user)
                                <tr>
                                <td>{{$user->firstname}} {{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    @if($user->status == 0)
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
                                                        <li class="dropdown-item"><a href="{{url('/vendor/user/edit/'.$user->user_id)}}">Edit</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/vendor/user/delete/'.$user->user_id)}}" onclick="return confirm('Are you sure you want to Remove?');">Remove</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/vendor/user/activate/'.$user->user_id)}}">Activate</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="dropdown-item"><a href="{{url('/vendor/user/desactivate/'.$user->user_id)}}">Desactivate</a></li>
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
