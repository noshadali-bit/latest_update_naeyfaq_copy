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
                  <h4 class="mb-0">Orders Pages</h4>
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
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                    
                     <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>User First Name</th>
                              <th>User Last Name</th>
                              <th>Product Name</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total Amount</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if($order_item) @foreach($order_item as $val)
                           <tr>
                              <td>{{$val->f_name}}</td> 
                              <td>{{$val->l_name}}</td>
                              <td>{{$val->name}}</td>
                              <td>{{$val->price}}</td>
                              <td>{{$val->qty}}</td>
                              <td>{{$val->amount}}</td>
                              <td>{{$val->status}}</td>
                              <td>
                                 @foreach($shipping_address as $ship) @if($val->id == $ship->order_id)
                                 <button type="button" class="btn btn-primary edit_page" data-shipping_f_name= "{{$ship->shipping_f_name}}" data-edit_id= "{{$val->id}}" data-shipping_l_name= "{{$ship->shipping_l_name}}" data-shipping_country= "{{$ship->shipping_country}}" data-shipping_address= "{{$ship->shipping_address}}" data-shipping_city= "{{$ship->shipping_city}}" data-shipping_email= "{{$ship->shipping_email}}" data-shipping_phonenumber= "{{$ship->shipping_phonenumber}}" data-shipping_charges= "{{$ship->shipping_charges}}" data-status= "{{$val->status}}">Edit</button>
                                 @endif @endforeach
                              </td>
                           </tr>
                           @endforeach @endif
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>User First Name</th>
                              <th>User Last Name</th>
                              <th>Product Name</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total Amount</th>
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
<div class="modal fade" id="exampleModalgrid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle3">Shipping Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <form method="POST" action="{{route('order_status_change')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="edit_id" id="edit_id">
         <div class="modal-body">
            <div class="container-fluid">
               <div class="container-fluid site-width">
                    
                      <div class="row">
                         <div class="col-12 mt-3">
                            <div class="card">
                               <div class="card-body">
                                  <table id="user" class="table table-bordered table-striped" style="clear: both;">
                                     <tbody>
                                        <tr>
                                           <td class="w-50">Shippping First Name</td>
                                           <td class="w-50" id="shipping_f_name"></td>
                                        </tr>
                                        <tr>
                                           <td class="w-50">Shippping last Name</td>
                                           <td class="w-50" id="shipping_l_name"></td>
                                        </tr>
                                        <tr>
                                           <td class="w-50">Shippping Email</td>
                                           <td class="w-50" id="shipping_email"></td>
                                        </tr>
                                        <tr>
                                           <td class="w-50">Shippping Phone Number</td>
                                           <td class="w-50" id="shipping_phonenumber"></td>
                                        </tr>
                                        <tr>
                                           <td class="w-50">Shippping Country</td>
                                           <td class="w-50" id="shipping_country"></td>
                                        </tr>
                                        <tr>
                                           <td class="w-50">Shippping City</td>
                                           <td class="w-50" id="shipping_city"></td>
                                        </tr>
                                        <tr>
                                           <td class="w-50">Shippping Address</td>
                                           <td class="w-50" id="shipping_address"></td>
                                        </tr>
                                        <tr>
                                           <td>Status</td>
                                           <td class="status" id="editis_active">
                                           <select name='status' class='form-control input-sm'>
                                              <option value='Pandding' >Pandding</option></select>
                                              <option value='Delivered'>Delivered</option>
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
@endsection 

@section('script') 
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

   $(".edit_page").click(function(){
     
        $("#shipping_f_name").html($(this).data('shipping_f_name'));
        $("#shipping_l_name").html($(this).data('shipping_l_name'));
        $("#shipping_email").html($(this).data('shipping_email'));
        $("#shipping_phonenumber").html($(this).data('shipping_phonenumber'));
        $("#shipping_country").html($(this).data('shipping_f_name'));
        $("#shipping_city").html($(this).data('shipping_city'));
        $("#shipping_address").html($(this).data('shipping_address'));
        $("#shipping_charges").html($(this).data('shipping_charges'));
        $("#edit_id").val($(this).data('edit_id'));
        
        var status = $(this).data('status');

        var body = "<select name='status' class='form-control innnput-sm'>";
        
        if(status == "Pending"){
         body += "<option value='Pending' selected>Pending</option><option value='Delivered'>Delivered</option>";
        }else{
         body += "<option value='Pending'>Pending</option><option value='Delivered' selected>Delivered</option>";
        } 

            body += " </select>";     
            $("#editis_active").html(body);
            $("#exampleModalgrid").modal('show');
        
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