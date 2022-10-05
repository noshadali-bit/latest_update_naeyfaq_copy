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
                  <h4 class="mb-0">Blog</h4>
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
                              <th>Blog ID</th>
                              <th>User Name</th>
                              <th>User Email</th>
                              <th>Comment</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if($blog) @foreach($blog as $val)
                           <tr>
                              
                              <td>{{$val->blog_id}}</td>
                              <td>{{$val->name}}</td>
                              <td>{{$val->email}}</td>
                              <td>{{$val->comment}}</td>

                              <td>
                                 <select name="active_comment" id="active_comment" class="form-control active_comment" edit_id="{{$val->id}}">
                                    <option value="1" @if($val->is_active==1) selected @endif >Active</option>
                                    <option value="0" @if($val->is_active==0) selected @endif >In-Active</option>
                                 </select>
                           </tr>
                           @endforeach @endif
                        </tbody>
                        <tfoot>
                           <tr>
                           <th>Blog ID</th>
                              <th>User Name</th>
                              <th>User Email</th>
                              <th>Comment</th>
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
   $(".active_comment").change(function(){
      
      $.ajax({
        method: "POST",
        url: "{{ route('active_comment') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          id: $(this).attr("edit_id"),
          is_active: $(this).val()
        },
        success: function(response) {
         toastr('success', "Change Status");
        }
      });
   })
</script>
@endsection