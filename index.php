<?php

session_start();

$conn = mysqli_connect("localhost:3308", "root", "", "publications");

if (!$conn){
    die("Connection Failed:" . mysqli_connect_error());
}else{
    echo "Connected Successfully";
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>To-do App</title>
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

    </form>

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>