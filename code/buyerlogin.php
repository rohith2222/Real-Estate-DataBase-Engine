<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }

      .container {
        max-width: 500px;
        margin: 0 auto;
        padding: 50px;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
      }

      h1 {
        text-align: center;
        margin-bottom: 30px;
      }

      form {
        display: flex;
        flex-direction: column;
      }

      label {
        font-size: 18px;
        margin-bottom: 5px;
      }

      input[type="text"],
      input[type="password"] {
        padding: 10px;
        font-size: 18px;
        border: 2px solid;
        border-radius: 5px;
        margin-bottom: 20px;
      }

      button[type="submit"] {
        background-color: #0077c2;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
      }

      button[type="submit"]:hover {
        background-color: #005f9d;
      }

      p {
        text-align: center;
        margin-top: 20px;
      }

      a {
        color: #0077c2;
        text-decoration: none;
      }

      a:hover {
        text-decoration: underline;
      }

    </style>
  </head>
  <body>
    <div class="container">
      <h1>Buyer Login</h1>
      <form action="" method="post">
        <label for="username">Email:</label>
        <input type="text" name="username" id="username">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <button type="submit" name="login">Login</button>
      </form>
      <p>Don't have an account? <a href="#">Register here</a></p>
    </div>
  </body>
</html>

<?php
	// Check if login form has been submitted
	if (isset($_POST['login'])) {

    session_start();

		// Connect to the database
		$conn = pg_connect("host=localhost port=5432 dbname=real_estate user=postgres password=1234");

		if (!$conn) {
			echo "An error occurred while connecting to the database.\n";
			exit;
		}

		// Retrieve the username and password from the form
		$username = $_POST['username'];
		$password = $_POST['password'];

		// Query the database for the agent with the specified username and password
		$query = "SELECT * FROM buyers WHERE email = '$username' AND password = '$password'";
		$result = pg_query($conn, $query);

		// Check if the agent was found in the database
		if (pg_num_rows($result) == 1) {
			// Agent has been found, so redirect to the agent page
      $row = pg_fetch_assoc($result);
      $buyer_id = $row['id'];
      $_SESSION['buyer_id'] = $buyer_id;
			header("Location: buyer.php");
			exit;
		} else {
			// Agent was not found, so display an error message
			echo "Invalid username or password. Please try again.";
		}

		// Close the database connection
		pg_close($conn);
	}
?>
