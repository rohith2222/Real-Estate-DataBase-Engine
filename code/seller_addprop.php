<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
/* Reset default margin and padding for all elements */
* {
  margin: 0;
  padding: 0;
}

/* Set box-sizing to border-box for easier sizing calculations */
html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

/* Set default font size and family */
body {
  font-size: 16px;
  font-family: Arial, sans-serif;
}

/* Style for header */
header {
  background-color: #0077c2;
  color: #fff;
  padding: 20px;
}

header h1 {
  font-size: 2em;
  margin: 0;
}

/* Style for navigation bar */
nav {
  background-color: #333;
  color: #fff;
  padding: 10px;
}

nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

nav li {
  display: inline-block;
  margin-right: 10px;
}

nav a {
  color: #fff;
  text-decoration: none;
  padding: 10px;
}

nav a:hover {
  background-color: #555;
}

/* Style for main content area */
main {
  padding: 20px;
}

/* Style for form */
form {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
}

input[type=text], input[type=number], select, textarea {
  padding: 5px;
  margin-bottom: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

input[type=submit], button {
  background-color: #0077c2;
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
  border-radius: 5px;
}

input[type=submit]:hover, button:hover {
  background-color: #005f9d;
}

/* Style for table */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ccc;
}

th {
  background-color: #0077c2;
  color: #fff;
}

/* Style for footer */
footer {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
}

footer p {
  margin: 0;
}


</style>
<body>
<div id="add-property" class="tabcontent">
    <h3>Add Property</h3>
    <form action="" method="post">
        <label for="property-type">Property Type:</label>
        <select id="property-type" name="property-type" required>
            <option value="">Select a property type</option>
            <option value="Apartment">Apartment</option>
            <option value="Bungalow">Bungalow</option>
            <option value="townhouse">Townhouse</option>
            <option value="Single Family">Single Family Home</option>
            <option value="Multi Family">Multi-Family Home</option>
            <option value="Ranch Home">Ranch Home</option>
            <option value="Duplex">Duplex</option>
        </select>
    
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
    
        <label for="city">City:</label>
        <select id="city" name="city" required>
            <option value="">Select a City</option>
            <option value="New York City">New York City</option>
            <option value="Syracuse">Syracuse</option>
            <option value="Albany">Albany</option>
            <option value="Rochester">Rochester</option>
            <option value="Buffalo">Buffalo</option>
        </select>
    
        <label for="zip-code">Zip Code:</label>
        <input type="text" id="zip-code" name="zip-code" required>
    
        <label for="beds">Bedrooms:</label>
        <input type="number" id="beds" name="beds" min="0" max="10" required>
    
        <label for="baths">Bathrooms:</label>
        <input type="number" id="baths" name="baths" min="0" max="10" required>
    
        <label for="square-feet">Square Feet:</label>
        <input type="number" id="square-feet" name="square-feet" min="0" max="10000" required>
    
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" min="0" max="100000000" required>
    
        <button type="submit" name="add-property">Add Property</button>
    </form>
</div>

</body>
</html>