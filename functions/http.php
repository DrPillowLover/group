<?php
const Base_URL = "http://localhost:81/group-master/";

function http($url)
{
    return Base_URL . $url;
}

$results_per_page = 2;
global $results_per_page;