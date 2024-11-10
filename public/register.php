
<?php 
require_once('../templates/loginHeader.php');//different for log in page to avoid an infinite loop 

require_once ('../functions/functions.php');
require_once ('../config.php'); // This is where the username and password are currently stored (hardcoded in variables)


// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["Username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', test_input($_POST["Username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :Username";
        
        //$pdo = new PDO($dsn, $dbUsername, $dbPassword, $options);
        require_once '../src/DBConnect.php';

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = test_input($_POST["Username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = test_input($_POST["Username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["Password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["Password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["Password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["Confirm_Password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["Confirm_Password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (Username, Password) VALUES (:Username, :Password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":Password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
 

 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../css/signin.css">
   <!-- <link rel="stylesheet" type="text/css" href="../css/stylesheet.css"> -->
    <title>Register</title>
</head>

<body>
    <div class="container">
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="Login_Form" class="form-signin">
            <h2 class="form-signin-heading">Register</h2>
            <p>Please fill this form to create an account.</p>
            <div class ="form-row">
                <div class="form-column">
                    <label for="inputUsername"  class="form-label">Username</label>
                    <!-- <input name="Username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus> -->
                    <input name="Username" type="username" id="inputUsername" class="form-input <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>     
                <div class="form-column">
                    <label  class="form-label" >Password</label>
                    <input name="Password" type="password" id="inputPassword" class="form-input <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-column">
                    <label  class="form-label">Confirm</label>
                    <input name="Confirm_Password" type="password" id="inputConfirmPassword" class="form-input <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div> 
                <div class="form-column">
                    <button name="Submit" value="Submit" class="button" type="submit">Submit</button>
                    <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
                    <button name="Reset" value="Reset" class="button" type="reset">Reset</button>
                    <!-- <input type="reset" class="btn btn-secondary ml-2" value="Reset"> -->
                </div>
            </div> <!-- form-row  -->
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
