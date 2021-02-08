$(document).ready(function(){	
	var contactData = $('#contactList').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"action.php",
			type:"POST",
			data:{action:'listContact'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 6, 7],
				"orderable":false,
			},
		],
		"pageLength": 10
	});		
	$('#addContact').click(function(){
		$('#contactModal').modal('show');
		$('#contactForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Contact");
		$('#action').val('addContact');
		$('#save').val('Add');
	});		
	$("#contactList").on('click', '.update', function(){
		var contactID = $(this).attr("id");
		var action = 'getContact';
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{contactID:contactID, action:action},
			dataType:"json",
			success:function(data){
				$('#contactModal').modal('show');
				$('#contactID').val(data.id);
				$('#contactName').val(data.name);
				$('#contactEmail').val(data.email);
				$('#contactPhone').val(data.phone);				
				$('#contactTitle').val(data.title);
				$('#contactDate').val(data.date);	
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Contact");
				$('#action').val('updateContact');
				$('#save').val('Save');
			}
		})
	});
	$("#contactModal").on('submit','#contactForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#contactForm')[0].reset();
				$('#contactModal').modal('hide');				
				$('#save').attr('disabled', false);
				contactData.ajax.reload();
			}
		})
	});		
	$("#contactList").on('click', '.delete', function(){
		var contactID = $(this).attr("id");		
		var action = "contactDelete";
		if(confirm("Are you sure you want to delete this contact?")) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{contactID:contactID, action:action},
				success:function(data) {					
					contactData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
});