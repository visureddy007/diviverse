$(document).ready(function(){	
	$("#signin_form").validate({
		rules:{
	        name:{
				required:true
			},
	        password:{
				required:true
			}
		},
		messages:{
			name:'Please enter username',
			password:'Please enter password',
		},
		submitHandler:function(form){
			var fdata = $(form).serialize();
			var action = site_url+'/Login/validate';
			$.ajax({
				url:action,
				data:fdata,
				type:'post',
				success:function(res){					
					var j=JSON.parse(res);		
					setcst(j.cst);
					if(j.status==1){						
						$("#signin_form").find("input[type=email],input[type=password]").val("");
						$("#signin_msg").html(j.msg);
					  window.location=j.url;
					}else if(j.status==0){							
						$("#signin_msg").html(j.msg);
					}
					
				}
			});
			return false;
		}
	});
});

