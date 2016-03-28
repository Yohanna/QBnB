<?php

// Displays current user info, properties owned. If the user is an admin, display an admin button that will redirects the user to admin.php


require_once 'header.php';
require_once 'navbar.php';

if(userLoggedIn() == false){
    //User is not logged in. Redirect the browser to the login index.php page and kill this page.
    header("Location: index.php");
    die();
}
else {
    // SELECT query
    $query = "SELECT FName, LName, gender, email, phone_no, grad_year, faculty_id, degree_type FROM users WHERE user_id=?";

    $stmt = $con->prepare($query);
    $stmt->bind_Param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Row data
    $row = $result->fetch_assoc();


    // Get Faculty name from Facutlies table
    $query = "SELECT faculty FROM faculties WHERE faculty_id=?";

    $stmt = $con->prepare($query);
    $stmt->bind_Param("i", $row['faculty_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $facultyName = $result->fetch_assoc();

}
?>


<!DOCTYPE HTML>
<html>
    <head>
        <h1 class="text-center">Hey <?=$row['FName'] .' '. $row['LName']?></h1>
    </head>

    <body>


        <!-- Display User Data -->
                <div class="container">

        <table class="table table-bordered table-striped" >
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone No.</th>
            <th>Graduation Year</th>
            <th>Faculty</th>
            <th>Degree Type</th>
            <th>Admin Privilege</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><?=$row['FName'] ?></td>
            <td><?=$row['LName']?></td>
            <td><?=$row['gender']?></td>
            <td><?=$row['email']?></td>
            <td><?=$row['phone_no']?></td>
            <td><?=$row['grad_year']?></td>
            <td><?=$facultyName['faculty']?></td>
            <td><?=$row['degree_type']?></td>
            <td><?= $_SESSION['is_admin'] ? "Yes": "No" ?></td>
          </tr>
        </tbody>

        </table>
        </div>

        <hr class = "colorgraph"> <br>

        <div class="container">
            <div class="row text-center" >
                <div class="col-sm-12">
                    <a type="button" class="btn btn-lg btn-primary" style="align: center;" href="edit_profile.php?user_id=<?=$_SESSION['user_id']?>">Edit Your Profile</a>
                </div>
            </div>
        </div>

    </body>
</html>
