@extends('layouts.main')
@section('content')
<!-- START: Card Data-->
<main>
   <div class="container-fluid site-width">
      <!-- START: Breadcrumbs-->
      <div class="row">
         <div class="col-12 align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
               <div class="w-sm-100 mr-auto">
                  <h4 class="mb-0">Order Items</h4>
               </div>
               <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                  <li class="breadcrumb-item">Home</li>
                  <li class="breadcrumb-item">Report</li>
                  <li class="breadcrumb-item active"><a href="#">Custom Report</a></li>
               </ol>
            </div>
         </div>
      </div>
      <!-- END: Breadcrumbs-->
      <!-- START: Card Data-->
      <div class="row">
         <div class="col-12 mt-3">
            <div class="card">
               <div class="card-body">
                  <div class="table-responsive">

                     <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>Order ID</th>
                              <th>Image</th>
                              <th>Product </th>
                              <th>description </th>
                              <th>Qty </th>
                              <th>Amount </th>
                              <th>Date </th>
                              <th>Price </th>
                              <th>Order Placed On</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if($order_item) @foreach($order_item as $val)
                           <tr>
                              <td>{{$val->id}}</td>
                              <td><img src="{{asset('/uploads/pages/'.$val->file)}}" alt="" with="50px" id="page_img"></td>
                              <td>{{$val->name}}</td>
                              <td>{{$val->description}}</td>
                              <td>{{$val->qty}}</td>
                              <td>{{$val->amount}}</td>
                              <td>{{$val->month}} {{$val->year}}</td>
                              <td>{{$val->price}}</td>
                              <td>{{$val->created_at}}</td>
                              <td>
                                 <button type="button" onclick="readBook({{$val->id}})" class="btn btn-primary " data-read_id= "{{$val->id}}" data-product_id= "{{$val->product_id}}">Read</button>
                              </td>
                           </tr>
                           @endforeach @endif
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>Order ID</th>
                              <th>Image</th>
                              <th>Product </th>
                              <th>description </th>
                              <th>Qty </th>
                              <th>Amount </th>
                              <th>Date </th>
                              <th>Price </th>
                              <th>Order Placed On</th>
                              <th>Action</th>
                           </tr>
                        </tfoot>
                    </table>

                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- END: Card DATA-->
   </div>
</main>
<!-- Edit user modal -->

<div class="modal fade" id="show_book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-slik" role="document">
       <div class="modal-content">
          <div class="show_files ">

            <div class="addFile slider slider-product">

			</div>

          </div>
       </div>
    </div>
 </div>
 
<!-- Edit user modal End-->
<!-- END: Card DATA-->
@endsection
@section('link')
@endsection

@section('script')
@endsection

@section('css')
<style type="text/css">
    #page_img, .pro_images{
        width:50px !important;
    }

    .pro_images{
        width:200px !important;
    }
    #image{
        width:40px !important;

    }
</style>
@endsection

@section('js')
<script type="text/javascript">

   $(".edit_page").click(function(){
      var product_id = $(this).data('product_id');
      var images = "<div class='row'>";
      @foreach($img as $val)
         if(product_id == {{$val->product_id}}){
            @php $src = "asset('/uploads/pages/'.auth()->user()->id.'/'.$val->file)"; @endphp
            images+="<div clss='col-lg-12 col-md-12'><img src='{{asset('/uploads/pages/'.auth()->user()->id.'/'.$val->file)}}' class='pro_images'></div>";
         }
      @endforeach
      images+="<div>";
      $("#exampleModalgrid").modal('show');
      $("#show_images").empty().append(images);
   })

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
@endsection
