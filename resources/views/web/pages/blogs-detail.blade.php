



@extends('web.layouts.main')
@section('content')
  <!-- ======= Hero Section ======= -->
  <div class="blog-detail">
    <div class="container">
      @if($blog) @foreach($blog as $val)
      <div class="row">
        <!-- LEFT SIDE -->
        <div class="col-md-9">
          <div class="blog-img">
            <div class="img-holder">
            <img src="{{asset('/uploads/pages/'.$val['file'])}}" alt="">
            </div>
          </div>

          <div class="blog-desc">
            <h2>{{$val['title']}}</h2>

            <p>{{$val['description']}}</p>
          </div>


        </div>
        <!-- END LEFT SIDE -->

        <!-- RIGHT SIDE -->
        <div class="col-md-3">
          <div class="side-img">
            <div class="img-holder">
          <img src="{{asset('/uploads/pages/'.$val['file'])}}" alt="">
          </div>
          </div>
        </div>
        <!-- END RIGHT SIDE -->





      </div>
      @endforeach @endif
    </div>

    <div class="blog-comment">
      <div class="container">

        <div class="row">
        <div class="col-md-9">
        <div class="comment-view">
          @if($blog_comment) @foreach($blog_comment as $val)
          <div class="comment-row">
            <div class="user-img">
              <img src="https://preview.colorlib.com/theme/universityedu/assets/img/blog/xsingle_blog_5.jpg.pagespeed.ic.iAJ-fvqdoP.webp" alt="">
              <h5>{{$val->name}}</h5>
            </div>

            <div class="user-comm">
              <p>{{$val->comment}}</p>
            </div>
          </div>
          @endforeach @endif

        </div>
        <form action="{{route('send_comment')}}" method="POST">
          <h4>Post Comment</h4>
          @CSRF
          <input type="hidden" name="blog_id" value="{{$blog[0]['id']}}">
          <input type='text' placeholder="Your Name" name="name">
          <input type='text' placeholder="Email Address" name="email">

          <textarea placeholder="Your Comment Here" name="comment"></textarea>
          <input type="submit" name="post_comment" value="Post Comment">
        </form>
        </div>
      </div>


      </div>

    </div>
  </div>

  <!-- END: Content-->
  @endsection

@section('css')

<style type="text/css">
  .blog-detail form {
    padding: 30px 0 0;
}

.blog-detail form h4 {
    margin: 0 0 20px;
}

.blog-detail form textarea {
    width: 100%;
    border: 1px solid #f06c6b;
    padding: 10px 15px;
    height: 150px;
}
.blog-detail form input[type="text"],.blog-post form textarea {
    width: 100%;
    border: 1px solid #f05455;
    padding: 10px 15px;

    margin: 0 0 16px;
}
.blog-detail form input[type="submit"] {
    background: #f06c6b;
    color: #fff;
    border: unset;
    text-transform: uppercase;
    font-size: 15px;
    padding: 10px 20px;
    margin: 10px 0 0;
}
  .blog-comment {
    padding: 50px 0 0;
}
  .user-img img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #f06c6b;
    margin: 0 0 5px;
}

.user-img {
    text-align: center;
    min-width: 120px;
}

.comment-row {
    margin: 0 0 15px;
    display: flex;
}

.user-comm {
    background-color: #f1f1f17a;
    padding: 10px 15px;
    border-radius: 5px;
    position: relative;
}

.user-comm:before {
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 10px 10px 0;
    border-color: transparent #f8f8f8 transparent transparent;
    position: absolute;
    left: -9px;
    top: 0;
    content: '';
}
  .img-holder img {
    width: 100%;
}
.side-img img {
    height: 290px;
    object-fit: cover;
}

.side-img {
    margin: 0 0 30px;
}
  .blog-detail .blog-img {
    margin: 0 0 30px;
}

.blog-detail {
    padding: 70px 0;
}

.blog-detail h2 {
    font-size: 30px;
    margin: 0 0 11px;
}

.blog-detail {
    color: #333;
}

.blog-detail p {
    font-size: 16px;
}

</style>

@endsection
@section('js')

  <script>
    @isset($message)
      toastr.success("{{$message}}",'Success!');
    @endisset

    $(document).ready(function() {
      $("#search_bar").keypress(function() {
        var dInput = $('#search_bar').val();
        // console.log(dInput);
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: "{{ route('search_detail') }}",
          data: {"_token":"{{ csrf_token() }}",'search': dInput},
          success: function(response) {
              console.log(response);
              toastr('success', "Message Sent.");
          }
        });
      });
    });
  </script>

@endsection

