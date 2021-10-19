<?php

session_start();

require 'modelos/Session.php';

Session::cerrar();
header('Location: index.php');
