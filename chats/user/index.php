<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../assets/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-5/css/all.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-5/css/brands.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/chats.css">
    <title>chats</title>
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
                <a href="../../profile/">
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
        <section class="user-chat group mt-5">
            <h2>User Chats</h2>
            <div class="d-flex">

                <aside class="groups">
                    <div class="groups-container">
                        <div class="agroup my-3 d-flex justify-content-around align-items-center">
                            <div class="agroup-icon"><i class="fas fa-user"></i></div>
                            <span class="agroup-name">
                                <p>user name</p>
                            </span>
                        </div>
                        <div class="agroup my-3 d-flex justify-content-around align-items-center">
                            <div class="agroup-icon"><i class="fas fa-user"></i></div>
                            <span class="agroup-name">
                                <p>user name</p>
                            </span>
                        </div>
                        <div class="agroup my-3 d-flex justify-content-around align-items-center">
                            <div class="agroup-icon"><i class="fas fa-user"></i></div>
                            <span class="agroup-name">
                                <p>user name</p>
                            </span>
                        </div>
                    </div>
                </aside>
                <section class="group-chat px-4 py-4">
                    <div class="msg-container clearfix">
                        <div class="receiver-msg">
                            Lorem ipsum dolor sit amet amet, eget rhoncus, pulvinar, justo ligula.
                            Dolor, eros ipsum odio, neque, lobortis lectus tristique dictumst id diam urna, mattis viverra id.
                        </div>
                        <div class="sender-msg float-end">
                            Lorem ipsum dolor sit amet amet, eget rhoncus, pulvinar, justo ligula.
                            Dolor, eros ipsum odio, neque, lobortis lectus tristique dictumst id diam urna, mattis viverra id.
                        </div>
                    </div>
                    <div class="form-container py-2">
                        <form action="" method="post">
                            <div class="input-group">
                                <textarea class="form-control" name="reply-box" id="" cols="30" rows="" placeholder="Reply Here..."></textarea>
                                <button type="button" class="btn btn-outline-dark"><i class="fab fa-telegram-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>
    </main>

    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/fontawesome-free-5/js/all.min.js"></script>
    <script src="../../assets/fontawesome-free-5/js/brands.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>