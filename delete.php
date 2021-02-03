<?php

    include 'conn.php';

    $model = new Model();

    $id = $_REQUEST['ID'];

    $delete = $model->delete($id);

    if($delete){
        header('location: index.php');
    }
?>
