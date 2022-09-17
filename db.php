<?php
require 'db_data.php';
if(isset($_POST['join'])){
    $result = getData($con, $_POST['Room_Id']);
    if($result){
        if(!array_search($_POST['Name'], explode(",",$result['Player_Array']))){
            if($result['Total_Players']>=5){
                header("location: index.php?Full");
                exit();
            }   
            setData($con,$result['Id'],$result['Names'].','.$_POST['Name'],($result['Total_Players']+1),($result['Player_Array'].','.$_POST['Name'].','. ($result['Total_Players']+1) .',0'));
            $result = getData($con, $_POST['Room_Id']);
        }
        $_SESSION['Id'] = $result['Id'];
        $_SESSION['Names'] = $result['Names'];
        $_SESSION['UName'] = $_POST['Name'];
        $_SESSION['Total_Players'] = $result['Total_Players'];
        $_SESSION['Player_Array'] = explode(",",$result['Player_Array']);
        $_SESSION['Card_Used'] = explode(",",$result['Cards_Used']);
        header("location: main_game.php?Successful");
        exit();
    }
    else{
        header("location: index.php?Room_Not_Found");
        exit();
    }
}

elseif(isset($_POST['create'])){
    if(insertData($con,$_POST['Name'],1,array($_POST['Name'],1,0))){
        $result = getAllData($con);
        $result = $result[count($result)-1];
        if($result){    
            $_SESSION['Id'] = $result['Id'];
            $_SESSION['Names'] = $result['Names'];
            $_SESSION['UName'] = $_POST['Name'];
            $_SESSION['Total_Players'] = $result['Total_Players'];
            $_SESSION['Player_Array'] = explode(",",$result['Player_Array']);
            $_SESSION['Card_Used'] = explode(",",$result['Card_Used']); 
            header("location: main_game.php?Successful");
            exit();
        }
        else{
            header("location: index.php?Server_Error");
            exit();
        }
    }
    else{
        header("location: index.php?Not_Successful");
        exit();
    }
}
else{
    header("location: index.php");
    exit();
}
?>