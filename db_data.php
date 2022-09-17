<?php
session_start();
$ServerName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "metaxp";

$con = mysqli_connect($ServerName, $dbUserName, $dbPassword, $dbName);

if (!$con){
    die("connection Failed: " . mysqli_connect_error());
}

function getAllData($con){
    $sql = "SELECT * FROM `games`;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: index.php?Error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resutData = mysqli_stmt_get_result($stmt);
        $solution = array();
        while ($row = mysqli_fetch_assoc($resutData))
            {
                #print_r($row);
                array_push($solution,$row);
            }
        if($solution){
            mysqli_stmt_close($stmt);
            return $solution;
        }
        else{
            mysqli_stmt_close($stmt);
            $result = false;
            return $result;
        }
        
}

function getData($con, $val){
    $sql = "SELECT * FROM `games` WHERE `Id` = ?;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: index.php?Error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i", $val);
        mysqli_stmt_execute($stmt);

        $resutData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resutData)){
            mysqli_stmt_close($stmt);
            return $row;
        }
        else{
            mysqli_stmt_close($stmt);
            $result = false;
            return $result;
        }
        
}

function setData($con, $id, $name, $totplayer, $playerarr){
    $sql = "UPDATE `games` SET `Names`=?,`Total_Players`=?,`Player_Array`=? WHERE `Id` = ?";         
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: index.php?Error=error");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sisi", $name, $totplayer, $playerarr, $id);
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        return true;
    }
    else{
        mysqli_stmt_close($stmt);
        return false;
    }
}

function setData2($con, $id, $name, $totplayer, $playerarr, $Card_Used){
    $sql = "UPDATE `games` SET `Names`=?,`Total_Players`=?,`Player_Array`=?,`Cards_Used`=? WHERE `Id` = ?";         
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: index.php?Error=error");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sissi", $name, $totplayer, implode(",",$playerarr), implode(",",$Card_Used), $id);
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        return true;
    }
    else{
        mysqli_stmt_close($stmt);
        return false;
    }
}


function insertData($con, $name, $totplayer, $playerarr){
    $sql = "INSERT INTO `games`(`Names`, `Total_Players`, `Player_Array`) VALUES (?,?,?)";         
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: index.php?Error=error");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sis", $name, $totplayer, implode(",",$playerarr));
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        return true;
    }
    else{
        mysqli_stmt_close($stmt);
        return false;
    }
    
}

if(isset($_POST['val'])){
    $cardUsed = '';
    $user_card = [array_search($_SESSION['UName'], $_SESSION['Player_Array'])+2];
    for($i=0; $i<count($_SESSION['Player_Array']);$i++){
        if($i%3 === 0){
            $cardUsed = $cardUsed.','.$i;
        }
    }
    if($_SESSION['Player_Array'][$user_card[0]]>0){
        print("You Have Already Selected Your Card.");
    }
    else{
        $_SESSION['Player_Array'][$user_card[0]] = $_POST['val'];
        array_push($_SESSION['Card_Used'],$_POST['val']);
        print_r($_SESSION['Card_Used']);
    setData2($con,$_SESSION['Id'],$_SESSION['Names'],$_SESSION['Total_Players'],$_SESSION['Player_Array'],$_SESSION['Card_Used']);
    }
}

?>