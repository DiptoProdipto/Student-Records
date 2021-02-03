<?php

class Model {

    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "web";
    private $conn;

    public function __construct(){
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
    }


    public function insert(){

        if(isset($_POST['submit'])){
            if(isset($_POST['name']) && isset($_POST['place']) && isset($_POST['birth'])){
                if(!empty($_POST['name']) && !empty($_POST['place']) && !empty($_POST['birth'])){
                    $name = $_POST['name'];
                    $place = $_POST['place'];
                    $birth = $_POST['birth'];

                    $query = "INSERT INTO student(Name, PlaceOfBirth, DateOfBirth) VALUES('$name','$place','$birth')";

                    if($sql = $this->conn->query($query)){
                        echo "<script>alert('records added successfully');</script>";
						echo "<script>window.location.href = 'index.php';</script>";
                    }

                }
            }
        }
    
    }

    public function fetch(){

        $data = null;

        $query = "SELECT * FROM student";

        if($sql = $this->conn->query($query)){
            while($row = mysqli_fetch_assoc($sql)){
                $data[] =$row;
            }
        }

        return $data;

    }

    public function delete($id){
        $query = "DELETE FROM student WHERE ID = '$id'";
        if($sql = $this->conn->query($query)){
            return true;
        }
        else{
            return false;
        }
    }

    public function update($id){
        if(isset($_POST['update'])){


            $name = $_POST['name'];
            $place = $_POST['place'];
            $date = $_POST['date'];
            $query = "update student set Name='$name', PlaceOfBirth='$place', DateOfBirth='$date' where ID = '$id'";
    
            if($sql = $this->conn->query($query)){

                header('location: update.php?ID=$id');

            }    
        }
    }

    public function search(){
        if(isset($_POST['submitt']))
        {

            $birthplace = $this->conn->$this->mysqli->real_escape_string($_POST['opt']);
                
            $query = "SELECT * FROM student WHERE PlaceOfBirth = '$birthplace'";

            if($data = $this->conn->query($query)){
                return $data;
            }
        }
        
    }

}


?>