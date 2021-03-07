<!DOCTYPE html>
<html>
 <head>
        <meta charset="utf-8">
        <title>Katalog</title>
	
    </head>
<body>

<div class="top">
    <form action="" method="" id="search_form">
      <input id="search_bar" type="text" placeholder="Suche" name="search" autocomplete="off">
	  <!-- <button type="" class="search_but"> → </button> -->
    </form>
	<button type="button" style="font-weight:bold;" id="toggle_help_but" onclick="activate_help()">Bessere Lesbarkeit! </button>
	<button type="button" style="font-weight:bold;" id="more_info_but" onclick="more_info()">Zusatzinformationen </button>
</div>


<div class="middle">

<p id="erg_header">Ergebnis</p>
<div id="search_cont">

</div>

<?php


/* 
function show_bookdetails($Buch_info,$book_number){
	
	echo "<p>Buch Informationen:</p>";
	//echo "<p>".implode("','",$Buch_info[$book_number])." </p>";
	echo $Buch_info[$book_number]['Produktcode'].", ";
	echo $Buch_info[$book_number]['Produktitel'].", ";
	echo $Buch_info[$book_number]['Autorname'].", ";
	echo $Buch_info[$book_number]['Verlagsname'].", ";
	echo $Buch_info[$book_number]['PreisBrutto']."€, ";
	echo $Buch_info[$book_number]['Kurzinhalt'];
	
} */

function search( $search_term){ 
	
	//echo $search_term;
	
}

?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript"> 
var search_erg;

function activate_help(){
	
	$("*").css("font-size","25px");

}
function more_info(){
	
	$(".more_info_col").fadeIn("slow");

}

$('#search_bar').submit(function(e){
	e.preventDefault();
	$.ajax({
		url: 'search_result.php',
		type: 'post',
		data:$('#search_bar').serialize(),
		success:function(data){
			
			search_erg= JSON.parse(data);
			append_info(search_erg);
			
		}
	});
});

function append_info(append_data){
	
	clear_search_erg()
	for(i=0;i<append_data.length;i++){
		
		$.each(append_data[i], function( key, value) {
			
			
			if(key == 'Produktitel' || key =="PreisNetto" ||key == "Mwstsatz" || key == "PreisBrutto"|| key == "Lagerbestand" || key == "Kurzinhalt" ||key == "Gewicht"){
				if(key == "Produktitel"){
					
					$("#search_cont").append("<a id='book_link_"+String(i)+"' href='?showdetails="+String(i)+"'>"+key +": "+value+" </a>");
				}
				else{
					$("#search_cont").append("<p class='more_info_col' style='display: none' >"+key +": "+value+"</p>")
				}
			}
			
			else{
				$("#search_cont").append("<p>"+key +": "+value+"</p>");
			}
		})
		
		$("#search_cont").append("<br>");
	}
}

function clear_search_erg() {
		
	$("#search_cont").empty();
	
}
$("#search_bar").keyup( function() {
	
	clear_search_erg()
    var searchQuery = $("#search_bar").val();
    $.ajax({
		url: 'search_result.php',
		type: 'post',
		data:$('#search_bar').serialize(),
		success:function(data){
			
			search_erg= JSON.parse(data);
			append_info(search_erg);
			
		}
	
});
});

	
</script> 

</body>
</html>




