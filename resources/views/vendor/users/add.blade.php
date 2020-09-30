@extends('layouts.lte')

@section('content')
<div class="container">

    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display: none" id="error_popup">popup</button>


    <div class="modal fade error-popup" id="myModal" role="dialog">

        <div class="modal-dialog">
    
            <div class="modal-content">
    
                <div class="modal-body">
    
                    <div class="media">
    
                        <div class="media-left">
    
                            <img src="{{asset('images/warning.jpg')}}" class="media-object" style="width:60px">
    
                        </div>
    
                        <div class="media-body">
    
                            <h4 class="media-heading">Information</h4>
    
                            <p id="error_messages_text"></p>
    
                        </div>
    
                    </div>
    
                    <div class="text-right">
    
                        <button type="button" class="btn btn-primary top" data-dismiss="modal">Okay</button>
    
                    </div>
    
                </div>
    
            </div>
    
        </div>
    
    </div>
      
   
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{url('/vendor/user/add')}}" > 
                        {{csrf_field()}}
                    @if($new ==false)
                            <input type="text" class="form-control" name="user_id" id="nuser_idame" value="{{$user_id}}">
                    @endif
                        <div class="form-group">
                            <label for="name">User name</label>
                            <input type="text" class="form-control" name="name" id="name" value="" required placeholder="User name">
                            
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="firstname">First name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value=""  required placeholder="User First name">
                            
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value=""  required placeholder="User Last name">
                            
                        </div>
                        <div class="form-group">
                            <label for="email">Email address <font color="red">(*)</font></label>
                            <input type="email" class="form-control" name="email" id="email" value=""  required placeholder="User Email">
                            
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" value=""  required placeholder="User address">
                            
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="phone" class="form-control" name="phone" id="phone" value=""  required placeholder="User phone">
                            
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
$('#submit').on('click',function(){
   

    var err = '';
 
        var name = $("#name").val();
        var password = $("#password").val();
        var password2 = $("#password-confirm").val();
        var first_name = $("#firstname").val();
        var last_name = $("#lastname").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var phone = $("#phone").val();


        if (name == '') {

            err = "Please fill the name field.";
        }
        if (password == '') {

        err = "Please fill the password field.";
        }
        if (password2 == '') {

        err = "Please fill the password confirmation field.";
        }
        if(password != password2){
            err = "Please make sure that you have enter the some password .";
        }

        





        if (first_name == '') {

        err = "Please fill the first name field.";
        }
        if (last_name == '') {

        err = "Please fill the last_name field.";
        }
        if (email == '') {

        err = "Please fill the email field.";
        }
        if (address == '') {

        err = "Please fill the addrss field.";
        }
        if (phone == '') {

        err = "Please fill the phone field.";
        }


       
    if (err) {

        $("#error_messages_text").html(err);

        $("#error_popup").click();

        //xhr.abort();

        return false;
    }
    else

        return true;
    
});

});



 </script> 

  @endsection

