<?php
session_start();

/* MOCK LOGIN ONLY — REMOVE LATER */

$_SESSION['user_id'] = 1;
$_SESSION['name'] = "Test User";
$_SESSION['role'] = "customer";

echo "Mock login active. Session created.";