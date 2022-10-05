@extends('web.layouts.main') 
@section('content')

<form id="create-job-form">
@csrf

@if(isset($job) && $job != null)
  <input type="hidden" name="job_id" value="{{Crypt::encrypt($job->id)}}">
@endif
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
<input type="hidden" name="step_filled" value="5">
<section class="basic-info">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="heading-edit-job">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="hding-job">
                                <h4>Set Application Preferences</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="hding-job-img">
                                <img src="{{asset('web/images/SET-APPLICATION-PREFERENCES.png')}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="maininfo-sec">
                   <div class="mainn">
                        <h4>How would you like to receive applications?<span class="asterik">*</span></h4>
                        <div class="row">
                        @foreach($data['receive_applications'] as $key => $val)
                        <div class="col-md-12">
                        <div class="post-opt get_job">
                            <label class="container">
                                <p>{{$key}}<span> ({{$val}})</span></p>
                               
                                <input type="radio" value="{{$key}}" {{(isset($job) && $job->receive_applications == $val)?'checked':''}} name="receive_applications" />
                                <span class="checkmark"></span>
                            </label>
                        </div>    
                        </div>
                        @endforeach                        
                        </div>
                    </div>
                   </div>
                   <div class="maininfo-sec">  
                    <div class="mainn">
                        <h4>Would you like people to submit a resume?<span class="asterik">*</span></h4>
                        <div class="row">
                        @foreach($data2['submit_resume'] as $key => $val)
                        <div class="col-md-12">
                        <div class="post-opt get_job">
                            <label class="container">
                                <p>{{$key}}<span> ({{$val}})</span></p>
                              
                                <input type="radio" value="{{$key}}" {{(isset($job) && $job->submit_resume == $val)?'checked':''}} name="submit_resume" />
                                <span class="checkmark"></span>
                            </label>
                        </div>    
                        </div>
                        @endforeach                        
                        </div>
                    </div>

                    
                </div>

                
                <div class="maininfo-sec">
                    
                    <div class="mainn">
                        <div class="comm-set">
                        <h6>Communication settings<span class="asterik">*</span></h6>
                        <p>Send daily updates about this job and applications to:</p>
                        </div>
                        <div class="country-opt country-opt2">
                            <input type="email" name="email" id="email" value="{{isset($job)?$job->email:''}}" placeholder="Enter Email Address" required="" />
                        </div>
                    </div>
                </div>

                {{--
                <div class="start-jobb">
                    <h4>Salary</h4>

                    <div class="mainn">
                        <div class="language">
                            <p>Starting Range<span class="asterik">*</span></p>
                        </div>
                        <div class="country-opt">
                            <input type="number" min="0" name="starting_salary" value="{{isset($job)?$job->starting_salary:''}}" class="form-control" required="" />
                        </div>
                    </div>

                    <div class="mainn">
                        <div class="language">
                            <p>Ending Range<span class="asterik">*</span></p>
                        </div>
                        <div class="country-opt">
                            <input type="number" min="1" name="ending_salary" value="{{isset($job)?$job->ending_salary:''}}" class="form-control" required="" />
                        </div>
                    </div>

                    <div class="language">
                        <p>Period<span class="asterik">*</span></p>
                    </div>
                    <div class="country-opt">
                        <select class="form-control" id="exampleFormControlSelect1" name="period">
                          @foreach($data['period'] as $val)
                            <option {{(isset($job) && $job->period == $val)?'selected':''}} value="{{$val}}">per {{$val}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="start-jobb">
                    <h4>Job description</h4>

                    <div class="mainn">
                        <div class="language">
                            <p>Describe the responsibilities of this job, required work experience, skills, or education.</p>
                        </div>
                        <div class="country-opt">
                            <textarea name="editor1" required="">{{isset($job)?$job->editor1:''}}</textarea>
                        </div>
                    </div>
                </div>
                --}}
            </div>
            <div class="col-md-4 sticky-top">
                <div class="about-job">
                    <h5>About this job</h5>
                    <p>we use this information to find the best candidate for this job</p>
                    <div class="about-img">
                        <img src="{{asset('web/images/about.png')}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="role-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="main-btn">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="user-btn">
                                 <a href="{{route('step2_form' ,Crypt::encrypt($job->id))}}" class="back">Back</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="user-btnn">
                                <a href="javascript:void(0)" class="back submit-form">Save and Continue</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</section>
</form>

@endsection 
@section('css') 
<style>
.maininfo-sec p span {
    padding: 0;
    font-weight: bold!important;
}
.post-opt p {
    color: rgb(45, 45, 45);
    font-size: 14px !important;
    font-weight: normal!important;
}
.comm-set h6 {
    font-size: 22px;
    margin: 0 0 16px;
}

.comm-set p {
    font-size: 13px;
    margin-bottom: 9px;
}

.country-opt2 input {
    border: 1px solid #9a9a9a;
    padding: 8px 12px;
    border-radius: 10px;
    margin-bottom: 20px;
    width: 100%;
}
.job-post h4 {
    padding: 0px 24px
;
}
</style>
@endsection 
@section('js')
<script>
    // CKEDITOR.replace("editor1");


    $(document).ready(function(){
        $(".one-location").hide()
    })

    $("#company_name").focusout(function(){
      var type = "duplicate";
      var table = "company";
      var value = $(this).val();
      var like = $(this);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'post',
        dataType : 'json',
        url: "{{route('validator_check')}}",
        data: {type:type , value:value,table:table},
          success: function (response) {
            if (response.status == 0) {
              $(like).addClass("is-invalid")
              $(like).removeClass("is-valid")
            }else{
              $(like).addClass("is-valid")
              $(like).removeClass("is-invalid")
            }
            return false;
          }
      });
    })


    $(".submit-form").click(function(){

        // if ($('input[name="receive_applications"]:checked').val() === undefined) {
        //     toastr.error("Please like to receive applications first to process further");
        //     return false;
        // }
        if ($('input[name="submit_resume"]:checked').val() === undefined) {
            toastr.error("Please Would you like people to submit a resume first to process further");
            return false;
        }
        if ($('#email').val()==''){
            toastr.error("Please email first to process further");
            return false;
        }
       
        var formData = $("#create-job-form").serialize();
            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type: 'post',
            dataType : 'json',
            url: "{{route('job_create_save')}}",
            data: formData,
              success: function (response) {
                if (response.status == 1) {
                    window.location.href = response.location;
                }
                return false;
              }
          });

    })


    // $(".role_location").click(function(){
    //     if ($(this).data("key") == "one-location") {
            
    //     }
    // })
</script>
@endsection
