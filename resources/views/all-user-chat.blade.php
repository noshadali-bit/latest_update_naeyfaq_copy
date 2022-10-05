@extends('web.layouts.main')
@section('content') 
<br><br><br><br><br><br>       
<section class="feature-sec">
    <div class="container">
        <div class="title-heading">
            <h2 class=""> <span>Jobs</span> Chat </h2>
        </div>        
        <div class="private-schools">
            <div class="row">
                @if(!$job_inquiry->isEmpty())
                @foreach($job_inquiry as $job_inq)
                @php $job=$job_inq->job_post($job_inq->job_id); @endphp
                @php $messages_count=$job->messages_count($job->id,Auth::user()->id,$job->user_id); @endphp
                <div class="col-md-6 col-xl-4">
                    <div class="feature-details chat-info">
                        <div class="noti-count">
                          <p><i class="fa fa-comments"><strong> {{$messages_count}}</strong></i><span></span></p>
                        </div>
                        <div class="school-title">
                            <div class="scool-logo">
                                <?php
                                   if(isset($job->company_logo) && $job->company_logo != ''){ $company_logo = asset("/uploads/company_logo/".$job->company_logo); } else { $company_logo = asset('web/images/no-img.png'); }?>
                                <img src="{{$company_logo}}" alt="" />
                            </div>
                            <div class="schl-head">
                                <h3>{{$job->company_name}}</h3>
                                <p>{{$job->role_location}}</p>
                            </div>
                        </div>
                        <div class="dummy-txt">
                            <h2>{{$job->job_title}}</h2>
                            <h4>{{$job->employment_type}}</h4>
                            {!! Str::limit($job->job_description, 90) !!}
                        </div>
                        <div class="price-area">
                            <div class="price">
                            {{--    <h3><i class="fa fa-comments"></i><span><strong> ({{$messages_count}})</strong></span></h3> --}}
                            </div>
                            <div class="apply">
                                <a href="{{route('user_chat_now' ,Crypt::encrypt($job_inq->id))}}">Chat Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-md-12 col-xl-12">
                <div class="no-message-txt">
                    <div class="container">
                        <span><img src="{{asset('web/images/chat-img.png')}}" /></span>
                        <p>When employer contacts you, <span>you will see messages here</span></p>
                    </div>
                </div>
                </div>
                
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
@section('css')
<style>
  .apply a {
    display: inline-block;
    width: 100%;
    padding: 14px 0 11px;
}

.chat-info .apply {
    width: 100%;
    display: inline-block;
    text-align: center;
    margin:0;
}
.chat-info .price-area {
    margin-top: 20px;
}
  .noti-count i {
    font-size: 36px;
      font-size: 42px;
    color: #004789;
     position: relative;
}

.noti-count {
    float: right;
    margin: -44px 0 0 0;
    position: relative;
    right: -31px;
}
.noti-count strong {
    position: absolute;
    color: #fff;
    font-size: 15px;
    left: 2px;
    top: 9px;
    width: 28px;
    text-align: center;
}
.noti-count i {
  
}
.no-message-txt {
    text-align: center;
        padding: 50px 0px;

}
.no-message-txt p {
    font-size: 30px;
}
.no-message-txt p span{
    display: block;
}
.no-message-txt .container> span {
    display: inline-block;
    background-color: #efefef;
    padding: 30px;
    border-radius: 100%;
    margin-bottom: 20px;
}
</style>
@endsection
@section('js')
@endsection