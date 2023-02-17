<?php

namespace App\Http\Helpers;

use App\Contracts\Services\LookupUserContact;
use App\Contracts\Services\MarketplaceContact;
use App\Contracts\Services\UserContact;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ViewHelper
{
    public static function getUserInformation()
    {

        $user_info = Auth::user();
        if($user_info){
            return $user_info;
        }
        return 'guest';
    }

    public static function getFirstLetterFromEachWord($string, $email, $case = 'strtoupper')
    {
        if($string != null && $string != '' && $string != ' '){
            //strtolower, strtoupper
            $words = explode(" ", $string);
            $acronym = "";
            foreach ($words as $w) {
                $acronym .= $w[0];
            }

            return $case($acronym);
        }
        else{
            //strtolower, strtoupper
            $words = explode(" ", $email);
            $acronym = "";
            foreach ($words as $w) {
                $acronym .= $w[0];
            }

            return $case($acronym);
        }

    }

    public static function get_login_error_message($check = true)
    {
        $message = '';
        if(Session::has('user_login_error')){
            $message = Session::get('user_login_error');
            $message = '<p class="m-login__title text-danger" style="font-size:12px;font-weight:bolder;">'.$message.'</p>';
            if($check){
                Session::forget('user_login_error');
            }
        }
        return $message;
    }

    public static function get_active_menu($link)
    {
        return request()->is($link) ? 'm-menu__item--active' : '';
    }

    public static function getCard($card_number)
    {
        $length = strlen($card_number);
        $get_last_four_digit = substr($card_number, -4);
        $number = '';
        for ($i = 1; $i <= ($length - 4); $i++)
        {
            $number .= 'x';
        }
        $number .= $get_last_four_digit;
        return $number;
    }

    public static function updateUser($field_name, $field_value)
    {
        $where = [
            'id' => Auth::id()
        ];
        App::make(UserContact::class)->updateByWhereANDField($where, [$field_name => $field_value]);
    }

    public static function numberReadableFormat($num) {

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

    public static function getCategories()
    {
       return App::make(MarketplaceContact::class)->getCategories();
    }
}
