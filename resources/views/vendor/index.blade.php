@extends('layouts.lte')

@section('content')

<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add new Vendor</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form method="get" action="{{url('/vendor/add')}}">
          <input type="submit" value="Add vendor"  name="add" class="btn btn-primary">
        </form>

        

        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

      

        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Liste Vendors</div>

                        <div class="card-body">
                        <table id="users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Vendor</th>
                                <th>Liste Users</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>Activated</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendors as $user)
                                <tr>
                                <td>{{$user->firstname}} {{$user->lastname}}</td>
                                    <td><a href="{{url('/vendor/users/'.$user->user_id)}}">List users</a></td>
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
                                                        <li class="dropdown-item"><a href="{{url('/vendor/edit/'.$user->user_id)}}">Edit</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/vendor/delete/'.$user->user_id)}}" onclick="return confirm('Are you sure you want to Remove?');">Remove</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/vendor/activate/'.$user->user_id)}}">Activate</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="dropdown-item"><a href="{{url('/vendor/desactivate/'.$user->user_id)}}">Desactivate</a></li>
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
