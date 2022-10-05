<style>

.step-hdr {

    padding: 4px 0 !important;

}

.logo {

    width: 20%;

}

.logo img {

    width: 100% !important;

}

footer {

    padding-top: 100px;

    background-color: #fff;

    position: relative;

}

.ftr-info {

    padding: 19px 0px;

}

.ftr-info p {

    font-size: 17px;

    color: #666666;

    font-family: "GT Walsheim-pro-regular";

}

.social-icons i {

    border: 1px solid #efefef;
    background: #efefef;
    padding: 1px;
    border-radius: 50%;
    margin: 0px 3px;
    color: #4c4a4b;
    width: 36px;
    height: 36px;
    text-align: center;
    line-height: 32px;

}

footer h4 {

    position: relative;
    text-transform: capitalize;
    font-weight: 700;

}

footer h4::before {

    content: "";

    position: absolute;

    top: 37px;

    /* bottom: 0; */

    left: 0;

    right: 0;

    border-bottom: 2px solid #018cb3;

    width: 59px;

}

footer ul {

    padding-top: 28px;

}

footer ul li {

    list-style: none;

    line-height: 35px;

}

footer ul li a {

    font-size: 18px;
    color: #707070;
    
}

.subscribe-info p {

    font-size: 16px;

    color: #7f7f7f;

    font-weight: 400;

}

.user-form {

    position: relative;

}

.user-form i.fa.fa-envelope {

    position: absolute;

    /* top: 0; */

    bottom: 15px;

    left: 25px;

    right: 0;

    z-index: 1;

    color: #7f7f7f;

    width: 0;

}

.user-form input {

    position: relative;

    width: 100%;

    border-radius: 31px;

    border: 1px solid #f0f0f0;

    outline: none;

    padding: 10px 0;

    padding-left: 46px;

}

.user-form input::before {

    content: '\f2b6' !important;

    position: absolute;

    color: #000;

    left: 0;

    top: 0;

    font-family: 'FontAwesome' !important;

    width: 25px;

    height: 25px;

    background-color: #000;

}

.plain {

    position: absolute;

    top: 4px;

    right: 0;

}

.plain button {

    right: 5px;
    top: -1px;
    padding: 1px 1px;

}



.user-form button {

    position: absolute;
    
    background-color: #004789;
    color: #fff;
    border: 0;
    border-radius: 100%;
    

}

.plain i {

    color: #fff;

}

.plain i {

    border: 1px solid #004789;
    background: #004789;
    padding: 10px 11px;
    border-radius: 20px;
    display: flex;

}

.footer-inner {

    padding: 40px 0px 0px;

}

.footer-inner ul li {



    line-height: normal;

    display: inline-block;

}

.footer-inner ul {

   align-items: center;
    padding: 0;
    display: flex;
    justify-content: end;
    margin: 0 auto;
    width: 80%;

}

.subscribe-info {

    margin-top: 40px;

}

</style>



<header class="step-hdr">

    <!-- Begin: Bottom Row -->

    <div class="bottom-row">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="">

                       {{-- <div class="logo">

                            <img src="{{asset('web/images/logopng.png')}}" />

                        </div> --}}

                        <nav class="navbar navbar-expand-md navbar-light">

                            <div class="logo">
                            <a href="{{url('/')}}" class="navbar-brand">
                            <img src="{{asset('web/images/logopng.png')}}" />
                            </a>

                        </div>

                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">

                                <span class="navbar-toggler-icon"></span>

                            </button>



                             <div class="collapse navbar-collapse" id="navbarCollapse">

                                <div class="navbar-nav">

                                   {{-- <a href="#" class="nav-item nav-link active">Home</a>

                                    <a href="#" class="nav-item nav-link">Dashboard</a> --}}
                                     <div class="help-center magic-help">

                        <div class="help">

                            <a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>

                        </div>

                        <div class="academy">

                            <a href=""><i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->name}}</a>

                        </div>

                        <div class="user-notification">

                            <!-- <a href=""><i class="fa fa-bell" aria-hidden="true"></i></a>

                            <a href=""><i class="fa fa-bell" aria-hidden="true"></i></a> -->

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                                @csrf

                            </form>

                        </div>

                    </div>

                                    <!-- <a href="#" class="nav-item nav-link">Messages</a>

                                    <a href="#" class="nav-item nav-link">Reports</a> -->

                                </div>

                            </div> 

                        </nav>

                    </div>

                </div>

                {{--<div class="col-md-7 col-lg-6 outer-div">

                    <div class="help-center">

                        <div class="help">

                            <a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>

                        </div>

                        <div class="academy">

                            <a href="">{{Auth::user()->name}}</a>

                        </div>

                        <div class="user-notification">

                            <!-- <a href=""><i class="fa fa-bell" aria-hidden="true"></i></a>

                            <a href=""><i class="fa fa-bell" aria-hidden="true"></i></a> -->

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i></a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                                @csrf

                            </form>

                        </div>

                    </div>

                </div> --}}

            </div>

        </div>

    </div>

    <!-- END: Bottom Row -->

</header>

