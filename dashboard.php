
<?php

    include 'connect.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    
    if(!$admin_id){
        header("Location: register.php");
    }


   

    if(isset($_POST['uptate'])) {
        $access_user = $_POST['access-user'];
        $access_user = filter_var($access_user, FILTER_SANITIZE_STRING);
        $id = $_POST['id'];
        $update_access = $conn->prepare("UPDATE admin_page SET access = ? WHERE id = '$id'");
        $update_access->execute([$access_user]);
        $success_msg[] = "access updated!";
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digifarm Dashboard admin</title>

    <!-- file cdnjs css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <main>
        <section class="left">
            <div class="box">
                <h3> SmartPlantation</h3>
                <p>accounts farmers</p>
                <a href="logout.php">Logout</a>
            </div>
        </section>

        <header class="header">
            <div class="flex">
            <h2>Dashboard</h2>
                <div class="center">
                <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" placeholder="search for admins...">
                </div>
                <div class="right">
                <i class="fas fa-sharp fa-light fa-bell"><span>3</span></i>
                    <img src="images/user.png" alt="">
                </div>
            </div>

           <div class="div">
                <div class="welcome">
                <?php

                    $select_name = $conn->prepare("SELECT * FROM admin_page WHERE id = ?");
                    $select_name->execute([$admin_id]);
                    $fetch_name = $select_name->fetch(PDO::FETCH_ASSOC);
                ?>
                    <h4>welcome: <span><?= $fetch_name['name']?></span></h4>
                </div>

                <div class="table">
                    <h2>table for users</h2>
                <table style="width:100%">
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>phone</th>
                        <th>status</th>
                        <th>data</th>
                        <th>Access</th>
                    </tr>
                        <?php
                            $select_accounts = $conn->prepare("SELECT * FROM admin_page WHERE user_type = 'user'");
                            $select_accounts->execute();
                            if($select_accounts->rowCount() > 0) {
                                while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td style="<?php if($fetch_accounts['access'] == 'Allow'){echo "background: green; color:#fff"; }else{echo "background: red; color:#fff";}; ?>"><?= $fetch_accounts['id']?></td>
                                            <td><?= $fetch_accounts['name']?></td>
                                            <td><?= $fetch_accounts['phone']?></td>
                                            <td><?= $fetch_accounts['status']?></td>
                                            <td><?= $fetch_accounts['cr_date']?></td>
                                            <td>
                                                <form method="post" class="access">
                                                    <input type="hidden" value="<?= $fetch_accounts['id']?>" name="id">
                                                    <select name="access-user" required>
                                                        <option selected>chosen one from these</option>
                                                        <option value="Allow">Allow</option>
                                                        <option value="UnAllow">UnAllow</option>
                                                    </select>
                                                    <input type="submit" value="Uptate" name="uptate">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else {
                                echo '<p class="empty">not added users yet!</p>';
                            }
                        ?>
                    </table>
                </div>
           </div>
        </header>
    </main>

  
            <!-- sweetalert -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include "alerts.php";
    ?>
</body>

</html>