var cstn ='';var cstv =''; 
var extraData ={};
$(document).ready(function(){
	
   $("#diviverse_form").validate({
		submitHandler:function(form){	
		cstn = $("#cstn").val();
		cstv = $("#cstv").val();
		extraData[cstn]=cstv;
		$(form).ajaxSubmit({
				data:extraData,
				beforeSend: function() {	
					debugger;
				},
				uploadProgress: function(event, position, total, percentComplete) {
					debugger;						
				},
				success: function() {
						debugger;						
				},
				complete: function(xhr) {
					var j = JSON.parse(xhr.responseText);
					setcst(j.cst);
					$("#msg").html(j.msg);		
					/*goTop();*/	
					if(j.status){					
						$("#avanti_form").find("input[type=text],input[type=email],input[type=password]").val("");
						$("#msg").html(j.msg);
						if(j.url!=undefined && j.url!=''){
							window.location=j.url;							
						}
					}else{
						$("#msg").html(j.msg);
					}
				}
			}); 
			return false;
		}
	});

	 
		
  $(document).on("click", ".del", function () {
	var i = $(this).data("i");
    var t = $(this).data("t");
    var c = $(this).data("c");
    if (
      i != "" &&
      i != undefined &&
      t != "" &&
      t != undefined &&
      c != "" &&
      c != undefined
    ) {
      Swal.fire({
        title: 'Are you sure, want to delete "' + t + '" ?',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: `Delete`,
        denyButtonText: `Close`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          var data = { i: i };
          var req = ajxReq(site_url + "/" + c + "/del", data, "POST", "json");
          req.done(function (res) {
            if (res.success) {
              table.ajax.reload(null, false);
              new PNotify({
                title: res.msg,
                type: "success",
                top: "500px",
                delay: 3000,
              });
            }
          });
          //Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
          Swal.fire("Changes are not saved", "", "info");
        }
      });
    }
  });
		
		
});

