
function correctLogin() {
	$("#error p").text("Email and password is success!")
					.css("color", "#00cc00");
	
	$("#formLog input").css({
			"border-color": "#00cc00",
			"width": "90%",
			"box-shadow": "0px 0px 10px #00cc00"
	});
	
	$("#formLog span").removeClass("fa fa-times")
					.addClass("fa fa-check")
					.css("color", "#00cc00");
}

function errorLogin() {
	$("#error p").text("Email or password is incorrect!")
					.css("color", "#ee0000");
	
	$("#formLog input").css({
			"border-color": "#ee0000",
			"width": "90%", 
			"box-shadow": "0px 0px 10px #ee0000"
	});
	
	$("#formLog span").addClass("fa fa-times")
					.css("color", "#ee0000");
}

function createTableRows(data)
{
	var row = '';
	var action = '<td><button class="fa fa-pencil"></button><button class="fa fa-times"></button></td>';
	$.each(data, function(index, rows) {
		var rowNum = parseInt(index) + 1;
		row += "<tr id='" + index + "'><td>" + rowNum + "</td>";
		
		$.each(rows, function(key, value) {
			if (key == 'tempName') {
				row += "<td>" + value + "</td>";
			}
		});
		row += action + "</tr>";
	});
		
	$("tbody").html(row);
}
