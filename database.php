<?php

echo phpinfo();

$mysqli = new SQLite3('people.db');

$mysqli->query('create table people(name varchar(40), location varchar(40) );');