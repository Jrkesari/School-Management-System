<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// ## Create Tables
// User Table:
try {
  mysqli_query($db, "DESCRIBE `users`");
} catch (mysqli_sql_exception $e) {
  // Table does not exists
  $userTable = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    password VARCHAR(100) NOT NULL,
    user_type INT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`,`email`)
    )";
  mysqli_query($db, $userTable);
}
// Grades Table:
try {
  mysqli_query($db, "DESCRIBE `grades`");
} catch (mysqli_sql_exception $e) {
  // Table does not exists
  $gradesTable = "CREATE TABLE grades (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    english VARCHAR(30) NOT NULL,
    math VARCHAR(30) NOT NULL,
    chemistry VARCHAR(30) NOT NULL,
    physics VARCHAR(30) NOT NULL,
    bio VARCHAR(30) NOT NULL,
    studentId INT(6) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `studentId` (`studentId`)
    )";
  mysqli_query($db, $gradesTable);
}

// ## Create Records
// Teacher:
if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE username='admin'")) === 0) {
  $hashedPassword = password_hash('admin', PASSWORD_DEFAULT);
  $admin = "INSERT INTO users (username, email, password, user_type)
  VALUES ('admin', 'admin@school.edu', '${hashedPassword}', '1')";
  if (!mysqli_query($db, $admin))
    echo mysqli_error($db);
}
// Student:
if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE username='user'")) === 0) {
  $hashedPassword = password_hash('user', PASSWORD_DEFAULT);
  $user = "INSERT INTO users (username, email, password, user_type)
  VALUES ('user', 'user@school.edu', '${hashedPassword}', '0')";
  if (!mysqli_query($db, $user))
    echo mysqli_error($db);
  else
    mysqli_query($db, "INSERT INTO `grades`(`id`, `english`, `math`, `chemistry`, `physics`, `bio`, `studentId`) VALUES ('0','0','0','0','0','0','2')");
}