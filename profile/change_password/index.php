<?php
session_start();
if (!isset($_SESSION['User'])) {
    header("Location:/liveChat/");
}
print_r($_SESSION['User']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user-setting</title>
    <link rel="stylesheet" href="../../assets/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-5/css/all.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-5/css/brands.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>

<body>
    <div class="float-menu">
        <span>
            <i class="fas fa-bars    "></i>
        </span>
        <ul class="menu shadow-sm">
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="Home">
                <a href="../../">
                    <i class="fas fa-home    "></i>
                </a>
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="Profile">
                <a href="../">
                    <i class="fas fa-user    "></i>
                </a>
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="SignOut" id="logout-btn">
                <a href="#">
                    <i class="fas fa-sign-out-alt    "></i>
                </a>
            </li>
        </ul>
    </div>
    <main class="container">
        <header>
            <h1 class="h">Update Your Password</h1>
            <div class="" id="error-logger">
            </div>
        </header>
        <div class="setting d-flex">
            <div class="form-container w-50">
                <form action="" method="post" class="needs-validation" id="user-inf">
                    <div class="third-block">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="pasword" id="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mt-1">
                            <input type="password" class="form-control" name="conf_pasword" id="confirm-pwd" placeholder="Confirm Password">
                            <label for="confirm-pwd">Confirm Password</label>
                        </div>
                    </div>
                    <div class="form-footer d-flex justify-content-end">
                        <button class="btn btn-outline-dark mt-3" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!--  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modelId">
        Launch
    </button> -->



    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/fontawesome-free-5/js/all.min.js"></script>
    <script src="../../assets/fontawesome-free-5/js/brands.min.js"></script>
    <script src="../assets/js/main_j.js"></script>
    <script>
        $(document).ready(function() {
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
            // displayError("Failed", "danger", "There was unknown error !, Please try again");

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            // logout mechanisim
            $('#logout-btn').click(function(e) {
                e.preventDefault();
                $.post("../../Route.php", {
                    'request': 'logout'
                }, function(data, status) {
                    if (status === 'success') {
                        console.log(data);
                        let dataObj = JSON.parse(data);
                        switch (JSON.parse(data)['type']) {
                            case "url":
                                window.location.replace(dataObj["context"]["msg"])
                                break;
                            default:
                                displayError("Failed", "danger", "Unkown Error")
                                break;
                        }
                    }
                }, )
            })


        });
    </script>
</body>

</html>