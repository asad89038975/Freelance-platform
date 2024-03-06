<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php?admin=3");
exit();
?>
