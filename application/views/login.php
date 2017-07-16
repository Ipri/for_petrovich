<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<form method="post" enctype="application/x-www-form-urlencoded" class="form-signin" role="form">
    <h2 class="form-signin-heading">Please sign in</h2>
    <input ng-model="profile.email" name="email" maxlength="255" type="email" class="form-control" placeholder="Email address" required autofocus>
    <input ng-model="profile.password" name="password" maxlength="255" type="password" class="form-control" placeholder="Password" required>
    <label class="checkbox">
        <input ng-model="profile.remember" type="checkbox" value="remember-me"> Remember me
    </label>
    <button ng-click="authorize(profile)" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
