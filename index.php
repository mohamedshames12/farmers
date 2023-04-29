<?php

    include 'connect.php';
    session_start();



    if(isset($_POST['login'])){
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $password = sha1($_POST['password']);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
     


        $verify_phone = $conn->prepare("SELECT * FROM `admin_page` WHERE name = ? AND password = ?");
        $verify_phone->execute([$name, $password]);

          
        $login = $conn->prepare("UPDATE admin_page SET status = 'active' WHERE name = ?");
        $login->execute([$name]);


        if($verify_phone->rowCount() > 0){


            $fetch_account = $verify_phone->fetch(PDO::FETCH_ASSOC);

            if($fetch_account['access'] == "Allow"){
                
                if($fetch_account['user_type'] == 'user') {

                    $_SESSION['user_id'] = $fetch_account['id'];
                    header('location: user.php');   
                }
            }else{
                $warning_msg[] = 'غير مسموح لك بالذهاب إلى صفحة المستخدم ، يرجى الانتظار بضع دقائق ، سيسمح لك المسؤول';
            }

            if($fetch_account['user_type'] == 'admin'){
                $_SESSION['admin_id'] = $fetch_account['id'];
                header("Location: dashboard.php");
            }

        }else {
            $warning_msg[] = "اسم المستخدم أو كلمة المرور غير صحيحة";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>مزارع</title>
</head>
    <section class="container">
        <h1>مرحبا بكم في المزارعين</h1>
        <div class="box">
            <div class="image">
                <img src="images/Farmer-bro.png" alt="">
            </div>
                <div class="login-box">
                    <h2>تسجيل الدخول</h2>
                    <form method="post">
                        <div class="user-box">
                            <input type="text" name="name" required="">
                            <label>اسم المستخدم</label>
                        </div>
                        <div class="user-box">
                            <input type="password" name="password" required="">
                            <label>كلمة المرور</label>
                        </div>
                        <button type="submit" name="login">
                            <span>تسجيل الدخول</span>
                            <span>تسجيل الدخول</span>
                            <span>تسجيل الدخول</span>
                            <span>تسجيل الدخول</span>
                            تسجيل الدخول
                        </button>
                        <p>ليس لديك حساب ؟ <a href="register.php">تسجيل الان</a></p>
                    </form>
                </div>
        </div>
    </section>
                <!-- sweetalert -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include "alerts.php";
    ?>
</body>
</html>

