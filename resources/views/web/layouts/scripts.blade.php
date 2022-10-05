
 
  <script src="{{asset('web/js/jquery.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.0/dist/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <script src="{{asset('web/vendor/swiper/swiper.js')}}"></script>
  <script src="{{asset('web/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('web/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('web/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('web/vendor/aos/aos.js')}}"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <script src="{{asset('web/js/main.js')}}"></script>
  <script type="text/javascript">

  </script><!-- END: Page Vendor JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
</script><!-- END: Page Vendor JS-->


<!-- Add book -->
<div class="modal fade" id="show_book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="show_files ">
            
            
            <div class="addFile slider slider-product">
		
			</div>
            

          </div>
       </div>
    </div>
 </div>

<!-- Edit user modal End-->



@yield('script')

<!-- START: APP JS-->
<!-- END: APP JS-->

<script>
  $(document).ready(function(){

    $("#select_category").on('change', function() {
      $.ajax({
        method: "POST",
        // dataType: 'json',
        url: "{{ route('select_category') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          cat_id: $(this).val()
        },
        success: function(response) {
          console.log(response)
          $('#select_year').html(response);
        }
      });
    });

    $("#select_year").on('change', function() {
      $.ajax({
        method: "POST",
        // dataType: 'json',
        url: "{{ route('select_year') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          cat_id: $("#select_category").val(),
          year: $("#select_year").val()
        },
        success: function(response) {
          console.log(response)
          $('#select_month').html(response);
        }
      });
    });

    $("#select_month").on('change', function() {
      $.ajax({
        method: "POST",
        // dataType: 'json',
        url: "{{ route('select_month') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          cat_id: $("#select_category").val(),
          year: $("#select_year").val(),
          month: $("#select_month").val()
        },
        success: function(response) {
          console.log(response)
          $('#select_search').html(response);
        }
      });
    });

  });

  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
  	"debug": false,
  	"positionClass": "toast-bottom-right",
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
  	"debug": false,
  	"positionClass": "toast-bottom-right",
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
  	"debug": false,
  	"positionClass": "toast-bottom-right",
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
  	"debug": false,
  	"positionClass": "toast-bottom-right",
  }
  		toastr.warning("{{ session('warning') }}");
  @endif

    function readBook(id){
        $.ajax({
            method: "POST",
            url: "{{ route('readBook') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                pro_id: id,
            },
            success: function(response) {
                try{
                    $('.slider-product').slick('unslick')
                }catch(ex){}
                setTimeout(function(){
                    $('.addFile').html('');
                    //console.log($('.addFile').html())
                    if(response.length>0){
    
                        if(response[0].file_type == 'images'){
                            
                            $(".slick-list").empty();
                            console.log(1);
                            $.each(response, function(index, value) {
                                $('.addFile').append("<div><img src='"+value.image_url+"' class='img-fluid'></div>");
                            });
                            
                            
                            setTimeout(function(){
                                // try{
                                //     $('.slider-product').slick('unslick')
                                // }catch(ex){}
                                $('.slider-product').slick({
                                    slidesToShow: 2,
                                    slidesToScroll: 2,               
                                    dots: false,
                                    infinite: true, 
                                });
                            },200)
                            
    
                        }else if(response[0].file_type == 'pdf'){
                            var a = "<embed src='" + response[0].image_url + "' frameborder='0' width='100%' height='400px'>";
                            $('.addFile').html(a);
                        }else{
                            $('.addFile').html("<p class='their_is_no_file'>Their is no Files</p>");
                        }
                        $("#show_book").modal('show');
    
                    }else{
                        $('.addFile').html("<p class='their_is_no_file'>Their is no Files</p>");
                        $("#show_book").modal('show');
                    }
                },500)

            }
        });
    }

</script>
<style>
.their_is_no_file{
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 64px !important;
    /*color: black;*/
}
.slider-product .slick-arrow {
    position: absolute;
    font-size: 0;
    border: none;
    background-color: transparent;
}
.slider-product .slick-prev::before {
    content: '<';
    font-size: 30px;
    background-color: #000;
    color: #fff;
    width: 40px;
    height: 40px;
    z-index: 999;
    position: absolute;
    left: 0;
    border-radius: 100%;
}
.slider-product .slick-prev {
    position: absolute;
    top: 50%;
    left: -30px;
}
.slider-product .slick-next {
    position: absolute;
    right: 0;
    left: auto;
    top: 50%;
    right: -30px;
}
.slider-product .slick-next::before {
    content: '>';
    font-size: 30px;
    background-color: #000;
    color: #fff;
    width: 40px;
    height: 40px;
    z-index: 999;
    position: absolute;
    right: 0;
    border-radius: 100%;
    left: auto;
}
.modal-dialog-centered {
    min-width: 1000px;
}
.slider-product img {
    width: 100%;
}
</style>
