<section class="sec-inner-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="inner-header-logo">
                   <a href="{{url('/')}}"><img src="{{asset('web/images/logo.png')}}"></a> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="share-story-form">
@auth
                   <a href="{{route('share_your_story')}}">Share Your Story</a>
@endauth
@guest
                    <a href="javascript:void(0)" id="loginFunction">Share Your Story</a>
@endguest
                </div>
            </div>
        </div>
    </div>
</section>