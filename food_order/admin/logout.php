<?php
include('../config/init.php');

session_destroy();

header("location:" . SITEURL . 'admin/login.php');
