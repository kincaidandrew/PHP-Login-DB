<?php require_once '../templates/header.php';?>
  
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contacts.php">Contact</a></li>
            <?php echo (($_SESSION['IsAdmin'] == 1 ) ? '<li><a href="../admin/administration.php">Administration</a></li>' : '' );?>
          </ul>
        </nav>
        <h3 class="text-muted">PHP Login exercise - About page</h3>
      </div>

        <div class="mainarea">
            <h1>Title </h1>
            <p class="lead">This is where we will put the logout button</p>

            <form action="" method="post" name="Logout_Form" class="form-signin">
                <button name="Submit" value="Logout" class="button" type="submit">Log out</button>
            </form>
           

        </div>

      <div class="row marketing">
          <div>
            <h4>About page</h4>
            <p>Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. </p>

        </div>
      </div>

          <?php require_once '../templates/footer.php';?>