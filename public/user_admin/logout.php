<?php
require_once('../../private/initialise.php');

unset($_SESSION['username']);
// or you could use
// $_SESSION['username'] = NULL;

redirect(url_for('/user_admin/login.php'));