@extends('layouts.lte')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="text-align:center;">
      
    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($coupon->code, 'QRCODE') }}" alt="barcode"   />
            </div>
        </div>
    </div>
</div>

    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{url('/admin/coupon/update')}}" > 
                        {{csrf_field()}}
                        
                        
                    <input type="hidden" class="form-control" name="coupon_id" id="coupon_id" value="{{$coupon_id}}"  >

                        <div class="form-group">
                            <label for="name">Coupon code</label>
                            <input type="text" class="form-control" name="code" id="name" value="{{$coupon->code}}" required placeholder="Event name" readonly>
                            
                        </div>
                   
                        <div class="form-group">
                            <label for="name">Coupon send to</label>

                            <input type="email" class="form-control" name="email" id="email" value="{{$coupon->email}}"  placeholder="Event name">
                            
                            
                        </div>

                        <div class="form-group">
                            <label for="name">Payed :</label>

                            

                            <select id="payed" name="payed" class="form-control select2bs4">
                                <option>Choose status</option>
                                @if($coupon->payed==0)
                                <option value="0" selected="selected" >Not Payed</option>
                                <option value="1" >Payed</option>
                                @else
                                <option value="0" >Not Payed</option>
                                <option value="1" selected="selected">Payed</option>
                                @endif

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


});



 </script> 

  @endsection

