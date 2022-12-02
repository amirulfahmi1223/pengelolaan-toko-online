<?php
session_start();
session_destroy();
session_unset();
setcookie('login', '', time() - 3600);
echo '<script>window.location="../form-login.php"</script>';
