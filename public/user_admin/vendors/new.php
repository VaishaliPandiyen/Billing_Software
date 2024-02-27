<?php require_once("../../../private/initialise.php");

// for now, we test our errors here
$test = $_GET['test'];

// if the url reads "localhost/billing_software/public/user_admin/vendors/new.php?test=404":
if ($test == '404') {
    error_404();
} else if ($test == '500') {
    error_500();
} else if ($test == 'redirect') {
    redirect(url_for('/user_admin/vendors/index.php'));
    exit();
} else {
    echo ("No error");
}
;