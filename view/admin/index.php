<?php
include '../../app/config/database.php';
include '../../app/config/filter.php';
session_start();
filterLoginToTeacher($_SESSION['group']);
