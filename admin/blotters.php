<?php
	use setasign\Fpdi\Fpdi;

	ob_start(); 
	session_start(); 
	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	if(isset($_POST["summon"])) { 
		require_once('fpdf/fpdf.php');
		require_once('vendor/setasign/fpdi/src/autoload.php');
		$pdf = new Fpdi();
		$pdf->AddPage();
		$pdf->setSourceFile('../assets/pdf/summon.pdf');
		$tplIdx = $pdf->importPage(1);
		$pdf->SetTitle("BARANGAY KAONGKOD");  
		$pdf->useTemplate($tplIdx, 0, 0, 200, 290);
		$pdf->SetFont('Times', 'B', 10);
		$pdf->SetTextColor(0, 0, 0);

		$pdf->SetXY(23, 108.2);
		$pdf->Write(0, strtoupper($_POST['def']));

		$pdf->SetXY(23, 82.5);
		$pdf->Write(0, strtoupper($_POST['com']));

		$pdf->SetXY(127.8, 82.5);
		$pdf->Write(0, strtoupper($_POST['acu']));


		$pdf->SetXY(114.8, 143.5);
		$pdf->Write(0, strtoupper(date('g:i A', strtotime($_POST['time']))));

		$pdf->SetXY(147.8, 143.5);
		$pdf->Write(0, date('jS', strtotime($_POST['date_filed'])));

		$pdf->SetXY(27, 148.5);
		$pdf->Write(0, strtoupper(date('F', strtotime($_POST['date_filed']))));

		$pdf->SetXY(55, 148.5);
		$pdf->Write(0, strtoupper(date('Y', strtotime($_POST['date_filed']))));


		$pdf->SetXY(52.5, 204);
		$pdf->Write(0, date('jS'));

		$pdf->SetXY(78.5, 204);
		$pdf->Write(0, strtoupper(date('F')));

		$pdf->SetXY(104, 204);
		$pdf->Write(0, strtoupper("2024"));


		ob_end_clean();
		$pdf->Output('I', 'BARANGAY KAONGKOD.pdf');
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

		<title>Brgy. Kaongkod</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

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
				
				$page = 'blotters';
				$secondnav = 'blotters';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #FCFCFC;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Records Management</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-agenda"></i>Blotters</li>
					</ul>
				</div>  
				
				<?php include 'widget.php'; ?>

				<div class="row">
					<div class="col-lg-12 m-b30">

								
								<div align="right">
									
									<a href="" class="btn green radius-xl" style="background-color: #333333;" data-toggle="modal" data-target="#add-blotters"><i class="ti-agenda"></i><span>&nbsp;ADD BLOTTER RECORD</span></a>

									&nbsp;
									<a href="archived-blotters" class="btn red radius-xl"><i class="ti-archive"></i><span>&nbsp;ARCHIVED BLOTTER RECORDS</span></a>


									
								</div>
								<div style="padding: 25px;"></div>
								<div class="table-responsive">
									<table id="table" class="table hover" style="width:100%">
										<thead>
											<tr>
												<th>Case ID</th>
												<th>Defendant</th>
												<th>Complainant's Fullname</th>
												<th>Accusation</th>
												<th>Blotter Filed</th>
												<th>Status</th>
												<th width="100">Action</th>
												<th>Report</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$blot_status = 1;
												$rows = $model->displayBlotters($blot_status);

												if (!empty($rows)) {
													foreach ($rows as $row) {
														$id = $row['id'];
														$blotter_id = $row['blotter_id'];
														$resident_id = $row['resident_id'];
														$first_name = $row['fname'];
														$middle_name = $row['mname'];
														$last_name = $row['lname'];
														$email = $row['email'];
														$contact = $row['contact'];
														$address = $row['address'];
														$date_added = $row['date_registered'];
														$fullname = $row['complaint_name'];
														$brgy_case = $row['brgy_case'];
														$accussation = $row['accussation'];
														$date_filed = $row['date_filed'];
														$time = $row['time'];
														$blotter_status = !empty($row['blotter_status']) ? $row['blotter_status'] : "Active";
														if ($blotter_status == "Settled") {
														    $blotter_status2 = "warning";
														}
														else {
														    $blotter_status2 = "success";
														}

														$def_name = $first_name.' '.$middle_name.' '.$last_name;
											?>
											<tr>
												<td><?php echo $brgy_case; ?></td>
												<td><?php echo $first_name.' '.$middle_name.' '.$last_name; ?></td>
												<td><?php echo $fullname; ?></td>
												<td><?php echo $accussation; ?></td>
												<td style="font-size: 14px;"><?php echo date('M. d, Y g:i A', strtotime($date_filed)); ?></td>
												<td>
											<center><span class="badge badge-<?php echo $blotter_status2; ?>"><a href="" style="font-size: 14px;color: white;" data-toggle="modal" data-target="#status-<?php echo $row['id']; ?>"><?php echo $blotter_status; ?></a></span></center> 
										</td>
												<td><center><a href="residents-profile?id=<?php echo $resident_id; ?>" class="btn blue" style="width: 50px; height: 37px;"><div data-toggle="tooltip" title="Profile"><i class="ti-search" style="font-size: 12px;"></i></div></a>&nbsp;<a href="" class="btn red" style="width: 50px; height: 37px;" data-toggle="modal" data-target="#decline-<?php echo $id; ?>"><div data-toggle="tooltip" title="Archive"><i class="ti-archive" style="font-size: 12px;"></i></div></a></center>
												</td>

												<td>
													<form method="POST" target="_blank">
													<input type="hidden" name="def" value="<?php echo $def_name; ?>">
													<input type="hidden" name="com" value="<?php echo $fullname; ?>">
													<input type="hidden" name="acu" value="<?php echo $accussation; ?>">

													<input type="hidden" name="date_filed" value="<?php echo $date_filed; ?>">
													<input type="hidden" name="time" value="<?php echo $time; ?>">


													<!-- <input type="hidden" name="day" value="<?php echo $day; ?>">
													<input type="hidden" name="month" value="<?php echo $month; ?>">
													<input type="hidden" name="age" value="<?php echo $age; ?>">
 -->

													<button type="submit" name="summon" class="btn btn-block green radius-xl" style="float: right;">PRINT</button><br><br>
												</form>
												</td>
											</tr>
											
											<div id="status-<?php echo $row['id']; ?>" class="modal fade" role="dialog">
										<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Update Blotter Status</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<div class="row">
															<input class="form-control" type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
															<div class="form-group col-12">
																<label class="col-form-label">Defendant</label>
																<input class="form-control" type="text" value="<?php echo $first_name.' '.$middle_name.' '.$last_name; ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Complainant's Fullname</label>
																<input class="form-control" type="text" value="<?php echo $fullname; ?>" readonly>
															</div>
                                                            <div class="form-group col-12">
																<label class="col-form-label">Accusation</label>
																<input class="form-control" type="text" value="<?php echo $accussation; ?>" readonly>
															</div>
															<div class="form-group col-12">
																<label class="col-form-label">Status</label>
																<select class="form-control" name="blotter_status">
																	<option value="Active"<?php if ($blotter_status == "Active") { echo "selected"; } else {} ?>>Active</option>
																	<option value="Settled"<?php if ($blotter_status == "Settled") { echo "selected"; } else {} ?>>Settled</option>
																</select>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<input type="submit" class="btn green radius-xl outline" name="status" value="Update Status">
														<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</form>
									</div>

											<div id="decline-<?php echo $id; ?>" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Archive Blotter Record</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<input type="hidden" name="decline_hidden" value="<?php echo $blotter_id; ?>">
																<div class="row">
																	<div class="form-group col-6">
																		<label class="col-form-label">Brgy. Case ID</label>
																		<input class="form-control" type="text" value="<?php echo $row['brgy_case']; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Accusation</label>
																		<input class="form-control" type="text" value="<?php echo $row['accussation']; ?>" readonly>
																	</div>
																	<div class="form-group col-12">
																		<label class="col-form-label">Defendant</label>
																		<input class="form-control" type="text" value="<?php echo $first_name.' '.$middle_name.' '.$last_name; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Complainant’s Full Name</label>
																		<input class="form-control" type="text" value="<?php echo $row['complaint_name']; ?>" readonly>
																	</div>
																	<div class="form-group col-6">
																		<label class="col-form-label">Complainant’s Address</label>
																		<input class="form-control" type="text" value="<?php echo $row['address']; ?>" readonly>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Age</label>
																		<input class="form-control" type="text" value="<?php echo $row['age']; ?>" readonly>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Gender</label>
																		<input class="form-control" type="text" value="<?php echo $row['gender']; ?>" readonly>
																	</div>
																	<div class="form-group col-4">
																		<label class="col-form-label">Contact Number</label>
																		<input class="form-control" type="text" value="<?php echo $row['contact']; ?>" readonly>
																	</div>
																	<div class="form-group col-3">
																		<label class="col-form-label">Date Happened</label>
																		<input class="form-control" type="text" value="<?php echo date('M. d, Y', strtotime($row['date'])); ?>" readonly>
																	</div>
																	<div class="form-group col-3">
																		<label class="col-form-label">Time</label>
																		<input class="form-control" type="text" value="<?php echo date('g:i A', strtotime($row['time'])); ?>" readonly>
																	</div>
																	<div class="form-group col-3">
																		<label class="col-form-label">Where</label>
																		<input class="form-control" type="text" value="<?php echo $row['happened']; ?>" readonly>
																	</div>
																	<div class="form-group col-3">
																		<label class="col-form-label">Blotter Date</label>
																		<input class="form-control" type="text" value="<?php echo date('M. d, Y', strtotime($row['date_filed'])); ?>" readonly>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn red radius-xl outline" name="archive" value="Archive">
																<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php


														if (isset($_POST['archive'])) {
															$decline_hidden = $_POST['decline_hidden'];
															$model->changeBlotterStatus(2, $decline_hidden);
															echo "<script>window.open('blotters', '_self');</script>";
														}
														
														if (isset($_POST['status'])) {
														    $model->changeBlotterStatus2($_POST['blotter_status'], $_POST['update_id']);
														    echo "<script>window.open('blotters', '_self');</script>";
														}
													}
												}

											?>
										</tbody>
									</table>
								</div>
								<br>
								<hr>
								<!-- <div align="right">

									<a href="blotters-chart" class="btn blue radius-xl"><i class="ti-bar-chart"></i><span>&nbsp;BLOTTER STATISTICS</span></a>


									
								</div> -->

								<div id="add-blotters" class="modal fade" role="dialog">
									<form class="edit-profile m-b30" method="POST">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><img src="../assets/images/<?php echo $web_icon; ?>.png" style="width: 30px; height: 30px;">&nbsp;Add Blotter Record</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-6">
															<label class="col-form-label"><b>Brgy. Case ID</b></label>
															<input id="brgy_case_id" class="form-control" type="text" name="brgy_case" readonly>
														</div>

														<div class="form-group col-6">
															<label class="col-form-label"><b>Defendant</b></label>
															<input type="text" class="form-control" name="defendant_name" placeholder="Type the defendant's name here" required>
														</div>

														<div class="form-group col-6">
															<label class="col-form-label"><b>Accusation</b></label>
															<select class="form-control" name="accusation">
																<option value="Arrest report">Arrest report</option>
																<option value="Incident report">Incident report</option>
																<option value="Crime report">Crime report</option>
																<option value="Accident report">Accident report</option>
																<option value="Others">Others</option>
															</select>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Specify Accusation</b></label>
															<input class="form-control" type="text" name="spec_accu" required>
														</div>
														<div class="form-group col-6">
															<label class="col-form-label"><b>Complainant’s Full Name</b></label>
															<select class="form-control" name="complaint_name">

															<?php 
															$status = 1; // Assuming this is the status for registered residents
															$rows = $model->displayResidents($status);

															if (!empty($rows)) {
																foreach ($rows as $row) {
																	$id = $row['id'];
																	$first_name = $row['fname'];
																	$middle_name = $row['mname'];
																	$last_name = $row['lname'];
															?>
																<option value="<?php echo $first_name . ' ' . $middle_name . ' ' . $last_name; ?>"><?php echo $last_name; ?>, <?php echo $first_name; ?> <?php echo $middle_name; ?></option>
															<?php
																}
															}
															?>
															</select>
														</div>


														<div class="form-group col-6">
															<label class="col-form-label"><b>Complainant’s Address</b></label>
															<input class="form-control" type="text" name="address" required>
														</div>
														<div class="form-group col-4">
															<label class="col-form-label"><b>Age</b></label>
															<select class="form-control" name="age" required>
																<option value="" disabled selected>Select age</option>
																<!-- Options for ages 1 to 130 -->
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
																<option value="13">13</option>
																<option value="14">14</option>
																<option value="15">15</option>
																<option value="16">16</option>
																<option value="17">17</option>
																<option value="18">18</option>
																<option value="19">19</option>
																<option value="20">20</option>
																<option value="21">21</option>
																<option value="22">22</option>
																<option value="23">23</option>
																<option value="24">24</option>
																<option value="25">25</option>
																<option value="26">26</option>
																<option value="27">27</option>
																<option value="28">28</option>
																<option value="29">29</option>
																<option value="30">30</option>
																<option value="31">31</option>
																<option value="32">32</option>
																<option value="33">33</option>
																<option value="34">34</option>
																<option value="35">35</option>
																<option value="36">36</option>
																<option value="37">37</option>
																<option value="38">38</option>
																<option value="39">39</option>
																<option value="40">40</option>
																<option value="41">41</option>
																<option value="42">42</option>
																<option value="43">43</option>
																<option value="44">44</option>
																<option value="45">45</option>
																<option value="46">46</option>
																<option value="47">47</option>
																<option value="48">48</option>
																<option value="49">49</option>
																<option value="50">50</option>
																<option value="51">51</option>
																<option value="52">52</option>
																<option value="53">53</option>
																<option value="54">54</option>
																<option value="55">55</option>
																<option value="56">56</option>
																<option value="57">57</option>
																<option value="58">58</option>
																<option value="59">59</option>
																<option value="60">60</option>
																<option value="61">61</option>
																<option value="62">62</option>
																<option value="63">63</option>
																<option value="64">64</option>
																<option value="65">65</option>
																<option value="66">66</option>
																<option value="67">67</option>
																<option value="68">68</option>
																<option value="69">69</option>
																<option value="70">70</option>
																<option value="71">71</option>
																<option value="72">72</option>
																<option value="73">73</option>
																<option value="74">74</option>
																<option value="75">75</option>
																<option value="76">76</option>
																<option value="77">77</option>
																<option value="78">78</option>
																<option value="79">79</option>
																<option value="80">80</option>
																<option value="81">81</option>
																<option value="82">82</option>
																<option value="83">83</option>
																<option value="84">84</option>
																<option value="85">85</option>
																<option value="86">86</option>
																<option value="87">87</option>
																<option value="88">88</option>
																<option value="89">89</option>
																<option value="90">90</option>
																<option value="91">91</option>
																<option value="92">92</option>
																<option value="93">93</option>
																<option value="94">94</option>
																<option value="95">95</option>
																<option value="96">96</option>
																<option value="97">97</option>
																<option value="98">98</option>
																<option value="99">99</option>
																<option value="100">100</option>
																<option value="101">101</option>
																<option value="102">102</option>
																<option value="103">103</option>
																<option value="104">104</option>
																<option value="105">105</option>
																<option value="106">106</option>
																<option value="107">107</option>
																<option value="108">108</option>
																<option value="109">109</option>
																<option value="110">110</option>
																<option value="111">111</option>
																<option value="112">112</option>
																<option value="113">113</option>
																<option value="114">114</option>
																<option value="115">115</option>
																<option value="116">116</option>
																<option value="117">117</option>
																<option value="118">118</option>
																<option value="119">119</option>
																<option value="120">120</option>
																<option value="121">121</option>
																<option value="122">122</option>
																<option value="123">123</option>
																<option value="124">124</option>
																<option value="125">125</option>
																<option value="126">126</option>
																<option value="127">127</option>
																<option value="128">128</option>
																<option value="129">129</option>
																<option value="130">130</option>
															</select>
														</div>
														<div class="form-group col-4">
															<label class="col-form-label"><b>Gender</b></label>
															<select class="form-control" name="gender">
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
														</div>
														<div class="form-group col-4">
																<label class="col-form-label"><b>Contact Number</b></label>
																<input class="form-control" 
																type="tel" 
																name="contact" 
																required 
																maxlength="11" 
																pattern="[0-9]{11}" 
																title="Please enter exactly 11 digits"
																value="09">
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Date Happened</b></label>
															<input class="form-control" type="date" name="date" required>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Time</b></label>
															<input class="form-control" type="time" name="time" required>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Where</b></label>
															<input class="form-control" type="text" name="happened" required>
														</div>
														<div class="form-group col-3">
															<label class="col-form-label"><b>Blotter Filed</b></label>
															<input class="form-control" type="datetime-local" name="date_filed" required>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn green radius-xl outline" name="add-confirm" value="Add Record">
													<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>

								<?php

									if (isset($_POST['add-confirm'])) {
										$model->addBlotters($_POST['def_id'], $_POST['brgy_case'], $_POST['complaint_name'], $_POST['age'], $_POST['gender'], $_POST['address'], $_POST['contact'], $_POST['time'], $_POST['date'], $_POST['happened'], $_POST['accusation'], $_POST['date_filed']);

										echo "<script>window.open('blotters', '_self');</script>";
									}

								?>
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

		<script>
			// Function to generate a random numeric string
			function generateNumericID(length) {
				let result = '';
				for (let i = 0; i < length; i++) {
					result += Math.floor(Math.random() * 10); // Generates a random digit (0-9)
				}
				return result;
			}

			// Generate a 8-digit numeric ID (you can adjust the length as needed)
			document.addEventListener('DOMContentLoaded', function() {
				document.getElementById('brgy_case_id').value = generateNumericID(5);
			});
		</script>


		<script type="text/javascript">
			$(document).ready(function() {
				$('#table').DataTable();
			});
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
		<script>
			document.querySelector('input[name="contact"]').addEventListener('input', function (e) {
				let value = e.target.value;
				// Remove non-numeric characters and limit the length to 11
				e.target.value = value.replace(/\D/g, '').substring(0, 11);
			});
		</script>

	</body>

</html>