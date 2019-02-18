<?php

    require($_SERVER["DOCUMENT_ROOT"] . "/include/check/session.php");

    if (!(isset($_SESSION["name"]) && isset($_SESSION["password"])))                                                        // The SESSION credentials shouldn't be set; otherwise the "logout.php" has failed.
    {
        $isValid = false;

        if (isset($_REQUEST["name"]) && isset($_REQUEST["password"]))                                                       // If true; evaluate if the credentials are valid.
        {
            $username = $_REQUEST["name"];
            $password = $_REQUEST["password"];

            if ($username == "admin" && $password == "Vc4UDw9B")                                                              // If true; the credentials are valid.
            {
                $isValid = true;
                $_SESSION["AUTH_CODE"] = 0;
                $_SESSION["name"] = $username;
                $_SESSION["password"] = $password;
            }
            else
            {
                $_SESSION["AUTH_CODE"] = -1;
            }
        }

        if (!$isValid)
        {
            header("Location: login/");
            die();
        }
    }
    else
    {
        $_SESSION["AUTH_CODE"] = 0;
    }

	$servername = "localhost";
	$username = "dbuser";
	$password = "harvestmood";
	$dbname = "moods";

	try
	{
		$conn = new mysqli($servername, $username, $password, $dbname);
	}
	catch (Exception $e)
	{
		echo($e->getMessage());
	} 
	
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->

<html lang="en">
<!--<![endif]-->

	<!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Harvest - Moods</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Harvest - Moods" name="description" />
        <meta content="Harvest" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700%26subset=all" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/layouts/layout/css/themes/grey.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <link rel="shortcut icon" href="/logo.png" />
    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">

            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">

                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="../../">
                        <img src="logo.png" alt="logo" class="logo-default" style="height: 30px; position: relative; top: -6px; left: -6px;"/>
                    </a>
                    <div class="menu-toggler sidebar-toggler"></div>
                </div>
                <!-- END LOGO -->

                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:void(0);" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->

                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a href="/logout/" id="link_Logout" class="dropdown-toggle">
                                <i class="icon-logout"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->

            </div>
            <!-- END HEADER INNER -->

        </div>
        <!-- END HEADER -->

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->

        <!-- BEGIN CONTAINER -->
        <div class="page-container">

            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">

                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar navbar-collapse collapse">

                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <li class="heading">
                            <h3 class="uppercase">Menu</h3>
                        </li>
                        <li class="nav-item active open">
                            <a href="index.php" class="nav-link nav-toggle">
                                <i class="fa fa-database"></i>
                                <span class="title">Detailoverzicht</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="charts.php" class="nav-link nav-toggle">
                                <i class="fa fa-pie-chart"></i>
                                <span class="title">Grafieken</span>
                            </a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->

                </div>
                <!-- END SIDEBAR -->

            </div>
            <!-- END SIDEBAR -->

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">

                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">

                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="../../">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Overzicht</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->

                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title">Overzicht van de gemoedstoestand.</h3>
                    <!-- END PAGE TITLE-->

                    <!-- BEGIN FORMS -->
                    <div class="col-md-12">
                        <div class="portlet light portlet-fit portlet-datatable bordered" id="form_wizard_1">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green sbold uppercase">Ruwe gegevens</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover order-column" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> Tijdstip </th>
                                            <th> Gemoedstoestand </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = "SELECT * FROM EmployeeMoods";
                                        $result = $conn->query($query);

                                        $label = "";

                                        while ($row = $result->fetch_assoc())
                                        {
                                            switch ($row["mood"])
                                            {
                                                    case 1: $label = "Tevreden"; break;
                                                    case 2: $label = "Neutraal"; break;
                                                    case 3: $label = "Ontevreden"; break;
                                                    default: $label = "[" . $row["mood"] . "]"; break;
                                            }

                                            $pushedAt = DateTime::createFromFormat("Y-m-d H:i:s", $row["pushedAt"]);

                                            echo "<tr class='odd gradeX'>";
                                            echo 	"<td>" . $row["id"] . "</td>";
                                            echo 	"<td>" . date_format($pushedAt, "d-m-Y H:i:s") . "</td>";
                                            echo 	"<td>" . $label. "</td>";
                                            echo "</tr>";
                                        }

                                        $conn->close();
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->

                    </div>
                </div>
                <!-- END CONTENT BODY -->

            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->

        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner">2017 &copy; <a href="http://www.harvest.be/" target="_blank">Harvest</a>
            </div><div class="scroll-to-top"><i class="icon-arrow-up"></i></div>
        </div>
        <!-- END FOOTER -->

        <!--[if lt IE 9]>
        <script src="/assets/global/plugins/respond.min.js"></script>
        <script src="/assets/global/plugins/excanvas.min.js"></script>
        <![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="rawDataTable.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

    </body>
    <!-- END BODY -->

</html>