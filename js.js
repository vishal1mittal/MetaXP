function card1_change() {
    ajaxAddCard(1);
    
}

function card2_change() {
    ajaxAddCard(2);
}

function card3_change() {
    ajaxAddCard(3);
}

function card4_change() {
    ajaxAddCard(4);
}

function card5_change() {
    ajaxAddCard(5);
}

function ajaxAddCard(card_num) {
    $.ajax({  
        type: 'POST',  
        url: 'db_data.php', 
        data: {val: card_num},
        success: function(response) {
            //alert(response);
            if(response == "You Have Already Selected Your Card."){
                alert("You Have Already Selected Your Card.");
                return;
            }
            document.getElementById("img_card"+card_num).src = "Img/switch_card"+card_num+".png";
        }
    });
}