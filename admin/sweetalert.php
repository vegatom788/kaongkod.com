<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if(isset($_POST["export-pdf"])) { 
		require_once('../tcpdf/tcpdf.php');  
		$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
		$obj_pdf->SetCreator(PDF_CREATOR);  
		$obj_pdf->SetTitle("BRGY. KAONGKOD - RESIDENTS");   
		$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
		$obj_pdf->SetDefaultMonospacedFont('helvetica');  
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
		$obj_pdf->setPrintHeader(false);  
		$obj_pdf->setPrintFooter(false);  
		$obj_pdf->SetAutoPageBreak(TRUE, 10);  
		$obj_pdf->SetFont('helvetica', '', 12);  
		$obj_pdf->AddPage(); 
		//ob_start(); 
		$content = '';  
		$content .= '
		<div align="center">
			<img src="11header.jpg" height="115" width="300">
			<h2 style="color: black;">BARANGAY KAONGKOD - RESIDENTS</h2>
		</div>
		<table border="1" cellspacing="0" cellpadding="5">
        	<thead>
        		<tr>
        			<th><b>ID Number</b></th>
        			<th><b>Name</b></th>
        			<th><b>Gender</b></th>
        			<th><b>Civil Status</b></th>
        			<th><b>Contact</b></th>
        		</tr>
        	</thead>
        	<tbody>';
        $status = 1;
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
				$gender = $row['gender'];
				$civil_status = $row['civil_status'];
				$address = $row['address'];
				$address2 = $row['address2'];
				$resident_since = $row['resident_since'];
				$date_added = $row['date_registered'];
				$verified = $row['verified'];
				
				$content .= '<tr>
			        <td>'.$id_number.'</td>
			        <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
			        <td>'.$gender.'</td>
			        <td>'.$civil_status.'</td>
			        <td>'.$contact.'</td>
		        </tr>';
			}
        }
        	
		$content .= '</tbody></table>';  
		$content = utf8_encode($content);
		$obj_pdf->writeHTML($content); 
		ob_end_clean();
		$obj_pdf->Output('Residents.pdf', 'I');  
	}

	if (empty($_SESSION['sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	$digits = 7;
	$digits_main = rand(pow(10, $digits-1), pow(10, $digits)-1);
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

		<title>Brgy. Kaongkod</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
						<li><i class="ti-agenda"></i>Registered Residents</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
                <div class="col-lg-12 m-b30">
                            <div align="right">
                                <a href="" class="btn green radius-xl" style="background-color: <?php echo $primary_color; ?>" data-toggle="modal" data-target="#add-announcement"><i class="ti-agenda"></i><span>&nbsp;ADD NEW RESIDENT</span></a>&nbsp;
                                <!-- <a href="pending-residents" class="btn green radius-xl" style="background-color: #267621;"><i class="ti-agenda"></i><span>&nbsp;PENDING RESIDENTS (<?php echo $pending; ?>)</span></a>&nbsp; -->
                                <a href="archived-residents" class="btn red radius-xl"><i class="ti-agenda"></i><span>&nbsp;ARCHIVED RESIDENTS</span></a><br>
                            </div>
                            <div style="padding: 25px;"></div>

                            <div class="table-responsive">
                                <table id="table" class="table hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID Number</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Civil Status</th>
                                            <th>Contact</th>
                                            <th width="80">Status</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $status = 1;
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
                                                    $gender = $row['gender'];
                                                    $civil_status = $row['civil_status'];
                                                    $address = $row['address'];
                                                    $address2 = $row['address2'];
                                                    $address3 = $row['address3'];
                                                    $resident_since = $row['resident_since'];
                                                    $date_added = $row['date_registered'];
                                                    $verified = $row['verified'];
                                                    //default.jpg
                                                    $bdt = date('Y', strtotime($row['birth_date']));
                                                    $dttt = date("Y");
                                                    $age = $dttt - $bdt;

                                                    if ($verified == 1) {
                                                        if ($row['email_verif'] == 1) {
                                                            $verified = 'Registered';
                                                            $verified2 = 'success';
                                                        }
                                                        else {
                                                            $verified = 'Registered';
                                                            $verified2 = 'success';
                                                        }
                                                    }
                                                    else {
                                                        $verified = '<span style="font-size: 12px;">Unregistered</span>';
                                                        $verified2 = 'danger';
                                                    }

                                                    $photo = $row['photo'];
                                                    if ($photo == '') {
                                                        $photo = 'default';
                                                    }
                                                    else {
                                                        $photo = $row['photo'];
                                                    }
                                        ?>
                                        <tr>
                                            <td><?php echo $id_number; ?></td>
                                            <td><img src="../assets/images/profile-pictures/<?php echo $photo; ?>.jpg" alt="User" style="width: 30px; height: 30px; border-radius: 50%;object-fit: cover;">&nbsp;
                                                <?php echo $first_name.' '.$middle_name.' '.$last_name; ?></td>
                                            <td><?php echo $gender; ?></td>
                                            <td><?php echo $civil_status; ?></td>
                                            <td><?php echo $contact; ?></td>
                                            <td style="font-size: 12px;"><center><span class="badge badge-<?php echo $verified2; ?>"><a href="" style="font-size: 14px;color: white;" data-toggle="modal" data-target="#status-<?php echo $row['id']; ?>"><?php echo $verified; ?></a></span></center> 
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="residents-profile?id=<?php echo $id; ?>" class="btn blue" style="width: 50px; height: 37px;">
                                                        <div data-toggle="tooltip" title="Profile"><i class="ti-search" style="font-size: 12px;"></i></div>
                                                    </a>&nbsp;
                                                    <a href="javascript:void(0);" class="btn red archive-btn" data-id="<?php echo $id; ?>" style="width: 50px; height: 37px;">
                                                        <div data-toggle="tooltip" title="Archive"><i class="ti-archive" style="font-size: 12px;"></i></div>
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <hr>
                            <div align="right">
                                <form method="POST" target="_blank">
                                    <button type="submit" name="export-pdf" class="btn blue radius-xl" style="background-color: <?php echo $primary_color; ?>"><i class="ti-import"></i>&nbsp;&nbsp;EXPORT TO PDF</button>
                                </form>
                            </div>

                            <div id="add-announcement" class="modal fade" role="dialog">
                                <form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add New Resident</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">First Name</label>
                                                        <div>
                                                            <input class="form-control" type="text" name="fname" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Middle Name</label>
                                                        <div>
                                                            <input class="form-control" type="text" name="mname">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Last Name</label>
                                                        <div>
                                                            <input class="form-control" type="text" name="lname" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Email Address</label>
                                                        <div>
                                                            <input class="form-control" type="email" name="email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Contact Number</label>
                                                        <div>
                                                            <input class="form-control" type="text" name="contact" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Gender</label>
                                                        <div>
                                                            <select class="form-control" name="gender">
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Civil Status</label>
                                                        <div>
                                                            <select class="form-control" name="civil_status">
                                                                <option value="Single">Single</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Widowed">Widowed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Address</label>
                                                        <div>
                                                            <input class="form-control" type="text" name="address">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Secondary Address</label>
                                                        <div>
                                                            <input class="form-control" type="text" name="address2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Tertiary Address</label>
                                                        <div>
                                                            <input class="form-control" type="text" name="address3">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Resident Since</label>
                                                        <div>
                                                            <input class="form-control" type="date" name="resident_since" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="col-form-label">Birth Date</label>
                                                        <div>
                                                            <input class="form-control" type="date" name="birth_date" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label class="col-form-label">Upload Photo</label>
                                                        <div>
                                                            <input type="file" class="form-control" name="photo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="add-resident" class="btn green radius-xl" style="background-color: <?php echo $primary_color; ?>">Add</button>
                                                <button type="button" class="btn red radius-xl" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="modal fade" id="edit-photo" role="dialog">
                                <form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Change Profile Photo</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <label class="col-form-label">Upload Photo</label>
                                                        <div>
                                                            <input type="file" class="form-control" name="photo" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="edit-photo" class="btn green radius-xl" style="background-color: <?php echo $primary_color; ?>">Change</button>
                                                <button type="button" class="btn red radius-xl" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                    
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

		
		<script>
        $(document).ready(function () {
            $('#table').DataTable();

            $('.archive-btn').on('click', function() {
                var residentId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to archive this resident?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, archive it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the archive action by submitting the form or using AJAX
                        $.ajax({
                            type: "POST",
                            url: "model.php", // Update with your actual URL for archiving
                            data: { id: residentId },
                            success: function(response) {
                                Swal.fire(
                                    'Archived!',
                                    'The resident has been archived.',
                                    'success'
                                ).then(() => {
                                    location.reload(); // Reload the page after successful archive
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>
</html>
