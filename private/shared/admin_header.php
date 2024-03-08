<?php if (!isset($page_title)) {
    $page_title = "Billing Schmbilling";
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($page_title) ?></title>
    <link rel="stylesheet" href="<?php echo url_for("/stylesheets/admin.css"); ?>">
</head>
<body>
    <header>
        <h1><?php echo $page_title ?></h1>
        <?php if(is_logged_in()) { ?> 
            <p>Admin: <?php echo $_SESSION['username'] ?? "" ?></p>
            <a href="<?php echo url_for("/user_admin/logout.php"); ?>">Logout</a>
            <?php } else { ?>
            <a href="<?php echo url_for("/user_admin/login.php"); ?>">Login</a>
            <?php } ?>
    </header>
    <nav>
        <!-- <ul><li> -->
            <a href="<?php echo url_for("/user_admin/index.php"); ?>">Home</a>
        <!-- </li></ul> -->
        <?php echo session_msg();?>
    </nav>