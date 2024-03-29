<?php if (!isset($page_title)) {
    $page_title = "Billing Staff";
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($page_title) ?></title>
    <link rel="stylesheet" href="<?php echo url_for("/stylesheets/admin.css"); ?>">
    <script src="<?php echo url_for("/js/staff_forms.js"); ?>"></script>
</head>
<body>
    <header>
        <h1><?php echo $page_title ?></h1>
        <?php if (is_logged_in()) { ?> 
                <p>Staff: <?php echo $_SESSION['username'] ?? "" ?></p>
                <a href="<?php echo url_for("/user_admin/logout.php"); ?>">Logout</a>
            </header>
            <nav>
                <!-- <ul><li> -->
                    <a href="<?php echo url_for("/user_staff/index.php"); ?>">Home</a>
                <!-- </li></ul> -->
            </nav>
        <?php } 
        require_login(); ?>