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
    date_default_timezone_set("Europe/Moscow");
    $cur_date_ts = time();
    $end_date_ts = strtotime($date);
    $dif_date_ts = $end_date_ts - $cur_date_ts;
    $hours_until_end = floor($dif_date_ts / 3600);
    $min_until_end = $dif_date_ts / 60 % 60;
    if ($min_until_end < 10 and $min_until_end >= 0 or $hours_until_end < 10 and $hours_until_end >= 0) {
        $min_until_end = sprintf("%02d", $min_until_end);
        $hours_until_end = sprintf("%02d", $hours_until_end);
    }
    return array($hours_until_end, $min_until_end);

}