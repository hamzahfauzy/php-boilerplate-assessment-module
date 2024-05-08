<?php

if(isset($_GET['filter']) && isset($_GET['filter']['instrument_id']))
{
    $data['instrument_id'] = $_GET['filter']['instrument_id'];
}