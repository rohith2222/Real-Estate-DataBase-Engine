<?php
  // Check if user is logged in
  session_start();
  if (!isset($_SESSION['seller_id'])) {
    header("Location: sellerlogin.php");
    exit();
  }
  $seller_id = $_SESSION['seller_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
}

.container {
  display: flex;
  max-width: 1200px;
  margin: 0 auto;
}

.sidebar {
  flex: 0 0 200px;
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
  padding: 20px;
}

.sidebar h2 {
  font-size: 24px;
  margin-top: 0;
  margin-bottom: 20px;
}

.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar li {
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

.content {
  flex: 1;
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
  padding: 20px;
}


button{
    margin-bottom: 10px;
    display: block;
  padding: 10px 20px;
  background-color: #0077c2;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

</style>
<body>
  <div class="container">
    <div class="sidebar">
      <h2>Dashboard</h2>
      <ul>
        <li><a href="#" id="personal-info-link">Personal Information</a></li>
        <li><a href="#" id="change-password-link">Change Password</a></li>
        <li><a href="seller_addprop.php" id="addProperties">Add Properties</a></li>
        <li><a href="#" id="saved-prop">My Properties</a></li>
        <li><a href="#" id="listings">My Listings</a></li>
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
      </ul>
    </div>
    <div class="content" id="pers">
      <h2>Welcome seller!</h2>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#personal-info-link').click(function(event) {
                event.preventDefault();
                $.getJSON('seller_personal_info.php', function(data) {
                    $('#pers').html('<h2>Personal Information</h2><p>Name: ' + data.name + '</p><p>Email: ' + data.email + '</p>');
                });
            });
        });
    </script>
</html>
<?php
// Logout functionality
if (isset($_POST['logout'])) {
  // Destroy the session
  session_destroy();
  
  // Redirect to login page
  header('Location: index.php');
  exit;
}
?>
<script>
  // Get references to the links and the content div
  const changePasswordLink = document.getElementById("change-password-link");
  const addProperties = document.getElementById("addProperties");
  const myProperties = document.getElementById("saved-prop");
  const myListings = document.getElementById("listings");
  const contentDiv = document.getElementById("pers");

  // Add an event listener to the "Change Password" link
  changePasswordLink.addEventListener("click", function(event) {
    event.preventDefault(); // prevent the default link behavior
    contentDiv.innerHTML = `
    <style>
    #change-password {
    background-color: #fff;
    padding: 20px;
    width: 400px;
    margin: 0 auto;
    }

    #change-password h3 {
    font-size: 24px;
    margin-bottom: 20px;
    }

    #change-password form {
    display: flex;
    flex-direction: column;
    }

    #change-password label {
    font-size: 16px;
    margin-bottom: 10px;
    }

    #change-password input[type="password"] {
    border: none;
    border-radius: 5px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    padding: 10px;
    margin-bottom: 20px;
    font-size: 16px;
    }

    #change-password button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    }

    #change-password button[type="submit"]:hover {
    background-color: #0062cc;
    }

    </style>
    <div id="change-password" class="tabcontent">
    <h3>Change Password</h3>
    <form action="" method="post">
    <label for="old-password">Old Password:</label>
    <input type="password" id="old-password" name="old-password" required>
    
    <label for="new-password">New Password:</label>
    <input type="password" id="new-password" name="new-password" required>
    
    <label for="confirm-password">Confirm New Password:</label>
    <input type="password" id="confirm-password" name="confirm-password" required>
    
    <button type="submit" name="change-password">Change Password</button>
    </form>
    </div>
    `;
  });


  addProperties.addEventListener("click", function(event) {
    event.preventDefault(); // prevent the default link behavior
    contentDiv.innerHTML = `
    
    `;
  });

  myProperties.addEventListener("click", function(event) {
    event.preventDefault(); // prevent the default link behavior
    contentDiv.innerHTML = `
    
    `;
  });

  myListings.addEventListener("click", function(event) {
    event.preventDefault(); // prevent the default link behavior
    contentDiv.innerHTML = `
    
    `;
  });

</script>



<?php
if (isset($_POST['change-password'])) {
  // Get the entered passwords
  $old_password = $_POST['old-password'];
  $new_password = $_POST['new-password'];
  $confirm_password = $_POST['confirm-password'];

  // Retrieve the user's current password from the database
  $conn = pg_connect("host=localhost port=5432 dbname=real_estate user=postgres password=1234");
  $user_id = $_SESSION['seller_id'];
  $query = "SELECT password FROM sellers WHERE id = $user_id";
  $result = pg_query($conn, $query);
  $row = pg_fetch_assoc($result);
  $current_password = $row['password'];
  
  // Verify that the old password matches the user's current password
  if ($old_password != $current_password) {
    echo "<script>alert('Invalid old password. Please try again.');</script>";
  } 
  // Verify that the new password and confirm password fields match
  else if ($new_password != $confirm_password) {
    echo "<script>alert('New password and confirm password fields do not match. Please try again.');</script>";
  }
  // Update the user's password in the database
  else {
    $query = "UPDATE sellers SET password = '$new_password' WHERE id = $user_id";
    $result = pg_query($conn, $query);
    echo "<script>alert('Password successfully updated.');</script>";
  }
  // Close the database connection
  pg_close($conn);
}

?>


