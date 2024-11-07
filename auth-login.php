<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to index page
if (isset($_SESSION["user_id"])) {
    header("location: index.php");
    exit;
}
// Include config file
require_once "layouts/config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Login | Minia - Admin & Dashboard Template</title>
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="index.php" class="d-block auth-logo">
                                    <img src="assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">مینیا</span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">خوش آمدید!</h5>
                                    <p class="text-muted mt-2">برای ادامه به مینیا وارد شوید.</p>
                                </div>
                                <form class="custom-form mt-4 pt-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="email">ایمیل</label>
                                        <input type="text" class="form-control" id="email" placeholder="ایمیل را وارد کنید" name="email">
                                        <span class="text-danger"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="password">کلمه عبور</label>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="">
                                                    <a href="auth-recoverpw.php" class="text-muted">کلمه عبور را فراموش کردید ؟</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="کلمه عبور را وارد کنید" name="password" aria-label="Password" aria-describedby="password-addon">
                                            <span class="text-danger"><?php echo $password_err; ?></span>
                                            <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    مرا به خاطر بسپار
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">ورود</button>
                                    </div>
                                </form>

                                <!-- <div class="mt-4 pt-2 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                    </div>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div> -->

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">حساب ندارید ? <a href="auth-register.php" class="text-primary fw-semibold"> همین حالا ثبت نام کنید ! </a> </p>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> مینیا . ساخته شده  <i class="mdi mdi-heart text-danger"></i> توسط Themesbrand</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <!-- end carouselIndicators -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط”
                                                </h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-1.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">آریا آریایی
                                                            </h5>
                                                            <p class="mb-0 text-white-50">طراح وب</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-2.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">بهناز بهنازی
                                                            </h5>
                                                            <p class="mb-0 text-white-50">توسعه دهنده وب</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <img src="assets/images/users/avatar-3.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        <div class="flex-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">پریا پریایی</h5>
                                                            <p class="mb-0 text-white-50">مدیر
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end carousel-inner -->
                                </div>
                                <!-- end review carousel -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>


<!-- Sweet alert init js-->
<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- password addon init -->
<script src="assets/js/pages/pass-addon.init.js"></script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once "vendor/auth.inc.php";

    $loginResult = loginUser($_POST["email"],$_POST["password"]);
    if($loginResult->isSuccess)
    {
        foreach($loginResult->value as $key => $val){
            $_SESSION[$key] = $val;
        }
//        header("location : index.php");
        echo '<script>document.location.reload();</script>';
    }
    else if($loginResult->isFailure) : ?>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <script>
            Swal.fire(
                {
                    title: "خطا",
                    text: '<?php echo "$loginResult->errors" ?>',
                    icon: 'error',
                    confirmButtonColor: '#5156be',
                    confirmButtonText: "باشه"
                }
            )
        </script>
    <?php endif;
//    // Check if username is empty
//    if (empty(trim($_POST["username"]))) {
//        $username_err = "Please enter username.";
//    } else {
//        $username = trim($_POST["username"]);
//    }
//
//    // Check if password is empty
//    if (empty(trim($_POST["password"]))) {
//        $password_err = "Please enter your password.";
//    } else {
//        $password = trim($_POST["password"]);
//    }
//
//    // Validate credentials
//    if (empty($username_err) && empty($password_err)) {
//        // Prepare a select statement
//        $sql = "SELECT id, username, password FROM users WHERE username = ?";
//
//        if ($stmt = mysqli_prepare($link, $sql)) {
//            // Bind variables to the prepared statement as parameters
//            mysqli_stmt_bind_param($stmt, "s", $param_username);
//
//            // Set parameters
//            $param_username = $username;
//
//            // Attempt to execute the prepared statement
//            if (mysqli_stmt_execute($stmt)) {
//                // Store result
//                mysqli_stmt_store_result($stmt);
//
//                // Check if username exists, if yes then verify password
//                if (mysqli_stmt_num_rows($stmt) == 1) {
//                    // Bind result variables
//                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
//                    if (mysqli_stmt_fetch($stmt)) {
//                        if (password_verify($password, $hashed_password)) {
//                            // Password is correct, so start a new session
//                            session_start();
//
//                            // Store data in session variables
//                            $_SESSION["loggedin"] = true;
//                            $_SESSION["id"] = $id;
//                            $_SESSION["username"] = $username;
//
//                            // Redirect user to welcome page
//                            header("location: index.php");
//                        } else {
//                            // Display an error message if password is not valid
//                            $password_err = "The password you entered was not valid.";
//                        }
//                    }
//                } else {
//                    // Display an error message if username doesn't exist
//                    $username_err = "No account found with that username.";
//                }
//            } else {
//                echo "Oops! Something went wrong. Please try again later.";
//            }
//
//            // Close statement
//            mysqli_stmt_close($stmt);
//        }
//    }
//
//    // Close connection
//    mysqli_close($link);
}

?>
</body>

</html>