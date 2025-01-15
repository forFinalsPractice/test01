<?php
include("connect.php");

session_start();

$_SESSION['userID'] = "";
$_SESSION['firstName'] = "";
$_SESSION['lastName'] = "";
$_SESSION['birthday'] = "";
$_SESSION['userName'] = "";
$_SESSION['phoneNumber'] = "";
$_SESSION['userType'] = "";

$error = "";

if (isset($_POST['signUpBtn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $userName = $_POST['userName'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password == $confirmPassword) {
        $userQuery = "INSERT INTO `users`(`firstName`, `lastName`, `email`, `birthday`, `userName`, `phoneNumber`, `password`) VALUES ('$firstName', '$lastName', '$email', '$birthday', '$userName', '$phoneNumber', '$password')";
        executeQuery($userQuery);

        $lastInsertedId = mysqli_insert_id($conn);

        $_SESSION['userID'] = $lastInsertedId;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['birthday'] = $birthday;
        $_SESSION['userName'] = $userName;
        $_SESSION['phoneNumber'] = $phoneNumber;

        header("Location: index.php");
    } else {
        $error = "PASSWORD UNMATCHED";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="signup.css">
    <title>NowUKnow | Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="">

    <style>
        body {
            background: url('NowUKnow/assets/icons/landing bg3.svg') no-repeat center center;
            font-family: Helvetica, sans-serif;
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-position: center center;
            background-attachment: fixed;
        }

        .card {
            background-color: #3D68A2;
            color: white;
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            height: auto;
        }

        .btnSignUp {
            background-color: #000F24;
            color: white;
            border-radius: 200px;
            width: 100%;
            max-width: 200px;
            height: 50px;
            margin-left: auto;
            margin-right: auto;
            display: block;

        }

        .customButtonText {
            font-family: "Helvetica Rounded";
        }

        .btnSignUp:hover {
            background-color: #000F24;
            color: white;
        }

        .form-control {
            border-radius: 200px;
            width: 90%;
            max-width: 320px;
            height: 30px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-label {
            padding-left: 40px;
            color: white;
            margin: -20px;
            font-family: Helvetica, sans-serif;
        }

        .btnModal {
            background-color: #06080f;
            color: white;
        }

        .btnModal:hover {
            background-color: #06080f;
            color: white;
        }

        .modal-content {
            background-color: #3D68A2;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid" id="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-12 col-sm-0 px-5 mt-5 d-flex align-items-bottom justify-content-center">
                <div class="leftSection ">
                    <div class="logoWordmark d-flex align-items-top">
                        <img src="NowUKnow/assets/icons/logowordmark.svg" alt="logowordmark">
                    </div>
                    <div class="headerSection p-0 d-flex flex-column text-start">
                        <h1 class="h1 fs-1 fs-md-2 fs-sm-3 m-0">Create New Account</h1>
                        <h6 class="fs-6 fs-md-5 m-0 p-2">Already have an account? <a href="login.html"
                                class="loginLink">Log in</a></h6>
                    </div>


                    <div class="col-lg-12 col-12 text-center">
                        <div class="info">
                            <div class="line" style="border-top: 2px solid white; width: 34%; margin: 10px 0;"></div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nemo quia
                                maioress</p>
                            <!-- button in learn more modal -->
                            <button type="button" class="btnLearnMore mt-3 customButtonText" data-bs-toggle="modal"
                                data-bs-target="#learnMore">Learn More?</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                <div class="card">
                    <?php if ($error == "PASSWORD UNMATCHED") { ?>
                        <div class="alert alert-danger mb-3" role="alert">
                            Passwords does not match
                        </div>
                    <?php } ?>
                    <div class="h3 my-4 mt-0 text-center signUpTittle">Create Account</div>
                    <form id="SignUpForm" method="POST">
                        <div class="d-flex gap-3 mb-2">
                            <div class="flex-grow-1">
                                <label for="firstname" class="form-label moveLeft">First Name</label>
                                <input type="text" id="firstname" class="form-control" name="firstName" required>
                            </div>

                            <div class="flex-grow-1">
                                <label for="lastname" class="form-label moveLeft">Last Name</label>
                                <input type="text" id="lastname" class="form-control" name="lastName" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="date of birth" class="form-label">Date of Birth</label>
                            <input type="text" id="birth" class="form-control" name="birthday" placeholder="DD/MM/YYYY"
                                required pattern="\d{2}/\d{2}/\d{4}">
                        </div>
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" name="userName" required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-2">
                            <label for="phone number" class="form-label">Phone Number</label>
                            <input type="text" id="phoneNumber" class="form-control" name="phoneNumber" required
                                pattern="^\+639\d{9}$"
                                title="Phone number should follow the format: +639XXXXXXXXX, where X is a digit.">
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password" required
                                pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$"
                                title="Password must be at least 8 characters long, contain at least one letter, one number, and one special character (!@#$%^&*).">
                        </div>
                        <div class="mb-2">
                            <label for="confirm password" class="form-label">Confirm Password</label>
                            <input type="password" id="confirmPassword" class="form-control" name="confirmPassword"
                                required>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-check moveRight">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Yes, I Agree to the <a href="#" class="termsLink" data-bs-toggle="modal"
                                        data-bs-target="#termsCondition">Terms and Condition</a>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" name="signUpBtn" class="btn btnSignUp mb-3 customButtonText">Sign
                                Up</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal for learn more (small version) -->
            <div class="col-lg-6 col-12 text-center">
                <div class="info2">
                    <p class="info2Content py-4 px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae
                        nemo quia maiores,
                        soluta iusto eveniet delectus illo non laudantium inventore alias ipsam saepe tempora omnis rem
                        eum
                        vel quis animi?</p>
                    <button type="button" class="btnLearnMore my-4 mx-5" data-bs-toggle="modal"
                        data-bs-target="#learnMore">Learn More?</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal in learn More -->
    <div class="modal fade" id="learnMore" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="learnMoreLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="learnMoreLabel">NowUKnow</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    NowUKnow, is an online platform designed for users to create, share, and browse tutorial-based
                    content. The website provides a space for users to post step-by-step guides on various projects or
                    tutorials on how to solve problems across a wide range of topics, such as cooking, technical skills,
                    education, and lifestyle tips. The platform aims to foster a centralized community where users are
                    encouraged to share content that is both helpful and allows them to learn from others. By focusing
                    on tutorial-based content, the website creates an environment that prioritizes self-improvement and
                    knowledge sharing.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnModal" data-bs-dismiss="modal">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal in terms & condition -->
    <div class="modal fade" id="termsCondition" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="termsConditionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="termsConditionLabel">Terms & Condition</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt architecto quis culpa commodi modi
                    voluptatibus eligendi? Vel ducimus dolores qui eos voluptatum, illo perspiciatis quae aliquam,
                    sapiente, laudantium placeat repellat?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnModal" data-bs-dismiss="modal">Understood</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>