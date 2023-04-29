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
                <a href="#">Logout</a>
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
                    <h4>welcome: <span>Mohamed shams</span></h4>
                </div>

                <div class="table">
                    <h2>table for users</h2>
                <table style="width:100%">
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>phone</th>
                        <th>data</th>
                        <th>status</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Mohamed shams</td>
                        <td>012345634</td>
                        <td>now</td>
                        <td>active</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Mayssa Grissa</td>
                        <td>07654321</td>
                        <td>yesterday</td>
                        <td>Unactive</td>
                    </tr>
                    </table>
                </div>
           </div>
        </header>
    </main>

  
</body>

</html>