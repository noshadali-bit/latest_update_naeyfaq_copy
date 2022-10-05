



@extends('web.layouts.main')
@section('content')
  <!-- ======= Hero Section ======= -->
  <div class="blog-temp">
    <div class="container">
      <div class="row">
        @if(isset($blog))
        @foreach($blog as $val)
        <div class="col-md-6">
          <div class="blog-box">

            <div class="img-holder">
              <a href="{{route('blogs_detail',Crypt::encrypt($val['id']))}}">
                <img src="{{asset('/uploads/pages/'.$val['file'])}}" alt="">
              </a>
            </div>

            <!-- CONTENT -->
            <div class="content-holder">
            <div class="chat-count">
              <i class="bi bi-chat"></i>
              <?php $count = 0;?>
              @if($blog_comment) @foreach($blog_comment as $comment)
              @if($comment->blog_id == $val->id)
              <?php $count++; ?>
              @endif
              @endforeach @endif
              <?php echo $count;?> Comments
              </div>
              <div class="blog-date">
                @php
                  $date = substr($val['created_at'],5,2);
                  $month = date_format($val['created_at'],"F");
                @endphp
                {{$date}}<br>{{ substr($month,0,3)}}
              </div>
              <h2><a href="{{route('blogs_detail',Crypt::encrypt($val['id']))}}">{{$val['title']}}</a></h2>
              <p>{{ Str::limit($val['description'], 370) }}</p>
              <div class="read-more">
                <a href="{{route('blogs_detail',Crypt::encrypt($val['id']))}}">Read more</a>
              </div>
            </div>

          </div>
        </div>
        @endforeach
        @endif

      </div>

      <div class="blog-post">
        <h4>Post A Blog</h4>

        <form action="{{route('add_blog')}}" method="POST" enctype="multipart/form-data">
          @CSRF
          <input type='text' placeholder="Your Name" name="name">
          <input type='text' placeholder="Email Address" name="email">
          <input type='text' placeholder="Title" name="title">
          <textarea placeholder="Description" name="description"></textarea>
          <div class="mb-3">

            <input class="form-control" type="file" id="formFile" name="file">
          </div>
          <input type="submit" value="POST blog">
        </form>
      </div>
    </div>
  </div>

  <!-- END: Content-->
  @endsection

@section('css')

<style type="text/css">
 .blog-post input[type="file"] {
    border-color: #f06c6b;
    border-radius: 0;
}
  .blog-post {
    color: #333;
    padding: 30px 0 0;
}

.blog-post h4 {
    margin: 0 0 15px;
}

.blog-post form input[type="text"],.blog-post form textarea {
    width: 100%;
    border: 1px solid #f05455;
    padding: 10px 15px;

    margin: 0 0 16px;
}

.blog-post form textarea {
    height: 155px;
}

.blog-post input[type="submit"] {
    background: #f06c6b;
    color: #fff;
    border: unset;
    text-transform: uppercase;
    font-size: 15px;
    padding: 10px 20px;
    margin: 30px 0 0;
    display: block;
}
  .chat-count i {
    margin-right: 5px;
}
  .chat-count {
    color: #a5a5a5;
    position: absolute;
    right: 15px;
    top: 40px;
    font-size: 12px;
}
  .pro_img{
    width:200px !important;
    height:200px !important;
  }
  .cat_logo{
    width:80px !important;
  }

  .img-holder img {
    width: 100%;
}
.read-more a {
    background-color: #f05455;
    color: #fff;
    font-size: 14px;
    text-transform: uppercase;
    display: inline-block;
    padding: 7px 10px;
    margin: 14px 0 0;
    border-radius: 3px;
}
.blog-date {
    background-color: #f05455;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
    line-height: 23px;
    font-size: 20px;
    font-weight: 600;
    max-width: 85px;
    padding: 10px 0;
    margin: -33px 0 0;
    position: relative;
}

.blog-box .content-holder {
    padding: 0 15px 20px;
    position: relative;
}

.blog-box h2 {
    font-size: 20px;
    margin: 20px 0 10px;
}

.blog-box p {
    color: #333;
    font-size: 15px;
    margin: 0;
}

.blog-box {
    box-shadow: 0px 0px 8px #0000001a;
    margin: 0 0 30px;
}

.blog-temp {
    padding: 60px 0;
}
</style>

@endsection
@section('js')

  <script>
  </script>

@endsection

