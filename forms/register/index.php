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
        <header class="d-flex">
            <div class="">
            </div>
            <h2 class="h text-center my-5">Sign up</h2>
            <a href="../../" class="btn btn-outline-dark text-decoration-none">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
        </header>
        <div class="d-flex align-items-center">

            <section class="mx-auto w-25">
                <form action="" method="post" id="register-form">
                    <input type="hidden" name="request" value="registerUser">
                    <div class="mb-4 input-container">
                        <input type="text" autocomplete="off" class="" name="firstName" aria-describedby="helpId" placeholder="" required>
                        <label for="" class="">First name</label>
                    </div>
                    <div class="mb-4 input-container">
                        <input type="text" autocomplete="off" class="" name="lastName" aria-describedby="helpId" placeholder="" required>
                        <label for="" class="">Last name</label>
                    </div>
                    <div class="mb-4 input-container">
                        <input type="text" autocomplete="off" class="" name="userName" aria-describedby="helpId" placeholder="" required>
                        <label for="" class="">User name</label>
                    </div>
                    <div class="mb-4 input-container">
                        <input type="email" autocomplete="off" class="" name="email" aria-describedby="helpId" placeholder="" required>
                        <label for="" class="">Email</label>
                    </div>
                    <div class="mb-4 input-container">
                        <input type="password" autocomplete="off" class="" name="first_pwd" aria-describedby="helpId" placeholder="" required>
                        <label for="" class="">Password</label>
                    </div>
                    <div class="mb-4 input-container">
                        <input type="password" autocomplete="off" class="" name="second_pwd" aria-describedby="helpId" placeholder="" required>
                        <label for="" class="">Confirm Password</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-outline-dark float-end" id="register-btn">Register</button>

                </form>
                <a href="../login/" class="btn btn-outline-dark float-start mt-5 text-decoration-none">
                    Login
                    <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                </a>
            </section>
        </div>
    </main>

    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/fontawesome-free-5/js/all.min.js"></script>
    <script src="../../assets/js/main_j.js"></script>
    <script>
        $(function() {
            $("#register-btn").click(function(e) {
                e.preventDefault();
                // console.log($("#register-form").serializeArray());
                let fm = $("#register-form").serialize();
                $.post("../../Route.php", fm,
                    function(data, status) {
                        if (status == 'success') {
                            console.log("Submitted");
                            console.log("\n" + data);
                        }
                    })
            })
        });
    </script>
</body>

</html>