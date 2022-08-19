<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('all.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('dist/css/theme.css')); ?>">
    <title>Profitability 404 </title>
    <script src="https://kit.fontawesome.com/33a7bbc14a.js" crossorigin="anonymous"></script>
    <style>
        @import  url('https://fonts.googleapis.com/css2?family=Manrope:wght@300;500;600;700;800&family=Nunito:wght@400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Nunito', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Manrope', sans-serif;
            font-weight: bold;
        }

        body {
            background: none;
            background-image: url("assets/banner.jpg");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #5e5873;
        }

        header nav,
        footer {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            background-color: rgb(255 255 255 / 50%);
            /* border-radius: 12px; */
            border: 1px solid rgba(209, 213, 219, 0.3);
            box-shadow: 0 4px 6px -1px rgb(0 0 0/0.1), 0 2px 4px -2px rgb(0 0 0/0.1);
        }

        .navbar {
            padding-top: .2rem;
            padding-bottom: .2rem;
        }

        .navbar-brand {
            padding: 0
        }

        .navbar-brand img {
            max-width: 200px;
        }

        .footer-logo {
            max-width: 200px;
        }

        footer {
            padding: 5px 10px;
            max-width: 100%;
            margin: 0;
            width: 100%;
            border: 0;
            box-shadow: 0 4px 6px -1px rgb(0 0 0/0.1), 0 2px 4px -2px rgb(0 0 0/0.1);
        }

        a {
            color: #224d89;
            text-decoration: none;
        }

        main {
            min-height: 86vh;
        }

        .nav .project-name {
            display: inline-block;
            font-size: 14px;
            line-height: 1.2;
            font-weight: bold;
        }

        .nav .project-name .project-name-text {
            display: block;
        }

        .box-container {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            padding: 15px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 10%), 0 2px 4px -2px rgb(0 0 0 / 10%);
            border-radius: 8px;
            background: linear-gradient(107.28deg, rgb(255 255 255 / 64%) 1.71%, rgb(255 244 244 / 78%) 75.44%);
            border: 4px solid #fff;
        }

        .img-vector-box {
            max-width: 450px;
            padding: 25px 0;
        }

        .btn {
            padding: 6px 15px;
            line-height: 1.2;
        }

        .btn-row .btn {
            margin: 0 .4rem 0;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.html" alt="Home" title="home">
                            <img src="<?php echo e(asset('assets/BSC_Main_Logo.png')); ?>" alt="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="project-name">
                            <span class="text-info project-name-text"></span>
                            <span class="text-warning project-name-text"></span>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                    </ul>
                </div> -->
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="box-container my-5 text-center align-items-center">
                        <h3 class="text-primary">404 Page Not Found</h3>
                        <img src="<?php echo e(asset('assets/404_error.webp')); ?>" class="img-fluid img-vector-box" alt="  ">
                        <h4 class="text-warning font-bolder">Uh Ohh! you lost your way</h4>
                        <p>The page you are looking for doesn't exist</p>
                        <div class="d-inline btn-row">
                            <a href="<?php echo e(route('customer')); ?>"><div class="btn btn-primary">Go Home</div></a>
                            <!-- <div class="btn btn-outline-info">Go Back</div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- initiate footer section-->
    <!-- <?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->

    <script src="<?php echo e(asset('all.js')); ?>"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->

</body>

</html><?php /**PATH F:\xampp\htdocs\profitability-tool\resources\views/errors/404.blade.php ENDPATH**/ ?>