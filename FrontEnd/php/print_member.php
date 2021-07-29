<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Member Info</title>

    <style>
      .box {
          position: absolute;
          top: 50%;
          left: 50%;
          margin-right: -50%;
          transform: translate(-50%, -50%);
          border: 3px solid salmon;
          padding: 50px;
      };
    </style>
  </head>
  <body>
    <?php  // creating a database connection 
          $db_sid = 
          "(DESCRIPTION =
              (ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-FM3MNF7)(PORT = 1521))
              (CONNECT_DATA =
              (SERVER = DEDICATED)
              (SERVICE_NAME = XE)
              )
          )";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 
          
          $db_user = "system";   // Oracle username e.g "scott"
          $db_pass = "1234";    // Password for user e.g "1234"
          $con = oci_connect($db_user,$db_pass,$db_sid); 
          if($con) 
              { echo "Oracle Connection Successful."; } 
          else 
              { die('Could not connect to Oracle: '); }
      ?>

      <center>
        <br>
        <br>
        <br>
        <form action="" method="POST">
            <label for="id">Enter Member ID: </label>
            <input type="text" name="id" />
            <input type="submit" name="search" value="Search The Record">
        </form>
        <?php
        if(isset($_POST['search'])) {
            $id = $_POST['id'];
            $q = "select * from gym_member where member_id = '$id'";
            $query = oci_parse($con, $q);
            $r = oci_execute($query);
            while($row = oci_fetch_array($query, OCI_BOTH+OCI_RETURN_NULLS)) {
        ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1>Info of the Member</h1>
        <form action="" method="POST" class="box">

            <label for="fname">FIRST NAME:</label>
            <input type ="text" name="fname" value="<?php echo $row['FIRST_NAME'] ?>"/>
            
            <label for="lname">LAST NAME:</label>
            <input type ="text" name="lname" value="<?php echo $row['LAST_NAME'] ?>"/><br>
            <br>
            <label for="age">AGE:</label>
            <input type ="text" name="age" value="<?php echo $row['AGE'] ?>"/>
            
            <label for="bmi">BMI:</label>
            <input type ="text" name="bmi" value="<?php echo $row['BMI'] ?>"/><br>
            <br>
            <label for="weight">WEIGHT:</label>
            <input type ="text" name="weight" value="<?php echo $row['WEIGHT'] ?>"/>
            
            <label for="gender">GENDER:</label>
            <input type ="text" name="gender" value="<?php echo $row['GENDER'] ?>"/><br>
            <br>
            <label for="password">MEMBER_PASSWORD:</label>
            <input type ="text" name="password" value="<?php echo $row['MEMBER_PASSWORD'] ?>"/>
            
            <h1><a href="reports.php" style="font-size: 20px">Go Back</a></h1>
        </form>
                
        <?php
            }
        }
        $query = oci_parse($con, "commit");
        $r = oci_execute($query);
        ?>
      </center>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>