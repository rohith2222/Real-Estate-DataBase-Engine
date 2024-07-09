<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    form {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 50px auto;
  width: 500px;
  font-family: Arial, sans-serif;
}

h1 {
  margin-bottom: 30px;
}

label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
}

input {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
}

select {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
}

button {
  background-color: #0077c2;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

button:hover {
  background-color: #005f9d;
}

.error {
  color: red;
  font-size: 14px;
  margin-bottom: 10px;
}
.sidebar a {
  display: block;
  padding: 10px 20px;
  background-color: #0077c2;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.sidebar a:hover{
  background-color: #005f9d;
}

</style>
<body>
<a href="index.php" id="saved-prop">Home</a>
<div class="registration-form">
  <h2>Create an Account</h2>
  <form action="" method="post">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="name" id="name" name="name" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
      <label for="confirm-password">Confirm Password</label>
      <input type="password" id="confirm-password" name="confirm-password" required>
    </div>
    <div class="form-group">
      <label for="user-type">Register as</label>
      <select id="user-type" name="user-type" required>
        <option value="">Select an option</option>
        <option value="buyer">Buyer</option>
        <option value="seller">Seller</option>
      </select>
    </div>
    <button type="submit" name="register">Register</button>
  </form>
</div>

</body>
</html>


<?php
  // Connect to the database
  $conn = pg_connect("host=localhost port=5432 dbname=real_estate user=postgres password=1234");

  // Handle form submission
  if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $userType = $_POST['user-type'];

    // Validate form data
    $errors = array();
    if (empty($email)) {
      $errors[] = "Email is required";
    }
    if (empty($password)) {
      $errors[] = "Password is required";
    }
    if ($password != $confirmPassword) {
      $errors[] = "Passwords do not match";
    }
    if (empty($userType)) {
      $errors[] = "User type is required";
    }
    

    // Insert new user into database
    if (count($errors) == 0) {
        if($userType=='buyer'){
            $query = "INSERT INTO buyers (name, email, password) VALUES ('$name', '$email', '$password')";
        }
        if($userType=='seller'){
            $query = "INSERT INTO sellers (name, email, password) VALUES ('$name', '$email', '$password')";
        }
      $result = pg_query($conn, $query);
      if (!$result) {
        echo "An error occurred while registering. Please try again later.";
      } else {
        echo "You have been registered successfully.";
      }
    } else {
      foreach ($errors as $error) {
        echo $error . "<br>";
      }
    }
  }

  // Close the database connection
  pg_close($conn);
?>
