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

function get_time_left(string $date)
{
    $cur_date_ts = time();
    $end_date_ts = strtotime($date);
    $dif_date_ts = $end_date_ts - $cur_date_ts;
    $hours_until_end = floor($dif_date_ts / 3600);
    $hours_until_end = str_pad($hours_until_end, 2, "0", STR_PAD_LEFT);
    $min_until_end = $dif_date_ts / 60 % 60;
    $min_until_end = str_pad($min_until_end, 2, "0", STR_PAD_LEFT);
    return array($hours_until_end, $min_until_end);

}