<?php
    require_once "response.php";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "12345678";
    $db_name = "test";

    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $request_data = json_decode(file_get_contents("php://input"));
    $data=array();
    if($request_data->action=="insert"){
        $data=array(":fname"=>$request_data->fname , ":lname"=>$request_data->lname, ":birthday"=>$request_data->birthday, ":email"=>$request_data->email);
        $query= "INSERT INTO employees (fname,lname,birthday,email) VALUES(:fname,:lname,:birthday,:email)";
        $stmt = $conn->prepare($query);
        $stmt->execute($data);
        $output = array("message"=>"insert Complete");
        echo json_encode($output);
    }
    if($request_data->action=="getAll"){
        $query= "SELECT * FROM employees";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $data[]=$row;
        }
        
        echo json_encode($data);
    }
    if($request_data->action=="geteditUser"){
        $query= "SELECT * FROM employees WHERE id = $request_data->id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $data['id']=$row['id'];
            $data['fname']=$row['fname'];
            $data['lname']=$row['lname'];
            $data['birthday']=$row['birthday'];
            $data['email']=$row['email'];
        }
        echo json_encode($data);
    }
    if($request_data->action=="update"){
        $data=array(":fname"=>$request_data->fname , ":lname"=>$request_data->lname , ":birthday"=>$request_data->birthday , ":email"=>$request_data->email,":id"=>$request_data->id);
        $query= "UPDATE employees SET fname=:fname , lname=:lname , birthday=:birthday , email=:email WHERE id=:id";
        $stmt = $conn->prepare($query);
        $stmt->execute($data);
        $output = array("message"=>"Update Complete");
        echo json_encode($output);
    }
    if($request_data->action=="getdeleteUser"){
        $query= "DELETE  FROM employees WHERE id = $request_data->id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $output = array("message"=>"Delete Complete");
        echo json_encode($output);
    }
?>