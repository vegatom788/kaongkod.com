	<header class="ttr-header">
		<div class="ttr-header-wrapper">
			<div class="ttr-toggle-sidebar ttr-material-button">
				<i class="ti-close ttr-open-icon"></i>
				<i class="ti-menu ttr-close-icon"></i>
			</div>
			<div class="ttr-logo-box">
				<div>
					<a href="index" class="ttr-logo">
						<img alt="" class="ttr-logo-mobile" src="../assets/images/3r.png" style="width: 100px; height: 36px;">
						<img alt="" class="ttr-logo-desktop" src="../assets/images/3r.png" style="width: 200px; height: 36px;">
					</a>
				</div>
			</div>
			<div class="ttr-header-menu">
			</div>
			<div class="ttr-header-right ttr-with-seperator">
				<ul class="ttr-header-navigation">
<!-- 					<li>
						<a href="#" class="ttr-material-button ttr-submenu-toggle"><span class="ttr-user-avatar"><i class="fa fa-cog fa-spin" style="font-size: 32px;"></i></span></a>
						
						<div class="ttr-header-submenu">
							<div class="ttr-notify-header">
								<span class="ttr-notify-text-top">9 New</span>
								<span class="ttr-notify-text">User Notifications</span>
							</div>
							<ul>
								<li><a href="index">My profile</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</div>
					</li> -->
					<?php
					$status = 1;
					$rows = $model->displayResidents($status);
					$hasUnverified = false; // Flag to check for unverified residents

					if (!empty($rows)) {
						foreach ($rows as $row) {
							$verified = $row['verified'];

							if ($verified == 0) {
								// Not verified
								$hasUnverified = true; // Set the flag if unverified resident is found
								break; // No need to check further if we found at least one unverified
							}
						}
					}
					?>

					<li id="checkmark-circle" style="position: relative;">
						<a href="residents.php">
							<i class="fa fa-check-circle"></i>
							<?php if ($hasUnverified): ?>
								<span class="notification-dot"></span>
							<?php endif; ?>
						</a>
					</li>

					<style>
					.notification-dot {
						position: absolute;
						width: 10px;
						height: 10px;
						background-color: black; /* Color of the dot */
						border-radius: 50%; /* Makes it a circle */
						border: 2px solid white; /* Optional: white border for better visibility */
					}
					</style>

						<li id="bell">
							<a href="monitoring-of-request.php">
									<i class="fa fa-bell"></i>
									<?php
									$rows = $model->fetchRequests();
									$notificationCount = 0;

									if (!empty($rows)) {
											foreach ($rows as $row) {
													// Assuming request_status 1 means pending or new requests
													if ($row['request_type'] == 1 || $row['request_type'] == 2 || $row['request_type'] == 3) {
															$notificationCount++;
													}
											}
									}

									// Display the notification count if there are pending requests
									if ($notificationCount > 0) {
											echo '<span class="notification-badge">' . $notificationCount . '</span>';
									}
									?>
							</a>
						</li>

					<li>
						<a href="#" class="ttr-material-button ttr-submenu-toggle"><img src="../assets/images/<?php echo  $web_icon; ?>.png" style="height: 45px; width: 45px;border-radius: 50%;"></a>
						<div class="ttr-header-submenu noti-menu">
							<div class="ttr-notify-header">
								<span class="ttr-notify-text-top"><?php echo $nm; ?></span>
								<span class="ttr-notify-text">Barangay Kaongkod</span>
							</div>
							<div class="noti-box-list">
								<ul>
									<a href="settings" style="text-decoration: none;color: black;"><li>
										
										<span class="notification-icon dashbg-green">
											<i class="fa fa-user" style="font-size: 18px;"></i>
										</span>
										<span style="font-size: 22px;" style="color: black!important;">
											My Profile
										</span>
									</li></a><hr>
									<a href="index" style="text-decoration: none;color: black;"><li>
										
										<span class="notification-icon dashbg-yellow">
											<i class="fa fa-calendar" style="font-size: 18px;"></i>
										</span>
										<span style="font-size: 22px;" style="color: black!important;">
											Calendar
										</span>
									</li></a><hr>
									<a href="logout" style="text-decoration: none;color: black;"><li>
										<span class="notification-icon dashbg-red">
											<i class="fa fa-sign-out" style="font-size: 18px;"></i>
										</span>
										<span style="font-size: 22px;" style="color: black!important;">
											Logout
										</span>
									</li></a>
								</ul>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</header>