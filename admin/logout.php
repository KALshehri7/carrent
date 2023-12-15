<?php ob_start();
session_start(); ?>

<html lang="en">
<body>
<p>Signing out... Please wait.</p>
<?php
if (isset($_SESSION['adminUsername']) && $_SESSION['authenticated'] == 1) {
    session_destroy();
    header('refresh: 1; url=../');
}
?>
</body>
</html>