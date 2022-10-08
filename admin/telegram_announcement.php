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
    <title>Dooo - Telegram Announcement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="public/images/favicon.ico">

    <!-- Toaster-->
    <link href="public/libs/toaster/toastr.min.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="public/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/headerStyle.php'; ?>
</head>

<?php include 'layouts/master.php'; echo setLayout();?>

<body onload="javascript:Load_Telegram_Data()">

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
                            <h4 class="font-size-18">Telegram Announcement</h4>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Telegram Notifications</a></li>
                                <li class="breadcrumb-item active">Telegram Announcement</li>
                            </ol>
                        </div>
                    </div>

                </div>
                <!-- end page title -->
                <div class="form" action="https://admin.fliq.pro/admin/videos/add/" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-body">
                                <h3 class="card-title mt-0">SEND TELEGRAM NOTIFICATION (Announcement)</h3>
                                <hr>

                                <div class="form-group">
                                    <label>Heading</label>
                                    <input class="form-control col-md-9" type="text" value="" id="Heading">
                                </div>

                                <div class="form-group">
                                                <label>Message</label>
                                                <div>
                                                    <textarea required="" class="form-control col-md-9" id="Message" rows="5"></textarea>
                                                </div>
                                            </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input class="form-control col-md-9" type="text" value="" id="image">
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 row justify-content-end">
                                        <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                            onclick="Save_Telegram_Data()" id="create_btn"
                                            type="submit" aria-haspopup="true" aria-expanded="false">
                                            <i class="ion ion-md-send"></i> SEND
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<?php include 'layouts/footerScript.php'; ?>

<!-- Sweet Alerts js -->
<script src="public/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Toaster js -->
<script src="public/libs/toaster/toastr.min.js"></script>

<!-- Sweet alert init js-->
<script src="public/js/pages/sweet-alerts.init.js"></script>

<?php include "layouts/content-end.php"; ?>

<script>
var telegram_token;
var telegram_chat_id;

function Load_Telegram_Data() {
    $.ajax({
            type: 'POST',
            url: "dashboard_api/get_teligram_data.php",
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                      'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
                    },
            success: function (response) {

                telegram_token = response.telegram_token;
                telegram_chat_id = response.telegram_chat_id;
            }
        });
}

function Save_Telegram_Data() {
    var Heading = document.getElementById("Heading").value;
    var Message = document.getElementById("Message").value;
    var image = document.getElementById("image").value;

    if(Heading != "" && Message != "") {
        var jsonObjects = {
            "telegram_token": telegram_token,
	        "telegram_chat_id": telegram_chat_id,
	        "Heading": Heading,
            "Message": Message,
	        "image": image
        };

        $.ajax({
            type: 'POST',
            url: 'dashboard_api/teligram.php',
            headers: {
                'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
            },
            contentType: 'application/json',
            data: JSON.stringify(jsonObjects),
            dataType: 'text',
            success: function (response) {
                Success();
            },
            error: function (response) {
                ErrorResponse();
            }
        })
    } else {
        Warning();
    }
    
}

function Success() {
    toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "2000",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

toastr.success("Sended Successfully!");
}

function Warning() {
    toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "2000",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

toastr.warning("Fill All Details Correctly!");
}

function ErrorResponse() {
    toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "2000",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

toastr.error("Something Went Wrong!");
}

</script>