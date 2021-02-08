<?php 
include('inc/header.php');
?>
<title>webapp</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/data.js"></script>	
<?php include('inc/container.php');?>
<div class="container contact">	
	<h2>HOME</h2>	
	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">   		
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" name="add" id="addContact" class="btn btn-success btn-xs">Add contact</button>
				</div>
			</div>
		</div>
		<table id="contactList" class="table table-bordered table-striped">
			<thead>
				<tr>
                    <th>#</th>
					<th>Name</th>
					<th>E-mail</th>					
					<th>Phone</th>
					<th>Title</th>
					<th>Created</th>					
					<th></th>
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	<div id="contactModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="contactForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Contact</h4>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label for="name" class="control-label">Name</label>
							<input type="text" class="form-control" id="contactName" name="contactName" placeholder="Name" required>			
						</div>
						<div class="form-group">
							<label for="age" class="control-label">E-mail</label>							
							<input type="email" class="form-control" id="contactEmail" name="contactEmail" placeholder="E-mail" required>							
						</div>	   	
						<div class="form-group">
							<label for="lastname" class="control-label">phone</label>							
							<input type="number" class="form-control"  id="contactPhone" name="contactPhone" placeholder="Phone" required>							
						</div>	 
						<div class="form-group">
							<label for="address" class="control-label">title</label>							
							<input type="text" class="form-control" id="contactTitle" name="contactTitle" placeholder="title" required>							
						</div>
						<div class="form-group">
							<label for="lastname" class="control-label">time</label>							
							<input type="datetime-local" class="form-control" id="contactTime" name="contactTime" placeholder="Time">			
						</div>						
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="contactId" id="contactId" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
</div>	
<?php include('inc/footer.php');?>