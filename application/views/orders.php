<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div ng-controller="OrdersController" class="jumbotron">
    <div class="orders-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th ng-repeat="fieldName in record.getSchema()">{{fieldName}}</th>
                </tr>
            </thead>
            <tbody>

                <tr ng-repeat="order in orders">
                    <td>{{order[0]}}</td>
                    <td>{{order[1]}}</td>
                    <td>{{order[2]}}</td>
                </tr>

            </tbody>
        </table>
    </div>    
    <ul class="pagination">
        <li ng-repeat="(key, range) in ranges" ng-class="{ 'active': rangeKey === key }"><a ng-click="filterOrders(range, key)" href="#">{{key + 1}}</a></li>
    </ul>
</div>    