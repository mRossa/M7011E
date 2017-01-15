<!DOCTYPE html>
<html lang="en">
<head>
<title> GoC Home </title> <!-- The name that will stand on the tab -->
<?php
session_name('goc');
session_start();
$id = session_id();

include('head.php');
?>
</head>
<body>
<?php
include('print_post.php');
?>

</main>
</div>
</body>
<footer>

</footer>
</html>
