<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dooo - Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="public/images/favicon.ico">
    <?php include 'layouts/headerStyle.php'; ?>

</head>

<body>

    <div class="home-btn d-none d-sm-block">
        <a href="index.php" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20 p-2">Reset Password</h5>
                                <a href="index.php" class="logo logo-admin">
                                    <img src="public/images/logo-sm.png" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">

                            <div class="p-3">

                                <div class="alert alert-success mt-5" role="alert">
                                    Enter your Email and instructions will be sent to you!
                                </div>



                                <label class="col-8">Email</label>
                                <div class="form-group col-12 row">
                                    
                                    <div class="form-group col-9">
                                        
                                        <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                    </div>
    
                                    <div class="form-group col-3">
                                        <div class="text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" id="Reset_btn"
                                                onclick="sendCode()">Send Code</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                        
                                        <input type="text" class="form-control" id="code" placeholder="Enter Code">
                                </div>

                                <div class="form-group col-12 row">
                                    
                                    <div class="form-group col-9">
                                        
                                        <input type="text" class="form-control" id="newpass" placeholder="Enter New Password">
                                    </div>
    
                                    <div class="form-group col-3">
                                        <div class="text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" id="Pass_Reset_btn"
                                                onclick="Reset()">Reset</button>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div id="result" class="m-t-15"></div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <a href="login.php"><i class="mdi mdi-chevron-left"></i> Back</a>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p class="mb-0">© <script>
                                document.write(new Date().getFullYear())
                            </script> Dooo- Crafted with <i class="mdi mdi-heart text-danger"></i></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include 'layouts/footerScript.php'; ?>
    <?php include "layouts/content-end.php"; ?>

    <script>
        function sendCode() {
            $('#result').html('');
            var mail = document.getElementById("useremail").value;

            if(mail != "") {
                $.ajax({
                    type: 'POST',
                    url: "dashboard_api/password_recover_api.php?mail=" + mail,
                    contentType: 'application/json',
                    dataType: 'text',
                    beforeSend: function () {
                        $("#Reset_btn").html('Sending...');
                    },
                    success: function (response) {
                        $("#Reset_btn").html('Send Code');
                        if (response == "") {
                            $('#result').html(
                                '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Went Wrong!</div>'
                            );
                        } else if (response == "Email Not Registered") {
                            $('#result').html(
                                '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Email Not Registered!</div>'
                            );
                        } else if (response == "Something Went Wrong!") {
                            $('#result').html(
                                '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Went Wrong!</div>'
                            );
                        } else if (response == "Message has been sent") {
                            $('#result').html(
                                '<div class="alert alert-success alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Code Sended To the Mail Address!</div>'
                            );
                        } else {
                            $('#result').html(
                                '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Went Wrong!</div>'
                            );
                        }
                    }
                });
            } else {
                $('#result').html(
                    '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please Enter a Valid Mail!</div>'
                );
            }

           
        }

        function Reset() {
            $('#result').html('');
            var code = document.getElementById("code").value;
            var newpass = document.getElementById("newpass").value;

            if(code != "") {
                if(newpass != "") {
                    $.ajax({
                        type: 'POST',
                        url: "dashboard_api/reset_password.php?token=" + code + "&pass=" + newpass,
                        contentType: 'application/json',
                        dataType: 'text',
                        beforeSend: function () {
                            $("#Pass_Reset_btn").html('Reseting...');
                        },
                        success: function (response) {
                            $("#Pass_Reset_btn").html('Reset');
                            if (response == "") {
                                $('#result').html(
                                    '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Went Wrong!</div>'
                                );
                            } else if (response == "Expired") {
                                $('#result').html(
                                    '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Code Expired!</div>'
                                );
                            } else if (response == "Password Updated successfully") {
                                $('#result').html(
                                    '<div class="alert alert-success alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Password Updated successfully!</div>'
                                );
                            } else if (response == "Something Went Wrong!") {
                                $('#result').html(
                                    '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Went Wrong!</div>'
                                );
                            } else if (response == "Invalid Request") {
                                $('#result').html(
                                    '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Went Wrong!</div>'
                                );
                            } else {
                                $('#result').html(
                                    '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Went Wrong!</div>'
                                );
                            }
                        }
                    });
                } else {
                    $('#result').html(
                        '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please Enter a Valid Password!</div>'
                    );
                }
            } else {
                $('#result').html(
                    '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please Enter a Valid Code!</div>'
                );
            }
        }
    </script>