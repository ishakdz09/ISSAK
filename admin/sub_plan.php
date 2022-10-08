<?php
session_start();
if($_SESSION['Status'] != "Logged in") {
   header("Location: login.php");
}
?>

<!doctype html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <title>Dooo - Subscription Plan</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />

    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->

    <link rel="shortcut icon" href="public/images/favicon.ico">



    <link href="public/cssadd-movie.css" rel="stylesheet" type="text/css" />



    <!-- Summernote css -->

    <link href="public/libs/summernote/summernote.css" rel="stylesheet" type="text/css" />


    <!-- Sweet Alert-->

    <link href="public/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


    <link href="public/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <link href="public/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <link href="public/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="public/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />



    <?php include 'layouts/headerStyle.php'; ?>

</head>



<?php include 'layouts/master.php'; echo setLayout();?>


<body>
    <!-- Begin page -->

    <div id="layout-wrapper">





        <?php include 'layouts/topbar.php'; ?>

        <div class="main-content">



            <div class="page-content">

                <div class="container-fluid">



                    <!-- start page title -->

                    <div class="row align-items-center">

                        <div class="col-sm-6">

                            <div class="page-title-box">

                                <h4 class="font-size-18">Subscription Plan</h4>

                                <ol class="breadcrumb mb-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Subscription Plan</a>
                                    </li>

                                    <li class="breadcrumb-item active">Subscription Plan</li>

                                </ol>

                            </div>

                        </div>

                    </div>

                    <!-- end page title -->


                    <div class="form" method="post">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-body">
                                    <div class="panel-heading">

                                        <div
                                            class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                                            <div>
                                                <h4 class="mb-3 mb-md-0">Subscription Plans</h4>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap text-nowrap">
                                                <div class="panel-heading">
                                                    <button data-toggle="modal" data-target="#Create_Plan_Modal"
                                                        id="Create_Plan"
                                                        class="btn btn-sm btn-primary waves-effect waves-light"><span
                                                            class="btn-label"><i class="fa fa-plus"></i></span> Create
                                                        Plan</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <br>

                                    <div class="panel-body">
                                        <div>
                                            <table id="datatable" class="table table-striped"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                                <thead>

                                                    <tr role="row">
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 9px;">#</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 50px;">Name</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 35px;">Time (Days)</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 57px;">Ammount</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 56px;">Currency</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 68px;">Background</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 68px;">Subscription Type</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 68px;">Status</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 68px;">Options</th>
                                                    </tr>

                                                </thead>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                </div> <!-- container-fluid -->

                <!-- Create_Plan_Modal Modal -->
                <div class="modal fade" id="Create_Plan_Modal" tabindex="-1" role="dialog"
                    aria-labelledby="Create_Plan_Modal_Lebel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Create_Plan_Modal_Lebel">Create Subscription plan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="panel-heading">
                                    <h3 class="panel-title row justify-content-center">Add Subscription Plan Details</h3>
                                </div>

                                <hr>

                                <div class="form-group"> <label class="control-label">Plan Name</label>&nbsp;&nbsp;<input id="modal_plan_name" type="text" name="label"
                                    class="form-control" placeholder="" required=""> </div>
                                <div class="form-group"> <label class="control-label">Time (Days)</label>&nbsp;&nbsp;<input id="modal_time" type="number" name="label"
                                    class="form-control" placeholder="" required=""> </div>
                                <div class="form-group"> <label class="control-label">Ammount</label>&nbsp;&nbsp;<input id="modal_ammount" type="number" name="label"
                                    class="form-control" placeholder="" required=""> </div>
                                    <div class="form-group">
                                        <label>Currency</label>
                                        <select class="form-control" id="modal_currency">
                                            <option value="0">INR</option>
                                        </select>
                                    </div>
                                <div class="form-group"> <label class="control-label">Background Image URL</label>&nbsp;&nbsp;<input id="modal_bg_image_url" type="text" name="label"
                                    class="form-control" placeholder="" required=""> </div>


                                    <div class="form-group">
                                    <label class="control-label">Subscription Type</label>
                                        <hr>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-6 ">Remove Ads</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="Remove_Ads_bool" switch="bool">
                                                <label for="Remove_Ads_bool" data-on-label=""
                                                    data-off-label=""></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-6 ">Watch Premium Contents</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="Watch_Premium_Contents_bool"
                                                    switch="bool">
                                                <label for="Watch_Premium_Contents_bool" data-on-label=""
                                                    data-off-label=""></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-6 ">Download Premium Contents</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="Download_Premium_Contents_bool"
                                                    switch="bool">
                                                <label for="Download_Premium_Contents_bool" data-on-label=""
                                                    data-off-label=""></label>
                                            </div>
                                        </div>
                                        <hr>
                                        </div>





                                    <div class="form-group">
                                        <label>Publish</label>
                                        <div>
                                            <input type="checkbox" id="Publish_toggle" switch="bool" checked />
                                            <label for="Publish_toggle" data-on-label="" data-off-label=""></label>
                                        </div>
                                    </div>



                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" onclick="Create_Plan()" class="btn btn-primary"
                                        id="Fetch_btn">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- End Page-content -->

            <?php include 'layouts/footer.php'; ?>

        </div>

        <!-- end main content-->

    </div>

    <!-- END layout-wrapper -->

    <?php include 'layouts/footerScript.php'; ?>



    <!--tinymce js-->

    <script src="public/libs/tinymce/tinymce.min.js"></script>



    <!-- Summernote js -->

    <script src="public/libs/summernote/summernote.js"></script>



    <!-- init js -->

    <script src="public/js/pages/form-editor.init.js"></script>


    <!-- Sweet Alerts js -->

    <script src="public/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Required datatable js -->

    <script src="public/libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <script src="public/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Sweet alert init js-->

    <script src="public/js/pages/sweet-alerts.init.js"></script>
    
    <!-- Buttons examples -->

    <script src="public/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    
    <script src="public/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    
    <script src="public/libs/jszip/jszip.min.js"></script>
    
    <script src="public/libs/pdfmake/build/pdfmake.min.js"></script>
    
    <script src="public/libs/pdfmake/build/vfs_fonts.js"></script>
    
    <script src="public/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    
    <script src="public/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    
    <script src="public/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->

    <script src="public/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>

    <script src="public/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->

    <script src="public/js/pages/datatables.init.js"></script>

    <script src="public/libs/select2/js/select2.min.js"></script>

    <script src="public/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script src="public/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

    <script src="public/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <script src="public/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>

    <script src="public/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>



    <script src="public/js/pages/form-advanced.init.js"></script>



    <?php include "layouts/content-end.php"; ?>



    <?php require '../db/config.php'; ?>

    <script>

    $('#datatable').dataTable({
        "order": [],
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "info": false,
        "filter": false,
        "paging":   false,
        "pageLength": 100,
        "ajax": "/admin/dashboard_api/subscription/get_all_subscriptions.php",
        "columns": [{
                "data": "1",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "2"
            },
            {
                "data": "3"
            },
            {
                "data": "4"
            },
            {
                "data": "5",
                render: function (data) {
                    if (data == 0) {
                        return '<label>INR</label>';
                    } else if (data == 1) {
                        return 'USD';
                    }
                }
            },
            {
                "data": "6",
                render: function (data) {
                   return '<img class="img-fluid" height="100" width="80" src='+ data +' data-holder-rendered="true">';
                }
            },
            {
                "data": "7"
            },
            {
                "data": "8",
                render: function (data) {
                    if (data == 0) {
                        return '<span class="badge badge-danger">UnPublished</span>';
                    } else if (data == 1) {
                        return '<span class="badge badge-success">Published</span>';
                    }
                }
            },
            {
                "data": "9",
                render: function (data) {
                    return '<div class="btn-group"> <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button> <div class="dropdown-menu" style=""> <a class="dropdown-item" onclick="Delete_plan(' +
                                data + ')" href="#">Delete</a> </div> </div>';
                }
            }
        ]
    });

    function Create_Plan() {
        var modal_plan_name = document.getElementById("modal_plan_name").value;
        var modal_time = document.getElementById("modal_time").value;
        var modal_ammount = document.getElementById("modal_ammount").value;
        var modal_currency = document.getElementById("modal_currency").value;
        var modal_bg_image_url = document.getElementById("modal_bg_image_url").value;

        if ($('#Remove_Ads_bool').is(':checked')) {
            var Remove_Ads = 1;
        } else {
            var Remove_Ads = 0;
        }
        if ($('#Watch_Premium_Contents_bool').is(':checked')) {
            var Watch_Premium_Contents = 2;
        } else {
            var Watch_Premium_Contents = 0;
        }
        if ($('#Download_Premium_Contents_bool').is(':checked')) {
            var Download_Premium_Contents = 3;
        } else {
            var Download_Premium_Contents = 0;
        }

        var Subscription_Type = "";
        if (Remove_Ads != "0") {
            Subscription_Type = "" + Remove_Ads;
        }
        if (Watch_Premium_Contents != "0") {
            Subscription_Type = "" + Subscription_Type + Watch_Premium_Contents;
        }
        if (Download_Premium_Contents != "0") {
            Subscription_Type = "" + Subscription_Type + Download_Premium_Contents;
        }
        if (Subscription_Type != "") {
            var f_Subscription_Type = Subscription_Type;
        } else {
            var f_Subscription_Type = 0;
        }

        if ($('#Publish_toggle').is(':checked')) {
            var Publish_toggle_int = 1;
        } else {
            var Publish_toggle_int = 0;
        }
        
        var jsonObjects = {
            "modal_plan_name": modal_plan_name,
            "modal_time": modal_time,
            "modal_ammount": modal_ammount,
            "modal_currency": modal_currency,
            "modal_bg_image_url": modal_bg_image_url,
            "f_Subscription_Type": f_Subscription_Type,
            "Publish_toggle_int": Publish_toggle_int
        };
        $.ajax({
            type: 'POST',
            url: "dashboard_api/subscription/create_sub_plan.php",
            contentType: 'application/json',
            data: JSON.stringify(jsonObjects),
            dataType: 'text',
            headers: {
                'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
            },
            success: function (response) {
                if (response != "") {
                    location.reload();
                }
            }
        });
    }

    function Delete_plan(ID) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it!"
        }).then(function (result) {
            if (result.value) {
                var jsonObjects = {
                    "ID": ID
                };
                $.ajax({
                    type: 'POST',
                    url: "dashboard_api/subscription/delete_sub_plan.php",
                    contentType: 'application/json',
                    data: JSON.stringify(jsonObjects),
                    dataType: 'text',
                    headers: {
                        'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
                    },
                    success: function (response) {
                        if (response == "Sub Plan Deleted successfully") {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Subscription Plan Deleted Successfully!',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            ErrorResponse();
                        }

                    }
                });
            }
        });
    }

    function ErrorResponse() {
        swal.fire({
            title: 'Error',
                      text: 'Something Went Wrong :(',
                      type: 'error'
                }).then(function() {
                    location.reload();
                });
    }

    </script>