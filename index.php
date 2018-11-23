<?php
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
?>
<!doctype html>
<html lang="en">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<head>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/vendor.css">
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="page-container">
			<div class="panel-container">
				<div class="panel-left">
					<div class="col-lg-12 col-sm-12">
						<div class="content form">
							<h2 style="text-align: center;">Our Client</h2>
							<hr>
							<div style="margin: 15px;">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Job</th>
											<th>Costumer</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="splitter"></div>
				<div class="panel-right">
					<div class="col-lg-12 col-sm-12">
						<div class="content form">
							<h2 style="text-align: center;">AGM Technology Job #3440</h2>
							<hr>
							<form action="action.php" method="POST" enctype="multipart/form-data">
								
								<div class="row">
									<div class="col-xs-4">
										<input required  type="radio" name="account" value="AGM Chargable Job" id="radio1" checked />
										<label for="radio1" class="radio"> AGM Chargable Job</label>
									</div>
									<div class="col-xs-4">
										<input required  type="radio" name="account" value="OKI Warranty" id="radio2">
										<label for="radio2" class="radio"> OKI Warranty</label>
									</div>
									<div style="margin-top: 5%;">
										<div class="col-xs-8"></div>
										<div class="col-xs-4">
											<div class="input-group">
												<span class="input-group-addon" style="min-width: 100px;">
													<span class="fa fa-shield"></span> Job Ref
												</span>
												<input required  type="text" class="form-control" name="job_no" placeholder="Job">
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-xs-12">
										<div class="input-group">
											<span class="input-group-addon">
												<span class="fa fa-user"></span> Customer Name
											</span>
											<input required  type="text" class="form-control" name="company_name" placeholder="Company">
										</div>
									</div>
									<div class="col-xs-12">
										<div class="input-group">
											<span class="input-group-addon">
												<span class="fa fa-user"></span> Contact Name
											</span>
											<input required  type="text" class="form-control" name="contact_name" placeholder="Contact Name">
										</div>
									</div>
									<div class="col-xs-12">
										<div class="input-group">
											<span class="input-group-addon">
												<span class="fa fa-print"></span> Printer Model
											</span>
											<input required  type="text" class="form-control" name="printer_model" placeholder="Printer Model">
										</div>
									</div>
									<div class="col-xs-12">
										<div class="input-group">
											<span class="input-group-addon">
												<span class="fa fa-print"></span> Printer Serial
											</span>
											<input required  type="text" class="form-control" name="printer_serial" placeholder="Printer Serial">
										</div>
									</div>
									<div class="col-xs-6">
										<div class="input-group">
											<span class="input-group-addon">
												<span class="fa fa-print"></span> Page Count Mono
											</span>
											<input required  type="text" class="form-control" name="page_count_mono" placeholder="Mono">
										</div>
									</div>
									<div class="col-xs-6">
										<div class="input-group">
											<span class="input-group-addon">
												<span class="fa fa-print"></span> Page Count Color
											</span>
											<input required  type="text" class="form-control" name="page_count_color" placeholder="Col">
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-xs-12">
										<div class="input-group" style="max-width: 90px;border-radius: 4px;">
											<span class="input-group-addon notes" style="height: 38px;border-radius: 4px;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
												<span class="fa fa-user"></span> Service Notes
											</span>
										</div>
									</div>
									<div class="col-xs-12">
										<textarea class="form-control" name="service_notes" rows="8"></textarea>
									</div>
									<div class="col-xs-12" style="margin-top: 10px;text-align: center;">
										<button class="btn btn-primary" onclick="append('Technician attended Onsite');return false;">Technician Attended</button>
										<button class="btn btn-primary" onclick="append('found machine');return false;">Found Machine</button>
										<button class="btn btn-primary" onclick="append('Technician Returned Onsite');return false;">Returned Onsite</button>
										<button class="btn btn-primary" onclick="append('Supplied & Installed');return false;">Supplied & Installed</button>
									</div>
									<div class="col-xs-12" style="margin-top: 10px;text-align: center;">
										<button class="btn btn-primary" onclick="append('Performed Internal clean and test');return false;">Performed Clean</button>
										<button class="btn btn-primary" onclick="append('Vacuumed machine. Performed Paper path clean.');return false;">Vacuumed Machine</button>
										<button class="btn btn-primary" onclick="append('Machine Tested. Tested OK. ');return false;">Machine Tested</button>
										<button class="btn btn-primary" onclick="append('');return false;">Clear All</button>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-xs-4">
										<select class="form-control" name="status">
											<option selected disabled>--Please Select--</option>
											<option value="FINISHED" >FINISHED</option>
											<option value="PARTS">PARTS</option>
											<option value="QUOTE">QUOTE</option>
											<option value="CANCEL">CANCEL</option>
										</select>
									</div>
								</div>
								<div class="row" style="margin-top:15px;margin-left: 20px;margin-right: 20px">
									<div class="col-xs-12">
										<div class="form-group">
											<div class="input-group input-file">
												<span class="input-group-addon" style="min-width:80px;">
													<span class="fa fa-file"></span> Choose File
												</span>
												<input required  type="text"  class="form-control" placeholder='No File Selected...'>
												<span class="input-group-btn">
													<button class="btn btn-warning btn-reset" type="button">Reset</button>
												</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group">
											<div class="input-group input-file">
												<span class="input-group-addon" style="min-width:80px;">
													<span class="fa fa-file"></span> Choose File
												</span>
												<input required  type="text"  class="form-control" placeholder='No File Selected...'>
												<span class="input-group-btn">
													<button class="btn btn-warning btn-reset" type="button">Reset</button>
												</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group">
											<div class="input-group input-file">
												<span class="input-group-addon" style="min-width:80px;">
													<span class="fa fa-file"></span> Choose File
												</span>
												<input required  type="text" class="form-control" placeholder='No File Selected...'>
												<span class="input-group-btn">
													<button class="btn btn-warning btn-reset" type="button">Reset</button>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-8"></div>
									<div class="col-xs-4">
										<canvas id="signature"></canvas>
										<input required  type="hidden" name="signature">
									</div>
									<div class="col-xs-8"></div>
									<div class="col-xs-4">
										<button class="btn btn-warning btn-block" id="erase" type="button">Clear Signature</button>
									</div>
									<div class="col-xs-8"></div>
									<div class="col-xs-4">
										<input required  type="text" class="form-control signature" name="name" placeholder="Full Name">
									</div>
									<div class="col-xs-8"></div>
									<div class="col-xs-4">
										<input required  type="number" class="form-control signature" name="phone" placeholder="Phone Number">
									</div>
									<div class="col-xs-4"></div>
									<div class="col-xs-4">
										<button class="btn btn-primary btn-block" id="save" type="button">Send</button>
									</div>
								</div>
								<hr>
								<div class="footer">
									AGM Technology <a href="/">Job Form</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
		<script src="js/jquery.js"></script>
		<script src="js/datatable.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/select.js"></script>
		<script src="js/scroll.js"></script>
		<script src="js/pad.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<script src="js/octopy.js"></script>
		<script src="js/resize/src/ResizeSensor.js"></script>
		<script src="js/resize/src/ElementQueries.js"></script>
		<?php if(isset($_SESSION['message']) && $_SESSION['message'] !== '') : ?>
			<script type="text/javascript">
				<?php if($_SESSION['status'] == 0) : ?>
					toastr.error('<?php echo $_SESSION['message']; ?>');
				<?php else : ?>
					toastr.success('<?php echo $_SESSION['message']; ?>')
				<?php endif;?>
			</script>
		<?php $_SESSION['message'] = ''; endif; ?>
	</body>
</html>