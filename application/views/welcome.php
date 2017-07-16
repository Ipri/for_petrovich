<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en" ng-app="test-app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test-app</title>
    <link href="<?=base_url();?>assets/css/lib/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/css/styles.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src='<?=base_url();?>assets/js/lib/angular.min.js'></script>
    <script type="text/javascript" src='<?=base_url();?>assets/js/lib/angular-route.min.js'></script>
    <script type="text/javascript" src='<?=base_url();?>assets/js/app.js'></script>
</head>
<body>
    <div class="container" ng-controller="MainController">
        <ng-view></ng-view>        
    </div>
</body>
</html>