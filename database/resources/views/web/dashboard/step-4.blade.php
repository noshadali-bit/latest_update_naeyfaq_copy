@extends('web.layouts.main') 

@section('content')



<form id="create-job-form">

@csrf



@if(isset($job) && $job != null)

  <input type="hidden" name="job_id" value="{{Crypt::encrypt($job->id)}}">

@endif

<input type="hidden" name="user_id" value="{{Auth::user()->id}}">

<input type="hidden" name="step_filled" value="3">

<section class="basic-info">

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <div class="heading-edit-job"> {{--information--}}

                    <div class="row">

                        <div class="col-md-6">

                            <div class="hding-job"> {{--job-post--}}
                                <?php echo (html_entity_decode(Helper::editck('h4', '', 'Add compensation' ,'h4Add compensation'.__LINE__)));?>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="hding-job-img"> {{--post-img--}}

                                <img src="{{asset('web/images/ADD-COMPENSATION.png')}}" />

                            </div>

                        </div>

                    </div>

                </div>

                <div class="maininfo-sec">



                    <div class="mainn">

                        

                        <div  class="row min-rate">

                        <div class="col-md-4">

                        <div class="language">

                            <p>Minimum<span class="asterik">*</span></p>

                        </div>

                        <div class="country-opt">

                            <input type="number" min="1" name="starting_salary" value="{{isset($job)?$job->starting_salary:''}}" class="form-control" required="" />

                        </div>

                        </div>



                        <div class="col-md-4">

                        <div class="language">

                            <p>Maximum<span class="asterik">*</span></p>

                        </div>

                        <div class="country-opt">

                            <input type="number" min="1" name="ending_salary" value="{{isset($job)?$job->ending_salary:''}}" class="form-control" required="" />

                        </div>

                        </div>



                        <div class="col-md-4">
                            <div class="language">
                            <p>What is the pay?<span class="asterik">*</span></p>
                            </div>
                            <div class="country-opt">
                        <select class="form-control" id="period" name="period">

                          @foreach($data['period'] as $val)

                            <option {{(isset($job) && $job->period == $val)?'selected':''}} value="{{$val}}">per {{$val}}</option>

                          @endforeach

                        </select></div>

                    </div>

                    </div>



                    </div>



                    <div class="mainn">

                        <h4>Do you offer any of the following supplemental pay? <span class="asterik">*</span></h4>

                    <div class="row">

                    @foreach($data['compensation'] as $key => $val)

                    @php

                    $array_compensation=$compensation_checked="";

                    $var_compensation = $job->compensation;

                    $array_compensation = explode(', ', $var_compensation);

                    @endphp

                    @if (in_array($val, $array_compensation))

                    @php  $compensation_checked="checked";@endphp

                    @else

                    @php $compensation_checked="";@endphp

                    @endif

                    <div class="col-md-6">

                    <div class="post-opt">

                        <label class="container">

                            <p>{{$val}}</p>

                            <input type="checkbox" data-key="{{$key}}" value="{{$val}}" class="compensation" {{$compensation_checked}} name="compensation[]" />

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

                        <h4>Are any of the following benefits offered?</h4>

                    <div class="row">

                    @foreach($data['benefits'] as $key => $val)

                    @php

                    $array_benefits=$benefits_checked="";

                    $var_benefits = $job->benefits;

                    $array_benefits = explode(', ', $var_benefits);

                    @endphp

                    @if (in_array($val, $array_benefits))

                    @php  $benefits_checked="checked";@endphp

                    @else

                    @php $benefits_checked="";@endphp

                    @endif

                    <div class="col-md-6">

                    <div class="post-opt">

                        <label class="container">

                            <p>{{$val}}</p>

                            <input type="checkbox" data-key="{{$key}}" value="{{$val}}" class="benefits" {{$benefits_checked}} name="benefits[]" />

                            <span class="checkmark"></span>

                        </label>

                    </div>

                    </div>

                    

                    @endforeach

                    </div>

                </div>

                </div>



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

                                <a href="{{route('step3_form' ,Crypt::encrypt($job->id))}}" class="back">Back</a>

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



        if ($('input[name="starting_salary"]').val() == '') {

            toastr.error("Please Minimum first to process further");

            return false;

        }if ($('input[name="ending_salary"]').val() == '') {

            toastr.error("Please Maximum first to process further");

            return false;

        }if ($('#period').val() == '') {

            toastr.error("Please What is the pay first to process further");

            return false;

        }

        // if ($('.compensation').is(':checked')) {

           

        // }
        // else{

        //      toastr.error("Please supplemental pay first to process further");

        //      return false;

        // }
        if ($('.benefits').is(':checked')) {

           

        }else{

             toastr.error("Please benefits offered first to process further");

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

