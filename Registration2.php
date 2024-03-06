<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style2.css">
</head>
<body>
<section class="header">
        <nav>
            <img src="image/Eye.png"></a>
            <div class="logoName">
                <h1>Arise</h1>
            </div>
            </nav>
</section>

  <div class="container">
  <?php
session_start();

if(isset($_SESSION["user"])){
  header("Location: index.php");
  exit();
}

require_once "database.php";

$errors = array();

if(isset($_POST["submit"])){
  $LotOrBLK = $_POST["Lot_BLK"];
  $Street = $_POST["Street"];
  $Subdivision = $_POST["Subdivision"];
  $Barangay = $_POST["Barangay"];
  $City = $_POST["City"];
  $Province = $_POST["Province"];
  $Country = $_POST["Country"];

  if (empty($LotOrBLK) OR empty($Street) OR empty($Subdivision) OR empty($Barangay) OR empty($City) OR empty($Province) OR empty($Country)) {
    array_push($errors, "All fields are required");
  }

  if (count($errors) == 0) {
  } else {
    require_once "database.php";
    $sql = "INSERT INTO users(Lot_Blk, street, subdivision, barangay, city, province, country) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssss", $LotOrBLK, $Street, $Subdivision, $Barangay, $City, $Province, $Country);
    if (mysqli_stmt_execute($stmt)) {
      echo "<div class='alert alert-success'>You are Registered Successfully!</div>";

      header("Location: index.php");
      exit();
    } else {
      array_push($errors, "Error occurred while registering. Please try again.");
    }
  }
}

?>
      
<form action="Login.php" method="post">
    <div class="form-group">
        <label for="Lot/Blk"></label>
        <p style="color: gold">Lot/Blk:</p>
        <input type="text" class="form-control" name="Lot/Blk" required>
    </div>
    <div class="form-group">
        <label for="Street"></label>
        <p style="color: gold">Street:</p>
        <input type="text" class="form-control" name="Street" required>
    </div>
    <div class="form-group">
        <label for="Subdivision"></label>
        <p style="color: gold">Subdivision:</p>
        <input type="text" class="form-control" name="Subdivision" required>
    </div>
    <div class="form-group">
    <label for="Barangay"></label>
    <p style="color: gold">Barangay:</p>
    <input type="text" class="form-control" name="Barangay" required>
</div>
    <div class="form-group">
        <label for="City"></label>
        <p style="color: gold">City:</p>
        <input type="text" class="form-control" name="City" required>
    </div>
    <div class="form-group">
        <label for="Province"></label>
        <p style="color: gold">Province:</p>
        <input type="text" class="form-control" name="Province" required>
    </div>
    <div class="form-group">
        <label for="Country"></label>
        <p style="color: gold">Country:</p>
        <input type="text" class="form-control" name="Country" required>
    </div>
    <div>
    <div class="form-btn">
    <a href="Registration.php" class="hero-btn">Back</a> <input type="Submit" class="hero-btn" value="Submit" name="Submit">
    </div>
</form>
</body>
</html>
