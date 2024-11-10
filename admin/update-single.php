

<?php require "../templates/header.php"; ?>

<title>Administration</title>
</head>
 

<body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul>
            <li><a href="../public/index.php">Home</a></li>
            <li><a href="../public/about.php">About</a></li>
            <li><a href="../public/contacts.php">Contact</a></li>
            <?php echo (($_SESSION['IsAdmin'] == 1 ) ? '<li><a href="administration.php">Administration</a></li>' : '' );?>
                       
          </ul>
        </nav>
        <h3 class="text-muted">PHP Login exercise - Administation page</h3>
      </div>

        <div class="mainarea">
        <h2>Edit a user</h2>
   
        <h1>Status: You are logged in  <?php echo $_SESSION['Username'];?> </h1>
                    <p class="lead">Here (with more time) we could edit user details</p>
            
                <a href="administration.php">Back to admin|home</a>

<?php require "../templates/footer.php"; ?>