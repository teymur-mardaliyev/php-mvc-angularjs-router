<!DOCTYPE html>
<html lang="en" ng-app="routerApp">
<head>
    <meta charset="UTF-8">
    <title>PHP MVC AngularJS Router</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/assets/css/ui-bootstrap-1.3.3-csp.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/assets/css/default.css"/>
    <script type="text/javascript">
        var defaults = {
            'url': '<?php echo URL;?>'
        };
    </script>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <nav class="navbar navbar-default color-s">
            <div class="container">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo URL; ?>#/">PHP MVC AngularJS Router</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo URL; ?>#/articles">Articles</a></li>
                            <li><a href="<?php echo URL; ?>blog/list">Blog</a></li>
                            <li><a href="<?php echo URL; ?>#/category">Category</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contact <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo URL; ?>#/contact">Angular Contact</a></li>
                                    <li><a href="<?php echo URL; ?>contact">Non-angular Contact</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div class="container">
        <div class="row">