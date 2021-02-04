<?php

class Database {

    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "web";
    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
    }


    public function insert($table_name, $data)  
    {  
        $string = "INSERT INTO ".$table_name." (";            
        $string .= implode(",", array_keys($data)) . ') VALUES (';            
        $string .= "'" . implode("','", array_values($data)) . "')";  
        if(mysqli_query($this->conn, $string))  
        {  
            return true;  
        }  
        else  
        {  
            echo mysqli_error($this->conn);  
        }  
    } 


    public function fetch($table_name){

        $array = array();  
        $query = "SELECT * FROM ".$table_name."";  
        $result = mysqli_query($this->conn, $query);  
        while($row = mysqli_fetch_assoc($result))  
        {  
            $array[] = $row;  
        }  
        return $array;

    }


    public function update($table_name, $fields, $where_condition)  
    {  
        $query = '';  
        $condition = '';  
        foreach($fields as $key => $value)  
        {  
            $query .= $key . "='".$value."', ";  
        }  
        $query = substr($query, 0, -2);  
        /*This code will convert array to string like this-  
        input - array(  
            'key1'     =>     'value1',  
            'key2'     =>     'value2'  
        )  
        output = key1 = 'value1', key2 = 'value2'*/  
        foreach($where_condition as $key => $value)  
        {  
            $condition .= $key . "='".$value."' AND ";  
        }  
        $condition = substr($condition, 0, -5);  
        /*This code will convert array to string like this-  
        input - array(  
            'id'     =>     '5'  
        )  
        output = id = '5'*/  
        $query = "UPDATE ".$table_name." SET ".$query." WHERE ".$condition."";  
        if(mysqli_query($this->conn, $query))  
        {  
            return true;  
        }  
    } 

    public function delete($table_name, $where_condition)  
    {  
        $condition = '';  
        foreach($where_condition as $key => $value)  
        {  
            $condition .= $key . " = '".$value."' AND ";  
             
            $condition = substr($condition, 0, -5);  
            $query = "DELETE FROM ".$table_name." WHERE ".$condition."";  
            if(mysqli_query($this->conn, $query))  
            {  
                    return true;  
            }  
        }  
    }

}
