<?php

    include 'conn.php';
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $place = $_POST['place'];
        $birth = $_POST['birth'];
        
        if($name!="" && $place!="" && $birth!="")
        {
           $sql = "INSERT INTO student (Name, PlaceOfBirth, DateOfBirth) VALUES('$name','$place','$birth');"; 
            
           $data = mysqli_query($conn, $sql);
            
            if($data)
            {
                header("location: index.php");
            }
        }
        else
        {
            header("location: index.php");
        }
    }
    

    
    
    

    

    