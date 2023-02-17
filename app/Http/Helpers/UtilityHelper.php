<?php

namespace App\Http\Helpers;

use App\Contracts\Services\UserContact;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UtilityHelper
{
    public static function getWebSocketCred()
    {
        return [
            'url'=> env('WEB_SOCKET_CRED_URL'),
            'user'=> env('WEB_SOCKET_CRED_USER'),
            'passcode'=> env('WEB_SOCKET_CRED_PASSCODE'),
            'destination'=> env('WEB_SOCKET_CRED_DESTINATION'),
            'auth_token'=> isset(ViewHelper::getUserInformation()->_id) ? ViewHelper::getUserInformation()->_id : null
        ];
    }

    public static function getUserBalance($user_id = null)
    {
        if($user_id == null)
            $user_id = Auth::id();
        $user = App::make(UserContact::class)->getBalanceByUserId(BaseModel::mongoId($user_id));
        return isset($user->amount) ? $user->amount : 0;
    }

    public static function increaseBalance($user_id, $balance)
    {
        $user = App::make(UserContact::class)->addBalanceByUserId(BaseModel::mongoId($user_id), $balance);
        return isset($user->amount) ? $user->amount : 0;
    }

    public static function preparedPagination(
        $limit, $active_list, $total_list, $select_structure = 7,
        $click_class = 'conversation-pagination-list', $active_class_custom = 'active-pagination-list-conversation',
        $extra_classes_in_nav = '', $extra_classes_in_ul = '', $extra_classes_in_li = '', $extra_classes_in_a = '',
        $remove_nav = false)
    {
        //total list is for total count
        //total selected structure = 3,5,7
        //click class for each click on li
        //active class custom for change the design of active li
        // remove nav for show or hide nav tag
        $pagination = '';

        if($total_list / $limit > 1){
            if($remove_nav == false){
                $pagination .= '<nav aria-label="Page navigation '.$extra_classes_in_nav.'">';
            }
            $pagination .= '<ul class="pagination '.$extra_classes_in_ul.'">';
            for($i = 0; $i < (int)ceil($total_list / $limit); $i++){
                //create structure for different selected structure
                if($select_structure == 7){
                    $active = '';
                    if($total_list > 7){
                        if($active_list < 4){
                            if($active_list == $i){
                                $active = $active_class_custom;
                            }
                            if($i < 5){
                                $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">'.($i+1).'</a></li>';
                            }
                            else{
                                if($i == ((int)ceil($total_list / $limit) - 2)){
                                    $pagination .= '<li data-id="null" class="page-item disabled'.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">...</a></li>';
                                }
                                elseif($i == ((int)ceil($total_list / $limit) - 1)){
                                    $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">>></a></li>';
                                }
                            }
                        }
                        else if(((int)ceil($total_list/$limit) - $active_list) <= 4){
                            if($active_list == $i){
                                $active = $active_class_custom;
                            }
                            if($i >=  ((int)ceil($total_list/$limit) - 5)){
                                $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">'.($i+1).'</a></li>';
                            }
                            else{
                                if($i == 0){
                                    $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)"><<</a></li>';
                                }
                                elseif($i == 1){
                                    $pagination .= '<li data-id="null" class="page-item disabled'.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">...</a></li>';
                                }
                                else{
                                    continue;
                                }
                            }
                        }
                        else{
                            $pagination .= '<li data-id="0" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)"><<</a></li>';

                            $pagination .= '<li data-id="null" class="page-item disabled'.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">...</a></li>';

                            $pagination .= '<li data-id="'.($active_list-1).'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">'.($active_list).'</a></li>';

                            $pagination .= '<li data-id="'.($active_list).'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active_class_custom.' '.$extra_classes_in_a.'" href="javascript:void(0)">'.($active_list+1).'</a></li>';

                            $pagination .= '<li data-id="'.($active_list+1).'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">'.($active_list+2).'</a></li>';

                            $pagination .= '<li data-id="null" class="page-item disabled '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">...</a></li>';

                            $pagination .= '<li data-id="'.(ceil($total_list / $limit) - 1).'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">>></a></li>';

                            break;
                        }
                    }
                    else{
                        if($active_list == $i){
                            $active = $active_class_custom;
                        }
                        $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">'.($i+1).'</a></li>';
                    }

                }
                elseif($select_structure == 5)
                {

                }
                elseif($select_structure == 3)
                {
                    if($total_list > 3){
                        if($active_list = 0){

                        }
                        elseif($active_list == ((int)ceil(($total_list / $limit)) -1)){

                        }
                        else{

                        }
                    }
                    else{

                    }

                }
                elseif($select_structure == 2){
                    $pagination .= '<li data-id="'.($active_list - 1).'" class="page-item '.($active_list == 0 ? 'disabled' : $click_class).' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)" >Previous</a></li>';
                    $pagination .= '<li data-id="'.($active_list + 1).'" class="page-item '.($active_list == ((int)ceil($total_list / $limit)-1) ? 'disabled' : $click_class).' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">Next</a></li>';
                    break;
                }
                elseif($select_structure > 7){
                    $active = '';
                    if($total_list > $select_structure){
                        if($active_list < ($select_structure-3)){
                            if($active_list == $i){
                                $active = $active_class_custom;
                            }
                            if($i < ($select_structure - 2)){
                                $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">'.($i+1).'</a></li>';
                            }
                            else{
                                if($i == ((int)ceil($total_list / $limit) - 2)){
                                    $pagination .= '<li data-id="null" class="page-item disabled'.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">...</a></li>';
                                }
                                elseif($i == ((int)ceil($total_list / $limit) - 1)){
                                    $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">>></a></li>';
                                }
                            }
                        }
                        else if(((int)ceil($total_list/$limit) - $active_list) <= ($select_structure-3)){
                            if($active_list == $i){
                                $active = $active_class_custom;
                            }
                            if($i >=  ((int)ceil($total_list/$limit) - ($select_structure - 2))){
                                $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">'.($i+1).'</a></li>';
                            }
                            else{
                                if($i == 0){
                                    $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)"><<</a></li>';
                                }
                                elseif($i == 1){
                                    $pagination .= '<li data-id="null" class="page-item disabled'.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">...</a></li>';
                                }
                                else{
                                    continue;
                                }
                            }
                        }
                        else{
                            //first two list
                            $pagination .= '<li data-id="0" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)"><<</a></li>';

                            $pagination .= '<li data-id="null" class="page-item disabled'.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">...</a></li>';

                            //dynamic list start
                            //before active list
                            for($loop = 0; $loop < (int)ceil(($select_structure - 5) / 2); $loop++){
                                $pagination .= '<li data-id="'.($active_list-($loop+1)).'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">'.($active_list - $loop).'</a></li>';
                            }

                            $pagination .= '<li data-id="'.($active_list).'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active_class_custom.' '.$extra_classes_in_a.'" href="javascript:void(0)">'.($active_list+1).'</a></li>';

                            //after active list
                            for($loop = 0; $loop < (int)floor(($select_structure - 5) / 2); $loop++){
                                $pagination .= '<li data-id="'.($active_list+($loop+1)).'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">'.($active_list+($loop +2)).'</a></li>';
                            }
                            //dynamic list end


                            //last two list
                            $pagination .= '<li data-id="null" class="page-item disabled '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">...</a></li>';

                            $pagination .= '<li data-id="'.(ceil($total_list / $limit) - 1).'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$extra_classes_in_a.'" href="javascript:void(0)">>></a></li>';

                            break;
                        }
                    }
                    else{
                        if($active_list == $i){
                            $active = $active_class_custom;
                        }
                        $pagination .= '<li data-id="'.$i.'" class="page-item '.$click_class.' '.$extra_classes_in_li.'"> <a class="page-link '.$active.' '.$extra_classes_in_a.'" href="javascript:void(0)">'.($i+1).'</a></li>';
                    }
                }
            }
            $pagination .= '</ul>';
            if($remove_nav  == false){
                $pagination .= '</nav>';
            }
        }

        return $pagination;
    }

    public static function subscriptionStatus($user_id)
    {
        $subscription_status = [
            'subscription' => BaseModel::SUBSCRIPTION_FALSE,
            'subscription_status' => BaseModel::SUBSCRIPTION_STATUS_TRUE
        ];
        $user = App::make(UserContact::class)->getByUserId(BaseModel::mongoId($user_id));
        if($user && $user->role !=BaseModel::ROLE_ADMIN){
            $subscription_status['subscription'] = $user->subscription;
            $subscription_status['subscription_status'] = $user->subscription_status;
        }

        return $subscription_status;
    }

    public static function fileVersion()
    {
        if(getenv('APP_ENV') == 'local'){
            return '?v001-'.date('d-m-Y').microtime();

        }
        else{
            return '?v001-'.date('d-m-Y');
        }

    }

    public static function getUserIpAddr(){
        $ip_address = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ip_address = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ip_address = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ip_address = $_SERVER['REMOTE_ADDR'];
        else
            $ip_address = 'UNKNOWN';
        return $ip_address;
    }

    public static function customRandomStr($number = 5){

        return Str::random($number);
    }


}
