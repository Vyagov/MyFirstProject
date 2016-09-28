
$(function() {
	login();
	createTable();
	deleteRow();
	createRow();
	editRow();
	goBack();
});

function goBack() {
	$("#goBack").click(function(e) {
		e.preventDefault();
		window.location.replace("templates.php");
	});
}

function login() {
	var username, pass, result;
	
	$("#formLog").submit(function(e) {
		 
		e.preventDefault();
		
		email = $("#email").val();
		pass = $("#pass").val();
		
		$.ajax({
			method: "POST",
			url: "php/serverLogin.php",
			data: {
				emailAddress: email, 
				password: pass
			},
			success: function(response) {
				result = response;
			}
		}).then(function() {
		    if (result) {
		    	correctLogin();
		    	email = $("#email").val("");
				pass = $("#pass").val("");
				window.location.replace("templates.php");
		    }
		    
		    if (!result && $("#error p").length == 1) {
		    	errorLogin();
		    }
		});
	});
}

function createTable() {
	$.ajax({
		url: "php/manageTemplateTable.php",
		success: function(response) {
			createTableRows(response);
		},
		async: true,
		dataType: "json"
	});
}

function deleteRow() {
	$(document).on("click", ".fa-times", function(event) {
		
		var confirmDelete = confirm("Are you sure you want to delete this row?");
		
	 	if(confirmDelete == true) {
		 	var rowIndex = $(this).closest("tr").attr("id");
		 	
		 	$.ajax({
				url: "php/delete.php",
				method: "POST",
				data: {index: rowIndex},
				success: function(response) {
					createTableRows(response);
				},
				dataType: "json"
			});
	 	}
	 	
	 	event.preventDefault();
	});
}

function createRow() {
	$(".fa-plus").on("click", function() {
		window.location.replace("blanks.php");
	});
}

function editRow() {
	$(document).on("click", ".fa-pencil", function(event) {
		window.location.replace("blanks.php");
	});
}
