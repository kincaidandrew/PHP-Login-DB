
<?php
require_once '../functions/functions.php';
/**
 * List all users with a link to edit
 */
    try {        
        require_once '../src/DBconnect.php';
        $sql = "SELECT * FROM users";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    } 
?>

        
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo test_input($row["id"]); ?></td>
                <td><?php echo test_input($row["username"]); ?></td>
                <td><?php echo test_input($row["isAdmin"]); ?></td>            
                <td><?php echo test_input($row["created_at"]); ?> </td>
                <td><a href="update-single.php?id=<?php echo test_input($row["id"]);?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        
    
<!-- <a href="../public/index.php">Back to home</a> -->