<?php
const Base_URL = "http://localhost/group_master/";

function http($url)
{
    return Base_URL . $url;
}

$results_per_page = 2;
global $results_per_page;