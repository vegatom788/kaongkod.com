				<style type="text/css">
					.show2 {
						background-color: #fff !important;
						color: #333;
					}
					.txtclr {
						color: <?php echo $secondary_color; ?>!important;
					}
				</style>
				<nav class="ttr-sidebar-navi">
					<ul>
						

						<li class="" style="margin-top: 0px;">
							<a href="homepage" class="ttr-material-button <?php echo ($page == 'dashboard') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-home <?php echo ($page == 'dashboard') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'dashboard') ? "show2" : ""; ?>">Dashboard</span>
							</a>
						</li>

						<li>
							<a href="announcement" class="ttr-material-button <?php echo ($page == 'announcement') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-announcement <?php echo ($page == 'announcement') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'announcement') ? "show2" : ""; ?>">Announcements</span>
							</a>
						</li>

						<li>
							<a href="clearance" class="ttr-material-button <?php echo ($page == 'services') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-agenda <?php echo ($page == 'services') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'services') ? "show2" : ""; ?>">Request Services</span>
							</a>
						</li>

						<li>
							<a href="my-blotters" class="ttr-material-button <?php echo ($page == 'my-blotters') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-list <?php echo ($page == 'my-blotters') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'my-blotters') ? "show2" : ""; ?>">My Blotter Record</span>
							</a>
						</li>

						<li>
							<a href="officials" class="ttr-material-button <?php echo ($page == 'officials') ? "show2" : ""; ?>">
								<span class="ttr-icon"><i class="ti-user <?php echo ($page == 'officials') ? "show2" : ""; ?>"></i></span>
								<span class="ttr-label <?php echo ($page == 'officials') ? "show2" : ""; ?>">Officials</span>
							</a>
						</li>







						<li class="ttr-seperate"></li>
						<br><br><br><br>
					</ul>
				</nav>
