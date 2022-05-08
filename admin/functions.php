<?php

function randomString($n, $set)
{
    $characters = '';
    if ($set == 1) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    } elseif ($set == 2) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }

    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}
