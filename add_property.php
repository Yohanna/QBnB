<?php

require_once 'header.php';
require_once 'navbar.php';

if(userLoggedIn() == false){
    //User is not logged in. Redirect the browser to the login index.php page and kill this page.
    header("Location: index.php");
    die();
}


if(isset($_POST['submitBtn'])){
    $userMsg = '';
    $validForm = True;

    // Used to indicate that the property already exists in the database.
    $addressError = '';

    $Address = $_POST['address'];
    $Price = $_POST['price'];
    $District = $_POST['district'];
    $Type = $_POST['type'];


    $query = "SELECT address FROM properties WHERE address = ? and district = ?";

    if($stmt = $con->prepare($query)){

            $stmt->bind_Param("ss", $Address, $District);
            $stmt->execute();
            $result = $stmt->get_result();
            $num = $result->num_rows;

            // If an address is found
            if($num>0){
                $addressError = '<br><p class="alert alert-danger text-center">This address already exists!</p>';
                $validForm = false;
            }
    }

    // At this point we should have checked all the user input for errors
    if ($validForm == true){
        $query = "INSERT INTO `properties` (`supplier_id`, `address`, `district`, `type`, `price`) VALUES (?, ?, ?, ?, ?)";

        $stmt = $con->prepare($query);

        $stmt->bind_param("isssi", $_SESSION['user_id'], $Address, $District, $Type, $Price);

        if ($stmt->execute()){
            echo '<script type="text/javascript">
            alert("Your property has been added successfully!");
            window.location.href = "user_properties.php";
            </script>';
        }
        else{
            $userMsg = '<br><p class="alert alert-danger text-center">Execute Failed</p>';
        }
    }
    else{
        $userMsg = '<br><p class="alert alert-danger text-center">Failed to add property</p>';
    }

}

?>

<!DOCTYPE HTML>
<html>

<head>
</head>

<body>

    <form action="add_property.php" method="post">
    <div class = "container">
            <h1 class = "form-signin-heading text-center">Add a new property to QBnB</h1>

            <hr class = "colorgraph"> <br>

            <?php echo isset($userMsg)? $userMsg: '' ?>

            Address: <input type="text" class="form-control" name="address" placeholder="Property Address" value="<?php echo !empty($Address)?$Address:'' ; ?>" required autofocus=""/>
            <?php echo isset($addressError)? $addressError: '' ?>


            <br>Price: <input type="text" class="form-control" name="price" placeholder="How rich you wanna be?" maxlength="4" value="<?php echo !empty($Price)? $Price: '' ; ?>" required/>

            <br>District:
            <select class="form-control" name="district">
                <option value="Kanata">Kanata</option>
                <option value="Nepean">Nepean</option>
                <option value="Osgoode">Osgoode</option>
                <option value="West Carleton">West Carleton</option>
            </select><br>

            <br>Type:
            <select class="form-control" name="type">
                <option value="House">House</option>
                <option value="Town House">Town House</option>
                <option value="Apartment">Apartment</option>
            </select><br>

            <br>Features:

            <label class="checkbox-inline"><input type="checkbox" value="1" name="internet">Internet</label>
            <label class="checkbox-inline"><input type="checkbox" value="1" name="gym">Gym</label>
            <label class="checkbox-inline"><input type="checkbox" value="1" name="pet_allowed">Pets Allowed</label>
            <label class="checkbox-inline"><input type="checkbox" value="1" name="tv">TV</label>
            <label class="checkbox-inline"><input type="checkbox" value="1" name="washer">Washer</label>
            <label class="checkbox-inline"><input type="checkbox" value="1" name="parking">Parking</label>
            <label class="checkbox-inline"><input type="checkbox" value="1" name="patio">Patio</label>

            <br>

            <br><label class="control-label">Select a property image to upload:</label>
            <input class="" type="file" name="property_pic" id="fileToUpload">

            <hr class = "colorgraph"> <br>

            <br><input type="submit" class="btn btn-lg btn-primary btn-block" name="submitBtn" value="Submit" />
    </div>
    </form>

</body>
</html>
