<!DOCTYPE html>
<html>

<head>
    <title>Movie Rental System</title>
    <!-- Style for showcasing elements -->
    <link rel="stylesheet" href="../Movie Rental/style.css">
</head>

<body>
    <?php
    session_start();
    // Database connection settings
    // Database configuration
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'my_movie_rental';

    // Create a connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Display alert box
    function alert($message)
    {
        // Display the alert box 
        echo "<script>alert('$message');</script>";
    }

    // Find errors in the query
    function executeQuery($conn, $query)
    {
        try {
            $result = $conn->query($query);
            if ($result === false) {
                echo "Error executing query. Please check your input and try again.";
                return null;
            }
            return $result;
        } catch (Throwable $exception) {
            echo "An error occurred while executing the query: " . $exception->getMessage();
            return null;
        }
    }


    ?>

    <div class="topNav">
        <form method="POST">
            <input type="text" name="full_name" placeholder="Full Name">
            <input type="text" name="user_password" placeholder="Password">
            <input type="submit" value="Login">
        </form>
        <?php
        $logged_in = false;
        if (isset($_POST['submit_login'])) {
            $full_name = $_POST['full_name'];
            $user_password = $_POST['user_password'];

            // Check if the password is correct
            $check_password_query = "SELECT password_hash FROM membership WHERE full_name = '$full_name'";

            $result = executeQuery($conn, $check_password_query);
            $row = $result->fetch_assoc();
            $hashed_password = $row['password_hash'];

            if (!password_verify($user_password, $hashed_password)) {
                die(alert("Incorrect password."));
            }
            $logged_in = true;

            $_SESSION['full_name'] = $full_name;
        }
        ?> 
    </div>

    <!-- Table to show current members -->
    <?php include 'membership.php'; ?>

    <!-- Table to show current rentable movies -->
    <?php include 'movies.php'; ?>

    <!-- Table to show current rented movies -->
    <?php include 'rent.php'; ?>

    <!-- ADD MEMBER ---------------------------------->
    <br><br>
    <div class="edit-form">
        <h2>Sign Up</h2>
        <form method='POST'>
            <label for='salutation_id'>Salutation:</label>
            <select name='salutation_id'>
                <option value='1'>Mr</option>
                <option value='2'>Mrs</option>
                <option value='3'>Ms</option>
                <option value='4'>Dr</option>
            </select><br>

            <label for='full_name'>Full Name:</label>
            <input type='text' name='full_name' required><br>

            <label for='physical_address'>Physical Address:</label>
            <input type='text' name='physical_address' required><br>

            <label for='age'>Age:</label>
            <input type='number' name='age' required><br>

            <label for='email'>Email:</label>
            <input type='email' name='email' required><br>

            <label for='phone_number'>Phone Number:</label>
            <input type='text' name='phone_number' required><br>

            <label for='user_password'>Password:</label>
            <input type='password' name='user_password' required><br>

            <input type='submit' name='submit_membership' value='Add Membership'>
        </form>
        <?php
            if (isset($_POST['submit_membership'])) {
                $full_name = $_POST['full_name'];
                $physical_address = $_POST['physical_address'];
                $salutation_id = $_POST['salutation_id'];
                $age = $_POST['age'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $user_password = $_POST['user_password'];
                $email = $_POST['email'];

                // Hashed password
                $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

                //Check if everything is filled in
                if (strlen($full_name) == 0 || strlen($physical_address) == 0 || strlen($age) == 0 || strlen($email) == 0 || strlen($phone_number) == 0 || strlen($user_password) == 0) {
                    alert("Please fill in all fields.");
                }

                $insert_membership_query = "INSERT INTO membership (full_name, physical_address, salutation_id, age, email, phone_number, password_hash)
                                        VALUES ('$full_name', '$physical_address', $salutation_id, $age, '$email', '$phone_number', '$hashed_password')";

                executeQuery($conn, $insert_membership_query);
            }
        ?>
    </div>

    <?php if ($logged_in): ?>
    <!-- REMOVE MEMBER ---------------------------------->
    <div class="edit-form">
        <h2>Remove Member</h2>
        <form method='POST'>
            <!-- <label for='full_name'>Full Name:</label>
            <input type='text' name='full_name'><br>

            <label for='user_password'>Password:</label>
            <input type='password' name='user_password'><br> -->

            <input type='submit' name='submit_remove_membership' value='Remove Membership'>
        </form>
        <?php
            if ($logged_in) {
                if (isset($_POST['submit_remove_membership'])) {
                    $full_name = 

                    // $user_password = $_POST['user_password'];

                    // // Check if the password is correct
                    // $check_password_query = "SELECT password_hash FROM membership WHERE full_name = '$full_name'";

                    // $result = executeQuery($conn, $check_password_query);
                    // $row = $result->fetch_assoc();
                    // $hashed_password = $row['password_hash'];

                    // if (!password_verify($user_password, $hashed_password)) {
                    //     die(alert("Incorrect password."));
                    // }

                    $delete_membership_query = "DELETE FROM membership WHERE full_name = '$full_name'";

                    executeQuery($conn, $delete_membership_query);
                }
            }
        ?>
    </div>
    
    <!-- UPDATE MEMBER ------------------------------->
    <div class="edit-form">
        <h2>Update Membership</h2>
        <form method='POST'>
            <!-- <label for='full_name'>Full Name:</label>
            <input type='text' name='full_name'><br>

            <label for='user_password'>Password:</label>
            <input type='password' name='user_password'><br>
            
            <br> <br> -->
            <label for='salutation_id'>Change Salutation:</label>
            <select name='salutation_id'>
                <option value='1'>Mr</option>
                <option value='2'>Mrs</option>
                <option value='3'>Ms</option>
                <option value='4'>Dr</option>
            </select><br>

            <label for='full_name'>Change Full Name:</label>
            <input type='text' name='full_name'><br>

            <label for='physical_address'>Change Physical Address:</label>
            <input type='text' name='physical_address'><br>

            <label for='age'>Change Age:</label>
            <input type='number' name='age'><br>

            <label for='email'>Change Email:</label>
            <input type='email' name='email'><br>

            <label for='phone_number'>Change Phone Number:</label>
            <input type='text' name='phone_number'><br>
            
            <label for='user_password'>Change Password:</label>
            <input type='password' name='user_password'><br>

            <input type='submit' name='submit_update_membership' value='Update Membership'>
        </form>
        <?php
            if (isset($_POST['submit_update_membership'])) {
                // $full_name = $_POST['full_name'];
                // $user_password = $_POST['user_password'];

                // $check_password_query = "SELECT password_hash FROM membership WHERE full_name = '$full_name'";

                // $result = executeQuery($conn, $check_password_query);
                // $row = $result->fetch_assoc();
                // $hashed_password = $row['password_hash'];

                // if (!password_verify($user_password, $hashed_password)) {
                //     die(alert("Incorrect password."));
                // }
                
                $salutation_id = $_POST['salutation_id'];
                $full_name = $_POST['full_name'];
                $physical_address = $_POST['physical_address'];
                $age = $_POST['age'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $user_password = $_POST['user_password'];
    
                $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
            }           
        ?>
    </div> 

    <!-- RENT MOVIE ---------------------------------->
    <div class="edit-form">
        <h2>Rent Movie</h2>
        <form method='POST'>
            <label for='title'>Title:</label>
            <select name='moviee_id'>
                <?php
                $query = "SELECT movie_id, title FROM movies";  // Select movie_id along with title

                $result = executeQuery($conn, $query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['movie_id']}'>{$row['title']}</option>";  // Use movie_id as option value
                }
                ?>
            </select><br>

            <!-- <label for='full_name'>Full Name:</label>
            <input type='text' name='full_name'><br>

            <label for='user_password'>Password:</label>
            <input type='password' name='user_password'><br> -->

            <input type='submit' name='submit_rental' value='Rent Movie'>
        </form>
        <?php
            if (isset($_POST['submit_rental'])) {
                $title = $_POST['movie_id'];
                $full_name = $_SESSION['full_name'];          

                // $user_password = $_POST['user_password'];

                // // Check if the password is correct
                // $check_password_query = "SELECT password_hash FROM membership WHERE full_name = '$full_name'";

                // $result = executeQuery($conn, $check_password_query);
                // $row = $result->fetch_assoc();
                // $hashed_password = $row['password_hash'];

                // if (!password_verify($user_password, $hashed_password)) {
                //     die(alert("Incorrect passwddddord."));
                // }

                $insert_rental_query = "INSERT INTO rentals (movie_id, full_name)
                                        VALUES ($title, '$full_name')";

                executeQuery($conn, $insert_rental_query);
            }
        ?>
    </div>
    <?php endif; ?>

    <!-- ADD MOVIE ---------------------------------->
    <div class="edit-form">
        <h2>Add Movie</h2>
        <form method='POST'>
            <label for='title'>Title:</label>
            <input type='text' name='title'><br>

            <label for='release_year'>Release Year:</label>
            <input type='number' name='release_year'><br>

            <label for='genre'>Genre:</label>
            <input type='text' name='genre'><br>

            <label for='rental_price'>Rental Price:</label>
            <input type='number' name='rental_price' step='0.01'><br>

            <input type='submit' name='submit_movie' value='Add Movie'>
        </form>
        <?php
        if (isset($_POST['submit_movie'])) {
            $title = $_POST['title'];
            $release_year = $_POST['release_year'];
            $genre = $_POST['genre'];
            $rental_price = $_POST['rental_price'];

            // Insert movie data into the database
            $insert_movie_query = "INSERT INTO movies (title, release_year, genre, rental_price)
                                    VALUES ('$title', $release_year, '$genre', $rental_price)";

            executeQuery($conn, $insert_movie_query);
        }
        ?>
    </div>

    <?php
    // Close the connection
    $conn->close();
    ?>
</body>

</html>