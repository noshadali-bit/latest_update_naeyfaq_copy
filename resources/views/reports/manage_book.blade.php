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
                  <h4 class="mb-0">Manage Book</h4>
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
               <div class="card-header justify-content-between align-items-center">
                  <h4 class="card-title"></h4>
                  {{-- <button class="btn btn-primary" id="add_category">Add Book</button> --}}
               </div>
               <div class="card-body">
                  <div class="table-responsive">

                     <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Category</th>
                              <th>Month</th>
                              <th>Name</th>
                              <th>Urdu Name</th>
                              <th>Author</th>
                              <th>Price</th>
                              <th>File type</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if($book) @foreach($book as $val)
                           <tr>
                              <td>{{$val->id}}</td>
                              <td>{{$val->cat_name}}</td>
                              <td>{{$val->pro_name}}</td>
                              <td>{{$val->post_title}}</td>
                              <td>{{$val->post_title_urdu}}</td>
                              <td>{{$val->writer_name}}</td>
                              <td>{{$val->price}}</td>
                              <td><button class="btn btn-primary" onclick="readBook({{$val->id}})">{{$val->file_type}}</button></td>
                              <td>
                                <select name='status' class='form-control input-sm' id={{$val->id}}>
                                    <option value='1' @if($val->is_active) selected @endif >Active</option>
                                    <option value='0' @if($val->is_active == 0) selected @endif>In-Active</option>
                                </select>
                              </td>
                              <td>
                                <button type="button" class="btn btn-primary edit_page" data-edit_id= "{{$val->id}}" data-post_title= "{{$val->post_title}}" data-post_title_urdu= "{{$val->post_title_urdu}}" data-writer_name= "{{$val->writer_name}}" data-price= "{{$val->price}}" data-file_type= "{{$val->file_type}}">Edit</button>

                             </td>
                           </tr>
                           @endforeach @endif
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>ID</th>
                              <th>Category</th>
                              <th>Month</th>
                              <th>Name</th>
                              <th>Urdu Name</th>
                              <th>Author</th>
                              <th>Price</th>
                              <th>File type</th>
                              <th>Status</th>
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

<!--  Add book -->
<div class="modal fade" id="exampleModalgrid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle3">ADD</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
          </div>
         <form method="POST" action="{{route('update_book')}}" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="edit_id" class="edit_id" id="edit_id">
          <div class="modal-body">
             <div class="container-fluid">
                <div class="container-fluid site-width">
                   <!-- START: Breadcrumbs-->
                   <div class="row">
                      <div class="col-12 align-self-center">
                         <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                               <h4 class="mb-0 heading_product">Edit Book</h4>
                            </div>
                         </div>
                      </div>
                   </div>
                   <!-- END: Breadcrumbs-->
                   <!-- START: Card Data-->

                       <div class="row">
                          <div class="col-12 mt-3">
                             <div class="card">
                                <div class="card-body">
                                   <table id="user" class="table table-bordered table-striped" style="clear: both;">
                                      <tbody>
                                         <tr>
                                           <td class="w-50">Name</td>
                                           <td class="w-50">
                                             <input type="text" name="post_title" class="form-controll" id="post_title">
                                           </td>
                                         </tr>

                                         <tr>
                                           <td class="w-50">Urdu Name</td>
                                           <td class="w-50">
                                             <input type="text" name="post_title_urdu" class="form-controll" id="post_title_urdu">
                                           </td>
                                         </tr>

                                         <tr>
                                            <td class="w-50">Author Name</td>
                                            <td class="w-50">
                                              <input type="text" name="writer_name" class="form-controll" id="writer_name">
                                            </td>
                                          </tr>

                                          <tr>
                                            <td class="w-50">Price</td>
                                            <td class="w-50">
                                              <input type="text" name="price" class="form-controll" id="price">
                                            </td>
                                          </tr>

                                          <tr>
                                            <td class="w-50">File Type</td>
                                            <td>
                                             <select name="file_type" id="file_type" class='form-control input-sm'>
                                                 <option value="pdf">PDF</option>
                                                 <option value="images">Images</option>
                                             </select>
                                            </td>
                                          </tr>

                                          <tr>
                                             <td>File</td>
                                             <td id="show_file_type"><input type='file' name='file' multiple accept="image/*" class='form-control'/></td>
                                          </tr>

                                          <tr>
                                             <td>Water Mark</td>
                                             <td class="status">
                                                 <input type="checkbox" name="watermark" value="watermark" id="watermark" class='form-control'>
                                             </td>
                                          </tr>

                                      </tbody>
                                   </table>
                                </div>
                             </div>
                          </div>
                       </div>

                   <!-- END: Card DATA-->
                </div>
             </div>
          </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Save changes</button>
         </div>
         </form>
       </div>
    </div>
 </div>
 <!-- Add book -->

<!-- Add book -->
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

<!-- Edit user modal End-->
<!-- END: Card DATA-->
@endsection
@section('link')
<link rel="stylesheet" href="{{asset('vendors/datatable/css/dataTables.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="{{asset('vendors/datatable/buttons/css/buttons.bootstrap4.min.css')}}"/>
<link rel="stylesheet" href="{{asset('vendors/x-editable/css/bootstrap-editable.css')}}" />
@endsection

@section('script')
<!-- END: Template JS-->

<script src="{{asset('vendors/x-editable/js/bootstrap-editable.min.js')}}"></script>
<script src="{{asset('js/xeditable.script.js')}}"></script>

<script src="{{asset('vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatable/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('vendors/datatable/jszip/jszip.min.js')}}"></script>
<script src="{{asset('vendors/datatable/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/datatable/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.print.min.js')}}"></script>

<script src="{{asset('js/datatable.script.js')}}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

@endsection

@section('css')
<style type="text/css">
    #page_img{
        width:50px !important;
    }
    #image{
        width:40px !important;
    }
    #logo{
        width:30px !important;
    }

</style>
@endsection

@section('js')
<script type="text/javascript">

   $(".input-sm").change(function(){

        $.ajax({
            method: "POST",
            url: "{{ route('active_book') }}",
            data: {
            "_token": "{{ csrf_token() }}",
            id: $(this).attr("id"),
            is_active: $(this).val()
            },
            success: function(response) {
            toastr.success("Change Status");
            }
        });

    })


    $(".edit_page").click(function(){

        $("#post_title").val($(this).data('post_title'));
        $("#post_title_urdu").val($(this).data('post_title_urdu'));
        $("#writer_name").val($(this).data('writer_name'));
        $("#price").val($(this).data('price'));
        $("#file_type").val($(this).data('file_type'));

        if($(this).data('file_type') == 'images'){
            $("#file_type").html("<option value='images' slelcted>Image</option><option value='pdf'>PDF</option>")
        }else if($(this).data('file_type') == 'pdf'){
            $("#file_type").html("<option value='images'>Image</option><option value='pdf' slelcted>PDF</option>")
        }

        $("#edit_id").val($(this).data('edit_id'));
        $("#exampleModalgrid").modal('show');
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

    $("#file_type").change(function(){

        if($(this).val() == 'pdf'){
            $("#show_file_type").html("<input type='file' name='file' accept='application/pdf,application/vnd.ms-excel' class='form-control'/>")
        }else if($(this).val() == 'images'){
            $("#show_file_type").html( "<input type='file' name='file[]' accept='image/*' class='form-control' multiple/>" )
        }

    })
</script>
@endsection
