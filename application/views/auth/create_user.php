<div id="pesan"></div>
<form method="POST" id="input_user">
	<div class="form-body">
		<div class="row p-t-20">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">First Name</label>
					<?php echo form_input($first_name); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Last Name</label>
					<?php echo form_input($last_name); ?>
				</div>
			</div>
		</div>
		<!--/row-->
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Gender</label>
					<select class="form-control custom-select">
						<option value="">Male</option>
						<option value="">Female</option>
					</select>
				</div>
			</div>
			<!--/span-->
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Date of Birth</label>
					<input type="text" class="form-control" placeholder="2017-06-04" id="mdate">
				</div>
			</div>
			<!--/span-->
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Email</label>
					<?php echo form_input($email); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Phone</label>
					<?php echo form_input($phone); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">Company</label>
					<?php echo form_input($company); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">Address</label>
					<input type="text" id="lastName" class="form-control" placeholder="12n">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Password</label>
					<?php echo form_input($password); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Confirm Password</label>
					<?php echo form_input($password_confirm); ?>
					<input type="hidden" name="cek_form" value="jh">
				</div>
			</div>
		</div>
	</div>
</form>
<button name="input" id="add_button" class="btn btn-success proses_modal"> <i class="fa fa-check"></i> Save</button>
<script>
	$('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
	$(document).ready(function(){
		$('.proses_modal').click(function(){
			$.ajax({
				url: '<?php echo base_url('auth/create_user'); ?>',
				method: 'post',
				data: new FormData($('#input_user')[0]),
				contentType: false,
				cache: false,
				processData:false,
				success:function(data){
					$('#pesan').html(data);
				}
			});
		});
	});
	$('#input_user').on('keyup change paste', 'input, select, textarea', function(){
		document.getElementById("add_button").className = "btn btn-success proses_modal";
	});
</script>
