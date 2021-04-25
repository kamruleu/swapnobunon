$(function(){
	var year = baseuri+"glrpt/getYear/Year";
		
		var $year = $("#xyear")
		$.get(year, function(o){
			for(var i = 0; i < o.length; i++){ 					
				$year.append($('<option>', {value: o[i].xcode, text: o[i].xcode}));
			}
		}, 'json');

		var month = baseuri+"glrpt/getYear/Month";
		
		var $month = $("#xmonth")
		$.get(month, function(o){
			for(var i = 0; i < o.length; i++){ 					
				$month.append($('<option>', {value: o[i].xcode, text: o[i].xcode}));
			}
		}, 'json');
});