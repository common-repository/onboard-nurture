jQuery(document).ready(function($){

	$('#publishNurture').click(function(){
		var nurture_nav_address1 = $('#nurture_nav_address1').val();
		var nurture_nav_address2 = $('#nurture_nav_address2').val();
		var nurture_nav_zip = $('#nurture_nav_zip').val();
		var nurture_bar_text = $('#nurture_bar_text').val();

		var error = 0;
		
		if(nurture_nav_address1 == ""){
			$('#nurture_nav_address1_err').text('This field is required');
			error++;
		}else if(nurture_nav_address1 !== ''){
			$('#nurture_nav_address1_err').text('');
		}
		
		if(nurture_nav_address2 == ""){
			$('#nurture_nav_address2_err').text('This field is required');
			error++;
		}else if(nurture_nav_address2 !== ''){
			$('#nurture_nav_address2_err').text('');
		}
		
		if(nurture_nav_zip == ""){
			$('#nurture_nav_zip_err').text('This field is required');
			error++;
		}else if(nurture_nav_zip !== ''){
			$('#nurture_nav_zip_err').text('');
		}
		
		if(nurture_bar_text == ""){
			$('#nurture_bar_text_error').text('This field is required');
			error++;
		}else if(nurture_bar_text !== ''){
			$('#nurture_bar_text_error').text('');
		}
		
		if(error > 0){
			return false;
		}else{
			return true;
		}
		
	});

});
function copy_nurture(element_id){
	
	var aux = document.createElement("div");
	aux.setAttribute("contentEditable", true);
	aux.innerHTML = document.getElementById(element_id).innerHTML;
	aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
	document.body.appendChild(aux);
	aux.focus();
	document.execCommand("copy");
	document.body.removeChild(aux);
	//var link = document.createElement("a");
	document.getElementById('copybtn').innerHTML ='Copied';
	return false;

}