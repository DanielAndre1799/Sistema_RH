<?php

$host = "localhost/XE";
$user = "hr";
$pass = "hr";
$db = "(DESCRIPTION = 
(ADDRESS= (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
(CONNECT_DATA = (SERVICE_NAME  = XEPDB1))
)";

$conexao = oci_connect($user, $pass, $db, 'AL32UTF8');

?>
