@extends('web.layouts.main') 
@section('content')
    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
  <!-- Employer Modal start -->
              <?php 
            if(isset($_GET['action']) && $_GET['action'] == "view"){
                $msg = "Job View";
            }else if(isset($_GET['action']) && $_GET['action'] == "review"){
                $msg = "Review The job post";
            }else{
                $_GET['action']="";
                $msg = "edit the job post";
            }
            ?>
<div class="modal fade custom-modal" id="myModal001" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <?php echo (html_entity_decode(Helper::editck('h4', 'modal-title', 'Edit this job' ,'h4Edit this job'.__LINE__)));?>
          <!-- <h4 class="modal-title">Edit this job</h4> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-body">
          <h4>Company name for this job<span>*</span></h4>
            <div class="frm-blk">
              <div class="row">
            <div class="col-md-12">
            <input type="text" name="company_name" value="{{$job->company_name}}" required>
            </div>
          </div>
        </div>          
            </div>
        <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form>          
          </div>
        </div>
    </div>
    <div class="modal fade btn-fix" id="myModal002" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <?php echo (html_entity_decode(Helper::editck('h4', 'modal-title', 'edit the job post' ,'h4edit the job post'.__LINE__)));?>
          <!-- <h4 class="modal-title">edit the job post</h4> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">       
        <div class="modal-body">
          <h4>Your role in the hiring process<span>*</span></h4>
            <div class="frm-blk">
              <div class="row">
            <div class="col-md-12">
          <select class="form-control" id="exampleFormControlSelect1" name="hiring_process_role">
                              @foreach($data['hiring_process_role'] as $val)
                                <option {{(isset($job) && $job->hiring_process_role == $val)?'selected':''}} value="{{$val}}">{{$val}}</option>
                              @endforeach
          </select>
            </div>
          </div>
        </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form>          
          </div>
        </div>
    </div>
    <div class="modal fade btn-fix" id="myModa003" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <?php echo (html_entity_decode(Helper::editck('h4', 'modal-title', 'edit the job post' ,'h4edit the job post'.__LINE__)));?>
          <!-- <h4 class="modal-title">edit the job post</h4> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-body">
          <h4>Job Title<span>*</span></h4>
            <div class="frm-blk">
              <div class="row">
            <div class="col-md-12">
            <input type="text" name="job_title" value="{{$job->job_title}}" required>
            </div>
          </div>
        </div>          
            </div>
        <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form>          
          </div>
        </div>
    </div>
    <div class="modal fade btn-fix" id="myModa004" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">        
        <div class="modal-body">
          <h4>Which option best describe this role location?*</h4>
                    @foreach($data['role_location'] as $key => $val)
                    <div class="post-opt">
                        <label class="container">
                            <p>{{$val}}</p>
                            <input type="radio" data-key="{{$key}}" value="{{$val}}" class="role_location" @if($job->role_location == $val) checked="" @endif name="role_location" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    @endforeach            
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
        </div>
          </div>
        </div>
 <!-- Employer Modal End -->
 <!-- Include Details Start -->
<div class="modal fade btn-fix" id="myModa005" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">        
        <div class="modal-body">
                    <h4>Is this a full-time or part-time job? ({{$job->part_time}}) </h4>
                    @foreach($data2['part_time'] as $key => $val)
                    <div class="post-opt">
                        <label class="container">
                            <p>{{$val}}</p>
                            <input type="radio" data-key="{{$key}}" value="{{$val}}" class="part_time" {{(isset($job) && $job->part_time == $val)?'checked':''}} name="part_time" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    @endforeach  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
        </div>
          </div>
        </div>
    <div class="modal fade btn-fix" id="myModa006" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">         
        <div class="modal-body">
          <h4>Do any of these job types apply?</h4>
                    @foreach($data2['employment_type'] as $key => $val)
                    <div class="post-opt">
                        <label class="container">
                            <p>{{$val}}</p>
                            <input type="radio" data-key="{{$key}}" value="{{$val}}" class="employment_type" name="employment_type" {{(isset($job) && $job->employment_type == $val)?'checked':''}}  />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    @endforeach            
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
          </div>
        </div>
    </div>
    <div class="modal fade btn-fix" id="myModa007" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">         
        <div class="modal-body">
          <h4>What is the schedule for this job? </h4>
                    @foreach($data2['job_schedule'] as $key => $val)
                    @php
                    $array_job_schedule=$job_schedule_checked="";
                    $var_job_schedule = $job->job_schedule;
                    $array_job_schedule = explode(', ', $var_job_schedule);
                    @endphp
                    @if (in_array($val, $array_job_schedule))
                    @php  $job_schedule_checked="checked";@endphp
                    @else
                    @php $job_schedule_checked="";@endphp
                    @endif
                    <div class="post-opt">
                        <label class="container">
                                <p>{{$val}}</p>
                                <input type="checkbox" data-key="{{$key}}" value="{{$val}}" class="job_schedule"  {{$job_schedule_checked}} name="job_schedule[]" />
                                <span class="checkmark"></span>
                            </label>
                    </div>
                    @endforeach            
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
          </div>
        </div>
    </div>
    <div class="modal fade btn-fix" id="myModa008" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">         
        <div class="modal-body">
          <h4>How many people do you want to hire for this opening?</h4>
                    <div class="country-opt">
                            <select class="form-control" name="hire_open" required="">
                                <option value="Not Mentioned">Select an option</option>
                                @for($i = 1;$i <= 10;$i++)
                                <option {{(isset($job) && $job->hire_open == $i)?'selected':''}} value="{{$i}}">{{$i}}</option>
                                @endfor
                                <option {{(isset($job) && $job->hire_open == 'I have an ongoing need to fill this role')?'selected':''}} value="I have an ongoing need to fill this role">I have an ongoing need to fill this role</option>
                            </select>
                        </div>  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
          </div>
        </div>
    </div>
<div class="modal fade btn-fix" id="myModa009" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">         
        <div class="modal-body">
          <h4>How quickly do you need to hire?</h4>
                    <div class="country-opt">
                            <select class="form-control" name="need_to_hire" required="">
                                <option value="Not Mentioned">Select an option</option>
                              @foreach($data2['need_to_hire'] as $val)
                                <option {{(isset($job) && $job->need_to_hire == $val)?'selected':''}} value="{{$val}}">{{$val}}</option>
                              @endforeach
                            </select>
                        </div>  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
          </div>
        </div>
    </div>
 <!-- Include Details End -->
 <!-- Compensation Start -->
<div class="modal fade btn-fix" id="myModa0010" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-body">
          <h4>Minimum<span>*</span></h4>
            <div class="frm-blk">
              <div class="row">
            <div class="col-md-12">
            <input type="number" name="starting_salary" value="{{$job->starting_salary}}" required>
            </div>
          </div>
        </div>          
            </div>
        <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form>          
          </div>
        </div>
    </div>
    <div class="modal fade btn-fix" id="myModa0011" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-body">
          <h4>Maximum<span>*</span></h4>
            <div class="frm-blk">
              <div class="row">
            <div class="col-md-12">
            <input type="number" name="ending_salary" value="{{$job->ending_salary}}" required>
            </div>
          </div>
        </div>          
            </div>
        <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form>          
          </div>
        </div>
    </div>
 <div class="modal fade btn-fix" id="myModa0012" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">       
        <div class="modal-body">
          <h4>What is the pay?<span>*</span></h4>
            <div class="frm-blk">
              <div class="row">
            <div class="col-md-12">
          <select class="form-control"  name="period">
                          @foreach($data3['period'] as $val)
                            <option {{(isset($job) && $job->period == $val)?'selected':''}} value="{{$val}}">per {{$val}}</option>
                          @endforeach
          </select>
            </div>
          </div>
        </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form>          
          </div>
        </div>
    </div>
<div class="modal fade btn-fix" id="myModa0013" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">        
        <div class="modal-body">
          <h4>Do you offer any of the following supplemental pay?*</h4>
@foreach($data3['compensation'] as $key => $val)
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
                    <div class="post-opt">
                        <label class="container">
                            <p>{{$val}}</p>
                            <input type="checkbox" data-key="{{$key}}" value="{{$val}}" class="compensation" {{$compensation_checked}} name="compensation[]" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    @endforeach            
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
        </div>
          </div>
        </div>
        <div class="modal fade btn-fix" id="myModa0014" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">        
        <div class="modal-body">
          <h4>Are any of the following benefits offered?*</h4>
@foreach($data3['benefits'] as $key => $val)
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
                    <div class="post-opt">
                        <label class="container">
                            <p>{{$val}}</p>
                            <input type="checkbox" data-key="{{$key}}" value="{{$val}}" class="benefits" {{$benefits_checked}} name="benefits[]" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    @endforeach           
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
        </div>
          </div>
        </div>
 <!-- Compensation End -->       
 <!-- Describe the Job Start -->  
<div class="modal fade btn-fix" id="myModa0015" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">        
        <div class="modal-body">
          <h4>Job Description <span>*</span></h4>
          <p>Describe the responsibilities of this job, required work experience, skills, or education.</p>
                               <div class="hiring-accord">
                                    <div class="hiring-pneal">
                                        <div class="panel" style="max-height: 472px;">
                                            <textarea name="job_description" id="job_description" class="keyouttext" required=""><?php echo html_entity_decode($job->job_description)?></textarea>
                                        </div>
                                    </div>
                                </div>            
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
        </div>
          </div>
        </div>
<div class="modal fade btn-fix" id="myModa0016" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-body">
          <h4>Are you taking any additional COVID-19 precautions?<span>*</span></h4>
          <p>Let people know how your company is responding to COVID-19.</p>
            <div class="frm-blk">
              <div class="row">
            <div class="col-md-12">
            <textarea name="covid_19_precautions" class="keyouttext" required="">{{$job->covid_19_precautions}}</textarea>
            </div>
          </div>
        </div>          
            </div>
        <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form>          
          </div>
        </div>
    </div>        
 <!-- Describe the Job End --> 
 <!-- Set Application Preferences Start -->
<div class="modal fade btn-fix" id="myModa0018" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">         
        <div class="modal-body">
          <h4>How would you like to receive applications?<span>*</span></h4>
                    @foreach($data4['receive_applications'] as $key => $val)
                    <div class="post-opt">
                        <label class="container">
                            <p><span>{{$key}}</span></p>
                            <p>{{$val}}</p>
                            <input type="radio" data-key="{{$key}}" value="{{$val}}" class="receive_applications" {{(isset($job) && $job->receive_applications == $key)?'checked':''}} name="receive_applications" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    @endforeach            
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
          </div>
        </div>
    </div>
    <div class="modal fade btn-fix" id="myModa0019" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">         
        <div class="modal-body">
          <h4>Would you like people to submit a resume?<span>*</span></h4>
                    @foreach($data5['submit_resume'] as $key => $val)
                    <div class="post-opt">
                        <label class="container">
                            <p><span>{{$key}}</span></p>
                            <p>{{$val}}</p>
                            <input type="radio" data-key="{{$key}}" value="{{$val}}" class="submit_resume" {{(isset($job) && $job->submit_resume == $key)?'checked':''}} name="submit_resume" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    @endforeach            
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form> 
          </div>
        </div>
    </div>
<div class="modal fade btn-fix" id="myModa0020" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">edit the job post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<form action="{{route('job_create_save')}}" method="post">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-body">
          <h4>Communication settings<span>*</span></h4>
          <p>Send daily updates about this job and applications to:</p>
            <div class="frm-blk">
              <div class="row">
            <div class="col-md-12">
            <input type="email" name="email" value="{{$job->email}}" required>
            </div>
          </div>
        </div>          
            </div>
        <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" >Update</button>
        </div>
</form>          
          </div>
        </div>
    </div>
 <!-- Set Application Preferences End -->       
  <section class="edit-job-sec">
    <div class="container">
      <div class="heading-edit-job">
          <div class="row">
            <div class="col-md-6">
              <div class="hding-job">
                <h4>{{$msg}}</h4>
              </div>
            </div>
            <div class="col-md-6">
              <div class="hding-job-img">
                <img src="{{asset('web/images/REVIEW-THE-JOB-POST.png')}}">
              </div>
            </div>
          </div>
        </div>
<!-- Employer -->
<div class="row-1">
        <div class="setting-blk">
          <div class="setting-txt">
            <h4>Employer</h4>
            <!-- <p>the following information will not be shared</p> -->
          </div>
          <div class="setting-img">
            <!-- <img src="images/setting-img.png"> -->
          </div>
        </div>
        <div class="app-setting-blk">         
            <ul>
            <li><p><h5>Company name for this job <a href="#myModal001" data-target="#myModal001" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->company_name}}</li>
            <li><p><h5>Your role in the hiring process <a href="#myModal002" data-target="#myModal002" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->hiring_process_role}}</li>
            <li><p><h5>Job title<a href="#myModa003" data-target="#myModa003" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->job_title}}</li>
            <li><p><h5>Which option best describe this role location?<a href="#myModa004" data-target="#myModa004" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->role_location}}</li>
          </ul>
          </div>
      </div>
<!-- Include details  -->
      <div class="row-1">
        <div class="setting-blk">
          <div class="setting-txt">
            <h4>Include details</h4>
            <!-- <p>the following information will not be shared</p> -->
          </div>
          <div class="setting-img">
            <!-- <img src="images/setting-img.png"> -->
          </div>
        </div>
        <div class="app-setting-blk">         
            <ul>
            <li><p><h5>Do any of these job types apply?<a href="#myModa006" data-target="#myModa006" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->employment_type}}</li>
            <li><p><h5>What is the schedule for this job?<a href="#myModa007" data-target="#myModa007" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->job_schedule}}</li>
            <li><p><h5>How many people do you want to hire for this opening?<a href="#myModa008" data-target="#myModa008" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->hire_open}}</li>
            <li><p><h5>How quickly do you need to hire?<a href="#myModa009" data-target="#myModa009" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->need_to_hire}}</li>
          </ul>
          </div>
      </div>
<!-- Compensation  -->
      <div class="row-1">
        <div class="setting-blk">
          <div class="setting-txt">
            <h4>Compensation</h4>
            <!-- <p>the following information will not be shared</p> -->
          </div>
          <div class="setting-img">
            <!-- <img src="images/setting-img.png"> -->
          </div>
        </div>
        <div class="app-setting-blk">         
            <ul>
            <li><p><h5>Minimum<a href="#myModa0010" data-target="#myModa0010" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->starting_salary}}</li>
            <li><p><h5>Maximum<a href="#myModa0011" data-target="#myModa0011" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->ending_salary}}</li>
            <li><p><h5>What is the pay?<a href="#myModa0012" data-target="#myModa0012" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->period}}</li>
            <li><p><h5>Do you offer any of the following supplemental pay?<a href="#myModa0013" data-target="#myModa0013" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{isset($job->compensation)?$job->compensation:'-'}}</li>
            <li><p><h5>Are any of the following benefits offered?<a href="#myModa0014" data-target="#myModa0014" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->benefits}}</li>
          </ul>
          </div>
      </div>
<!-- Describe the Job  -->
      <div class="row-1">
        <div class="setting-blk">
          <div class="setting-txt">
            <h4>Describe the Job</h4>
            <!-- <p>the following information will not be shared</p> -->
          </div>
          <div class="setting-img">
            <!-- <img src="images/setting-img.png"> -->
          </div>
        </div>
        <div class="app-setting-blk">         
            <ul>
            <li><p><h5>jobs Description <a href="#myModa0015" data-target="#myModa0015" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </p></li>
            <li><?php echo html_entity_decode($job->job_description)?><li>
  {{--
<button onclick="myFunction()" id="myBtn">Show</button></li>
  <div class="supplement-pay-blk">
    <div class="supp-icn">
      <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
    </div>
    <div class="supp-txt">
      <h5>Supplemental Pay</h5>
      <p>Supplemental Pay was not provided and will not appear on the job post</p>
    </div>
    <div class="add-blk">
      <a href=""><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
    </div>
  </div>
</li>
--}}
          </ul>
          <ul>
            <li><p><h5>Covid-19 Precautions <a href="#myModa0016" data-target="#myModa0016" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p> </li>
            <li>{{$job->covid_19_precautions}}</li>
            {{--
            <li class="map">
              <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26373281.096296508!2d-113.75449853839812!3d36.20560109310575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2s!4v1637001892504!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <div class="map-txt"></div>
                <p>9259 park Blvd, Seminole, FL 33777 <a href="#myModal8" data-target="#myModal8" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
              </div>
            </li>
            <li>
              <div class="photos-blk">
                <h4>Company photos and videos <a href="#myModal15" data-target="#myModal15" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h4>
                  <div class="supplement-pay-blk">
    <div class="supp-icn">
      <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
    </div>
    <div class="supp-txt">
      <h5>Company photos and videos</h5>
      <p>photos and videos were not added and will not appear on the job post</p>
    </div>
    <div class="add-blk">
      <a href=""><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
    </div>
  </div>
              </div>
            </li>
            --}}
          </ul>
          </div>
      </div>
      <!-- Set Application Preferences  -->
      <div class="row-1">
        <div class="setting-blk">
          <div class="setting-txt">
            <h4>Set Application Preferences</h4>
            <!-- <p>the following information will not be shared</p> -->
          </div>
          <div class="setting-img">
            <!-- <img src="images/setting-img.png"> -->
          </div>
        </div>
        <div class="app-setting-blk">         
            <ul>
            <li><p><h5>How would you like to receive applications?<a href="#myModa0018" data-target="#myModa0018" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->receive_applications}}</li>
            <li><p><h5>Would you like people to submit a resume?<a href="#myModa0019" data-target="#myModa0019" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li>{{$job->submit_resume}}</li>
            <li><p><h5>Send daily updates about this job and applications to:<a href="#myModa0020" data-target="#myModa0020" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5></p></li>
            <li style="text-transform: unset;">{{$job->email}}</li>
          </ul>
          </div>
      </div>
{{--
      <div class="row-1">
        <div class="setting-blk">
          <div class="setting-txt">
            <h4>Settings</h4>
            <p>the following information will not be shared</p>
          </div>
          <div class="setting-img">
            <!-- <img src="images/setting-img.png"> -->
          </div>
        </div>
        <div class="app-setting-blk">
            <h4>Applications Setting</h4>
            <ul>
            <li><h5>Apply method <a href="#myModal16" data-target="#myModal16" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </li>
            <li class="dot"><span>•</span> Email</li>
          </ul>
          <ul>
            <li><h5>Resume Required <a href="#myModal10" data-target="#myModal10" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </li>
            <li class="dot"><span>•</span> optional</li>
          </ul>
          <ul>
            <li><h5>Send application updates to <a href="#myModal16-a" data-target="#myModal16-a" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </li>
            <li class="dot"><span>•</span> justin@the-sprout-academy.com</li>
            <li class="dot"><span>•</span> rachel@the-sprout-academy.com</li>
            <li class="dot"><span>•</span> alicia@the-sprout-academy.com</li>
            <li class="dot"><span>•</span> also send an individual email update each time someones applies</li>
          </ul>
          <ul>
            <li><h5>Allow Messages <a href="#myModal1" data-target="#myModal2" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </li>
          </ul>
          <ul>
            <li><h5>Employer assist <a href="#myModal16-b" data-target="#myModal16-b" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </li>
            <li class="dot"><span>•</span>  yes automatically decline candidates after 10 days</li>
          </ul>
          <ul class="brdr">
            <li><h5>Customized pre-screening <a href="#myModal17" data-target="#myModal17" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </li>
            <li class="dot"><span>•</span> yes automatically decline candidates after 10 days</li>
            <li class="dot"><span>•</span> Application Question:What is the highest level of education you have completed?</li>
            <li class="dot"><span>•</span> Application Question: How many years of Teaching experience do you have?</li>
            <li class="dot"><span>•</span> Application Question:How many years of Childcare experience do you have?</li>
            <li class="dot"><span>•</span> Application Question:Please list 2-3 dates and time ranges that you could do an interview.</li>
            <li class="dot"><span>•</span> Application Question:Do you have a valid CPR Certification?</li>
            <li class="dot"><span>•</span> Application Question:Do you have a valid 40 DCF clock hours?
Job settings</li>
          </ul>
          </div>
          <div class="job-setting-blk">
        <h4>Job settings</h4>
        <ul>
            <li><h5>Country and language <a href="#myModal3" data-target="#myModal3" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </li>
            <li class="dot"><span>•</span> United States</li>
            <li class="dot"><span>•</span> English</li>
          </ul>
          <ul>
            <li><h5>Advertising location <a href="#myModal8" data-target="#myModal8" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </li>
            <li class="dot"><span>•</span> Seminole, FL 33777</li>
          </ul>
          <ul>
            <li><h5>Expect to hire within <a href="#myModal4" data-target="#myModal4" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h5> </li>
            <li class="dot"><span>•</span>1 to 3 days</li>
          </ul>
      </div>
      </div>
--}}
<div class="cancel-preview-confirm-blk edjob">
        <div class="row">
          <div class="col-sm-6"> {{--col-md-9--}}
            <div class="cancel">
              <a href="{{url('/')}}"> <i class="fa fa-angle-left" aria-hidden="true"></i> Cancel</a>
            </div>
          </div>
<?php if (isset($_GET['action']) && $_GET['action'] == "review"): ?>
      
          <div class="col-sm-6"> {{--col-md-3 mt-2--}}
            <div class="show-confirm">
              <ul>
                <!-- <li class="preview"><a href="">Show preview</a></li> -->
<form action="{{route('job_create_save')}}" method="post" id="#confirmform">
 @csrf
<input type="hidden" name="job_id" class="job_id" value="{{Crypt::encrypt($job->id)}}">
<input type="hidden" name="step_filled" value="6">
<input type="hidden" name="action" value="{{$_GET['action']}}">
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">        
<input type="hidden" name="is_confirm" value="1"> 
<li class="confirm"><button type="submit">Confirm</button></li>   
</form>                
<!--                 <li class="confirm"><a href="javascript:void(0);" id="confirmsubmit"> Confirm</a></li> -->
              </ul>
            </div>
          </div>
          <?php endif ?> 
        </div>
      </div>
     
    </div>
  </section>
@endsection  
@section('js')  
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    var job_description = CKEDITOR.replace("job_description");
    job_description.on("change", function (evt) {
        $("#job_description").text(evt.editor.getData());
    });
</script>  
  <!-- <script>
    editor.document.designMode = "On";
function transform(option, argument) {
  editor.document.execCommand(option, false, argument);
}
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");
  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "show"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "less"; 
    moreText.style.display = "inline";
  }
}
  </script> -->
  <!-- <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script> -->
@endsection