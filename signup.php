<?php

require_once 'connect.php';

session_start();

$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
  }else{
    $sql = "SELECT id FROM users WHERE username = ?";

    if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("s", $param_username);
      $param_username = trim($_POST["username"]);

      if($stmt->execute()){
        $stmt->store_result();

        if($stmt->num_rows == 1){
          $username_err = "This username is already taken.";
        }else{
          $username = trim($_POST["username"]);
          $_SESSION["username"] = $username;
        }
      }else{
        echo "Something went wrong. Please try again later.";
      }
    }
    $stmt->close();
  }

  if(empty(trim($_POST["password"]))){
    $password_err = "Please enter a password.";
  }elseif(strlen(trim($_POST["password"])) < 6){
    $password_err = "Password must have atleast 6 characters.";
  }else{
    $password = trim($_POST["password"]);
  }

  if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = "Please confirm password.";
  }else{
    $confirm_password = trim($_POST["confirm_password"]);
    
    if(empty($password_err) && ($password != $confirm_password)){
      $confirm_password_err = "Password did not match.";
    }
  }

  if(empty($username_err) && empty($empty_err) && empty($password_err) && empty($confirm_password_err)){
    
    $sql = "INSERT INTO users (username, password, email, confirmNum) VALUES (?, ?, ?, ?)";

    if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("ssss", $param_username, $param_password, $param_email, $param_confirmNum);

      $param_username = $username;
      $param_email = $email;
      $param_confirmNum = rand(10000, 99999);
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      if($stmt->execute()){
        $_SESSION["confirmNum"] = $param_confirmNum;
        header("location:");
      }else{
        echo "Something went wrong. Please try again later.";
      }
    }
    $stmt->close();
  }
  $mysqli->close();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Sign up Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <h3>Sign up</h3>

    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
    <label>Username:</label><br>
    <input type="text" name="username"><br>
    <label>Password</label><br>
    <input type="password" name="password"><br>
    <label>Repeat Password</label><br>
    <input type="password" name="password2"><br>
    <input type="submit" value="Sign up">
    </form>

    <?php

      if($_POST){
        if($_POST['password'] !== $_POST['password2']){
          echo "<p>Your password's do not match</p>";
        }
      }

      echo htmlspecialchars($_SERVER["PHP_SELF"]);
    ?>

    
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>