<?php

include '../connection.php';

if($_SESSION['username'] ==false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='admin-index.php';
    </script>";
}
else {
    $sql = "SELECT * FROM customers order by customer_id";
    $result = mysqli_query($conn, $sql) or die("Data Retrieval Failed.");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/icon-bus.png">
    <title>Admin - User Information</title>

    <!-- Bootstrap - CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="container">
        <!-- Header START -->
        <div class="row mb-3 mt-5">
            <div class="col">
                <a href="admin-dashboard.php" class="hero-btn rounded float-end">Back</a>
            </div>
        </div>
        <!-- Header - END -->
    </div>

    <div class="container">
        <h1>Customer Information</h1>
        <div class="hero-middle vh-100">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        if (mysqli_num_rows($result) > 0)
                        {
                            while ($row_member = mysqli_fetch_assoc($result)){
                            ?>

                            <tr>
                                <td ><?php echo $row_member['customer_id']; ?></td>
                                <td><?php echo $row_member['customer_name']; ?></td>
                                <td><?php echo $row_member['customer_email']; ?></td>
                                <td><?php echo $row_member['customer_contactnum']; ?></td>
                            </tr>

                            <?php
                                }
                            ?>
                    <?php
                        }
                        else
                        {
                            echo "0 results";
                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>