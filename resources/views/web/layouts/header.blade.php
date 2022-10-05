<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{route('welcome')}}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{asset('web/img/index_logo.jpg')}}" alt=""> </a> <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i> <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{route('categories',Crypt::encrypt(2))}}">Anchal</a></li>
          <li><a href="{{route('categories',Crypt::encrypt(1))}}">Hijab</a></li>
          <li><a href="{{route('categories',Crypt::encrypt(7))}}">Naeyufaq</a></li>
          <li><a href="{{route('categories',Crypt::encrypt(8))}}">novel</a></li>
          <!-- <li><a href="{{--{{route('novel')}}--}}">novel</a></li> -->
          <li><a href="{{ url('categories') }}/{{Crypt::encrypt(9)}}" class="active">Islamic book</a></li>
          <li><a href="{{ url('blogs') }}">Blog</a></li>
@php
  use App\Models\category;
  $select_cat = category::where('is_deleted',0)->get();

@endphp

          <li>
            <div class="dropdown">
              <button class="get-a-quote dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Shop Now
              </button>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Select Category</li>
                <li>
                  <div class="input-group">
                    <select class="form-select" aria-label="Select Category" id="select_category">
                      @foreach($select_cat as $cate)
                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </li>
                <li class="dropdown-header">Select Year</li>
                <li>
                  <div class="input-group">
                    <select class="form-select" aria-label="Select Year"  id="select_year">
                      <option selected>Select Year</option>
                    </select>
                  </div>
                </li>
                <li class="dropdown-header">Select Month</li>
                <li>
                  <div class="input-group">
                    <select class="form-select" aria-label="Select Month"  id="select_month">
                      <option selected>Select Month</option>
                    </select>
                  </div>
                </li>
                <li>
                <li class="dropdown-header">Search</li>
                  <div class="input-group" id="select_search">
                  <a href='#' class='get-a-quote cta-btn search_btn'> Search </a>
                  </div>
                </li>
              </ul>
            </div>
            <!-- <a class="get-a-quote" href="#{{--{{route('user_dashboard')}}--}}">Shop Now</a> -->
          </li>
          <li><a class="" href="{{route('login')}}">Login</a></li>
        </ul>
      </nav>
      <!-- .navbar -->
    </div>
  </header>
  @yield('header')
