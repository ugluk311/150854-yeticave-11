<?php
$is_auth = rand(0, 1);

$user_name = 'Евгений';


function format_sum($num)
{
    $num_round = ceil($num);
    $ruble_html = '<b class="rub">р</b>';
    if ($num_round < 1000) {
        return $num_round . $ruble_html;
    } else {
        $num_format = number_format($num_round, 0, '', ' ');
        return $num_format . $ruble_html;
    }
}