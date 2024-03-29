<!doctype html>
<?php
//$emp = App\Models\Employee::where(['ecode' => Auth::user()->current_team_id])->first();
//$restriction = App\Models\Assignright::where(['ecode' => Auth::user()->current_team_id])->first();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VEFM</title>

    <link rel="icon" href="{{ asset('media/image/favicon.png') }}" type="image/x-icon">

    <!-- begin::global styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('vendors/bundle.css') }}">
    <!-- end::global styles -->

    <!-- begin::dataTable -->
    <link rel="stylesheet" href="{{ asset('vendors/dataTable/responsive.bootstrap.min.css') }}" type="text/css">
    <!-- end::dataTable -->

    <!-- begin::datepicker -->
    <link type="text/css" rel="stylesheet" href="{{ asset('vendors/datepicker/daterangepicker.css') }}">
    <!-- begin::datepicker -->

    <!-- begin::vmap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('vendors/vmap/jqvmap.min.css') }}">
    <!-- begin::vmap -->

    <!-- begin::custom styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- end::custom styles -->

    <!-- begin::select2 -->
    <link type="text/css" rel="stylesheet" href="{{ asset('vendors/select2/css/cloudfareselect2.min.css') }}">
    <!--<link type="text/css" rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">--><!-- borderless select2 css-->
    <!-- end::select2 -->

    <style>
        #sidebar ul li.open a {
            margin: 0 15px;
        }
      .side-menu > .side-menu-body > ul li {
        margin: 0 !important;
        }
        /* for side menu level1 li */
        .side-menu > .side-menu-body > ul > li> a{
        font-size:15px;
        }

        .side-menu > .side-menu-body > ul li ul a {
        padding-left:3.5rem !important;
        font-size:14px;
        }
        .side-menu > .side-menu-body > ul > li> ul > ul > li {
        padding-left:1rem !important;

        }
        .side-menu > .side-menu-body > ul > li> ul > ul > li a {

        font-size:13px;
        }


    </style>
</head>

<body>

    <!-- begin::page loader-->
    <div class="page-loader">
        <div class="spinner-border"></div>
        <span>Loading</span>
    </div>
    <!-- end::page loader -->

    <!-- begin::side menu -->
    <div class="side-menu">
        <div class='side-menu-body'>
            <ul>
                <li class="side-menu-divider m-t-0"></li>

                <li class="open">
                    <a href="{{ url('/') }}">
                        <i class="icon fa fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon fa fa-globe"></i>
                        <span>Dashboard</span>
                    </a>

                </li>
                {{-- <li class="side-menu-divider m-t-10">Modules</li> --}}
                <li >
                    <a href="#">
                        <i class="icon fa fa-table"></i>
                        <span>Timesheet</span>
                    </a>
                   <ul >
                    <a href="#" >
                        <span>Timesheet</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/timesheet') }}">Timesheet</a></li>
                        <li><a href="{{ url('enquiry') }}">BU Timesheet</a></li>
                        <li><a href="{{ url('/enquiryform') }}">Timesheet - General Invoice</a></li>
                        <li><a href="{{ url('/enquiryform') }}">BU Timesheet - General Invoice</a></li>
                        <li><a href="{{ url('/enquiryform') }}">Engineer Track</a></li>
                        <li><a href="{{ url('/enquiryform') }}">Traveling Timesheet</a></li>
                        <li><a href="{{ url('/enquiryform') }}">BU Design / ATT</a></li>
                    </ul>



                    <a href="#" >
                        <span>Invoice</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">Invoice list</a></li>
                        <li><a href="{{ url('/projectcreate') }}">BU Invoice List</a></li>
                        <li><a href="{{ url('/projectlod') }}">Upload Invoice</a></li>
                        <li><a href="{{ url('/projectassign') }}">Invoice Upload Report</a></li>
                    </ul>
                    <a href="#" >
                        <span>Collection</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">Collection</a></li>
                        <li><a href="{{ url('/projectcreate') }}">BU Collection </a></li>
                        <li><a href="{{ url('/projectlod') }}">Retention </a></li>
                        <li><a href="{{ url('/projectassign') }}">BU Retention </a></li>
                    </ul>

                    <a href="#" >
                        <span>GST Process</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">GST Verify</a></li>
                        <li><a href="{{ url('/projectcreate') }}">GST Report</a></li>
                        <li><a href="{{ url('/projectlod') }}">BU GST Report</a></li>
                        <li><a href="{{ url('/projectassign') }}">GST Summary - AD</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Tally Ledger Report</a></li>
                        <!--<li><a href="{{ url('/projectlod') }}"> Tally Ledger Report -SRV</a></li>-->
                        <li><a href="{{ url('/projectassign') }}">Customer Ledger Report</a></li>

                    </ul>

                    <a href="#" >
                        <span>Report</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">Bill & Collection Report</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Site Report</a></li>
                        <li><a href="{{ url('/projectlod') }}">Customer Pending With Site Name </a></li>
                        <li><a href="{{ url('/projectassign') }}">Invoice Collection & Due</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Customer Ledger Report</a></li>
                        <li><a href="{{ url('/projectlod') }}"> Job Wise Query</a></li>
                        <li><a href="{{ url('/projectassign') }}">Equipment Report</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Turnover Report</a></li>
                        <li><a href="{{ url('/projectlod') }}"> Customer Pending payment</a></li>
                        <li><a href="{{ url('/projectassign') }}">PO Report</a></li>

                    </ul>

                    <a href="#" >
                        <span>PO</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/Setup_pomaster_list') }}">PO Master</a></li>
                        <li><a href="{{ url('/projectcreate') }}">PO Report</a></li>

                    </ul>

                    <a href="#"  >
                        <span>Customer</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/Setup_customer_create') }}">New Customer</a></li>
                        <li><a href="{{ url('/Setup_gstmaster') }}">GST Master</a></li>

                    </ul>

                   </ul>
            </li>

            <li>
                <a href="#">
                    <i class="icon fa fa-money"></i>
                    <span>Budget</span>
                </a>
                <ul>
                    <li><a href="{{ url('/project') }}">Budget</a></li>
                    <li><a href="{{ url('/projectcreate') }}"> BU Budget</a></li>
                    <li><a href="{{ url('/project') }}">Approval</a></li>
                    <li><a href="{{ url('/projectcreate') }}">TES - Debit - Ecode</a></li>
                    <li><a href="{{ url('/Setup_engineer') }}">New Engineer</a></li>
                </ul>
            </li>

                <li>
                    <a href="#">
                        <i class="icon fa fa-suitcase"></i>
                        <span>TES</span>
                    </a>
                    <ul>
                    <a href="#">
                        <span>Engineer Expenses</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">Expenses</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Other Debits</a></li>
                        <li><a href="{{ url('/projectlod') }}">Security Deposit</a></li>
                        <li><a href="{{ url('/projectassign') }}">Expense Upload</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Expnse Upload Report</a></li>
                        <li><a href="{{ url('/projectlod') }}">TES Report</a>
                            <ul>
                                <li><a href="{{ url('/project') }}">TES Ledger</a></li>
                                <li><a href="{{ url('/projectcreate') }}">TES Summary</a></li>
                                <li><a href="{{ url('/projectlod') }}">TES Division</a></li>
                                <li><a href="{{ url('/projectassign') }}">TES Month</a></li>
                                <li><a href="{{ url('/projectcreate') }}">TES Ecode</a></li>
                                <li><a href="{{ url('/projectlod') }}">TES Transfer Amount Report</a></li>
                                <li><a href="{{ url('/projectassign') }}">TES Checklist</a></li>
                                <li><a href="{{ url('/project') }}"> TES Engineer Summary Report</a></li>
                                <li><a href="{{ url('/projectcreate') }}">TES Month Summary Report</a></li>
                            </ul>


                        </li>
                        <li><a href="{{ url('/projectassign') }}">BU TES Report</a>
                            <ul>
                                <li><a href="{{ url('/project') }}">BU TES Ledger </a></li>
                                <li><a href="{{ url('/projectcreate') }}">BU TES Summary</a></li>
                                <li><a href="{{ url('/projectlod') }}">BU TES Division</a></li>
                                <li><a href="{{ url('/projectassign') }}">BU TES Month</a></li>
                                <li><a href="{{ url('/projectcreate') }}">BU TES Ecode</a></li>
                                <li><a href="{{ url('/projectlod') }}">BU TES Engineer Summary Report</a></li>
                                <li><a href="{{ url('/projectassign') }}">BU TES Month Summary Report</a></li>
                                <li><a href="{{ url('/project') }}">BU TES ledger Consolidate</a></li>
                                <li><a href="{{ url('/projectcreate') }}">BU TES ledger Consolidate New</a></li>
                            </ul>
                        </li>
                    </ul>



                    <a href="#">
                        <span>TES</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">Region Dispatch</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Receive Execution</a></li>
                        <li><a href="{{ url('/projectlod') }}">Receive - TES - Finance</a></li>
                        <li><a href="{{ url('/projectassign') }}">TES Month - Received Report</a></li>
                        <li><a href="{{ url('/projectcreate') }}">TES Received Finance Checklist Report</a></li>
                        <li><a href="{{ url('/projectlod') }}">TES Receipt Status - YTD</a></li>
                        <li><a href="{{ url('/projectassign') }}">TES Receipt Updated</a></li>
                        <li><a href="{{ url('/projectassign') }}">TES Ecode Summary -FY</a></li>
                    </ul>




                    <a href="#">
                        <span>Engineer List</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/Setup_engineer_list') }}">Engineer List</a></li>
                    </ul>

                    <a href="#">
                        <span>Reports</span>
                    </a>
                    <ul>
                                <li><a href="{{ url('/') }}">TES Report</a></li>
                                <li><a href="{{ url('/') }}">TES Ledger</a></li>
                                <li><a href="{{ url('/') }}">TES Summary</a></li>
                                <li><a href="{{ url('/') }}">TES Division</a></li>
                                <li><a href="{{ url('/') }}">TES Debit Report</a></li>
                                <li><a href="{{ url('/') }}">TES Month</a></li>
                                <li><a href="{{ url('/') }}">TES Ecode</a></li>
                                <li><a href="{{ url('/') }}">TES Transfer Amount Report</a></li>
                                <li><a href="{{ url('/') }}">TES Checklist</a></li>
                                <li><a href="{{ url('/') }}">TES Engineer Summary Report</a></li>
                                <li><a href="{{ url('/') }}">TES Month Summary Report</a></li>
                            </ul>

                    <a href="#">
                        <span>BU TES Reports</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/') }}">BU TES Ledger</a></li>
                        <li><a href="{{ url('/') }}">BU TES Summary</a></li>
                        <li><a href="{{ url('/') }}">BU TES Division</a></li>
                        <li><a href="{{ url('/') }}">BU TES Month</a></li>
                        <li><a href="{{ url('/') }}">BU TES Ecode</a></li>
                        <li><a href="{{ url('/') }}">BU TES Engineer Summary Report</a></li>
                        <li><a href="{{ url('/') }}">BU TES Month Summary Report</a></li>
                        <li><a href="{{ url('/') }}">BU TES Ledger Consolidate</a></li>
                        <li><a href="{{ url('/') }}">BU TES Ledger Consolidate New</a></li>

                    </ul>

                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="icon fa fa-inr"></i>
                        <span>Outstanding</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">Outstanding List </a></li>
                        <li><a href="{{ url('/projectcreate') }}">Overall OS List</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Outstanding Aging</a></li>
                        <li><a href="{{ url('/projectlod') }}">Outstanding Due - Date</a></li>
                        <li><a href="{{ url('/projectassign') }}">Outstanding Status Entry</a></li>
                        <li><a href="{{ url('/projectcreate') }}">OS List 2017</a></li>
                        <li><a href="{{ url('/projectlod') }}">OS List 2018</a></li>
                        <li><a href="{{ url('/projectassign') }}"></a></li>


                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="icon fa fa-file-text"></i>
                        <span>Reports</span>
                    </a>
                    <ul>
                        <a href="#">
                            <span>MIS Reports</span>
                        </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">Timesheet Report</a>
                            <ul>
                                <li><a href="{{ url('/project') }}">Actual Report</a></li>
                                <li><a href="{{ url('/projectcreate') }}">Projection Report</a></li>
                                <li><a href="{{ url('/projectlod') }}">Invoice Pending Report</a></li>


                            </ul>
                        </li>

                        <li><a href="{{ url('/project') }}">Invoice Report</a>
                            <ul>
                                <li><a href="{{ url('/project') }}">Invoice Register Report</a></li>
                                <li><a href="{{ url('/projectcreate') }}">Invoice Collection Report</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <span>Collection Report</span>
                            </a>
                            <ul>
                                <li><a href="{{ url('/project') }}">Collection Summary Report</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <span>Engr Expenses Report</span>
                            </a>
                            <ul>
                                <li><a href="{{ url('/project') }}">Engr Expenses Summary</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <span>Engr List Report</span>
                            </a>
                            <ul>
                                <li><a href="{{ url('/project') }}">Engr list with Invoice</a></li>
                                <li><a href="{{ url('/project') }}">Engr List Without Invoice</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <span>Gross Query</span>
                            </a>
                            <ul>
                                <li><a href="{{ url('/project') }}">Gross Query</a></li>
                                <li><a href="{{ url('/project') }}">Gross Report</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="#">
                                <span>Site Report</span>
                            </a>
                            <ul>
                            <li><a href="{{ url('/project') }}">Site Report</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <span>Adhoc Adjustment</span>
                            </a>
                            <ul>
                        <li><a href="{{ url('/project') }}">Adhoc Adjustment</a></li>
                            </ul>
                        </li>
                    </ul>

                    <a href="#">
                        <span>Management Report</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">Collectio Vs Invoice</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Invoice Vs Collection</a></li>
                        <li><a href="{{ url('/projectlod') }}">Turn Over</a></li>
                        <li><a href="{{ url('/projectassign') }}">Invoice Summary</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Collection Summary</a></li>
                        <li><a href="{{ url('/projectlod') }}">Outstanding Summary</a></li>
                        <li><a href="{{ url('/projectassign') }}">Engineer - Job Report</a></li>
                        <li><a href="{{ url('/projectassign') }}">Turnover Report</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Receipt Report</a></li>
                        <li><a href="{{ url('/projectlod') }}">Receivables</a></li>

                    </ul>

                    <a href="#">
                        <span>BU Report</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">Collection FY Report</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Turnover FY Report</a></li>
                        <li><a href="{{ url('/projectlod') }}">Invoice Collection Consolidate</a></li>
                        <li><a href="{{ url('/projectassign') }}">Invoice Collection Consolidate 21-22</a></li>
                        <li><a href="{{ url('/projectcreate') }}">Outstanding Consolidation</a></li>
                        <li><a href="{{ url('/projectlod') }}">Outstanding Consolid 21-22</a></li>
                        <!--<li><a href="{{ url('/projectassign') }}">Outstanding Consolid 21-22 KHP</a></li>-->
                    </ul>

                </ul>

                </li>

                <li>
                    <a href="#">
                        <i class="icon fa fa-line-chart"></i>
                        <span>PL Form & Report</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/project') }}">PL Form</a></li>
                        <li>
                            <a href="{{ url('/projectcreate') }}">PL Report</a>
                            <ul>
                                <li><a href="{{ url('/project') }}">PL Region Wise</a></li>
                                <li><a href="{{ url('/project') }}">PL All Unit - Real Time</a></li>
                                <li><a href="{{ url('/project') }}">PL All Unit - Period</a></li>
                                <li><a href="{{ url('/project') }}">PL Division - YTD</a></li>
                                <li><a href="{{ url('/project') }}">PL Report - BU</a></li>
                                <li><a href="{{ url('/project') }}">PL Report - BU - FY</a></li>
                                <li><a href="{{ url('/project') }}">PL Variance - Detail</a></li>
                                <li><a href="{{ url('/project') }}">PL Variance - Summary</a></li>
                                <li><a href="{{ url('/project') }}">PL Report AD - Period</a></li>
                            </ul>

                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="icon fa fa-cogs"></i>
                        <span>Setup</span>
                    </a>
                    <ul>
                        <li><a href="{{ url('/Setup_division') }}">Division</a></li>
                        <li><a href="{{ url('/Setup_unit') }}">Unit</a></li>
                        <li><a href="{{ url('/Setup_region') }}">Region</a></li>
                        <li><a href="{{ url('/Setup_company_list') }}">Company</a></li>
                        <li><a href="{{ url('/project') }}">User</a>
                            <ul>
                                <li><a href="{{ url('/Setup_user') }}">Add User</a></li>
                                <li><a href="{{ url('/Setup_user_list') }}">List User</a></li>
                                <li><a href="{{ url('/Setup_assignrights_page') }}">Assign Right</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/projectcreate') }}">Profile</a>
                            <ul>
                                <li><a href="{{ url('/project') }}">Change Master</a></li>

                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- end::side menu -->

    <!-- begin::navbar -->
    <nav class="navbar">
        <div class="container-fluid">

            <div class="header-logo">
                <a href="{{ url('/') }}">
                    <img class="d-none d-lg-block" src="{{ asset('images/vefmnext-logo.png') }}" alt="...">
                    <img class="d-lg-none d-sm-block" src="{{ asset('images/vefmnext-logo.png') }}" alt="...">
                </a>
            </div>

            <div class="header-body">
                <form class="search">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>VEFM - Voltech Engineers Finance Management </h4>
                            <i class="card-subtitle">(An initative of Voltech Engineers Pvt.Ltd.)</i>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="d-lg-none d-sm-block nav-link search-panel-open">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <i class="fa fa-user-o"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                            <div class="dropdown-menu-title text-center"
                                data-backround-image="{{ asset('media/image/bg.jpg') }}">
                                <figure class="avatar avatar-xl">
                                    <img src="" class="rounded-circle" alt="image">
                                </figure>
                                <h6 class="text-uppercase font-size-12 m-b-0"> </h6>
                            </div>
                            <div class="dropdown-menu-body">
                                <ul class="list-group list-group-flush" style="text-align: center">
                                    <form method="POST" action="">
                                        @csrf
                                        <a href=""
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="list-group-item text-danger"> Logout <i class="fa fa-sign-out"></i>
                                        </a>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item d-lg-none d-sm-block">
                        <a href="#" class="nav-link side-menu-open">
                            <i class="ti-menu"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>


    <!-- end::navbar -->

    <!-- begin::main content -->
    <main class="main-content">
        @yield('content')
        <!-- begin::footer -->
       <!-- <footer class="fixed-bottom">
            <div class="row" style="background-color: white; border-top: 1px solid #e1e1e1;padding: 5px">
                <div class="col-sm-6" style="text-align: left">
                    © <i style="color: grey"> Voltech Engineers Pvt.Ltd. - </i> <?php echo date('Y'); ?>
                </div>
                <div class="col-sm-6" style="text-align: right">
                    Since 2015 Powered by <a href="http://voltechgroup.com/" target="_blank"><i
                            style="color: green">Team ERP</i></a>
                </div>
        </footer>-->
        <!-- end::footer -->
    </main>
    <!-- end::main content -->

    <!-- begin::global scripts -->
    <script src="{{ asset('vendors/bundle.js') }}"></script>
    <!-- end::global scripts -->

    <!-- begin::chart -->
    <script src="{{ asset('vendors/charts/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('vendors/charts/sparkline/sparkline.min.js') }}"></script>
    <script src="{{ asset('vendors/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('js/examples/charts.js') }}"></script>
    <!-- end::chart -->

    <script src="{{ asset('vendors/datepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/examples/datepicker.js') }}"></script>
    <script src="{{ asset('js/examples/dashboard.js') }}"></script>

    <!-- begin::vamp -->
    <script src="{{ asset('vendors/vmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendors/vmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('js/examples/vmap.js') }}"></script>
    <!-- end::vamp -->

    <!-- begin::custom scripts -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/borderless.min.js') }}"></script>
    <!-- end::custom scripts -->

    <!-- begin::dataTable -->
    <script src="{{ asset('vendors/dataTable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/examples/datatable.js') }}"></script>
    <!-- end::dataTable -->


    <!-- begin::select2 -->

    <script src="{{ asset('vendors/select2/js/cloudfareselect2.min.js') }}"></script>
    <!--<script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/examples/select2.js') }}"></script>-->
    <!-- end::select2 -->
    @stack('scripts')
</body>

</html>