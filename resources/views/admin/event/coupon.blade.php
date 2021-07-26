@extends('layouts.lte')

@section('content')



<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add new coupon</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <a href="{{url('admin/coupon/add/')}}/{{ $event_id ?? '' }}">
          <input type="submit" value="Add new Coupon"  name="add" class="btn btn-primary">
        </a>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

      

        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Liste Coupons</div>

                        <div class="card-body">
                        <table id="users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Coupon code</th>
                                
                                <th>Coupon send to  </th>
                                <th>Coupon status</th>
                                <th>Activated by</th>
                                <th>Activation date</th>
                                <th>Payed</th>
                                <th>Activation date</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td><a href="{{url('/admin/coupon/edit/'.$coupon->id)}}">{{$coupon->code}}</a></td>
                                    
@if($coupon->email=="")
<td><a href="{{url('/admin/coupon/edit/'.$coupon->id)}}">Send To</a></td>
@else
<td>{{$coupon->email}}</td>
@endif
                                    
                                    
                                    @if($coupon->status == 0)
                                    <td><span class="right badge badge-danger">No</span></td>
                                    @else
                                    <td><span class="right badge badge-success">Activated</span></td>
                                    @endif

                                    <td>{{$coupon->activated_by}}</td>
                                    <td>{{$coupon->activated_date}}</td>

                                    @if($coupon->payed == 0)
                                    <td><span class="right badge badge-danger">Not Payed</span></td>
                                    @else
                                    <td><span class="right badge badge-success">Payed</span></td>
                                    @endif
                                    <td>{{$coupon->payed_date}}</td>

                                    <td>
                                            <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        Action
                                                      </button>
                                                      <ul class="dropdown-menu">
                                                        <li class="dropdown-item"><a href="{{url('/admin/coupon/pay/'.$coupon->id)}}">Pay</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/coupon/edit/'.$coupon->id)}}">Edit</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/coupon/delete/'.$coupon->id)}}" onclick="return confirm('Are you sure you want to Remove?');">Remove</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/coupon/activate/'.$coupon->id)}}">Activate</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/coupon/desactivate/'.$coupon->id)}}">Desactivate</a></li>
                                                        <li class="dropdown-item"><a href="{{url('/admin/coupon/notpay/'.$coupon->id)}}">Not Pay</a></li>
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
