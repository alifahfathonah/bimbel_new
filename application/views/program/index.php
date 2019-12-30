<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item active">Program</li>
					</ol>
				</h4>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<button type="button" class="btn btn-info d-none d-lg-block m-l-15 create_program" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-plus-circle"></i> Create New
					</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Program</h4>
						<h6 class="card-subtitle">Total Program : <?php echo count($program); ?> Data </h6>
						<div class="table-responsive m-t-40">
							<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Program</th>
										<th>Keterangan</th>
										<th>Harga</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Program</th>
										<th>Keterangan</th>
										<th>Harga</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
										$no = 1;
										foreach ($program as $pr){
											echo '
												<tr>
													<td>'.$no.'</td>
													<td>'.htmlspecialchars($pr->program,ENT_QUOTES,'UTF-8').'</td>
													<td>'.htmlspecialchars($pr->keterangan,ENT_QUOTES,'UTF-8').'</td>
													<td>'.number_format($pr->harga, 0,'.','.').'</td>	
													<td>'.htmlspecialchars($pr->status,ENT_QUOTES,'UTF-8').'</td>
													<td>
														<button type="button" class="btn btn-sm btn-outline-success edit_program" id_program="'.$pr->id_program.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Edit</button>
														<button type="button" class="btn btn-sm btn-outline-danger" onclick="delete_program('.$pr->id_program.')"><i class="fa fa-trash"></i> Hapus</button>
														<button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-info"></i> Detail</button>
													</td>
												</tr>
											';
											$no++;
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- sample modal content -->
<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><div id="judul_modal"></div></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<div id="data_modal"></div>
			</div>
			<!--
			<div class="modal-footer">
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
			</div>
			!-->
		</div>
	</div>
</div>
<!-- /.modal -->

<script>
	$(document).ready(function() {
		$('#example23').DataTable({
			"displayLength": 25,
			/*dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]*/
		});
		
		$('.create_program').click(function(){
			$.ajax({
				url: '<?php echo base_url('program/create_program'); ?>',
				method: 'post',
				success:function(data){
					$('#judul_modal').html('Create New Program');
					$('#data_modal').html(data);
					$('#myModal').modal("show");
				}
			});
		});
		
		$('.edit_program').click(function(){
			var programID = $(this).attr("id_program");
			
			$.ajax({
				url: '<?php echo base_url('program/edit_program'); ?>/'+programID,
				method: 'post',
				success:function(data){
					$('#judul_modal').html('Edit Program');
					$('#data_modal').html(data);
					$('#myModal').modal("show");
				}
			});
		});
		
		$('#myModal').on('hidden.bs.modal', function () {
			location.reload();
		})
		
		
	});
	function delete_program(id){
		swal({   
			title: "Apakah Anda Yakin ?",   
			text: "Data Akan Terhapus Permanen !",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Ya, Hapus Data!",   
			cancelButtonText: "Tidak, Batalkan!",   
			closeOnConfirm: false,   
			closeOnCancel: false 
		}, function(isConfirm){   
			if (isConfirm) {     
				$.ajax({
					url: "<?php echo base_url('program/delete_program'); ?>",
					method: 'post',
					data: {id_program:id},
					success:function(data){
						swal("Deleted!", "Data Telah Terhapus.", "success"); 
						window.location.reload();
					}
				});
			} else {     
				swal("Cancelled", "Data Batal di Hapus.", "error");   
			} 
		});
	}
</script>