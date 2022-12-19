<?php
session_start();
if (isset($_SESSION['User'])) {
    header("Location:/liveChat/profile/");
}
// print_r($_SESSION['User']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-5/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/forms.css">
    <title>Login</title>
</head>

<body>
    <main class="container login-form">
        <header>
            <div class="d-flex">
                <div class="">
                </div>
                <h2 class="h text-center my-5">Login</h2>
                <a href="../../" class="btn btn-outline-dark text-decoration-none">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
            </div>
            <div class="" id="error-logger">
            </div>
        </header>
        <div class="d-flex align-items-center">

            <section class="mx-auto w-25">
                <form action="" method="post" id="login-form">
                    <input type="hidden" name="request" value="login">
                    <div class="mb-4 input-container">
                        <input type="text" autocomplete="off" class="" name="email" aria-describedby="helpId" placeholder="" required>
                        <label for="" class="">User name/Email</label>
                    </div>
                    <div class="mb-4 input-container">
                        <input type="password" autocomplete="off" class="" name="pasword" aria-describedby="helpId" placeholder="" required>
                        <label for="" class="">Password</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-outline-dark float-end" id="login-btn">Login</button>

                </form>
                <a href="../register/" class="btn btn-outline-dark float-start mt-5 w-25 text-decoration-none">Sign up</a>
            </section>
        </div>
    </main>

    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/fontawesome-free-5/js/all.min.js"></script>
    <script src="../../assets/js/main_j.js"></script>
    <script>
        $(function() {
            function displayError(response, errType, msg) {
                $('#error-logger #alert-note').remove();
                $('#error-logger').html(`
                <div class="alert alert-${errType} alert-dismissible" id="alert-note">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>${response}!</strong> ${msg}.
                </div>`)
                // setTimeout(() => {
                $('#alert-note').fadeOut(5000);
                // }, 3000);
            }
            $("#login-btn").click(function(e) {
                e.preventDefault();
                // console.log($("#register-form").serializeArray());
                let fm = $("#login-form").serialize();
                $.post("../../Route.php", fm,
                    function(data, status) {
                        if (status == 'success') {
                            // console.log("Submitted");
                            console.log(data);
                            let dataObj = JSON.parse(data);
                            switch (JSON.parse(data)['type']) {
                                case "error":
                                    console.log(dataObj["context"]["msg"]);
                                    displayError("Failed", "danger", dataObj["context"]["msg"])
                                    break;
                                case "url":
                                    window.location.replace(dataObj["context"]["msg"])
                                    break;
                                default:
                                    displayError("Failed", "danger", dataObj["context"]["msg"])
                                    break;
                            }
                        } else {
                            displayError("Failed", "danger", "There was unknown error !, Please try again");
                        }
                    }, )
            })
        });
    </script>
</body>

</html>