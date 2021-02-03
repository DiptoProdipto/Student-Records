<?php

    include 'conn.php';

    $model = new Model();

    $id = $_REQUEST['ID'];

    $update = $model->update($id);

?>


<html>
<head>
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="css/updateStyle.css?v=<?php echo time(); ?>">   
</head>
    <body>
    <div class="update">
            <br>
            <br>
            <form method="post">
            
            <h2 style="color:#fff; font-weight:bold;">Update information for ID: <?php echo $id;?></h2>
            <br>
            <br>
            <input type="text" name="name" placeholder="Name" required>
            <br>
            <br>
            <input type="text" name="place" placeholder="Place of birth" required>
            <br>
            <br>
            <input type="text" name="date" placeholder="Date of birth(YYYY-MM-DD)" required>
            <br>
            <br>
            <input type="submit" name="update" value="Update">  
            <br>
            <a href="index.php" style="text-decoration:none;color:#fff">Cancel</a> 
            </form> 
        </div>   
    </body>
</html>