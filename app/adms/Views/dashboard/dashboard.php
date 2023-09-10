<?php

echo "VIEW - Página Deshboard <br>";
echo $this->data . " " . $_SESSION['user_name'] . "!<br>";

echo "<a href='" . URLADM . "'>Sair</a>";
