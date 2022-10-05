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
                  <h4 class="mb-0">Category Pages</h4>
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
                  <button class="btn btn-primary" id="add_category">Add Category</button>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                    
                     <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Logo</th>
                              <th>Name</th>
                              <th>Urdu Name</th>
                              <th>Description</th>
                              <th>Image</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if($category) @foreach($category as $val)
                           <tr>
                              <td>{{$val->id}}</td> 
                              <td><img src='{{asset("/uploads/pages/$val->logo")}}' alt="" with="50px" id="page_img"></td> 
                              <td>{{$val->name}}</td>
                              <td>{{$val->name_urdu}}</td>
                              <td>{{$val->description}}</td>
                              <td><img src='{{asset("/uploads/pages/$val->file")}}' alt="" with="50px" id="page_img"></td>
                              <td>
                                 <button type="button" class="btn btn-primary edit_page" data-edit_id= "{{$val->id}}" data-name= "{{$val->name}}" data-name_urdu= "{{$val->name_urdu}}" data-desc= "{{$val->description}}" data-status= "{{$val->is_active}}" data-logo= "{{$val->logo}}" >Edit</button>
                              </td>
                           </tr>
                           @endforeach @endif
                        </tbody>
                        <tfoot>
                           <tr>
                           <th>ID</th>
                              <th>Logo</th>
                              <th>Name</th>
                              <th>Urdu Name</th>
                              <th>Description</th>
                              <th>Image</th>
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
<div class="modal fade" id="exampleModalgrid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle3">ADD</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <form method="POST" action="{{route('add_category')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="edit_id" id="edit_id">
         <div class="modal-body">
            <div class="container-fluid">
               <div class="container-fluid site-width">
                  <!-- START: Breadcrumbs-->
                  <div class="row">
                     <div class="col-12 align-self-center">
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                           <div class="w-sm-100 mr-auto">
                              <h4 class="mb-0">Add Category</h4>
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
                                           <td class="w-50">Logo</td>
                                           <td class="w-50">
                                            <input type="file" name="logo" class="form-controll" id="img_logo">
                                            <img src="" alt="" id="logo">
                                        </td>
                                        <tr>     
                                           <td class="w-50">Name</td>
                                           <td class="w-50">
                                            <input type="text" name="name" class="form-controll" id="img_name">
                                        </td>
                                       </tr>
                                        <tr>     
                                           <td class="w-50">Urdu Name</td>
                                           <td class="w-50">
                                            <input type="text" name="name_urdu" class="form-controll" id="img_name_urdu">
                                        </td>
                                        </tr>
                                        <tr>     
                                           <td class="w-50">Description</td>
                                           <td class="w-50">
                                            <textarea name="desc" class="form-controll" id="img_desc"></textarea>
                                        </td>
                                        </tr>
                                        
                                        <tr>     
                                           <td class="w-50">Image</td>
                                           <td class="w-50">
                                            <input type="file" name="file" class="form-controll" >
                                            <img src="" alt="" id="image">
                                        </td>
                                        </tr>

                                        <tr>
                                           <td>Status</td>
                                           <td class="status" id="editis_active">
                                           <select name='is_active' class='form-control input-sm'>
                                                <option value='1'>Active</option><option value='0' >In-Active</option></select>
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
   $("#image").hide();
   $("#hide").hide();
   $("#logo").hide();

   $(".edit_page").click(function(){
     
        $("#img_name").val($(this).data('name'));
        $("#img_name_urdu").val($(this).data('name_urdu'));
      //   $("#img_logo").val($(this).data('logo'));
        
      //   $("#logo").attr("src","{{asset('/uploads/pages/')}}/"+$(this).data('logo'));
        $("#image").attr("src","{{asset('/uploads/pages/')}}/"+$(this).data('file'));
        $("#logo").show();
        $("#image").show();
        $("#img_desc").text($(this).data('desc'));
        $("#edit_id").val($(this).data('edit_id'));
        var status = $(this).data('status');

        var body = "<select name='status' class='form-control innnput-sm'>";
        
        if(status == 1){
         body += "<option value='1' selected>Active</option><option value='0'>In-Active</option>";
        }else{
         body += "<option value='1'>Active</option><option value='0' selected>In-Active</option>";
        } 

            body += " </select>";     
            $("#editis_active").html(body);
            $("#exampleModalgrid").modal('show');
        
    //     $("#edit_email").prop("data-placeholder",$(this).data('email'));
    //     $("#edit_userid").val($(this).data('edit_userid'));
    })   
    
    $("#add_category").click(function(){
        $("#exampleModalgrid").modal('show');
    });

    $('#edit_active').click(function(){
        var body = "<select name='status' class='form-control input-sm'>";
        body += "<option value='1'>Active</option><option value='0'>In-Active</option>";
        body += " </select>";        
        $(this).closest("td").html(body);
    })



    

   
</script>
@endsection