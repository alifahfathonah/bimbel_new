<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item active">Dashboard 1</li>
					</ol>
				</h4>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<button type="button" class="btn btn-info d-none d-lg-block m-l-15 create_user" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-plus-circle"></i> Create New
					</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Users</h4>
						<h6 class="card-subtitle">Total Users : <?php echo count($users); ?> Data </h6>
						<div class="table-responsive m-t-40">
							<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Group</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Group</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
										$no = 1;
										foreach ($users as $user){
											echo '
												<tr>
													<td>'.$no.'</td>
													<td>
														'.htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8').'
														'.htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8').'
													</td>
													<td>'.htmlspecialchars($user->email,ENT_QUOTES,'UTF-8').'</td>
													<td>
											';
											foreach($user->groups as $group){
												echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')).'<br />';
											}
											echo '</td><td>';
											echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));
											echo '	</td>
													<td>
														<button type="button" class="btn btn-sm btn-outline-success edit_user" id_user="'.$user->id.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Edit</button>
														<button type="button" class="btn btn-sm btn-outline-danger" onclick="delete_user('.$user->id.')"><i class="fa fa-trash"></i> Hapus</button>
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
		
		$('.create_user').click(function(){
			$.ajax({
				url: '<?php echo base_url('auth/create_user'); ?>',
				method: 'post',
				success:function(data){
					$('#judul_modal').html('Create New User');
					$('#data_modal').html(data);
					$('#myModal').modal("show");
				}
			});
		});
		
		$('.edit_user').click(function(){
			var userID = $(this).attr("id_user");
			
			$.ajax({
				url: '<?php echo base_url('auth/edit_user'); ?>/'+userID,
				method: 'post',
				//data: {id_user:userID},
				success:function(data){
					$('#judul_modal').html('Edit User');
					$('#data_modal').html(data);
					$('#myModal').modal("show");
				}
			});
		});
		
		$('#myModal').on('hidden.bs.modal', function () {
			location.reload();
		})
		
		
	});
	function delete_user(id){
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
					url: "<?php echo base_url('auth/delete_user'); ?>",
					method: 'post',
					data: {id_user:id},
					success:function(data){
						swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
						window.location.reload();
					}
				});
			} else {     
				swal("Cancelled", "Your imaginary file is safe :)", "error");   
			} 
		});
	}
</script>