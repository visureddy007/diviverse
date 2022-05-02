/*var site_url = window.location.protocol+'://'+window.location.hostname;*/
var site_url = window.location.origin+'/diviverse';
function goTop(){
	 $('body, html').animate({scrollTop: $("#app").offset().top	});
}

function ajxReq(url,data,type,dataType){
	return $.ajax({
		url:url,
		data:data,
		type:type,
		dataType:dataType,
		success:function(res){
			debugger;
			return res;
		}
	});	
}
function setcst(c){
	$("#cstn").val(c.cstn);
	$("#cstv").val(c.cstv);
}	
