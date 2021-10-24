<?php

session_start();

require 'modelos/Sesion.php';

Sesion::cerrar();
header('Location: index.php');
