<?php

    include 'conn.php';

    $database = new Database();

    $success_message = '';  

    if(isset($_POST["submit"]))  
    {  
        $insert_data = array(  
            'Name'     =>     mysqli_real_escape_string($database->conn, $_POST['name']),  
            'PlaceOfBirth'    =>     mysqli_real_escape_string($database->conn, $_POST['place']),
            'DateOfBirth'    =>     mysqli_real_escape_string($database->conn, $_POST['birth']),  
        );  
        if($database->insert('student', $insert_data))  
        {  
            $success_message = 'Post Inserted';  
        }       
    } 

    if(isset($_GET["delete"]))  
    {  
        $where = array(  
            'ID'     =>     $_GET["ID"]  
        );  
        if($database->delete("student", $where))  
        {  
            header("location:index.php");  
        }  
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Assignment3</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="top">
        <div class="form">
           <br>
            <h2 style="font-family: arial;color:white">Insert a new student</h2>
            <br>
            <form action="" method="POST">
                <input type="text" name="name" placeholder="Enter your name" required>
                <br>
                <br>
                <input type="text" name="place" placeholder="Enter your place of birth" required>
                <br>
                <br>
                <input type="text" name="birth" placeholder="Date of birth(YYYY-MM-DD)" required>
                <br>
                <br>
                <input type="submit" name="submit" value="Insert">
            </form>
        </div>
        <div class="search">
         <br>
          <h2 style="font-family: arial;color:white">Find out students by their place of birth</h2>
           <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <select name="opt" >
                <option value="Dhaka">Dhaka</option>
                <option value="Chattagram">Chattagram</option>
                <option value="Sylhet">Sylhet</option>
                <option value="Mymensingh">Mymensingh</option>
            </select>
            
            <br>
            <br>
            
                <input id="search" type="submit" name="submitt" value="Search">
            </form>
            
        </div>
    </div>
    <div id="tables">
        <div class="table1">
            <table border="1">

                <tr>

                    <th> ID </th>
                    <th> Name </th>
                    <th> Place of Birth </th>
                    <th> Date of Birth </th>
                    <th>Delete</th>
                    <th>Update</th>

                </tr>

                <?php

                $student_data = $database->fetch('student');  
                foreach($student_data as $res){
    
                ?>

                    <tr style="background-color: black;">
                        <td> <?php echo $res['ID'];  ?> </td>
                        <td> <?php echo $res['Name'];  ?> </td>
                        <td> <?php echo $res['PlaceOfBirth'];  ?> </td>
                        <td> <?php echo $res['DateOfBirth'];  ?> </td>
                        <td> <button style="background-color: red;"> <a href="index.php?delete=1&ID=<?php echo $res["ID"]; ?>" style="text-decoration: none; color:#fff;"> Delete </a> </button> </td>
                        <td> <button style="background-color: green;"> <a href="update.php?ID=<?php echo $res['ID']; ?>" style="text-decoration: none; color:#fff;"> Update </a> </button> </td>

                    </tr>

                <?php
                }

                ?>

            </table>

        </div>
        <div class="table2">
            <table border="1">

                <tr>

                    <th> ID </th>
                    <th> Name </th>
                    <th> Place of Birth </th>
                    <th> Date of Birth </th>
                    <th>Delete</th>
                    <th>Update</th>

                </tr>
                <?php

                if(isset($_POST['submitt']))
                {
                
                    $birthplace = mysqli_real_escape_string($database->conn,$_POST['opt']);
                        
                    $query = "SELECT * FROM student WHERE PlaceOfBirth = '$birthplace'";
                    
                    $data = mysqli_query($database->conn,$query) or die('error');
                    
                    if(mysqli_num_rows($data)>0){
                        while($row = mysqli_fetch_assoc($data)){
                            $id = $row['ID'];
                            $name = $row['Name'];
                            $place = $row['PlaceOfBirth'];
                            $date = $row['DateOfBirth'];
                        ?>
                        <tr style="background-color: black;">
                            <td><?php echo $id;?></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $place;?></td>
                            <td><?php echo $date;?></td>
                            <td> <button style="background-color: red;"> <a href="index.php?delete=1&ID=<?php echo $row["ID"]; ?>" style="text-decoration: none;color:#fff;"> Delete </a> </button> </td>
                            <td> <button style="background-color: green;"> <a href="update.php?ID=<?php echo $row['ID']; ?>" style="text-decoration: none;color:#fff;"> Update </a> </button> </td>
                        </tr>
                        <?php
                        }
                    }
                    else{
                        ?>
                        <tr style="background-color: black;">
                            <td colspan='6'>Records not found</td>
                        </tr>
                        <?php
                    }
                }
                
                ?>
            </table>
        </div>
    </div>
</body>

</html>
