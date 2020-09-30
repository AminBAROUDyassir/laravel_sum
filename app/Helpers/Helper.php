<?php

namespace App\Helpers;

use File;

class Helper
{

    public static function upload_picture($picture)
    {
        Helper::delete_picture($picture, "/uploads/");

        $file_name = Helper::file_name();

        $ext = $picture->getClientOriginalExtension();
        $local_url = $file_name . "." . $ext;

        $ext = $picture->getClientOriginalExtension();
        $local_url = $file_name . "." . $ext;
        $picture->move(public_path() . "/uploads", $file_name . "." . $ext);

        $web_url = Helper::web_url() . '/uploads/' . $local_url;

        return $web_url;
    }

    public static function web_url()
    {
        return url('/');
    }

    public static function delete_picture($picture, $path)
    {

        if (file_exists(public_path() . $path . basename($picture))) {

            File::delete(public_path() . $path . basename($picture));

        }
        return true;
    }

    public static function get_url_picture($picture, $path)
    {

        if (file_exists(public_path() . $path . basename($picture))) {

            return Helper::web_url() . $path . basename($picture);

        }
        return Helper::web_url() . $path . "images/50x40.png";
    }

    public static function file_name($prefix = "")
    {

        $prefix = $prefix ? $prefix : "event_";

        $current_time = date("Y-m-d-H-i-s");

        $random_name = sha1(rand());

        $file_name = $prefix . "-" . $current_time . "-" . $random_name;

        $file_name = str_replace("-", "_", $file_name);

        return $file_name;
    }

    public static function is_token_valid($entity, $id, $token, &$error)
    {
        if (
            ($entity == 'USER' && ($row = User::where('id', '=', $id)->where('token', '=', $token)->first()))
        ) {
            if ($row->token_expiry > time()) {
                // Token is valid
                $error = null;
                return $row;
            } else {
                $error = array('success' => false, 'error_messages' => Helper::get_error_message(103), 'error_code' => 103);
                return false;
            }
        }
        $error = array('success' => false, 'error_messages' => Helper::get_error_message(104), 'error_code' => 104);
        return false;
    }

    public static function get_error_message($code)
    {

        switch ($code) {

            case 101:
                $string = tr('invalid_input');
                break;
            case 102:
                $string = tr('email_address_already_use');
                break;
            case 103:
                $string = tr('token_expiry');
                break;
            case 104:
                $string = tr('invalid_token');
                break;
            case 105:
                $string = tr('username_password_donot_match');
                break;
            case 106:
                $string = tr('all_fields_required');
                break;
            case 107:
                $string = tr('current_password_incorrect');
                break;
            case 108:
                $string = tr('password_not_correct');
                break;
            case 109:
                $string = tr('application_encountered_unknown');
                break;
            case 111:
                $string = tr('email_not_activated');
                break;
            case 115:
                $string = tr('invalid_refresh_token');
                break;
            case 123:
                $string = tr('something_went_wrong_error');
                break;
            case 124:
                $string = tr('email_not_registered');
                break;
            case 125:
                $string = tr('not_valid_social_register');
                break;
            case 130:
                $string = tr('no_result_found');
                break;
            case 131:
                $string = tr('old_password_wrong_password_doesnot_match');
                break;
            case 132:
                $string = tr('provider_id_not_found');
                break;
            case 133:
                $string = tr('user_id_not_found');
                break;
            case 141:
                $string = tr('something_went_wrong_paying_amount');
                break;
            case 144:
                $string = tr('please_verify_your_account');
                break;
            case 145:
                $string = tr('video_already_added_history');
                break;
            case 146:
                $string = tr('something_wrong_please_try_again');
                break;

            case 147:
                $string = tr('redeem_disabled_by_admin');
                break;
            case 148:
                $string = tr('minimum_redeem_not_have');
                break;
            case 149:
                $string = tr('redeem_wallet_empty');
                break;
            case 150:
                $string = tr('redeem_request_status_mismatch');
                break;
            case 151:
                $string = tr('redeem_not_found');
                break;
            case 152:
                $string = tr('coupon_not_found');
                break;
            case 153:
                $string = tr('coupon_inactive_status');
                break;
            case 154:
                $string = tr('subscription_not_found');
                break;
            case 155:
                $string = tr('subscription_inactive_status');
                break;
            case 156:
                $string = tr('subscription_amount_should_be_grater');
                break;
            case 157:
                $string = tr('video_not_found');
                break;
            case 158:
                $string = tr('video_amount_should_be_grater');
                break;
            case 159:
                $string = tr('expired_coupon_code');
                break;
            case 162:
                $string = tr('failed_to_upload');
                break;
            case 163:
                $string = tr('user_payment_details_not_found');
                break;
            case 164:
                $string = tr('subscription_autorenewal_already_cancelled');
                break;
            case 165:
                $string = tr('subscription_autorenewal_already_enabled');
                break;
            case 166:
                $string = tr('publish_time_should_not_lesser');
                break;
            case 167:
                $string = tr('video_not_saving');
                break;
            case 168:
                $string = tr('sub_profile_details_not_found');
                break;
            case 169:
                $string = tr('sub_profile_delete_not_allowed_for_default_profile');
                break;
            case 170:
                $string = tr('user_profile_save_failed');
                break;
            case 171:
                $string = tr('admin_video_no_ppv');
                break;

            case 901:
                $string = tr('default_card_not_available');
                break;
            case 902:
                $string = tr('something_went_wrong_error_payment');
                break;
            case 903:
                $string = tr('payment_not_completed_pay_again');
                break;
            case 904:
                $string = tr('flagged_video');
                break;
            case 905:
                $string = tr('user_login_decline');
                break;
            case 906:
                $string = tr('video_data_not_found');
                break;

            case 3000:
                $string = tr('user_record_deleted_contact_admin');
                break;
            case 3001:
                $string = tr('verification_code_title');
                break;
            case 3002:
                $string = tr('sub_profile_is_invalid');
                break;
            case 3003:
                $string = tr('verification_mobile');
                break;
            case 3004:
                $string = tr('verification_email');
                break;
            // Wallet voucher codes
            case 10001:
                $string = tr('user_wallet_amount_add_failed');
                break;
            case 10002:
                $string = tr('voucher_code_is_invalid');
                break;
            case 10003:
                $string = tr('voucher_code_expired');
                break;
            case 10004:
                $string = tr('voucher_code_already_used');
                break;
            case 10005:
                $string = tr('wallet_no_balance');
                break;

            default:
                $string = tr('unknown_error_occured');
        }
        return $string;
    }

}
