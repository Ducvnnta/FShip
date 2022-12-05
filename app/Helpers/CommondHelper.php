<?php

use League\CommonMark\Environment\Environment;

if(!function_exists('getStatusMaintenance')){
    function getStatusMaintenance()
    {
        return Environment::select('*')->where('name','maintenance')->first()->status;
    }
}
