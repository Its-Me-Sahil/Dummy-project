<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: url(../images/j2.jpeg);
            backdrop-filter: blur(5px);
            margin: 0;
            padding: 0;
            background-color: #FFE4B5; /* Light orange background */
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #loginContainer {
            border: 2px solid black;
            border-radius: 10px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            box-sizing: border-box;
        }

        form {
            margin: 20px;
            display: flex;
            flex-direction: column;
        }

        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #FF5555;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #FF8C00;
        }
        #img1{
            position:fixed;
            top:0;
            left:0;
            width: 10vh;
            height: 10vh;
        }
    </style>
</head>
<body>
    <!-- <img id = "img1" src="../images/fast-forward.gif" alt="image" height = "100vh" width="100vw"><br><br> -->
    <div id="loginContainer">
        <h2>Login</h2>
        <form action="" onsubmit = "redirecttoohome()" method="post">
            Email: <input type="text" name="email" placeholder="Enter your email" required><br>
            Password: <input type="password" name="password" placeholder="Enter your password" required><br>
            <input type="submit" >
        </form>
    </div>
    <?php
$server = "localhost";
$user = "root";
$password = "";
$database = "juice_c";
$conn = mysqli_connect($server, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Check if the entered email and password match any record in the admin table
    $query = "SELECT * FROM `admin` WHERE ad_email ='$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if a record is found in the admin table
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['ad_pass'];

        // Verify the entered password with the stored password in the admin table
        if ($password === $storedPassword) {
            // Login successful
            header("Location: ../data/h_data.html");
            exit();
        } else {
            // Incorrect password
            echo '<script>alert ("Wrong Password")</script>';
            exit();
        }
    } else {
        // No record found for the entered email
        echo '<script>alert ("Wrong Email ID")</script>';
        exit();
    }
}

mysqli_close($conn);
?>


        </body>
</html>
