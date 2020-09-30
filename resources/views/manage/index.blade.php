@extends('layouts.lte')

@section('content')



        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Liste Users in Yassir</div>

                        <div class="card-body">
                        <table id="users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Code</th>
                                <th>Manager</th>
                                <th>Departement</th>
                                <th>Position</th>
                                <th>Date of start</th>
                                <th>Activated</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                <td>{{$user->firstname}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->country}}</td>
                                    <td>{{$user->city}}</td>
                                    <td>{{$user->code}}</td>
                                    <td>{{$user->manager}}</td>
                                    <td>{{$user->departement}}</td>
                                    <td>{{$user->position}}</td>
                                    <td>{{$user->seniority_date}}</td>
                                   
                                    @if($user->activate == 0)
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
                                                        <li class="dropdown-item"><a href="{{url('/admin/manager/edit/'.$user->id)}}">Edit</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/manager/delete/'.$user->id)}}" onclick="return confirm('Are you sure you want to Remove?');">Remove</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/manager/activate/'.$user->id)}}">Activate</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/manager/desactivate/'.$user->id)}}">Desactivate</a></li>
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
