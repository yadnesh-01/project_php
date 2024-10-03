<?php
    session_start();

    $servername="localhost";
    $username="root";   
    $password="";
    $dbname="rest_book";

    $conn= new mysqli($servername,$username,$password,$dbname);
    // Check connection
    if ($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }


    //taking inputs

    if(isset($_POST['login_btn'])){
        $ruid = $_POST['ruid'];
        $rpass= $_POST['rpass'];

        //sql query to check

        $sql="Select * from restinfo where ruid= ? AND rpass= ?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ss", $ruid, $rpass);
        
        
        //catching sql prepration errors
        if($stmt==false){
            die("Error Preparing Statement : ".$conn->error);
        }

        //identyfying issues during query execution and preventing silent failuer
        if(!$stmt->execute()){
            die("Eror making query: ".$stmt->error);
        }

        $result= $stmt->get_result();

        if($result == false){
            die("Error fetching data: ".$conn->error);
        }

        // for successful login

        if($result->num_rows>0){
            $row = $result->fetch_assoc();  //fetch a single row from the result set of a query and return it as an associative array.
            $_SESSION['authenticated']= true;
            $_SESSION['rname'] = $row['rname'];
            $_SESSION['rcontact'] = $row['rcontact'];
            header("Location: dashboard.php");
            exit();

        }else{
            echo "<script> alert('Wrong User-Id or Password ! '); window.location.href='login.php';</script>";
            exit();
        }

    }
    $stmt->close();
    $conn->close();
?>