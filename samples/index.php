<!-- Welcome to PayU MEA SDK PHP -- >
<?php
if (PHP_SAPI == 'cli') {
    // If the index.php is called using console, we would try to host
    // the built-in PHP Server
    if (version_compare(phpversion(), '8.1', '>=') === true) {
        //exec('php -S -t ' . __DIR__ . '/');
        $cmd = "php -S localhost:5500 -t " . __DIR__;
        $descriptors = [
            0 => ["pipe", "r"],
            1 => STDOUT,
            2 => STDERR,
        ];
        $process = proc_open($cmd, $descriptors, $pipes);

        if ($process === false) {
            fprintf(STDERR, "Unable to launch PHP's built-in web server.\n");

            exit(2);
        }

        fclose($pipes[0]);
        $exit = proc_close($process);
        exit($exit);
    } else {
        echo "You must be running PHP version 8.1+. You would have to manually host the website on your local web server.\n";
        exit(2);
    }
} ?>
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>PayU MEA SDK PHP API Samples</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        /* Header Links */
        .header-link {
            position: absolute;
            left: 7px;
            opacity: 0;

        }

        h2:hover .header-link,
        h3:hover .header-link,
        h4:hover .header-link,
        h5:hover .header-link,
        h6:hover .header-link {
            opacity: 1;
        }

        .list-group-item h5 {
            padding-left: 10px;
        }

        /* End Header Links */

        li.list-group-item:hover {
            background-color: #80AF14;
        }

        .jumbotron {
            background: #80AF14 url("https://www.paypalobjects.com/webstatic/developer/banners/Braintree_desktop_BG_2X.jpg") no-repeat top right;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .jumbotron {
            margin-bottom: 0;
            padding-bottom: 20px;
        }

        .jumbotron h2, .jumbotron p, h5 {
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
        }

        .footer-links a {
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
        }

        @media (max-width: 992px) {
            .jumbotron {
                background-color: #FFF;
            }

            .logo {
                position: relative;
            }

            #leftNavigation {
                visibility: hidden;
            }
        }

        @media (min-width: 992px) {
            .jumbotron {
                background-color: #FFF;
            }

            .footer-div a {
                text-decoration: none;
            }

            .img-div {
                position: fixed;
                margin-left: 0;
                padding-left: 0;
            }

            .logo {
                top: 80px;
            }
        }

        html {
            position: relative;
            min-height: 100%;
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            min-height: 60px;
            padding-top: 15px;
        }

        .footer-links, .footer-links li {
            display: inline-block;
            font-size: 110%;
            padding-left: 0;
            padding-right: 0;
        }

        .footer-links li {
            padding-top: 5px;
            padding-left: 5px;
        }

        .footer-links a {
            color: #80AF14;;
        }

        .fixed {
            position: fixed;
        }

        .nav a {
            font-weight: bold;
        }

    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#leftNavigation" data-offset="15" class="scrollspy-example">
<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 pull-left img-div">
                <img src="https://southafrica.payu.com/wp-content/themes/global-website/assets/src/images/payu-logo.svg"
                     class="logo img-responsive"/>
            </div>
            <div class="col-md-9 pull-right">
                <h2>// Enterprise/Redirect API Samples</h2>

                <p>These examples are created to experiment with the PayU-PHP-SDK capabilities. Each examples
                    are designed to demonstrate the default use-cases in each segment.</p>
                <br/>
                <div class="footer-div">
                    <ul class="footer-links">
                        <li>
                            <a href="https://github.com/PayUMEA/payu-mea-sdk-php" target="_blank"><i
                                        class="fa fa-github"></i>
                                PayU PHP SDK</a></li>
                        <li>
                            <a href="https://payusahelp.atlassian.net/wiki/spaces/general/overview?mode=global" target="_blank"><i
                                        class="fa fa-book"></i> API documentation</a>
                        </li>
                        <li>
                            <a href="https://github.com/PayUMEA/payu-mea-sdk-php/issues" target="_blank"><i
                                        class="fa fa-exclamation-triangle"></i> Report Issues </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 ">
            <div class="row-fluid fixed col-md-3" id="leftNavigation" role="navigation">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#enterprise-payment">Payment (Enterprise API)</a></li>
                    <li><a href="#enterprise-reserve">Authorization/Capture (Enterprise API)</a></li>
                    <li><a href="#redirect-payment">Payment (Redirect API)</a></li>
                    <li><a href="#redirect-reserve">Authorization/Capture (Redirect API)</a></li>
                    <li><a href="#lookup">Lookup Transactions</a></li>
                    <li><a href="#partner-api">Partner API</a></li>
                </ul>

            </div>
        </div>
        <div class="col-md-9 samples">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 id="enterprise-payment" class="panel-title"><a
                                href="#"
                                target="_blank">Payment (Enterprise API)</a></h3>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Payment using credit card</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/payment/create-payment.php" class="btn btn-primary pull-left execute"> Try It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/payment/create-payment.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Payment using credit card (secure3D)</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/payment/create-payment-secure3d.php" class="btn btn-primary pull-left execute"> Try It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/payment/create-payment-secure3d.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8">
                                <h5>Payment using saved credit card
                                    <small>(using Payment method ID - pmId)</small>
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <a href="enterprise/payment/create-payment-with-saved-card.php" class="btn btn-primary pull-left execute">
                                    Try It <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/payment/create-payment-with-saved-card.html" class="btn btn-default pull-right">Source <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8">
                                <h5>Real-Time Recurring Credit Card Transactions (RTR)
                                    <small></small>
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <a href="enterprise/payment/create-payment-real-time-recurring.php" class="btn btn-primary pull-left execute">
                                    Try It <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/payment/create-payment-real-time-recurring.html" class="btn btn-default pull-right">Source <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Debit Order</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/payment/create-debit-order.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/payment/create-debit-order.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Payment with fraud management</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/payment/create-payment-with-fraud-management.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/payment/create-payment-with-fraud-management.html" class="btn btn-default pull-right">Source <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get a payment details</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/payment/get-payment.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/payment/get-payment.html" class="btn btn-default pull-right">Source <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 id="enterprise-reserve" class="panel-title"><a
                                href="#"
                                target="_blank">Authorize and Capture (Enterprise API)</a></h3>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Reserve Payment</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/reserve/reserve-payment.php" class="btn btn-primary pull-left execute"> Try
                                    It<i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/reserve/reserve-payment.html" class="btn btn-default pull-right">Source
                                    <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get details of a reserved payment</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/reserve/get-reserve.php" class="btn btn-primary pull-left execute"> Try
                                    It<i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/reserve/get-reserve.html" class="btn btn-default pull-right">Source
                                    <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Finalize a reserved payment</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/reserve/reserve-capture.php" class="btn btn-primary pull-left execute">
                                    Try It <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/reserve/reserve-capture.html" class="btn btn-default pull-right">Source
                                    <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get details of a finalized payment</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/reserve/get-capture.php" class="btn btn-primary pull-left execute"> Try It <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/reserve/get-capture.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Void a reserved payment</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/reserve/void-reserve.php" class="btn btn-primary pull-left execute"> Try
                                    It<i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/reserve/void-reserve.html" class="btn btn-default pull-right">Source
                                    <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Credit finalized payment</h5></div>
                            <div class="col-md-4">
                                <a href="enterprise/reserve/refund-capture.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/enterprise/reserve/refund-capture.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 id="redirect-payment" class="panel-title"><a
                                href="#"
                                target="_blank">Payment (Redirect API)</a></h3>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Standard Redirect
                                    <small>Credit card, eBucks, and Discovery Miles</small>
                                </h5></div>
                            <div class="col-md-4">
                                <a href="redirect/payment/standard-redirect.php" class="btn btn-primary pull-left execute"> Try It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/redirect/payment/standard-redirect.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Standard Redirect
                                    <small>EFT Pro</small>
                                </h5></div>
                            <div class="col-md-4">
                                <a href="redirect/payment/standard-redirect-eft-pro.php" class="btn btn-primary pull-left execute"> Try It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/redirect/payment/standard-redirect-eft-pro.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Payment using credit card (secure3D)</h5></div>
                            <div class="col-md-4">
                                <a href="redirect/payment/setup-payment-secure3d.php" class="btn btn-primary pull-left execute"> Try It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/redirect/payment/setup-payment-secure3d.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get a payment details</h5></div>
                            <div class="col-md-4">
                                <a href="redirect/payment/get-redirect.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/redirect/payment/get-redirect.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Standard payment with fraud management</h5></div>
                            <div class="col-md-4">
                                <a href="redirect/payment/standard-redirect-with-fraud-management.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/redirect/payment/standard-redirect-with-fraud-management.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Debit Order</h5></div>
                            <div class="col-md-4">
                                <a href="redirect/payment/setup-debit-order.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/redirect/payment/setup-debit-order.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Real-Time Recurring</h5></div>
                            <div class="col-md-4">
                                <a href="redirect/payment/setup-real-time-recurring.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/redirect/payment/setup-payment-real-time-recurring.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 id="redirect-reserve" class="panel-title"><a
                                href="#"
                                target="_blank">Authorization/Capture (Redirect API)</a></h3>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Standard Redirect</h5></div>
                            <div class="col-md-4">
                                <a href="redirect/reserve/standard-redirect.php" class="btn btn-primary pull-left execute"> Try It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/redirect/reserve/standard-redirect.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get a redirect reserve details</h5></div>
                            <div class="col-md-4">
                                <a href="redirect/reserve/get-redirect.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/redirect/reserve/get-redirect.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 id="lookup" class="panel-title"><a href="#" target="_blank">Lookup Transactions</a></h3>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get Customer Details</h5></div>
                            <div class="col-md-4">
                                <a href="lookup/get-payment-method.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/lookup/get-payment-method.html" class="btn btn-default pull-right">Source <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 id="partner-api" class="panel-title"><a href="#" target="_blank">Partner API</a></h3>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>eBucks Authenticate Account (Enterprise API)</h5></div>
                            <div class="col-md-4">
                                <a href="partner-api/ebucks-authenticate-account.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/partner-api/ebucks-authenticate-account.html" class="btn btn-default pull-right">Source <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>eBucks Payment (Enterprise API)</h5></div>
                            <div class="col-md-4">
                                <a href="partner-api/ebucks-payment.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/partner-api/ebucks-payment.html" class="btn btn-default pull-right">Source <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>EFT Pro Payment (Enterprise API)</h5></div>
                            <div class="col-md-4">
                                <a href="partner-api/eft-payment.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/partner-api/eft-payment.html" class="btn btn-default pull-right">Source <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Smart EFT Payment (Enterprise API)</h5></div>
                            <div class="col-md-4">
                                <a href="partner-api/smart-eft-payment.php" class="btn btn-primary pull-left execute"> Try It
                                    <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/partner-api/smart-eft-payment.html" class="btn btn-default pull-right">Source <i class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /container -->
<hr/>
<footer class="footer">
    <div class="container">
        <div class="footer-div">
            <ul class="footer-links">
                <li>
                    <a href="https://github.com/PayUMEA/payu-mea-sdk-php" target="_blank"><i
                                class="fa fa-github"></i>
                        PayU PHP SDK</a></li>
                <li>
                    <a href="https://payusahelp.atlassian.net/wiki/spaces/general/overview?mode=global" target="_blank"><i
                                class="fa fa-book"></i> API Documentation</a>
                </li>
                <li>
                    <a href="https://github.com/PayUMEA/payu-mea-sdk-php/issues" target="_blank"><i
                                class="fa fa-exclamation-triangle"></i> Report Issues </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/scrollspy.min.js"></script>
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>

<script>
    $(function () {
        return $(".samples h5, h6").each(function (i, el) {
            var $el, icon, id;
            $el = $(el);
            id = CryptoJS.MD5(($el.html())).toString();
            id = $el.attr('id');
            icon = '<i class="fa fa-link"></i>';
            if (id) {
                $el.parent().parent().parent().attr('id', id);
                return $el.prepend($("<a />").addClass("header-link").attr('title', "Anchor Link for this Sample").attr("href", "#" + id).html(icon));
            }
        });
    });
</script>
</body>
</html>
