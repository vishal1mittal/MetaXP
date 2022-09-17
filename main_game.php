<?php
require 'db_data.php';
if(!isset($_SESSION['Id'])){    
    header("location: index.php");
    exit();
}

?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>


function executeQuery() {
    $.ajax({
    url: 'Recurring_Data.php',
    success: function(data) {
        const myArray = data.split(",");
        for (i=0;i<myArray.length+1;i++) { 
            changeState(myArray[i]);
        }
    }
  });
    updateCall();
}

function updateCall(){
setTimeout(function(){executeQuery()}, 50);
}

$(document).ready(function() {
  executeQuery();
});
</script>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Game</title>
    <link rel="stylesheet" href="style.css">
    <script src="js.js"></script>
</head>
<body id="main_game_body">
    <h1>Name:&nbsp<?php echo ucfirst($_SESSION['UName']) ?></h1>
    <h1>Room Id:&nbsp<?php echo $_SESSION['Id'] ?></h1>
    <div id="Cards">
        <div id="Card1">
            <img src="Img/card1.png" alt="10 Of Heart" id="img_card1">
        </div>
        <div id="Card2">
            <img src="Img/card2.png" alt="Jack of Hearts" id="img_card2">
        </div>
        <div id="Card3">
            <img src="Img/card3.png" alt="Queen of Hearts" id="img_card3">
        </div>
        <div id="Card4">
            <img src="Img/card4.png" alt="King of Hearts" id="img_card4">
        </div>
        <div id="Card5">
            <img src="Img/card5.png" alt="Ace Of Heart" id="img_card5">
        </div>
    </div>
</body>
</html>
<script>
document.getElementById("img_card1").addEventListener("click", card1_change);
document.getElementById("img_card2").addEventListener("click", card2_change);
document.getElementById("img_card3").addEventListener("click", card3_change);
document.getElementById("img_card4").addEventListener("click", card4_change);
document.getElementById("img_card5").addEventListener("click", card5_change);
function changeState(item){    
    if(item == "" || item == 0){}
    else{
        switch (item) {
            case '1':
                document.getElementById('img_card1').onclick = function(){ alert('Card Already Selected')}; 
                document.getElementById('img_card1').src = 'Img/switch_card1.png';
                document.getElementById('img_card1').removeEventListener('click', card1_change);
                break;
            case '2':
                document.getElementById('img_card2').onclick = function(){ alert('Card Already Selected')}; 
                document.getElementById('img_card2').src = 'Img/switch_card2.png';
                document.getElementById('img_card2').removeEventListener('click', card_2change);
                break;
            case '3':
                document.getElementById('img_card3').onclick = function(){ alert('Card Already Selected')}; 
                document.getElementById('img_card3').src = 'Img/switch_card3.png';
                document.getElementById('img_card3').removeEventListener('click', card3_change);
                break;
            case '4':
                document.getElementById('img_card4').onclick = function(){ alert('Card Already Selected')}; 
                document.getElementById('img_card4').src = 'Img/switch_card4.png';
                document.getElementById('img_card4').removeEventListener('click', card4_change);
                break;
            case '5':
                document.getElementById('img_card5').onclick = function(){ alert('Card Already Selected')}; 
                document.getElementById('img_card5').src = 'Img/switch_card5.png';
                document.getElementById('img_card5').removeEventListener('click', card5_change);
                break;
            case '6':
                document.getElementById('img_card6').onclick = function(){ alert('Card Already Selected')};  
                document.getElementById('img_card6').src = 'Img/switch_card6.png';
                document.getElementById('img_card6').removeEventListener('click', card6_change);
                break;
        }
    }

}
</script>
<?php


?>