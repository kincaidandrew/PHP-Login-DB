<?php include "../templates/header.php";?>

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
            <!-- <h1>Title </h1> -->
            <h1>Status: You are logged in  <?php echo $_SESSION['Username'];?> </h1>
            <p class="lead">This is where we will put the logout button</p>
            <h2>Update users</h2>
            <center>
              <h3><table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>IsAdmin</th>
                        <th>CreatedDate</th>
                        <th>Edit</th>
                    </tr>
                </thead></h3>
                
                <h4><tbody>           
                  <?php require('update.php') ?>
                </tbody>

              </table></h4>
          </center>            

            <a href="../public/index.php">Back to home</a>
          </div>
            
         
    <?php include "../templates/footer.php";?>