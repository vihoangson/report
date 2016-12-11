
		  $(".btncity").change(function() {
			  $(".btnward").find('option').not(':first').remove();
			  $.post(__URL + '/Quanglykho/ccity',{id:$(this).val()},
				function(data,status){
					$(".btnward").append(data);
					//window.alert(data);
				}
			  );
		  });


				function myFunction(v) {
					$("#"+v).dialog();
				}
				function myFunctionClose(v) {
					$("#"+v).dialog("close");
				}
		
				$( "#adap" ).click(function() {
				  $( "#fdap" ).submit();
				});
				
				$( "#adatopic" ).click(function() {
				  $( "#fdatopic" ).submit();
				});
