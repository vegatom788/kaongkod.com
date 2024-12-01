<?php
	use setasign\Fpdi\Fpdi;
	
	ob_start(); 
	session_start();

	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['sess2'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	if(isset($_POST["residency"])) { 
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/residency.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("BRGY. VICTORIA REYES");  
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetXY(84, 92);
		$pdf->Write(0, date('M. d, Y', strtotime($_POST['date_issued'])));
		$pdf->SetXY(112, 137);
		$pdf->Write(0, $_POST['name']);
		$pdf->SetXY(142, 142);
		$pdf->Write(0, $_POST['address']);
		$pdf->SetXY(155, 142);
		$pdf->Write(0, $_POST['address2']);
		$pdf->SetXY(136, 147);
		$pdf->Write(0, $_POST['resident_since']);
		$pdf->SetXY(93, 157);
		$pdf->Write(0, date('j', strtotime($_POST['date_issued'])));
		$pdf->SetXY(113, 157);
		$pdf->Write(0, date('F', strtotime($_POST['date_issued'])));
		ob_end_clean();
		$pdf->Output('I', 'Brgy Victoria Reyes.pdf');
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

		<link rel="icon" href="../assets/images/icon.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/k.png" />

		<title>Brgy. Kaongkod</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- jQuery (needed for DataTables) -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<!-- DataTables JS -->
		<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
		<!-- SweetAlert2 CSS -->
		<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">
	</head>
	<style type="text/css">
		.btn.dropdown-toggle.btn-default:hover {
			color: #000!important;
		}

		.btn.dropdown-toggle.btn-default:focus {
			color: #000!important;
		}

		tbody tr:hover {
			background-color: #d4d4d4;
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
	</style>
	<style>
		/* Style for mobile responsiveness */
		@media (max-width: 768px) {
			.table-responsive {
				overflow-x: auto;
				-webkit-overflow-scrolling: touch;
			}

			.table {
				font-size: 15px; /* Smaller font for mobile */
			}

			.table th, .table td {
				padding: 6px 8px; /* Reduced padding */
			}

			/* Stack rows into cards for smaller screens */
			.table thead {
				display: none;
			}

			.table td {
				display: block;
				width: 100%;
				text-align: left;
				position: relative;
				padding-left: 50%;
				padding-top: 10px;
				padding-bottom: 10px;
				border-top: 1px solid #ddd;
			}

			.table td::before {
				content: attr(data-label);
				position: absolute;
				left: 10px;
				font-weight: bold;
			}
		}
	</style>
	<style>
    .contact-bx {
        background-color: #ffffff;
        border: 2px solid #ccc;
        padding: 30px;
        border-radius: 5px;
    }
</style>
	<?php include '../assets/css/color/color-1.php';  ?>
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #F3F3F3;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php 
			
				include 'sidebar.php';
				
				$page = 'services';
				$secondnav = '';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Services</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Certificate of Residency</li>
					</ul>
				</div> 
				
				<?php include 'widget.php'; ?>

				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
				<style type="text/css">
				.chart {
					width: 100%; 
					min-height: 500px;
				}
				.rowy {
					margin:0 !important;
				}
				</style>
			<div class="row">
    <div class="col-lg-7 m-b30">
		<!-- SweetAlert2 JS -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <?php
            if (isset($_POST['post_msg'])) {
				$request_type = 2;
                $purpose = $_POST['message'];
                $payment_method = $_POST['payment_method'];
                $reference_number = $_POST['reference_number'];

                $model->addRequest($_SESSION['sess2'], 2, $purpose, $payment_method, $reference_number);

                setcookie('cancel_request_clearance', time() + (60 * 5), time() + (60 * 5), "/", "", isset($_SERVER["HTTPS"]), true);

                echo "<script>
									Swal.fire({
										title: 'Success!',
										text: 'Your request has been submitted successfully.',
										icon: 'success',
										confirmButtonText: 'Ok',
										customClass: {
													popup: 'my-swal-popup'
										}
									}).then((result) => {
										if (result.isConfirmed) {
											window.open('residency', '_self');
										}
									});
								</script>";
            }
        ?>
									<form class="contact-bx dzForm" method="post" style="background-color: #ffffff; border: 2px solid #ccc; padding: 30px; border-radius: 5px;">
										<div class="dzFormMsg"></div>
										<div class="heading-bx left">
											<h2 class="title-head">Request <span>Services</span></h2>
										</div>
										<div style="padding: 5px;"></div>
										<div class="row placeani" id="sent">
											<div class="col-lg-12">
												<select class="form-control" id="switch-page">
													<option value="1" >Request of Barangay Clearance</option>
													<option value="2" selected>Request Certificate of Residency</option>
													<option value="3">Request Certificate of Indigency</option>
												</select>
											</div>
											<div class="col-lg-12">
												<br>
												<div class="form-group">
													<label>Name</label><div class="input-group">
														<?php echo $r_fname; ?> <?php echo $r_mname; ?> <?php echo $r_lname; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<br>
												<div class="form-group">
													<label>Resident Since</label><div class="input-group">
														<?php echo $r_resident_since; ?>
													</div>
		</div>
		</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Block</label><div class="input-group">
														<?php echo $r_address; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Lot</label><div class="input-group">
														<?php echo $r_address2; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
											<div class="form-group">
											<label>Payment Method</label>
            <div class="input-group">
                <select id="payment-method" name="payment_method" class="form-control">
                    <option value="Cash on Pick-up">Cash on Pick-up</option>
                    <option value="Gcash">GCash</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-12" id="gcash-reference-number">
        <div class="form-group">
            <label>Reference No. (for Gcash Payment only)</label>
            <div class="input-group">
                <input type="text" id="reference-number" name="reference_number" class="form-control" placeholder="Enter gcash reference no." maxlength="13">
            </div>
						</div>
										</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Purpose</label><div class="input-group">
														<input name="message" rows="1" class="form-control" required minlength="5" maxlength="300" placeholder="Enter the purpose here">
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Date Request</label><div class="input-group">
														<?php echo date("M. d, Y"); ?>
													</div>
												</div>
											</div>
										</form>
											<div class="col-lg-12">
												<div id="request_button">
													<?php
													$request_type = 2;
													$rows = $model->pendingRequestChecker($_SESSION['sess2'], $request_type);
													if (!empty($rows)) {
														foreach ($rows as $row) {
														}
													?>
													<center>
														<h3 style="color: green;">YOUR REQUEST IS PENDING</h3>
														<button type="button" data-toggle="modal" data-target="#view-cancel-<?php echo $row['id']; ?>" class="btn red radius-xl" style="width: 210px;height: 50px;display: flex;align-items: center;justify-content: center;">
															<i class="ti-archive" style="font-size: 15px;"></i>
															<span style="font-size: 15px;">&nbsp;&nbsp;CANCEL REQUEST</span>
														</button>
													</center>
													<?php
														if (isset($_POST['cancel'])) {
															$model->updateRequestStatus(4, $_POST['cancel_hidden']);

															setcookie('cancel_request_clearance', null, time() - 3600, '/', "", isset($_SERVER["HTTPS"]), true);  

															echo "<script>
																Swal.fire({
																	icon: 'success',
																	title: 'Request Cancelled!',
																	text: 'Your request has been successfully cancelled.',
																	confirmButtonText: 'OK',
																	customClass: {
																	popup: 'my-swal-popup'
																	}
																}).then(function() {
																	window.location.href = 'residency'; // Redirect after alert is closed
																});
															</script>";
														}
													} else { ?>
													<center><button name="post_msg" type="submit" class="btn button-md button-block">Submit Request</button></center>
													<?php } ?>
												</div>
												
											</div>
											<?php
												$row['id'] = isset($row['id']) ? $row['id'] : ''; // Ensure $row['id'] is initialized
												?>
											<div id="view-cancel-<?php echo htmlspecialchars($row['id']); ?>" class="modal fade" role="dialog">
													<form class="edit-profile m-b30" method="POST">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Request Details</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="cancel_hidden" value="<?php echo isset($row['id']) ? htmlspecialchars($row['id']) : ''; ?>">
																<div class="row">
																	<div class="form-group col-12">
																		<label class="col-form-label">Name</label>
																		<br><?php echo $r_fname; ?> <?php echo $r_mname; ?> <?php echo $r_lname; ?>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Blk</label>
																		<br><?php echo $r_address; ?>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Lot</label>
																		<br><?php echo $r_address2; ?>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Purok</label>
																		<br><?php echo $r_address3; ?>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Purpose</label>
																		<input class="form-control" type="text" value="<?php echo isset($row['purpose']) ? htmlspecialchars($row['purpose']) : ''; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Payment Method</label>
																		<input class="form-control" type="text" value="<?php echo isset($row['payment_method']) ? htmlspecialchars($row['payment_method']) : ''; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Reference Number</label>
																		<input class="form-control" type="text" value="<?php echo isset($row['reference_number']) ? htmlspecialchars($row['reference_number']) : ''; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Date Submitted</label>
																		<input class="form-control" type="text" value="<?php echo !empty($row['date_issued']) ? date('M. d, Y', strtotime($row['date_issued'])) : ''; ?>" readonly>
																	</div>

																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn red radius-xl outline" name="cancel" value="Cancel">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
													</form>
												</div>
											<div class="col-lg-12" align="center">
											<br>
											<label style="color: green;font-weight: 540;">
											</label>
											</div>
										</div>
												</div>

												<div class="col-lg-4 m-b30">
										<form class="contact-bx dzForm" method="post" style="background-color: #ffffff; border: 2px solid #ccc; padding: 30px; border-radius: 5px;">
											<div class="dzFormMsg"></div>
											<div class="heading-bx left">
												<h2 class="title-head">Scan to <span>Pay</span></h2>
												<label>GCash QR Code</label>
												<div class="text-center">
													<img src="../assets/images/qr.jpg" alt="Scan to Pay Image" style="max-width: 70%; height: auto;">
												</div>
											</div>
											<!-- Image Placeholder -->
											
											<!-- Additional form fields can be added here as needed -->
											<div class="form-group" style="margin-top: 20px;">
												<ul style="list-style-type: none; padding-left: 0;">
													<li style="margin-bottom: 10px;"><strong>Fees:</strong> ₱50.00</li>
													<li style="margin-bottom: 10px;"><strong>GCash Number:</strong> 09631296743</li>
													<!-- Add more details as needed -->
												</ul>
											</div>
										</form>
									</div>

					</div>
					<div class="col-lg-12 m-b30" style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 15px;">
    <div class="heading-bx left">
        <h2 class="title-head">Certificate of Residency<span> Request History</span></h2>
    </div>
    <div class="table-responsive">
        <table id="table" class="table hover" style="width:100%">
            <thead>
                <tr>
                    <th width="50">Action</th>
                    <th>Purpose</th>
                    <th>Date Request</th>
					<th>Payment Method</th>
                    <th>Reference Number</th>
                    <th width="100">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rows = $model->fetchRequestsHistory2($_SESSION['sess2'], $request_type);
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                ?>
                <tr>
                    <td>
                        <center>
                            <a href="" class="btn blue" style="width: 50px; height: 37px;" data-toggle="modal" data-target="#view-<?php echo $row['id']; ?>">
                                <div data-toggle="tooltip" title="View Details">
                                    <i class="ti-search" style="font-size: 12px;"></i>
                                </div>
                            </a>
                        </center>
                    </td>
                    <td><?php echo $row['purpose']; ?></td>
                    <td style="font-size: 14px;"><?php echo date('M. d, Y', strtotime($row['date_issued'])); ?></td>
					<td><?php echo $row['payment_method']; ?></td>
                    <td><?php echo $row['reference_number']; ?></td>
                    <td>
                        <center>
                            <?php
                            if ($row['status'] == 1) {
                            ?>
                            <span style="color: green;"><b><?php echo $row['status2']; ?><br><?php echo date('M. d, Y', strtotime($row['date_pickup'])); ?></b></span>
                            <?php
                            } else if ($row['status'] == 2) {
                            ?>
                            <span class="badge badge-primary">PENDING</span>
                            <?php
                            } else if ($row['status'] == 4) {
                            ?>
                            <span class="badge badge-danger">DECLINED</span>
                            <?php
                            } else {
                            ?>
                            <span class="badge badge-danger">DECLINED</span>
                            <?php
                            }
                            ?>
                        </center>
                    </td>
                </tr>
                <div id="view-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
                    <form class="edit-profile m-b30" method="POST">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">
                                        <img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Request Details
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="approve_hidden" value="<?php echo $id; ?>">
                                    <div class="row">
										<div class="form-group col-12">
											<label class="col-form-label">Name</label>
											<input class="form-control" type="text" value="<?php echo $r_fname; ?> <?php echo $r_mname; ?> <?php echo $r_lname; ?>" readonly>
										</div>
										<div class="form-group col-6">
											<label class="col-form-label">Blk</label>
											<input class="form-control" type="text" value="<?php echo $r_address; ?>" readonly>
										</div>
										<div class="form-group col-6">
											<label class="col-form-label">Lot</label>
											<input class="form-control" type="text" value="<?php echo $r_address2; ?>" readonly>
										</div>
                                        <div class="form-group col-6">
                                            <label class="col-form-label">Purok</label>
                                            <input class="form-control" type="text" value="<?php echo $r_address3; ?>" readonly>
                                        </div>
                                        <div class="form-group col-12">
											<label class="col-form-label">Purpose</label>
											<input class="form-control" type="text" value="<?php echo isset($row['purpose']) ? htmlspecialchars($row['purpose']) : ''; ?>" readonly>
										</div>
										<div class="form-group col-12">
											<label class="col-form-label">Payment Method</label>
											<input class="form-control" type="text" value="<?php echo isset($row['payment_method']) ? htmlspecialchars($row['payment_method']) : ''; ?>" readonly>
										</div>
										<div class="form-group col-12">
											<label class="col-form-label">Reference Number</label>
											<input class="form-control" type="text" value="<?php echo isset($row['reference_number']) ? htmlspecialchars($row['reference_number']) : ''; ?>" readonly>
										</div>
										<div class="form-group col-12">
											<label class="col-form-label">Date Submitted</label>
											<input class="form-control" type="text" value="<?php echo !empty($row['date_issued']) ? date('M. d, Y', strtotime($row['date_issued'])) : ''; ?>" readonly>
										</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
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
				$('#switch-page').change( function() {
					if ($(this).val() == 1) {
						window.open('clearance', '_self');
					}

					else if ($(this).val() == 2) {
						window.open('residency', '_self');
					}

					else if ($(this).val() == 3) {
						window.open('indigency', '_self');
					}

					else if ($(this).val() == 4) {
						window.open('business', '_self');
					}
				});

				var timer = setInterval(function() {
					var timer_text = $('#timer').text();
					const timer_split = timer_text.split(':');
					var seconds = (timer_split[0] * 60) + timer_split[1];

					if (parseInt(seconds) > 0) {
						$('#timer').load(location.href + " #timer");
					}

					else {
						$('#timer').html('');
					}

					$('#request_button').load(location.href + " #request_button");
				}, 1000);
			});

			$(document).ready(function() {
				$('#table').DataTable();
			});
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
		<script type="text/javascript">
			function blockSpecialChar(evt) { 
				var charCode = (evt.which) ? evt.which : window.event.keyCode; 
				if (charCode <= 13) { 
					return true; 
				} 
				
				else { 
					var keyChar = String.fromCharCode(charCode); 
					var re = /^[A-Za-z. ]+$/ 
					return re.test(keyChar); 
				} 
			}
		</script>
			 <script>
        $(document).ready(function() {
            $('#gcash-reference-number').hide();
            $('#payment-method').change(function() {
                if ($(this).val() === 'Gcash') {
                    $('#gcash-reference-number').show();
                } else {
                    $('#gcash-reference-number').hide();
                }
            });
        });
    </script>
		
	</body>
</html>