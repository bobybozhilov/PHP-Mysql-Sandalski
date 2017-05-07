<?php
error_reporting(0);
$conn = mysql_connect("localhost","root","")
or die("server connection error");

$db_create = mysql_query("CREATE DATABASE IF NOT EXISTS balance")
or die("cannot create database.".mysql_error());

mysql_select_db("Balance");

$user = "CREATE TABLE User(" .
	"Code smallint(5) unsigned NOT NULL auto_increment," .
	"Name varchar(33) NOT NULL," . 
	"Kind smallint(4) unsigned NOT NULL default 0," . 
	"Sum decimal(9,2) NOT NULL default 0.0," .
	"PRIMARY KEY (Code))";
	
$result = mysql_query($user)
or die(mysql_error());

echo "New database named Balance had been created successfully!"
?>