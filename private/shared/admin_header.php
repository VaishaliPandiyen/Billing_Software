<?php if (!isset($page_title)) {
    $page_title = "Billing Admin";
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($page_title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo url_for("/stylesheets/admin.css"); ?>">
</head>
<body class="bg-white">
    <header class="bg-primary">
        <h1 class="text-white">
            <?php echo $page_title ?>
        </h1>
<?php if (is_logged_in()) { ?> 
        <p class="text-white">Admin: <?php echo $_SESSION['username'] ?? "" ?></p>
        <a class="text-white" href="<?php echo url_for("/user_admin/logout.php"); ?>">Logout</a>
    </header>
    <nav>
        <!-- <ul><li> -->
        <a href="<?php echo url_for("/user_admin/index.php"); ?>">Home</a>
        <!-- </li></ul> -->
        <?php echo session_msg(); ?>
    </nav>
<?php } 
require_login(); ?>