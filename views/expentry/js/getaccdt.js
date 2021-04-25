$(document).ready(function (e) {
	$('#dynamicfrm').on('submit', function (e) {
		//e.preventDefault();
		var errlabel = $("label:visible[class=error]").length;
		//console.log(errlabel);
		if(errlabel == 0){
			$("#overlay").css("display", "block");
		}
		var ifr = $(parent.document).find('#helpframe')[0];
		var newifrheight = ifr.contentWindow.document.body.scrollHeight + 148;
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


$(".number").focus(function() {
    if ($(this).val() == "0.00")
		$(this).val("")
}).blur(function() {
    if ($(this).val() == "")
		$(this).val("0.00")
})

$('#xmember').blur(function(){
	var ele = $(this).val().split("~");
	$('#xmember').val(ele[0]);
});


$(function(){

		var doctype = baseuri+"depositentry/getdoctype/Expense Type";
		
		var $doctype = $("#xdoctype")
		$.get(doctype, function(o){
			for(var i = 0; i < o.length; i++){ 					
				$doctype.append($('<option>', {value: o[i].xcode, text: o[i].xcode}));
			}
		}, 'json');

		var searchby = baseuri+"depositentry/getdoctype/Deposit Search";
		
		var $searchby = $("#xsearchby")
		$.get(searchby, function(o){
			for(var i = 0; i < o.length; i++){ 					
				$searchby.append($('<option>', {value: o[i].xcode, text: o[i].xcode}));
			}
		}, 'json');
		//console.log(appe);
});