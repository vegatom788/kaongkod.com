<?php
	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<meta name="robots" content="" />

		<meta name="description" content="" />

		<meta property="og:title" content="" />
		<meta property="og:description" content="" />
		<meta property="og:image" content="" />
		<meta name="format-detection" content="telephone=no">

		<link rel="icon" href="../assets/images/<?php echo $web_icon; ?>.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/<?php echo $web_icon; ?>.png" />

		<title><?php echo $web_name; ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- SweetAlert2 CSS -->
		<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">

		<style type="text/css">
			.btn.dropdown-toggle.btn-default:hover {
				color: #000!important;
			}

			.btn.dropdown-toggle.btn-default:focus {
				color: #000!important;
			}
			.widget-card .icon {
				position: absolute;
				top: auto;
				bottom: -20px;
				right: 5px;
				z-index: 0;
				font-size: 65px;
				color: rgba(0, 0, 0, 0.15);
			}
			tbody tr:hover {
				background-color: #d4d4d4;
			}
		</style>
	</head>
	<?php include '../assets/css/color/color-1.php';  ?>
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #FCFCFC;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php 
			
				include 'sidebar.php';
				
				$page = 'residents';
				//$secondnav = 'residents';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Residents Management</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Archived Residents</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">
								<a href="residents" class="btn green radius-xl" style="float: right;background-color: #1043A9;"><i class="ti-agenda"></i><span>&nbsp;ALL RESIDENTS</span></a><br>
								<div style="padding: 30px;"></div>
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th>ID Number</th>
												<th>Name</th>
												<th>Contact</th>
												<th>Block</th>
												<th>Lot</th>
												<th width="100">Status</th>
												<th width="100">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$status = 3;
												$rows = $model->displayResidents($status);

												if (!empty($rows)) {
													foreach ($rows as $row) {
														$id = $row['id'];
														$id_number = $row['id_number'];
														$first_name = $row['fname'];
														$middle_name = $row['mname'];
														$last_name = $row['lname'];
														$email = $row['email'];
														$contact = $row['contact_number'];
														$address = $row['address'];
														$address2 = $row['address2'];
														$date_added = $row['date_registered'];
														$verified = $row['verified'];

														if ($verified == 1) {

															$verified = '<center><span class="badge badge-success"><a href="" style="font-size: 14px;color: white;">Verified</a></span></center> ';
														}
														else {
															$verified = '<center><span class="badge badge-danger"><a href="" style="font-size: 14px;color: white;">Not Verified</a></span></center> ';
														}
											?>
											<tr>
												<td><?php echo $id_number; ?></td>
												<td><?php echo $first_name.' '.$middle_name.' '.$last_name; ?></td>
												<td><?php echo $contact; ?></td>
												<td><?php echo $address; ?></td>
												<td><?php echo $address2; ?></td>
												<td><center><b><?php echo $verified; ?></b></center></td>
												<td>
												<center>
													<a href="" class="btn green" style="width: 50px; height: 37px;" data-toggle="modal" data-target="#archive-<?php echo $id; ?>">
														<div data-toggle="tooltip" title="Restore"><i class="ti-archive" style="font-size: 12px;"></i></div>
													</a>&nbsp;
													<a href="#" class="btn red" style="width: 50px; height: 37px;" data-toggle="modal" data-target="#delete-<?php echo $id; ?>">
														<div data-toggle="tooltip" title="Delete"><i class="ti-trash" style="font-size: 12px;"></i></div>
													</a>
												</center>
											</tr>
											<!-- Delete Modal -->
											<div id="delete-<?php echo $id; ?>" class="modal fade" role="dialog">
												<form class="delete-form m-b30" method="POST">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Delete Resident</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="delete_hidden" value="<?php echo $id; ?>">
																<p>Are you sure you want to delete <?php echo $first_name.' '.$middle_name.' '.$last_name; ?>?</p>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn red radius-xl outline" name="delete" value="Delete">
																<button type="button" class="btn green outline radius-xl" data-dismiss="modal">Cancel</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php
												try {
													// Assuming you have a PDO connection established, create a Model instance
													$pdo = new PDO('mysql:host=127.0.0.1;dbname=u510162695_kaongkod', 'u510162695_kaongkod', '1Kaongkod');
													$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set PDO to throw exceptions on error
													$model = new Model($pdo);

													// Check if the form is submitted
													if (isset($_POST['delete'])) {
														$delete_id = $_POST['delete_hidden'];
														
														// Call deleteResident method
														if ($model->deleteResident($delete_id)) {
															echo "<script>alert('Resident deleted successfully');</script>";
														} else {
															echo "<script>alert('Resident deleted successfully');</script>";
														}

														// Redirect back to the same page after deletion
														echo "<script>window.open('archived-residents.php', '_self');</script>";
														exit;
													}
												} catch (PDOException $e) {
													// Handle PDO exception (connection or query error)
													echo "Connection failed: " . $e->getMessage();
													// You might want to log the error or display a user-friendly message
													exit;
												}
												?>




											<div id="archive-<?php echo $id; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Restore Resident</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="approve_hidden" value="<?php echo $id; ?>">
																<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label">Name</label>
																		<input class="form-control" type="text" value="<?php echo $first_name.' '.$middle_name.' '.$last_name; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Email</label>
																		<input class="form-control" type="text" value="<?php echo $email; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Contact</label>
																		<input class="form-control" type="text" value="<?php echo $contact; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Block</label>
																		<input class="form-control" type="text" value="<?php echo $address; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Lot</label>
																		<input class="form-control" type="text" value="<?php echo $address2; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Date registered</label>
																		<input class="form-control" type="text" value="<?php echo date('M. d, Y g:i A', strtotime($date_added)); ?>" readonly>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn green radius-xl outline" name="archive" value="Restore">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
															</div>
														</div>
													</div>
												</form>
											</div>
											<!-- SweetAlert2 JS -->
											<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
											<?php

														if (isset($_POST['archive'])) {

															$approve_id = $_POST['approve_hidden'];
															$model->changeResidentStatus($approve_id, 1);
															echo "<script>
																	Swal.fire({
																		title: 'Restored!',
																		text: 'Resident has been restored successfully.',
																		icon: 'success',
																		confirmButtonText: 'OK',
																		customClass: {
																			popup: 'my-swal-popup'
																		}
																	}).then((result) => {
																		if (result.isConfirmed) {
																			window.location.href = 'archived-residents';
																		}
																	});
																</script>";
														}
													}
												}

											?>
											
										</tbody>
									</table>
								</div>
								<hr>
								<!-- <a href="residents" class="btn green radius-xl" style="float: right;background-color: #267621;"><i class="ti-agenda"></i><span>&nbsp;ALL RESIDENTS</span></a> -->

					</div>
				</div>
			</div>
		</main>
		<div class="ttr-overlay"></div>

		<script src="../dashboard/assets/js/jquery.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap/js/popper.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
		<script src="../dashboard/assets/vendors/magnific-popup/magnific-popup.js"></script>
		<script src="../dashboard/assets/vendors/counter/waypoints-min.js"></script>
		<script src="../dashboard/assets/vendors/counter/counterup.min.js"></script>
		<script src="../dashboard/assets/vendors/imagesloaded/imagesloaded.js"></script>
		<script src="../dashboard/assets/vendors/masonry/masonry.js"></script>
		<script src="../dashboard/assets/vendors/masonry/filter.js"></script>
		<script src="../dashboard/assets/vendors/owl-carousel/owl.carousel.js"></script>
		<script src='../dashboard/assets/vendors/scroll/scrollbar.min.js'></script>
		<script src="../dashboard/assets/js/functions.js"></script>
		<script src="../dashboard/assets/vendors/chart/chart.min.js"></script>
		<script src="../dashboard/assets/js/admin.js"></script>
		<script src='../dashboard/assets/vendors/calendar/moment.min.js'></script>   
		<script src="../dashboard/assets/js/jquery.dataTables.min.js"></script>
		<script src="../dashboard/assets/js/dataTables.bootstrap4.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#table').DataTable();
			});
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>

</html>