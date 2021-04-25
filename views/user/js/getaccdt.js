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

});

$(function(){

	var zrole = baseuri+"user/getRoles";
	
	var $zrole = $("#zrole")
	$.get(zrole, function(o){
		for(var i = 0; i < o.length; i++){ 					
			$zrole.append($('<option>', {value: o[i].zrole, text: o[i].zrole}));
		}
	}, 'json');

	var xbranch = baseuri+"user/getdoctype/Branch";
	
	var $xbranch = $("#xbranch")
	$.get(xbranch, function(o){
		for(var i = 0; i < o.length; i++){ 					
			$xbranch.append($('<option>', {value: o[i].xcode, text: o[i].xcode}));
		}
	}, 'json');
	//console.log(appe);
});