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
                <a href="../">
                    <i class="fas fa-home    "></i>
                </a>
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="Profile">
                <a href="./">
                    <i class="fas fa-user    "></i>
                </a>
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="SignOut">
                <a href="#">
                    <i class="fas fa-sign-out-alt    "></i>
                </a>
            </li>
        </ul>
    </div>
    <main class="container">
        <header>
            <h1 class="h">Configuration Setup</h1>
        </header>
        <div class="setting d-flex">
            <div class="form-container w-50">
                <form action="" method="post" class="needs-validation">
                    <div class="first-block">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="fullName" id="full-name" placeholder="full name">
                            <label for="full-name">Full name</label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="text" class="form-control needs-validation" name="userName" id="user-name" placeholder="user name">
                            <label for="user-name">User name</label>
                            <div class="valid-feedback">user name available</div>
                            <div class="invalid-feedback">user name already used</div>
                        </div>
                    </div>
                    <div class="second-block my-4">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="third-block">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mt-1">
                            <input type="password" class="form-control" name="fullName" id="confirm-pwd" placeholder="Confirm Password">
                            <label for="confirm-pwd">Confirm Password</label>
                        </div>
                    </div>
                    <div class="form-footer d-flex justify-content-end">
                        <button class="btn btn-outline-dark mt-3" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <div class="image-block w-100">
                <div class="h2 text-center mb-5">New photo here</div>
                <form action="" method="post" enctype="multipart/form-data" class="text-center">
                    <div class="image-input ">
                        <input type="file" name="" id="">
                        <span class="image-icon">
                            <span class="fa-icon">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                            </span>
                            <img src="../assets/images/person_FILL0.svg" alt="" srcset="">
                        </span>
                    </div>
                    <button type="submit" class="btn btn-outline-dark my-3 w-25 mx-auto">Save</button>
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
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            $(".image-input input").change(function() {
                let validImage = ["image/jpeg", "image/png"]
                if ($.inArray(this.files[0]['type'], validImage)) {
                    // console.log(this.files[0]['type']);
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $(".image-input .image-icon img").attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0])
                }
            })
        });
    </script>
</body>

</html>