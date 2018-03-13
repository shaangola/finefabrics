var thePrevRow="";
var thePrevClass="";


function ChangeGridCSS(theRow,theClass){
 if(thePrevRow==""){
      theRow.className="current_Row";
      thePrevRow=theRow;
      thePrevClass=theClass;
  }
  else{
      thePrevRow.className=thePrevClass;
      theRow.className="current_Row";
      thePrevRow=theRow;
      thePrevClass=theClass;
  }
}

function mouseMove(theRow,theClass){
	theRow.className="temp_Row";	
}
function mouseOut(theRow,theClass){
	 if(thePrevRow == theRow){
		 theRow.className="current_Row";
	 }
	 else{
		theRow.className=theClass; 
	 }
}

function datediff(smalld,bigd){
    var ONE_DAY=(1000*60*60*24); 

	var sd=smalld.split('/');
	var fdate=new Date(sd[1]+'/'+sd[0]+'/'+sd[2]);
	var bd=bigd.split('/');
	var tdate=new Date(bd[1]+'/'+bd[0]+'/'+bd[2]);
	var date1_ms = fdate.getTime()
	var date2_ms = tdate.getTime()
	var difference_ms = (date2_ms - date1_ms);
	return (parseInt(difference_ms/ONE_DAY));
}
function rm_trim(inputString)
{
	if (typeof inputString != "string") { return inputString;}
	var temp_str = '';
	temp_str = inputString.replace(/[\s]+/g,"");
	if(temp_str == '')
		return "";
	
	var retValue = inputString;
	var ch = retValue.substring(0, 1);
	while (ch == " "){
		retValue = retValue.substring(1, retValue.length);
		ch = retValue.substring(0, 1);
	}
	ch = retValue.substring(retValue.length-1, retValue.length);
	while (ch == " "){
		retValue = retValue.substring(0, retValue.length-1);
		ch = retValue.substring(retValue.length-1, retValue.length);
	}
	while (retValue.indexOf("  ") != -1){
	  retValue = retValue.substring(0, retValue.indexOf("  ")) + retValue.substring(retValue.indexOf("  ")+1, retValue.length);
	}
	return retValue;
}
function emailValidator(elem){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.match(emailExp)){
		return true;
	}else{
		return false;
	}
}
function onChangeFilter(theValue){
		if(theValue=="")
			SHSDiv("ffieldtd","none");
		else
			SHSDiv("ffieldtd","block");
}


function showfilter(){
	SHSDiv("filtertxtdiv","none");
	SHSDiv("filterfielddiv","block");
	//SHSDiv("filtertxttr","block");
	$("#filtertxttr td").each(function(){ $(this).show();});
									   	
}

function hidefilter(){
	SHSDiv("filtertxtdiv","block");
	SHSDiv("filterfielddiv","none");
	//SHSDiv("filtertxttr","block");
	$("#filtertxttr td").each(function(){ $(this).hide();});
									   	
}

function removefilter(){
	SHSDiv("filtertxtdiv","block");
	SHSDiv("filterfielddiv","none");
	$("#filtertxttr td").each(function(){ $(this).hide();});
									   	
}



function SHSDiv(did,act){
	if(document.getElementById(did)){
		var sdivObject=document.getElementById(did);
		sdivObject.style.display=act;
	}
}
//****************** select list value ***********
function select_options(objSel,val) {
	for (var i = 0; i < objSel.length; i++) {
		if(objSel.options[i].value == val){	
		    objSel.options[i].selected = true;
		}
	}
}

function removeFilter(){
		select_options(document.getElementById('fcond'),'');
}

function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
//alert(unicode);
if (unicode!=9 && unicode!=8 && unicode!=37 && unicode!=39 ){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}

function amountonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
//alert(unicode);
	if (unicode!=9 && unicode!=8 && unicode!=37 && unicode!=39 && unicode!=46){ //if the key isn't the backspace key (which we should allow)
		if (unicode<48||unicode>57) //if not a number
			return false //disable key press
	}
}

function cmd_delete(val){
	var x=confirm("Are you sure you want to delete "+val+" ?");
	if(x)
		return true
	else 
		return false
}
function clear_form_elements(frm) {
	var ele=$('#'+frm);
    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}
function hideLevel(id)
 {
	 //alert(id);
 	$('#lbl_'+id).html("");
	$('#lbl_'+id).hide();
 }
 function getAjxResp(divid,url){ 
	$('#loadingdiv').addClass("LockOn");
	$('#'+divid).show();
	//$('#ack_div').hide();
	//alert(url);
	$.post(url,
	function(data){ //alert(data);
		$('#'+divid).html(data);
		$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
	});
}

 function getAjxRespMD(divid1,divid2,url){ 
	$('#loadingdiv').addClass("LockOn");
	$('#'+divid1).show();
	$('#'+divid2).show();
	//$('#ack_div').hide();
	//alert(url);
	$.post(url,
	function(data){ //alert(data);
		$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
		var sresp=data.split('#@#');
		if(sresp[0]=="1"){
			$('#'+divid1).html(sresp[1]);
			$('#'+divid2).html(sresp[2]);
			if(sresp.length==4){$('#materialdiv').html(sresp[3]);}
			$(".btnDelete").bind("click", Delete);
		}
		else{
			
		}
		
	});
}

 function changeCategory(url){ 
	$('#loadingdiv').addClass("LockOn");
	$('#subcatdiv').show();
	$('#braddiv').show();
	$('#itemdiv').show();
	//alert(url);
	$.post(url,
	function(data){ //alert(data);
		$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
		var sresp=data.split('#@#');
		if(sresp[0]=="1"){
			$('#subcatdiv').html(sresp[1]);
			$('#braddiv').html(sresp[2]);
			$('#itemdiv').html(sresp[3]);
			$("#attributespan").html('');
		}
		else{
			alert(data);
		}
		
	});
}

function changeSubCategory(url){
	$('#loadingdiv').addClass("LockOn");
	$('#braddiv').show();
	$('#itemdiv').show();
	//alert(url);
	$.post(url,
	function(data){ //alert(data);
		$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
		var sresp=data.split('#@#');
		if(sresp[0]=="1"){
			$('#itemdiv').html(sresp[1]);
			$('#braddiv').html(sresp[2]);
			$("#attributespan").html('');

		}
		else{
			alert(data);
		}
		
	});
}

function checkAll(p_chk,c_chk){
	  $('.'+c_chk).attr('checked',p_chk.checked);
}
function checkAll_M(p_chk,c_chk){
	 var ele=$('#frm_assingpriv');
    $(ele).find(':input').each(function() {
		if(this.type=="checkbox" && $(this).attr('alt')==c_chk){
			$(this).attr('checked',p_chk.checked);		
		}
	});
}


function chkselection()
{
	if (document.frm_sendtocompany.master.checked==true)
	for (i=0; i<document.frm_sendtocompany.elements.length;i++)
	{
		document.frm_sendtocompany.elements[i].checked=true
	}
	if (document.frm_sendtocompany.master.checked==false)
	for (i=0; i<document.frm_sendtocompany.elements.length;i++)
	{
		document.frm_sendtocompany.elements[i].checked=false
	}
}

function selectAllChecbox(chb,theForm){ 
	if (document.getElementById(chb).checked){
		for (i=0; i<document.getElementById(theForm).elements.length;i++){
			document.getElementById(theForm).elements[i].checked=true
		}
	}
	else{
		for (i=0; i<document.getElementById(theForm).elements.length;i++){
			document.getElementById(theForm).elements[i].checked=false
		}
	}
}


function isCheckDynamic(theForm,checkbox){
	var chks = document.getElementsByName(checkbox+'[]');
	var hasChecked = false;
	var rval=true;
	for (var i = 0; i < chks.length; i++){
		if (chks[i].checked){
			hasChecked = true;
			break;
		}
	}
	if (hasChecked == false){
		alert("Please tick at least one checkbox");
		rval= false;
	}
	else{
		var x=confirm("Are you sure you want to perform this task ?");
		if(x){ rval= true;	}
		else { rval= false	}
	}
	return rval;
}

function chkYesNo(theobj,divid){ 
		if( $(theobj).val()=="NO" ){ $("#"+divid).show("slow"); }
		else{ $("#"+divid).hide("slow"); }

}

//==================================format and valid time==============
function formatTime(dis,evnt){
	var charCode = (evnt.which) ? evnt.which : evnt.keyCode;
	if(dis.value!="" && charCode!=8 && charCode!=35 && charCode!=36 && charCode!=37 && charCode!=39){
		if(dis.value.length==2)
			dis.value+=":";
	}
}

function validTime(evnt){
	var charCode = (evnt.which) ? evnt.which : evnt.keyCode;
	if(charCode>=106 || charCode<=95 && (charCode!=8 && charCode!=13 && charCode!=9 && charCode!=46 ))
		return false;
	return true;
}

function backTime(dis){
	if(dis.value==""){
		var dt = new Date();
		var currHour = Number(dt.getHours()<=9)?"0"+dt.getHours():dt.getHours();
		var currMin = Number(dt.getMinutes()<=9)?"0"+dt.getMinutes():dt.getMinutes();
		dis.value=currHour+":"+currMin;
	}
	else{
		if(dis.value.length!=5){
			alert("Invalid Time..Use HH:MM(02:15) as 24Hr format");		
			dis.value="";
			dis.focus();
		}
		else{
			var parts=dis.value.split(":");
				if(IsNumeric(parts[0]) && IsNumeric(parts[1])){
					if(parts[0]>24 || parts[1]>59){
						alert("Invalid Time..Use HH:MM(02:15) as 24Hr format");		
						dis.value="";
						dis.focus();
					}	
				}
				else{
					alert("Invalid Time..Use HH:MM(02:15) as 24Hr format");		
					dis.value="";
					dis.focus();
				}	
		}
	}

}
function IsNumeric(input)
{
   return (input - 0) == input && input.length > 0;
}

function validateImage(Img)
{
	if((Img.toLowerCase().lastIndexOf(".jpg")==-1) && (Img.toLowerCase().lastIndexOf(".gif")==-1) && (Img.toLowerCase().lastIndexOf(".pjpeg")==-1) && (Img.toLowerCase().lastIndexOf(".png")==-1)){
		return false;
	}
	else
	  return true;
}
function getsentFormData(formid,divid,url){ 
//	alert(url);
	$('#loadingdiv').addClass("LockOn");
	$.post(url,$("#"+formid).serialize(),function(data){ 
		//alert(data);
		$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
		$("#"+divid).html(data);
	});
	
	return false;
}

function getInvoice(formid,url){ 
//	alert(url+"&"+$("#"+formid).serialize());
	$('#loadingdiv').addClass("LockOn");
	$.post(url,$("#"+formid).serialize(),function(data){ 
	//	alert(data);
		$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
		var sresp=data.split("#@#");
		if(sresp[0]==0){
			alert(sresp[1])	
		}
		else if(sresp[0]==1){
			window.location.href=sresp[1];	
		}
		else{
			alert(data)	
		}
	});
	
	return false;
}


function getAJ(divid,url){ 
	$('#'+divid).show();
	$.post(url,
	function(data){
		$('#'+divid).html(data);
	});
}

//====================================Date Validation============================================
function formatDate(dis,evnt)
{
	var charCode = (evnt.which) ? evnt.which : evnt.keyCode;
	if(dis.value!="" && charCode!=8)
		{
		if(dis.value.length==2 || dis.value.length==5)
			dis.value+="/";
		}
}
//******************************************************************************************************

function validDate(evnt)
{
	var charCode = (evnt.which) ? evnt.which : evnt.keyCode;
	if(charCode>=65 && charCode<=90)
		return false;
	return true;
}
//*********************************************************************************
function clearDate(dis)
{
	if(dis.value=="DD/MM/YYYY")
		dis.value="";
}
//===========================================================================================
function backDate(dis)
{
	if(dis.value!=""){
		
		if(dis.value.length!=10)
			{
			alert("Invalid Date..Use DD/MM/YYYY(09/12/2008)");		
			dis.value="";
			dis.focus();
			}
		else
			{
			var parts=dis.value.split("/");
			var d = new Date(parts[2],parts[1]-1,parts[0]);
			if(!(d.getFullYear()==parts[2] && d.getMonth()==parts[1]-1 && d.getDate()==parts[0]))
				{
				alert("Invalid Date..Use DD/MM/YYYY(09/12/2008)");		
				dis.value="";
				dis.focus();
				return false;
				}	
			}
		
	}

}

function validatePWD(field, rules, i, options){
	var r_pwd =  field.val();
	var pwd =  $("#password").val();
	if((r_pwd!=pwd)){
		return "password not matched!";
	}
	else
	  return true;
}
function validateDDMMYYYY(datestr){
                var ddmmyyyyExp = /^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/;
                if(datestr.match(ddmmyyyyExp)){ return true; }
                else{ return false;}
}

function checkDate(field, rules, i, options){
	var r_file =  field.val();
	var parts=r_file.split("-");
	//var d = new Date(parts[2],(parts[1]-1),parts[0]);
	var dateDDMMYYYRegex = /^\d{2}\-\d{2}\-\d{4}$/; 
	
	if(!validateDDMMYYYY(r_file)){
		return "* Invalid date use (dd-mm-yyyy)";
	}
	else
	  return true;
}