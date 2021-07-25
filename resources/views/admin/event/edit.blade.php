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
                    <form method="post" enctype="multipart/form-data" action="{{url('/admin/event/add')}}" > 
                        {{csrf_field()}}
                        
                        
                    <input type="hidden" class="form-control" name="event_id" id="event_id" value="{{$event_id}}"  >

                        <div class="form-group">
                            <label for="name">Event Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$event->name}}" required placeholder="Event name">
                            
                        </div>
                   
                        <div class="form-group">
                            <label for="name">Event Message</label>

                            <textarea id="message_event" name="message_event" class="form-control" required rows="4" cols="50" placeholder="Event Message">{{$event->message_event}}</textarea>
                            
                        </div>

                        <div class="form-group">
                            
                            <label for="firstname">Picture Event : </label>
                            <a href="{{$event->picture_event}}"><img src = "{{$event->picture_event}}" height="50"></a>
                            <input type="file" class="form-control" name="picture_event" id="picture_event" value="{{$event->picture_event}}"  required placeholder="Select an event picture">
                            
                        </div>

                        <div class="form-group">
                            <label for="firstname">Date Event : </label>
                            <input type="date" class="form-control" name="date_event" id="date_event" value="{{$event->date_event}}"  required placeholder="Select a date">
                            
                        </div>
                        <div class="form-group">
                            <label for="lastname">Number of coupons</label>
                            <input type="number" class="form-control" name="nbr" id="nbr" value="{{$event->nbr}}"  required placeholder="Number of coupons">
                            
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
        var message_event = $("#message_event").val();
        var picture_event = $("#picture_event").val();
        var picture_event = $("#nbr").val();
      


        if (name == '') {

            err = "Please fill the name event field.";
        }
        
        if (date_event == '') {

        err = "Please fill the date event field."; 

        }

        if (message_event == '') {

        err = "Please fill the message event field.";
        }
        if (picture_event == '') {

        err = "Please fill the picture event field.";
        }

        if (nbr == '') {

        err = "Please fill the first Number of coupons field.";
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

