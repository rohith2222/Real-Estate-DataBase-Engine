Project Name: Real Estate Search Engine
This project demonstrates how to load and import data from create.sql and load.sql files using PostgreSQL.

Introduction
This project provides a step-by-step guide on how to import and load data from SQL files using PostgreSQL. The create.sql file contains the necessary SQL commands for creating the required database tables, while the load.sql file contains the data to be loaded into the database.

Requirements
To follow this guide, you will need:
1.PostgreSQL database server
2.pgAdmin, or any other PostgreSQL client software
3.Apache HTTP Server
4.PHP
5.The create.sql and load.sql files from this repository

Installation
1.Download and install the PostgreSQL server for your operating system, if you haven't already, from the official PostgreSQL website: https://www.postgresql.org/download/
2.Download and install pgAdmin, or any other PostgreSQL client software of your choice.
3.Download and install the Apache HTTP Server for your operating system from the official Apache website: https://httpd.apache.org/download.cgi
4.Download and install PHP for your operating system from the official PHP website: https://www.php.net/downloads.php
5.Configure PHP to work with Apache by following the instructions specific to your operating system: https://www.php.net/manual/en/install.php
6.Clone or download this repository to your local machine.

Usage
1.Open pgAdmin, or your chosen PostgreSQL client software, and connect to your PostgreSQL server.
2.Create a new database, or use an existing one.
3.Import the create.sql file:
  In your PostgreSQL client, open the create.sql file.
  Execute the SQL commands in the file to create the required tables.
4.Import the load.sql file:
  In your PostgreSQL client, open the load.sql file.
  Execute the SQL commands in the file to load the data into the tables.
5.Create a new PHP file (e.g., index.php) in your Apache web server's document root directory (e.g., /var/www/html on Linux or C:\xampp\htdocs on Windows) and add the necessary PHP code to connect to the PostgreSQL database and query the data.
6.Open a web browser and navigate to the URL corresponding to the PHP file you created in the previous step (e.g., http://localhost/index.php). The PHP code should execute and display the desired data from the PostgreSQL database.

Support
If you encounter any issues or have questions, please feel free to contact the rgamini@buffalo.edu.

