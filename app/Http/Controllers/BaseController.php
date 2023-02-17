<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;

class BaseController extends Controller
{
    public function __construct()
    {

    }

    public function redirectSuccess($route, $message)
    {
        Session::flash('flash-message-success', $message);
        return Redirect::route($route);

    }

    /**
     * @param $route
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectFailure($route, $message)
    {
        Session::flash('flash-message-error', $message);
        return Redirect::route($route);
    }

    protected function redirectToPreviousUrlForFailure($message)
    {
        Session::flash('flash-message-error', $message);
        return Redirect::back();
    }

    public function redirectWithData($type,$route,$message,$data){
        if($type == "success"){
            Session::flash('flash-message-success', $message);
        }
        elseif($type == "error"){
            Session::flash('flash-message-error', $message);
        }
        return Redirect::route($route,[$data]);
    }


    ////////////////////////////////////////
    ////////RAMDON NUMBER SET/////////////////
    public function generateRandomString($length = 10) {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    protected function redirectToReload($message)
    {
        Session::flash('flash-message-error', $message);
    }

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

    public function rearrangeDateRangeCarbon($dateRange){
        $daterange_array = explode('-', $dateRange);
        $daterange_array[0] = trim($daterange_array[0]);
        $daterange_array[1] = trim($daterange_array[1]);

        $date['from'] = Carbon::create($daterange_array[0])->format('Y-m-d');
        $date['to'] = Carbon::create($daterange_array[1])->format('Y-m-d');
        return $date;
    }




}
