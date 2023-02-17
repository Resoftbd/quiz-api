<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;

class BaseModel extends Eloquent
{
    /* common attributes */
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /* user model attribute */
    const ROLE_SUPER_ADMIN = 0;
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
    const ROLE_SUB_USER = 2;

    /*HTTP Status Code*/
    const CODE_OK = 200;
    const CODE_CREATED = 201;
    const CODE_ACCEPTED = 202;
    const CODE_BAD_REQUEST = 400;
    const CODE_UNAUTHORIZED = 401;
    const CODE_FORBIDDEN = 403;
    const CODE_NOT_FOUND = 404;
    const CODE_UNPROCESSABLE_ENTITY =422;
    const CODE_INTERNAL_SERVER_ERROR = 500;
    const CODE_NOT_IMPLEMENTED = 501;
    const CODE_BAD_GATEWAY = 502;
    const CODE_GATEWAY_TIMEOUT = 504;
    /*HTTP Status Code*/


    public static function rearrangeDateRangeCarbon($dateRange){
        $daterange_array = explode('-', $dateRange);
        $daterange_array[0] = trim($daterange_array[0]);
        $daterange_array[1] = trim($daterange_array[1]);

        $date['from'] = Carbon::create($daterange_array[0])->format('Y-m-d');
        $date['to'] = Carbon::create($daterange_array[1])->format('Y-m-d');
        return $date;
    }

    /*Number in K format*/
    public function numberReadableFormat($num) {

        if( $num > 1000 ) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;
        }

        return $num;
    }

    public static function cleanNumber($value)
    {
        $value = str_replace(' ', '', $value); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9]/', '', $value); // Removes special chars.
    }

    public static function getUSAreaCodeByNumber($number)
    {
        $number = str_replace('+','',trim($number));
        $firstCharacter = substr($number, 0,1);
        if(strlen($number) == 11 && ($firstCharacter == 1 || $firstCharacter == '1'))
            return substr($number,1,3);
        else if(strlen($number) == 10 && ($firstCharacter != 1 || $firstCharacter != '1'))
            return substr($number,0,2);
        else
            return false;
    }




    public static function getWeekdayAndName()
    {

        $weekMap = [
            0 => 'SUNDAY',
            1 => 'MONDAY',
            2 => 'TUESDAY',
            3 => 'WEDNESDAY',
            4 => 'THURSDAY',
            5 => 'FRIDAY',
            6 => 'SATURDAY',
        ];

        return $weekMap;
    }

    public static function utcToLocalTime($time,$timezone,$format='Y-m-d H:i:s')
    {
        $timestamp = Carbon::parse($time);
        $convertedTime = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
        $convertedTime->setTimezone($timezone);
        $formatedTime = $convertedTime->format($format);
        return $formatedTime;
    }

    public static function localToUTCTime($time,$timezone,$format='Y-m-d H:i:s')
    {
        $timestamp = Carbon::parse($time);
        $convertedTime = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, $timezone);
        $convertedTime->setTimezone('UTC');
        $formatedTime = $convertedTime->format($format);
        return $formatedTime;
    }



}
