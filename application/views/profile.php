<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div ng-controller="ProfileController" class="jumbotron">
    <div ng-switch="profileMode">
        <div ng-switch-when="viewing">

                <div class="row">
                    <div class="col-md-2">
                        Name
                    </div>
                    <div  class="col-md-10">{{profile.name}}</div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        Email
                    </div>
                    <div  class="col-md-10">{{profile.email}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button ng-click="switchMode('edit')" class="btn btn-lg btn-primary btn-block" type="submit">Edit</button>
                    </div>
                    <div class="col-md-8"></div>
                </div>

        </div>
        <div ng-switch-when="edit">

                <div class="row">
                    <div class="col-md-4">
                        <input ng-model="profile.newName" ng-init="profile.newName=profile.name" name="name" maxlength="255" type="text" class="form-control" placeholder="Name" required autofocus>
                    </div>
                    <div class="col-md-8"></div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input ng-model="profile.newEmail" ng-init="profile.newEmail=profile.email" type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-md-8"></div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button ng-click="profileSave()" class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
                    </div>
                    <div class="col-md-8"></div>
                </div>

        </div>
    </div>
</div>


