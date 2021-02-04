<?php

    include 'conn.php';

    $database = new Database();

    $id = $_REQUEST['ID'];

    if(isset($_POST["update"]))  
    {  
        $update_data = array(  
            'Name'     =>     mysqli_real_escape_string($database->conn, $_POST['name']),  
            'PlaceOfBirth'      =>     mysqli_real_escape_string($database->conn, $_POST['place']),
            'DateOfBirth'      =>     mysqli_real_escape_string($database->conn, $_POST['date'])  
        );  
        $where_condition = array(  
            'ID'     =>     $id  
        );  
        if($database->update("student", $update_data, $where_condition))  
        {  
            header("location:update.php?ID=$id");  
        }  
    }


    $get_data = "SELECT * FROM student WHERE ID = $id";
    $run_data = mysqli_query($database->conn, $get_data);

    while ($row = mysqli_fetch_array($run_data)) {
        
        $name = $row['Name'];
        $place = $row['PlaceOfBirth'];
        $birth = $row['DateOfBirth'];

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
            <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
            <br>
            <br>
            <input type="text" name="place" placeholder="Place of birth" value="<?php echo $place; ?>" required>
            <br>
            <br>
            <input type="text" name="date" placeholder="Date of birth(YYYY-MM-DD)" value="<?php echo $birth; }?>" required>
            <br>
            <br>
            <input type="submit" name="update" value="Update">  
            <br>
            <a href="index.php" style="text-decoration:none;color:#fff">Cancel</a> 
            </form> 
        </div>   
    </body>
</html>