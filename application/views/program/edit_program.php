<div id="pesan"></div>
<form method="POST" id="edit_program">
	<div class="form-body">
		<div class="row p-t-20">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Program</label>
					<?php echo form_input($program); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Harga</label>
					<?php echo form_input($harga); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">Keterangan</label>
					<?php echo form_input($keterangan); ?>
					<input type="hidden" name="cek_form" value='cek'>
				</div>
			</div>
		</div>
		<?php echo form_hidden('id_program', $id_program);?>
		<?php //echo form_hidden($csrf); ?>
	</div>
</form>
<button name="input" id="edit_button" class="btn btn-success proses_modal"> <i class="fa fa-check"></i> Save</button>
<script>
	$('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
	$(document).ready(function(){
		$('.proses_modal').click(function(){
			$.ajax({
				url: '<?php echo base_url('program/edit_program/'.$id_program); ?>',
				method: 'post',
				data: new FormData($('#edit_program')[0]),
				contentType: false,
				cache: false,
				processData:false,
				success:function(data){
					$('#pesan').html(data);
				}
			});
		});
	});
	$('#edit_program').on('keyup change paste', 'input, select, textarea', function(){
		document.getElementById("edit_button").className = "btn btn-success proses_modal";
	});
</script>
