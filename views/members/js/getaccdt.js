$(document).ready(function (e) {
	$('#dynamicfrm').on('submit', function (e) {
		//e.preventDefault();
		var errlabel = $("label:visible[class=error]").length;
		//console.log(errlabel);
		if(errlabel == 0){
			$("#overlay").css("display", "block");
		}
		var ifr = $(parent.document).find('#helpframe')[0];
		var newifrheight = ifr.contentWindow.document.body.scrollHeight;
		ifr.style.height = newifrheight + "px";
		//console.log(newifrheight);

	});

	var status = $('#xstatus').val();
	//debugger;
	//console.log(name);
			if(status != null && status != ''){
				var icon = 'error';
				var title = status;
				if(status == 'saved'){
					 icon = 'success';
					 title = 'Save Sucessfully';
				}else if(status == 'edited'){
					 icon = 'success';
					 title = 'Edit Sucessfully';
				}
				Swal.fire({
					icon: icon,
					title: title
				})
			}

		var perzila = baseuri+"depositentry/getdoctype/DISTRICT";
		$("#xperzila").attr("onChange", "getperdistrict(this.value)");
		$("#xprezila").attr("onChange", "getpredistrict(this.value)");
		var $perzila = $("#xperzila");
		var $prezila = $("#xprezila");
		$.get(perzila, function(o){
			for(var i = 0; i < o.length; i++){ 					
				$perzila.append($('<option>', {value: o[i].xcode, text: o[i].xcode}));
				$prezila.append($('<option>', {value: o[i].xcode, text: o[i].xcode}));
			}
		}, 'json');
		

});

function getperdistrict(val) {
	$('#xperthana').find("option").remove();
	var url = baseuri+"depositentry/getdoctype/"+val;
			
		var $this = $("#xperthana").append($('<option>', {text: 'Select Thana'}));;
			$.get(url, function(o){ 
				for(var i = 0; i < o.length; i++){
						$this.append($('<option>', {value: o[i].xcode, text: o[i].xcode}));
				}
		}, 'json');
}

function getpredistrict(val) {
	$('#xprethana').find("option").remove();
	var url = baseuri+"depositentry/getdoctype/"+val;
			
		var $this = $("#xprethana").append($('<option>', {text: 'Select Thana'}));;
			$.get(url, function(o){ 
				for(var i = 0; i < o.length; i++){
						$this.append($('<option>', {value: o[i].xcode, text: o[i].xcode}));
				}
		}, 'json');
}