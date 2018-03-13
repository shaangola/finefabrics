jQuery(document).ready(function () {
		
	$('#subs_lbform').on('submit',function(){
		$('#ackdiv').html("Please wait...");
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: form.attr('method'),
			data: form.serialize(),
			success: function (data) { 
				//$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
				//alert(data);
				if(isJSON(data)){
					var dataArray=jQuery.parseJSON(data);
					if(dataArray.status=='1'){ 
						$('#ackdiv').html(dataArray.message);
						clear_form_elements(form.attr('id'));
					}
					else{
						$('#ackdiv').html(dataArray.message);
					}
				}
				else{
					$('#ackdiv').html(data);
				} 
			},
			error: function (xhr, err) { 
				//$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
				$('#ackdiv').html(err);
				
			}
		});
	
		return false;   
	});
	
	$('#frmunsubscribe').on('submit',function(){
		$('#loadingdiv').addClass("LockOn");
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: form.attr('method'),
			data: form.serialize(),
			success: function (data) { 
				$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
				//alert(data);
				if(isJSON(data)){
					var dataArray=jQuery.parseJSON(data);
					if(dataArray.status=='1'){ 
						$('#unsubscribediv').html(dataArray.message);
						
					}
					else{
						$('#ackdiv').html(dataArray.message);
					}
				}
				else{
					$('#ackdiv').html(data);
				} 
			},
			error: function (xhr, err) { 
				//$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
				$('#ackdiv').html(err);
				
			}
		});
	
		return false;   
	});
	
	 $('#subsfooter_form').on('submit',function(){ 
		$('#fackdiv').html("Please wait...");
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: form.attr('method'),
			data: form.serialize(),
			success: function (data) { 
				//$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
				//alert(data);
				if(isJSON(data)){
					var dataArray=jQuery.parseJSON(data);
					if(dataArray.status=='1'){ 
						$('#fackdiv').html(dataArray.message);
						clear_form_elements(form.attr('id'));
					}
					else{
						$('#fackdiv').html(dataArray.message);
					}
				}
				else{
					$('#fackdiv').html(data);
				} 
			},
			error: function (xhr, err) { 
				//$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
				$('#fackdiv').html(err);
				
			}
		});
	
		return false;   
	});
	 
	
	 
	 
});



function isJSON(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function clear_form_elements(frm) {
	var ele=$('#'+frm);
    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'email':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}

function reloadCaptcha (captchaid,abspath,file) {
    $('#'+captchaid).attr('src', abspath+''+file+'');
    //(new Date).getTime()  return timestamp in milliseconds, so we can make sure that image won't be in browsers cache
}