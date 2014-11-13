
$('select[name=price]').change(function () {
	$('#filter').submit();
	/*
	jQuery.ajax({
         url:    'customer-inventory-list.php?' 
                  + 'price=' + $( "#filter_price option:selected").val(),
         success: function(result) {
                      if(result.isOk == false)
                          alert(result.message);
                  },
         async:   false
    }); 
	*/
  });
  
$('select[name=category]').change(function () {
	$('#filter').submit();
	/*
	jQuery.ajax({
         url:    'customer-inventory-list.php?' 
                  + 'price=' + $( "#filter_price option:selected").val(),
         success: function(result) {
                      if(result.isOk == false)
                          alert(result.message);
                  },
         async:   false
    }); 
	*/
  });
  
 $(function() {
	$('#alertMe').click(function(e){
		e.preventDefault();
		alert('hi');
		$('#successAlert').slideDown());
	});
 
 });
  
  
  
  
  
$('form#sign-up').submit(function () {
	
	if ($('form#sign-up input[name=item\\[username\\]]').val().length = 0 ){
		alert("Username can't be blank");
		return false;
	}
	
	if ($('form#sign-up input[name=item\\[fname\\]]').val().length = 0 ){
		alert("First name can't be blank");
		return false;
	}
	
	if ($('form#sign-up input[name=item\\[lname\\]]').val().length = 0 ){
		alert("Last name can't be blank");
		return false;
	}
	
	if ($('form#sign-up input[name=item\\[email\\]]').val().length = 0 ){
		alert("Email can't be blank");
		return false;
	}
	
	
	if ($('form#sign-up input[name=item\\[password\\]]').val().length < 3){
		alert("Length of password should be greater than 3");
		return false;
	}
	
	if ($('form#sign-up input[name=item\\[password\\]]').val() != $('form#sign-up input[name=item\\[password_confirmation\\]]').val()){
		alert("Passwords do not match.");
		return false;
	}
	return true;
});