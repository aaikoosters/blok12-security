<?php
    function newUser($un, $pw)
    {
        $hash = password_hash($pw, PASSWORD_BCRYPT, ['cost' => 12]);
    }
?>