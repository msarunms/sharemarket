<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: register.php");
    exit;
}
?>
<?php include '../Common_header/header.php'; ?>
    <!-- partial -->
		
					<div class="row mt-4">
					<div class="col-sm-12 flex-column d-flex stretch-card">
							<div class="row">
								<!-- <div class="col-lg-4 d-flex grid-margin stretch-card">
									<div class="card bg-primary">
										<div class="card-body text-white">
											<h3 class="font-weight-bold mb-3">18,39 (75GB)</h3>
											<div class="progress mb-3">
												<div class="progress-bar  bg-warning" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<p class="pb-0 mb-0">Bandwidth usage</p>
										</div>
									</div>
								</div>
								<div class="col-lg-4 d-flex grid-margin stretch-card">
									<div class="card sale-diffrence-border">
										<div class="card-body">
											<h2 class="text-dark mb-2 font-weight-bold">$6475</h2>
											<h4 class="card-title mb-2">Sales Difference</h4>
											<small class="text-muted">APRIL 2019</small>
										</div>
									</div>
								</div>
								<div class="col-lg-4 d-flex grid-margin stretch-card">
									<div class="card sale-visit-statistics-border">
										<div class="card-body">
											<h2 class="text-dark mb-2 font-weight-bold">$3479</h2>
											<h4 class="card-title mb-2">Visit Statistics</h4>
											<small class="text-muted">APRIL 2019</small>
										</div>
									</div>
								</div> -->
							</div>
							<div class="row">
								<div class="col-sm-12 grid-margin d-flex stretch-card">
									<div class="card">
										<div class="card-body">
											<div class="d-flex align-items-center justify-content-between">
												<h4 class="card-title mb-2">Last 30 record Stock Details</h4>
												<div class="dropdown">
													<!-- <a href="#" class="text-success btn btn-link  px-1"><i class="mdi mdi-refresh"></i></a>
													<a href="#" class="text-success btn btn-link px-1 dropdown-toggle dropdown-arrow-none" data-bs-toggle="dropdown" id="settingsDropdownsales">
														<i class="mdi mdi-dots-horizontal"></i></a> -->
														<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="settingsDropdownsales">
															<a class="dropdown-item">
																<i class="mdi mdi-grease-pencil text-primary"></i>
																Edit
															</a>
															<a class="dropdown-item">
																<i class="mdi mdi-delete text-primary"></i>
																Delete
															</a>
														</div>
												</div>
											</div>
											<div>
												<ul class="nav nav-tabs tab-no-active-fill" role="tablist">
													<li class="nav-item">
														<a class="nav-link active ps-2 pe-2" id="revenue-for-last-month-tab" data-bs-toggle="tab" href="#revenue-for-last-month" role="tab" aria-controls="revenue-for-last-month" aria-selected="true">Daily Details</a>
													</li>
													<!-- <li class="nav-item">
														<a class="nav-link ps-2 pe-2" id="server-loading-tab" data-bs-toggle="tab" href="#server-loading" role="tab" aria-controls="server-loading" aria-selected="false">Weekly Details</a>
													</li>
													<li class="nav-item">
														<a class="nav-link ps-2 pe-2" id="data-managed-tab" data-bs-toggle="tab" href="#data-managed" role="tab" aria-controls="data-managed" aria-selected="false">Monthly Details</a>
													</li>
													<li class="nav-item">
														<a class="nav-link ps-2 pe-2" id="sales-by-traffic-tab" data-bs-toggle="tab" href="#sales-by-traffic" role="tab" aria-controls="sales-by-traffic" aria-selected="false">Hourly Details</a>
													</li>
													<li class="nav-item">
														<a class="nav-link ps-2 pe-2" id="sales-by-traffic-tab" data-bs-toggle="tab" href="#sales-by-traffic" role="tab" aria-controls="sales-by-traffic" aria-selected="false">15 Min Details</a>
													</li> -->
												</ul>
												<div class="tab-content tab-no-active-fill-tab-content">
													<div class="tab-pane fade show active" id="revenue-for-last-month" role="tabpanel" aria-labelledby="revenue-for-last-month-tab">
														<div class="d-lg-flex justify-content-between">
															
															<canvas id="lineChart" width="" height=""></canvas>

														</div>
														<!-- <canvas id="revenue-for-last-month-chart"></canvas> -->
													</div>
													<div class="tab-pane fade" id="server-loading" role="tabpanel" aria-labelledby="server-loading-tab">
														<div class="d-flex justify-content-between">
															<p class="mb-4">+5.2% vs last 7 days</p>
															<div id="serveLoading-legend" class="revenuechart-legend">f</div>
														</div>
														<canvas id="serveLoading"></canvas>
													</div>
													<div class="tab-pane fade" id="data-managed" role="tabpanel" aria-labelledby="data-managed-tab">
														<div class="d-flex justify-content-between">
															<p class="mb-4">+5.2% vs last 7 days</p>
															<div id="dataManaged-legend" class="revenuechart-legend">f</div>
														</div>
														<canvas id="dataManaged"></canvas>
													</div>
													<div class="tab-pane fade" id="sales-by-traffic" role="tabpanel" aria-labelledby="sales-by-traffic-tab">
														<div class="d-flex justify-content-between">
															<p class="mb-4">+5.2% vs last 7 days</p>
															<div id="salesTrafic-legend" class="revenuechart-legend">f</div>
														</div>
														<canvas id="salesTrafic"></canvas>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-lg-4 mb-3 mb-lg-0">
							<div class="card congratulation-bg text-center">
								<div class="card-body pb-0">
									<img src="images/dashboard/face29.png" alt="">  
									<h2 class="mt-3 text-white mb-3 font-weight-bold">Congratulations
										Johnson
									</h2>
									<p>You have done 57.6% more sales today. 
										Check your new badge in your profile.
									</p>
								</div>
							</div>
						</div> -->
					</div>
					<!-- <div class="row">
						<div class="col-sm-8 flex-column d-flex stretch-card">
							<div class="row">
								<div class="col-lg-4 d-flex grid-margin stretch-card">
									<div class="card bg-primary">
										<div class="card-body text-white">
											<h3 class="font-weight-bold mb-3">18,39 (75GB)</h3>
											<div class="progress mb-3">
												<div class="progress-bar  bg-warning" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<p class="pb-0 mb-0">Bandwidth usage</p>
										</div>
									</div>
								</div>
								<div class="col-lg-4 d-flex grid-margin stretch-card">
									<div class="card sale-diffrence-border">
										<div class="card-body">
											<h2 class="text-dark mb-2 font-weight-bold">$6475</h2>
											<h4 class="card-title mb-2">Sales Difference</h4>
											<small class="text-muted">APRIL 2019</small>
										</div>
									</div>
								</div>
								<div class="col-lg-4 d-flex grid-margin stretch-card">
									<div class="card sale-visit-statistics-border">
										<div class="card-body">
											<h2 class="text-dark mb-2 font-weight-bold">$3479</h2>
											<h4 class="card-title mb-2">Visit Statistics</h4>
											<small class="text-muted">APRIL 2019</small>
										</div>
									</div>
								</div>
							</div> -->
							<!-- <div class="row">
								<div class="col-sm-12 grid-margin d-flex stretch-card">
									<div class="card">
										<div class="card-body">
											<div class="d-flex align-items-center justify-content-between">
												<h4 class="card-title mb-2">Sales Difference</h4>
												<div class="dropdown">
													<a href="#" class="text-success btn btn-link  px-1"><i class="mdi mdi-refresh"></i></a>
													<a href="#" class="text-success btn btn-link px-1 dropdown-toggle dropdown-arrow-none" data-bs-toggle="dropdown" id="settingsDropdownsales">
														<i class="mdi mdi-dots-horizontal"></i></a>
														<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="settingsDropdownsales">
															<a class="dropdown-item">
																<i class="mdi mdi-grease-pencil text-primary"></i>
																Edit
															</a>
															<a class="dropdown-item">
																<i class="mdi mdi-delete text-primary"></i>
																Delete
															</a>
														</div>
												</div>
											</div>
											<div>
												<ul class="nav nav-tabs tab-no-active-fill" role="tablist">
													<li class="nav-item">
														<a class="nav-link active ps-2 pe-2" id="revenue-for-last-month-tab" data-bs-toggle="tab" href="#revenue-for-last-month" role="tab" aria-controls="revenue-for-last-month" aria-selected="true">Revenue for last month</a>
													</li>
													<li class="nav-item">
														<a class="nav-link ps-2 pe-2" id="server-loading-tab" data-bs-toggle="tab" href="#server-loading" role="tab" aria-controls="server-loading" aria-selected="false">Server loading</a>
													</li>
													<li class="nav-item">
														<a class="nav-link ps-2 pe-2" id="data-managed-tab" data-bs-toggle="tab" href="#data-managed" role="tab" aria-controls="data-managed" aria-selected="false">Data managed</a>
													</li>
													<li class="nav-item">
														<a class="nav-link ps-2 pe-2" id="sales-by-traffic-tab" data-bs-toggle="tab" href="#sales-by-traffic" role="tab" aria-controls="sales-by-traffic" aria-selected="false">Sales by traffic</a>
													</li>
												</ul>
												<div class="tab-content tab-no-active-fill-tab-content">
													<div class="tab-pane fade show active" id="revenue-for-last-month" role="tabpanel" aria-labelledby="revenue-for-last-month-tab">
														<div class="d-lg-flex justify-content-between">
															<p class="mb-4">+5.2% vs last 7 days</p>
															<div id="revenuechart-legend" class="revenuechart-legend">f</div>
														</div>
														<canvas id="revenue-for-last-month-chart"></canvas>
													</div>
													<div class="tab-pane fade" id="server-loading" role="tabpanel" aria-labelledby="server-loading-tab">
														<div class="d-flex justify-content-between">
															<p class="mb-4">+5.2% vs last 7 days</p>
															<div id="serveLoading-legend" class="revenuechart-legend">f</div>
														</div>
														<canvas id="serveLoading"></canvas>
													</div>
													<div class="tab-pane fade" id="data-managed" role="tabpanel" aria-labelledby="data-managed-tab">
														<div class="d-flex justify-content-between">
															<p class="mb-4">+5.2% vs last 7 days</p>
															<div id="dataManaged-legend" class="revenuechart-legend">f</div>
														</div>
														<canvas id="dataManaged"></canvas>
													</div>
													<div class="tab-pane fade" id="sales-by-traffic" role="tabpanel" aria-labelledby="sales-by-traffic-tab">
														<div class="d-flex justify-content-between">
															<p class="mb-4">+5.2% vs last 7 days</p>
															<div id="salesTrafic-legend" class="revenuechart-legend">f</div>
														</div>
														<canvas id="salesTrafic"></canvas>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
						<!-- </div>
						<div class="col-sm-4 flex-column d-flex stretch-card">
							<div class="row flex-grow">
								<div class="col-sm-12 grid-margin stretch-card">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-lg-8">
													<h3 class="font-weight-bold text-dark">Canada,Ontario</h3>
													<p class="text-dark">Monday 3.00 PM</p>
													<div class="d-lg-flex align-items-baseline mb-3">
														<h1 class="text-dark font-weight-bold">23<sup class="font-weight-light"><small>o</small><small class="font-weight-medium">c</small></sup></h1>
														<p class="text-muted ms-3">Partly cloudy</p>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="position-relative">
														<img src="images/dashboard/live.png" class="w-100" alt="">
														<div class="live-info badge badge-success">Live</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12 mt-4 mt-lg-0">
													<div class="bg-primary text-white px-4 py-4 card">
														<div class="row">
															<div class="col-sm-6 pl-lg-5">
																<h2>$1635</h2>
																<p class="mb-0">Your Iincome</p>
															</div>
															<div class="col-sm-6 climate-info-border mt-lg-0 mt-2">
																<h2>$2650</h2>
																<p class="mb-0">Your Spending</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row pt-3 mt-md-1">
												<div class="col">
													<div class="d-flex purchase-detail-legend align-items-center">
														<div id="circleProgress1" class="p-2"></div>
														<div>
															<p class="font-weight-medium text-dark text-small">Sessions</p>
															<h3 class="font-weight-bold text-dark  mb-0">26.80%</h3>
														</div>
													</div>
												</div>
												<div class="col">
													<div class="d-flex purchase-detail-legend align-items-center">
														<div id="circleProgress2" class="p-2"></div>
														<div>
															<p class="font-weight-medium text-dark text-small">Users</p>
															<h3 class="font-weight-bold text-dark  mb-0">56.80%</h3>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 grid-margin stretch-card">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-sm-12">
													<div class="d-flex align-items-center justify-content-between">
														<h4 class="card-title mb-0">Visits Today</h4>
														<div class="dropdown">
															<a href="#" class="text-success btn btn-link  px-1"><i class="mdi mdi-refresh"></i></a>
															<a href="#" class="text-success btn btn-link px-1 dropdown-toggle dropdown-arrow-none" data-bs-toggle="dropdown" id="profileDropdownvisittoday"><i class="mdi mdi-dots-horizontal"></i></a>
															<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdownvisittoday">
																<a class="dropdown-item">
																	<i class="mdi mdi-grease-pencil text-primary"></i>
																	Edit
																</a>
																<a class="dropdown-item">
																	<i class="mdi mdi-delete text-primary"></i>
																	Delete
																</a>
															</div>
														</div>
													</div>
													<p class="mt-1">Calculated in last 30 days</p>
													<div class="d-lg-flex align-items-center justify-content-between">
														<h1 class="font-weight-bold text-dark">4332</h1>
														<div class="mb-3">
															<button type="button" class="btn btn-outline-light text-dark font-weight-normal">Day</button>
															<button type="button" class="btn btn-outline-light text-dark font-weight-normal">Month</button>
														</div>
													</div>
													<canvas id="visitorsToday"></canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<div class="row">
						<div class="col-lg-2 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-success font-weight-bold">18390</h2>
										<i class="mdi mdi-account-outline mdi-18px text-dark"></i>
									</div>
								</div>
								<canvas id="newClient"></canvas>
								<div class="line-chart-row-title">TOTAL CLIENTS</div>
							</div>
						</div>
						<div class="col-lg-2 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-danger font-weight-bold">839</h2>
										<i class="mdi mdi-refresh mdi-18px text-dark"></i>
									</div>
								</div>
								<canvas id="allProducts"></canvas>
								<div class="line-chart-row-title">15 Min Counts</div>
							</div>
						</div>
						<div class="col-lg-2 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-info font-weight-bold">244</h2>
										<i class="mdi mdi-file-document-outline mdi-18px text-dark"></i>
									</div>
								</div>
								<canvas id="invoices"></canvas>
								<div class="line-chart-row-title">Hourly Counts</div>
							</div>
						</div>
						<div class="col-lg-2 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-warning font-weight-bold">3259</h2>
										<i class="mdi mdi-folder-outline mdi-18px text-dark"></i>
									</div>
								</div>
								<canvas id="projects"></canvas>
								<div class="line-chart-row-title">Daily Counts</div>
							</div>
						</div>
						<div class="col-lg-2 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-secondary font-weight-bold">586</h2>
										<i class="mdi mdi-cart-outline mdi-18px text-dark"></i>
									</div>
								</div>
								<canvas id="orderRecieved"></canvas>
								<div class="line-chart-row-title">Weekly Counts</div>
							</div>
						</div>
						<div class="col-lg-2 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-dark font-weight-bold">7826</h2>
										<i class="mdi mdi-cash text-dark mdi-18px"></i>
									</div>
								</div>
								<canvas id="transactions"></canvas>
								<div class="line-chart-row-title">Monthly Counts</div>
							</div>
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-flex align-items-center justify-content-between">
										<h4 class="card-title">Support Tracker</h4>
										<h4 class="text-success font-weight-bold">Tickets<span class="text-dark ms-3">163</span></h4>
									</div>
									<div id="support-tracker-legend" class="support-tracker-legend"></div>
									<canvas id="supportTracker"></canvas>
								</div>
							</div>
						</div>
						<div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-lg-flex align-items-center justify-content-between mb-4">
										<h4 class="card-title">Product Orders</h4>
										<p class="text-dark">+5.2% vs last 7 days</p>
									</div>
									<div class="product-order-wrap padding-reduced">
										<div id="productorder-gage" class="gauge productorder-gage"></div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<?php include '../Common_footer/footer.php'; ?>

				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
    </div>
		<!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
		<script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
		<script src="vendors/justgage/raphael-2.1.4.min.js"></script>
		<script src="vendors/justgage/justgage.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>


<script>

	$.ajax({
        url: "../Api_files/query_file.php?function=get_data_stocks_dash",
        type: "POST",
        dataType: "json",
        success: function (stockData) {


			// Prepare data
			const labels = stockData.map(item => {
				const date = new Date(item.Date);
				const month = date.toLocaleString('default', { month: 'short' });
				const year = date.getFullYear();
				return `${month} ${year}`;
			});

			const openData = stockData.map(item => parseFloat(item.Open) || 0);
			const highData = stockData.map(item => parseFloat(item.High) || 0);
			const lowData = stockData.map(item => parseFloat(item.Low) || 0);
			const closeData = stockData.map(item => parseFloat(item.Close) || 0);

			// Create Chart
			const ctx = document.getElementById('lineChart').getContext('2d');
			const chart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: labels, // X-axis labels
					datasets: [
						{
							label: 'Open',
							data: openData,
							borderColor: 'blue',
							borderWidth: 2,
							fill: false,
						},
						{
							label: 'High',
							data: highData,
							borderColor: 'green',
							borderWidth: 2,
							fill: false,
						},
						{
							label: 'Low',
							data: lowData,
							borderColor: 'red',
							borderWidth: 2,
							fill: false,
						},
						{
							label: 'Close',
							data: closeData,
							borderColor: 'orange',
							borderWidth: 2,
							fill: false,
						},
					],
				},
				options: {
					responsive: true,
					plugins: {
						legend: {
							position: 'top',
						},
					},
					scales: {
						x: {
							title: {
								display: true,
								text: 'Month & Year',
							},
						},
						y: {
							title: {
								display: true,
								text: 'Value',
							},
							beginAtZero: true,
						},
					},
				},
			});
			
		},
        error: function (xhr, status, error) {
            console.error("Failed to fetch stock data:", error);
        },
    });
        // Example data from your JSON
	// const jsonData = [
	// 	{ "Date": "2025-01-16", "Open": "4324.43", "High": "43243.34", "Low": "", "Close": "4324324" },
	// 	{ "Date": "2024-11-01", "Open": "51550.15", "High": "52760.2", "Low": "49787.1", "Close": "52055.6" },
	// 	{ "Date": "2024-10-01", "Open": "52844", "High": "53235.25", "Low": "50194.3", "Close": "51475.35" },
	// 	{ "Date": "2024-09-02", "Open": "51579.5", "High": "54467.35", "Low": "50369.4", "Close": "52978.1" },
	// 	{ "Date": "2024-08-01", "Open": "51672.6", "High": "51877.15", "Low": "49654.65", "Close": "51351" },
	// 	{ "Date": "2024-07-01", "Open": "52351.15", "High": "53357.7", "Low": "50438.3", "Close": "51553.4" }
	// ];

	
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
