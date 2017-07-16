<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li ng-class="{'active' : view === 'profile'}" ng-click="view = 'profile'"><a href="#">Profile</a></li>
                <li ng-class="{'active' : view === 'orders'}" ng-click="view = 'orders'"><a href="#">Orders</a></li>
                <li ng-class="{'active' : view === 'logout'}" ng-click="logout()"><a href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div ng-switch="view">
    <div ng-switch-when="profile">
        <div ng-include="'/template/get/profile'"></div>
    </div>
    <div ng-switch-when="orders">
        <div ng-include="'/template/get/orders'"></div>
    </div>
</div>
