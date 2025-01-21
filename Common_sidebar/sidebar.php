<?php
$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name
?>

<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Dashboards</li>
            <li>
                <a href="../Content_details/index.php" class="<?= $current_page == 'index.php' ? 'mm-active' : '' ?>">
                    <i class="metismenu-icon"></i>
                    Dashboard Details
                </a>
                <a href="../Content_details/measurement.php" class="<?= $current_page == 'measurement.php' ? 'mm-active' : '' ?>">
                    <i class="metismenu-icon"></i>
                    Trading Measurement
                </a>
                <a href="../Content_details/trade_analysis.php" class="<?= $current_page == 'measurement.php' ? 'mm-active' : '' ?>">
                    <i class="metismenu-icon"></i>
                    Trading Analysis
                </a>
                <a href="../Content_details/add_stocks.php" class="<?= $current_page == 'add_stocks.php' ? 'mm-active' : '' ?>">
                    <i class="metismenu-icon"></i>
                    Add Stocks
                </a>
            </li>

            <li class="app-sidebar__heading">Daily Details</li>
            <li>
                <a href="">
                    <i class="metismenu-icon "></i>
                    Daily Target Details
                    <i class="metismenu-state-icon"></i>
                </a>
                <ul>
                    <li>
                        <a href="../Content_details/add_daily.php" class="<?= $current_page == 'add_daily.php' ? 'mm-active' : '' ?>">
                            <i class="metismenu-icon"></i>
                            Add New Details
                        </a>
                    </li>
                    <li>
                        <a href="../Content_details/target_calc.php" class="<?= $current_page == 'target_calc.php' ? 'mm-active' : '' ?>">
                            <i class="metismenu-icon"></i>
                            Daily Target Calculation
                        </a>
                    </li>
                </ul>
            </li>

            <li class="app-sidebar__heading">Weekly Details</li>
            <li>
                <a href="#">
                    <i class="metismenu-icon"></i>
                    Weekly Target Details
                    <i class="metismenu-state-icon"></i>
                </a>
                <ul>
                    <li>
                        <a href="../Content_details/add_weekly.php" class="<?= $current_page == 'add_weekly.php' ? 'mm-active' : '' ?>">
                            <i class="metismenu-icon"></i>
                            Add New Details
                        </a>
                    </li>
                    <li>
                        <a href="../Content_details/target_calc_weekly.php" class="<?= $current_page == 'target_calc_weekly.php' ? 'mm-active' : '' ?>">
                            <i class="metismenu-icon"></i>
                            Weekly Target Calculation
                        </a>
                    </li>
                </ul>
            </li>

            <li class="app-sidebar__heading">Monthly Details</li>
            <li>
                <a href="#">
                    <i class="metismenu-icon"></i>
                    Monthly Target Details
                    <i class="metismenu-state-icon"></i>
                </a>
                <ul>
                    <li>
                        <a href="../Content_details/add_monthly.php" class="<?= $current_page == 'add_monthly.php' ? 'mm-active' : '' ?>">
                            <i class="metismenu-icon"></i>
                            Add New Details
                        </a>
                    </li>
                    <li>
                        <a href="../Content_details/target_calc_monthly.php" class="<?= $current_page == 'target_calc_monthly.php' ? 'mm-active' : '' ?>">
                            <i class="metismenu-icon"></i>
                            Monthly Target Calculation
                        </a>
                    </li>
                </ul>
            </li>

            <li class="app-sidebar__heading">Logout</li>
            <li>
                <a href="../Content_details/login.php" class="<?= $current_page == 'login.php' ? 'mm-active' : '' ?>">
                    <i class="metismenu-icon"></i>
                    Log Out
                </a>
            </li>
        </ul>
    </div>
</div>
