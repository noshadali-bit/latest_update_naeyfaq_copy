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
                            <h4 class="mb-0">Product Pages</h4>
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
                            {{-- <button class="btn btn-primary"><a href="{{route('add_product')}}" class="btn btn-primary" >Add Product</a></button> --}}
                            <button class="btn btn-primary" id="add_page_images">Add Product</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="example" class="display table dataTable table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Urdu Name</th>
                                            <th>Date</th>
                                            <th>category</th>
                                            <th>Add Book</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($product)
                                            @foreach ($product as $val)
                                                <tr>
                                                    <td>{{ $val->id }}</td>
                                                    <td><img src="{{ asset('/uploads/pages/' . $val->file) }}"
                                                            alt="" with="50px" id="page_img"></td>
                                                    <td>{{ $val->name }}</td>
                                                    <td>{{ $val->name_urdu }}</td>
                                                    {{-- <td>{{$val->description}}</td>
                              <td>{{$val->price}}</td> --}}
                                                    <td>{{ $val->month }} {{ $val->year }}</td>
                                                    <td>
                                                        @if ($category)
                                                            @foreach ($category as $cat)
                                                                @if ($val->cat_id == $cat->id)
                                                                    {{ $cat->name }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary"
                                                            onClick="add_book({{ $val->id }})">Add Book</button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary"> <a
                                                                href="{{ route('edit_products', $val->id) }}"
                                                                class="btn btn-primary">Edit</a> </button>
                                                        <!-- <button type="button" class="btn btn-primary edit_page" data-edit_id= "{{ $val->id }}" data-name= "{{ $val->name }}" data-desc= "{{ $val->description }}" data-cat_id= "{{ $val->cat_id }}" data-status= "{{ $val->is_active }}">Edit</button> -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Urdu Image</th>
                                            <th>Name</th>
                                            <th>Desc</th>
                                            <th>Category</th>
                                            <th>Add Book</th>
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
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle3">ADD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('add_product') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="edit_id" class="edit_id">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="container-fluid site-width">
                                <!-- START: Breadcrumbs-->
                                <div class="row">
                                    <div class="col-12 align-self-center">
                                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                                            <div class="w-sm-100 mr-auto">
                                                <h4 class="mb-0 heading_product">Add Product</h4>
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
                                                <table id="user" class="table table-bordered table-striped"
                                                    style="clear: both;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="w-50">Category</td>
                                                            <td class="w-50">
                                                                <select class="form-control" name="cat_id" id="productcat"
                                                                    required>
                                                                    @if ($category)
                                                                        @foreach ($category as $val)
                                                                            <option value="{{ $val->id }}">
                                                                                {{ $val->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <td class="w-50">Year</td>
                                                            <td class="w-50">
                                                                <select class="form-control" name="year" id="productyear"
                                                                    required>
                                                                    <option value=''>--Select Month--</option>
                                                                    @for ($i = 2000; $i < 2050; $i++)
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="w-50">Month</td>
                                                            <td class="w-50">
                                                                <select class="form-control" name="month"
                                                                    id="productmonth" required>
                                                                    <option value=''>--Select Month--</option>
                                                                    <option selected value='Jan'>Jan</option>
                                                                    <option value='Feb'>Feb</option>
                                                                    <option value='Mar'>Mar</option>
                                                                    <option value='Apr'>Apr</option>
                                                                    <option value='May'>May</option>
                                                                    <option value='Jun'>Jun</option>
                                                                    <option value='Jul'>Jul</option>
                                                                    <option value='Aug'>Aug</option>
                                                                    <option value='Sep'>Sep</option>
                                                                    <option value='Oct'>Oct</option>
                                                                    <option value='Nov'>Nov</option>
                                                                    <option value='Dec'>Dec</option>
                                                                </select>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="w-50">Image</td>
                                                            <td class="w-50">
                                                                <input type="file" name="product_img_1"
                                                                    class="form-control" id="1" required>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status</td>
                                                            <td class="status">
                                                                <select name='status' class='form-control input-sm'>
                                                                    <option value='1'>Active</option>
                                                                    <option value='0'>In-Active</option>
                                                                </select>
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
                        <span id="error_msg"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit_btn" disabled>Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add book -->
    <div class="modal fade" id="add_book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle3">ADD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('add_book') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="edit_id" id="edit_id" value="">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="container-fluid site-width">
                                <!-- START: Breadcrumbs-->
                                <div class="row">
                                    <div class="col-12 align-self-center">
                                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                                            <div class="w-sm-100 mr-auto">
                                                <h4 class="mb-0 heading_product">Add Book</h4>
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
                                                <table id="user" class="table table-bordered table-striped"
                                                    style="clear: both;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="w-50">Book Title</td>
                                                            <td><input type="text" name="post_title"
                                                                    class="form-control" id="post_title"
                                                                    placeholder="Book Title" required></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="w-50">Urdu Title</td>
                                                            <td><input type="text" name="post_title_urdu"
                                                                    class="form-control" id="post_title_urdu"
                                                                    placeholder="Urdu Title" required></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="w-50">Author Name</td>
                                                            <td><input type="text" name="writer_name"
                                                                    class="form-control" id="writer_name"
                                                                    placeholder="Author Name" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="w-50">Price</td>
                                                            <td><input type="text" name="price"
                                                                    class="form-control" id="price"
                                                                    placeholder="Price" required></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="w-50">File Type</td>
                                                            <td>
                                                                <select name="file_type" id="file_type"
                                                                    class='form-control input-sm'>
                                                                    <option value="pdf">PDF</option>
                                                                    <option value="images">Images</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>File</td>
                                                            <td id="show_file_type"><input type='file' name='file'
                                                                    accept='application/pdf,application/vnd.ms-excel'
                                                                    class='form-control' /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Water Mark</td>
                                                            <td class="status">
                                                                <input type="checkbox" name="watermark" value="watermark"
                                                                    id="watermark" class='form-control'>
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
                        <button type="submit" class="btn btn-primary" >Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit user modal End-->
    <!-- END: Card DATA-->
@endsection
@section('link')
    <link rel="stylesheet" href="{{ asset('vendors/datatable/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/datatable/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/x-editable/css/bootstrap-editable.css') }}" />
@endsection

@section('script')
    <!-- END: Template JS-->

    <script src="{{ asset('vendors/x-editable/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('js/xeditable.script.js') }}"></script>

    <script src="{{ asset('vendors/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('vendors/datatable/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendors/datatable/buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/buttons/js/buttons.print.min.js') }}"></script>

    <script src="{{ asset('js/datatable.script.js') }}"></script>
@endsection

@section('css')
    <style type="text/css">
        #page_img {
            width: 50px !important;
        }
        #error_msg{
            display: none;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        $(".edit_page").click(function() {

            $("#img_name").val($(this).data('name'));
            $("#img_name_urdu").val($(this).data('name_urdu'));
            $("#image").val($(this).data('file'));
            $("#img_desc").text($(this).data('desc'));
            $("#edit_id").val($(this).data('edit_id'));

            var status = $(this).data('status');
            // alert(status)
            var body = "<select name='status' class='form-control innnput-sm'>";
            body += "<option value='1' " + status == 1 ? 'selected' : ''; + ">Active</option><option value='0' " +
            status == 0 ? 'selected' : ''; + ">In-Active</option>";
            body += " </select>";
            // $(".status").html(body);
            $("#exampleModalgrid").modal('show');

            //     $("#edit_email").prop("data-placeholder",$(this).data('email'));
            //     $("#edit_userid").val($(this).data('edit_userid'));
        })

        $("#add_page_images").click(function() {
            $("#exampleModalgrid").modal('show');
        });

        $('#edit_active').click(function() {
            var body = "<select name='status' class='form-control input-sm'>";
            body += "<option value='1'>Active</option><option value='0'>In-Active</option>";
            body += " </select>";
            $(this).closest("td").html(body);
        })

        function add_book(i) {
            $("#edit_id").val(i);
            $("#add_book").modal('show');
        }

        $("#file_type").change(function() {

            if ($(this).val() == 'pdf') {
                $("#show_file_type").html(
                    "<input type='file' name='file' accept='application/pdf,application/vnd.ms-excel' class='form-control'/>"
                )
            } else if ($(this).val() == 'images') {
                $("#show_file_type").html(
                    "<input type='file' name='file[]' accept='image/*' class='form-control' multiple/>")
            }

        })

        $("#productmonth").change(function() {

            var month = $(this).val();
            var year = $('#productyear').val();


            if (month !== '' || year !== '') {
                CheckYearMonth(year, month);
            }


        });

        $("#productyear").change(function() {

            var month = $('#productmonth').val();
            var year = $(this).val();


            if (month !== '' || year !== '') {
                CheckYearMonth(year, month);
            }

        });


        function CheckYearMonth(year, month) {

            var year = year;
            var month = month;

            if (year !== '' || month !== '') {
                $.ajax({
                    method: "POST",
                    url: "{{ route('check_product') }}",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        cat_id: $("#productcat").val(),
                        year: year,
                        month: month
                    },
                    success: function(response) {

                        // console.log(response)
                        // if (response == null) {
                        //     $("#submit_btn").prop('disabled', false);
                        //     $("#submit_btn").removeAttr("disabled");
                        // } else {
                        //     $("#submit_btn").attr("disabled", true);
                        // }
                        //var data = jQuery.parseJSON(JSON.stringify(response));

                        if (typeof response['error'] !== 'undefined' && response['error'].length > 0) {
                            $('#submit_btn').prop('disabled', true);
                            $('#error_msg').show();
                            $('#error_msg').css('color', 'red');
                            $('#error_msg').html("This Year & Month are already included");
                        }
                        if (typeof response['success'] !== 'undefined' && response['success'].length > 0) {
                            $('#error_msg').hide();
                            //$('#submit_btn').attr('disabled', '');
                            $('#submit_btn').prop('disabled', false);
                        }
                    },

                });
            }

        }
    </script>
@endsection
