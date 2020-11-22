<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util
{
    public static function convert_date_format($date_format_source){
        $object_date = date_create_from_format('Y-m-d',$date_format_source);
        $date_format_return = $object_date->format("d/m/Y");
        return $date_format_return;
    }
}

