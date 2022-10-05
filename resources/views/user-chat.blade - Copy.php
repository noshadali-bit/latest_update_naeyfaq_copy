@extends('web.layouts.main')
        @section('content')
@if($user->profile_pic != "")

@php $path_pic = $user->profile_pic; @endphp

@else

@php $path_pic = 'images/no-img.png'; @endphp

@endif        
        <!-- =============== Left side End ================-->
        <br>
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="card chat-sidebar-container" data-sidebar-container="chat">              
                    <div class="chat-content-wrap" data-sidebar-content="chat">
                        <div class="d-flex pl-3 pr-3 pt-2 pb-2 o-hidden box-shadow-1 chat-topbar"><a class="link-icon d-md-none" data-sidebar-toggle="chat"><i class="icon-regular i-Right ml-0 mr-3"></i></a>
                            <div class="d-flex align-items-center"><img class="avatar-sm rounded-circle mr-2" src="{{asset($path_pic)}}" alt="alt" />
                                <p class="m-0 text-title text-16 flex-grow-1">{{$user->name}}</p>
                               
                            </div>
                        </div>
                        <div class="chat-content perfect-scrollbar" data-suppress-scroll-x="true" id="show_messages">
                        </div>
                        <!-- <div class="chat-content perfect-scrollbar" data-suppress-scroll-x="true" id="hide_messages"> -->

                              <!--  @foreach($thread_messages as $value)

                                <?php if($value->sender_id == $user->id){
                                    $name = $value->sender->name;
                                    if($user->profile_pic != ""){
                                        $logo = asset($user->profile_pic);
                                    }
                                    else
                                    {
                                        $logo = asset('images/no-img.png');
                                    }
                                    ?>
                                    <div class="d-flex mb-4">
                                    <div class="message flex-grow-1">
                                    <div class="d-flex">
                                    <p class="mb-1 text-title text-16 flex-grow-1">{{$name}}</p><span class="text-small text-muted">{{$value->created_at->diffForHumans()}}</span>
                                     </div>
                                     <?php 
                                    if ($value->has_file == 0) {?>
                                        <p class="m-0">{{$value->message}}</p>
                                          
                                    <?php }else{?>
                                      <?php $path = asset('/Uploads/user_chat_attachment/'.$value->message);?>
                                    {{--
                                        <p class="m-0"><a href="{{$path}}" target="_blank">Open attached file : {{$value->message}}</a></p>
                                    --}}
                                        <img class='avatar-sm rounded-circle ml-3' src='{{$logo}}' alt='alt' />
                                    <?php }?>
                                    </div>
                                    </div>
                               <?php }else{
                                    if($value->sender->profile_pic != ""){
                                        $logo = asset($value->sender->profile_pic);
                                    }
                                    else
                                    {
                                        $logo = asset('images/no-img.png');
                                    }
                                    // Receiver Member
                                    if($value->sender->profile_pic != ""){
                                        $logo = asset($value->sender->profile_pic);
                                    }
                                    else
                                    {
                                        $logo = asset('images/no-img.png');
                                    }
                                    $name = $value->sender->name;
                                    ?>
                                    <div class='d-flex mb-4 user'>
                                   <img class='avatar-sm rounded-circle ml-3' src='{{$logo}}' alt='alt' />
                                    <div class='message flex-grow-1'>
                                            <div class='d-flex'>
                                                <p class='mb-1 text-title text-16 flex-grow-1'>{{$name}}</p><span class='text-small text-muted'>{{$value->created_at->diffForHumans()}}</span>
                                            </div>
                                    <?php
                                    if ($value->has_file == 0) {?>
                                        <p class="m-0">{{$value->message}}</p>  
                                    <?php}else{?>
                                        <?php $path = asset('/Uploads/user_chat_attachment/'.$value->message);?>
                                        {{--
                                        <p class="m-0"><a href="{{$path}}" target="_blank">Open attached file : {{$value->message}}</a></p>
                                          --}}
                                   <?php }?>
                                    </div>
                                    </div>
                               <?php }?>
                            @endforeach
                        </div> -->
                        
                        <div class="pl-3 pr-3 pt-3 pb-3 box-shadow-1 chat-input-area">
                              <form class="inputForm" id="chating-box">
                                  <input type="hidden" value="{{$job_inquiry->job_id}}" name="order_id" id="order_id" class="form-control">
                                  @php
                                  $job_post=$job_inquiry->job_post($job_inquiry->job_id);
                                  @endphp
                                  @if($user->id == $job_inquiry->user_id)      
                                    <input type="hidden" value="{{$job_post->user_id}}" name="receiver_id" id="receiver_id" class="form-control">
                                    <input type="hidden" value="{{$job_inquiry->user_id}}" name="sender_id" id="sender_id" class="form-control">
                                  @else
                                    <input type="hidden" value="{{$job_inquiry->user_id}}" name="receiver_id" id="receiver_id" class="form-control">
                                    <input type="hidden" value="{{$job_post->user_id}}" name="sender_id" id="sender_id" class="form-control">
                                  @endif

                                  <div class="form-group">
                                      <textarea class="form-control form-control-rounded" placeholder="Type your message" name="msg" id="msg" required cols="30" rows="3"></textarea>
                                  </div>
                                  <div class="d-flex">
                                      <div class="flex-grow-1"></div>
                                      
                                      <button class="btn btn-icon btn-rounded btn-primary mr-2" type="submit" id="send_msg">Send <i class="i-Paper-Plane"></i></button>
                                      {{--<button class="btn btn-icon btn-rounded btn-outline-primary" type="button"><i class="i-Add-File"></i></button>--}}
                                      {{--<button class="btn btn-icon btn-rounded btn-primary mr-2" type="button" id="attached_file">Attached File <i class="nav-icon i-Data-Upload"></i></button>--}}
                                  </div>

                              </form>
                              <form class="dropzone" id="single-file-upload" method="POST"  action="{{route('user_chat_attached')}}" enctype="multipart/form-data">
                              {!! csrf_field() !!}
                                <div class="fallback">
                                  <input type="hidden" value="{{$job_inquiry->job_id}}" name="order_id"  class="form-control">                               
                                  <input type="hidden" value="{{$job_inquiry->user_id}}" name="receiver_id" class="form-control">

                                  <input type="hidden" value="{{$job_post->user_id}}" name="sender_id" class="form-control">
                                </div>
                              </form>
                             
                        </div>
                    </div>
                    
                </div><!-- end of main-content -->
            </div><!-- Footer Start -->
            <div class="flex-grow-1"></div>

            <!-- fotter end -->
        </div>
    @endsection
    @section('css')
<link href="{{ asset('css/chat.min.css')}}" rel="stylesheet" />
<!-- <link rel="stylesheet" href="{{ asset('css/dropzone.min.css')}}" /> -->
<style type="text/css">
.chat-content p{
  padding: 10px 0!important;
}
    </style>
    @endsection
    @section('js')
    <script src="{{asset('js/dropzone.min.js')}}"></script>
    <script src="{{asset('js/dropzone.script.min.js')}}"></script>
 
    <script type="text/javascript">

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone",{ 
        maxFilesize: 10,  // 10 mb
        acceptedFiles: ".doc,.pdf,.docx,.ppt",
        //autoProcessQueue: false,
    });

    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    var sender_id = $("#sender_id").val();
    var receiver_id = $("#receiver_id").val();
    var order_id = $("#order_id").val();

    myDropzone.on("sending", function(file, xhr, formData) {
       formData.append("_token", CSRF_TOKEN);
       formData.append("sender_id", sender_id);
       formData.append("receiver_id", receiver_id);
       formData.append("order_id", order_id);
    });

    $("#single-file-upload").hide();
    $( "#attached_file" ).on('click', function(){
        var txt = $(this).text();
        if(txt == "Attached File"){
            $(this).text("Send Files");
            $("#single-file-upload").show();
        }else{
            $(this).text("Attached File");
            $("#single-file-upload").hide();
        }
    });
    
    </script>

<script type="text/javascript">
$(document).ready(function(){
        
        //$("#show_messages").animate({ scrollTop: $('#show_messages').prop("scrollHeight")}, 1000);
        $("#send_msg").click(function(e){

         var msg = $('#msg').val();
         var order_id = $('#order_id').val();

        
         if(msg == ''){
              toastr('error',"Please type your message first");
            }
         else if(msg != '')
         {     
            //$('#show_messages').html('');  
            e.preventDefault();
            $.ajaxSetup({
              headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
              });      
              $.ajax({
               type: 'post',
               dataType : 'json',
               url: "{{route('user_save_msg')}}",        
               data: $("#chating-box").serialize(),
               success: function (response) {
               // console.log(response);
                  $('#msg').val("");
                  console.log($('#show_messages').html());
                  $('#hide_messages').hide();  
                  $('#show_messages').append(response);  
                 $("#show_messages").animate({ scrollTop: $('#show_messages').prop("scrollHeight")}, 500);
            toastr('success',"Message Sent.");  
               }
              });
         }
         else
            toastr('error',"Kindly filled all Fields.");  
        });

        

});



</script>
@if(isset($thread_messages))
<script type="text/javascript">
// $(document).ready(function(){
//     setInterval(function () {
//         fetcher();
//     }, 1000);
// });
 $( "#show_messages" ).mouseleave(function() {
    // setInterval(function () {
        fetcher();
    // }, 2000);
 });
         function fetcher(){
          // alert(1);
            var order_id = "{{$job_inquiry->job_id}}";
            $.ajaxSetup({
              headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
              });      
              $.ajax({
               type: 'post',
               dataType : 'json',
               url: "{{route('user_fetch_msg')}}",        
               data: {order_id:order_id},
               success: function (response) {
                  //$('#msg').val("");
                  $('#show_messages').html(response);  
                  $("#show_messages").animate({ scrollTop: $('#show_messages').prop("scrollHeight")}, 500);
               }
              });
         }


</script>
@endif

@endsection