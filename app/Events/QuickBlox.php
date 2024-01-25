<?php

namespace App\Events;

use App\User;
use App\Models\PortalJoinUser;

class QuickBlox
{
    const QUICKBLOX_APPLICATION_ID = 91878;
    const QUICKBLOX_AUTH_KEY = 'mRqM3sXLYzAwjx9';
    const QUICKBLOX_AUTHSECRET = 'H-4bfvxNORFJAC9';
    const QUICKBLOX_API_URL = 'https://api.quickblox.com';

    public static function quickboxToken() {
        // server
        $application_id = self::QUICKBLOX_APPLICATION_ID;
        $auth_key = self::QUICKBLOX_AUTH_KEY;
        $authSecret = self::QUICKBLOX_AUTHSECRET;
        $nonce = rand();
        $timestamp = time();


        $stringForSignature = "application_id=" . $application_id . "&auth_key=" . $auth_key . "&nonce=" . $nonce . "&timestamp=" . $timestamp;
        $signature = hash_hmac('sha1', $stringForSignature, $authSecret);

        $post_body = http_build_query(
                array(
                    'application_id' => $application_id,
                    'auth_key' => $auth_key,
                    'nonce' => $nonce,
                    'signature' => $signature,
                    'timestamp' => $timestamp,
                )
        );

        $tokenCurl = curl_init();
        curl_setopt($tokenCurl, CURLOPT_URL, self::QUICKBLOX_API_URL . '/session.json');
        curl_setopt($tokenCurl, CURLOPT_POST, true);
        curl_setopt($tokenCurl, CURLOPT_POSTFIELDS, $post_body);
        curl_setopt($tokenCurl, CURLOPT_RETURNTRANSFER, true);
        $responce = curl_exec($tokenCurl);
        // Check errors
        if ($responce) {
            $responceDecode = json_decode($responce);
            $token = $responceDecode->session->token;
            return $token;
        } else {
            $error = curl_error($tokenCurl) . '(' . curl_errno($tokenCurl) . ')';
            return true;
        }
        // Close connection
        curl_close($tokenCurl);
    }

    public static function quickboxTokenUser($quickBloxID) {
        // server
        $application_id = self::QUICKBLOX_APPLICATION_ID;
        $auth_key = self::QUICKBLOX_AUTH_KEY;
        $authSecret = self::QUICKBLOX_AUTHSECRET;
        $nonce = rand();
        $timestamp = time();

        if ($quickBloxID != '') {
            $userDetail = PortalJoinUser::where('user_id', $quickBloxID)->first();
            $quickblox_password = 'quickblox';
            $stringForSignature = "application_id=" . $application_id . "&auth_key=" . $auth_key . "&nonce=" . $nonce . "&timestamp=" . $timestamp . "&user[login]=" . $userDetail->quickblox_username . "&user[password]=" . $quickblox_password;

            $signature = hash_hmac('sha1', $stringForSignature, $authSecret);

            $post_body = http_build_query(array(
                'application_id' => $application_id,
                'auth_key' => $auth_key,
                'timestamp' => $timestamp,
                'nonce' => $nonce,
                'signature' => $signature,
                'user[login]' => $userDetail->quickblox_username,
                'user[password]' => $quickblox_password
            ));
        } else {
            $stringForSignature = "application_id=" . $application_id . "&auth_key=" . $auth_key . "&nonce=" . $nonce . "&timestamp=" . $timestamp;
            $signature = hash_hmac('sha1', $stringForSignature, $authSecret);

            $post_body = http_build_query(
                    array(
                        'application_id' => $application_id,
                        'auth_key' => $auth_key,
                        'nonce' => $nonce,
                        'signature' => $signature,
                        'timestamp' => $timestamp,
                    )
            );
        }
        $tokenCurl = curl_init();
        curl_setopt($tokenCurl, CURLOPT_URL, self::QUICKBLOX_API_URL . '/session.json');
        curl_setopt($tokenCurl, CURLOPT_POST, true);
        curl_setopt($tokenCurl, CURLOPT_POSTFIELDS, $post_body);
        curl_setopt($tokenCurl, CURLOPT_RETURNTRANSFER, true);
        $responce = curl_exec($tokenCurl);
        $responceDecode = json_decode($responce);
        //echo '<pre>'; print_r($responce);die;
        // Check errors
        if ($responce && isset($responceDecode->session)) {
            $responceDecode = json_decode($responce);
            $token = $responceDecode->session->token;
            return $token;
        } else {
            $error = curl_error($tokenCurl) . '(' . curl_errno($tokenCurl) . ')';
            return true;
        }
        // Close connection
        curl_close($tokenCurl);
    }

    public static function quickboxSinupUser($userid) {
        $token = self::quickboxToken();  // genrate quickblox session
        $userData = PortalJoinUser::select('users.email', 'portal_join_users.firstName', 'portal_join_users.lastName', 'portal_join_users.username', 'portal_join_users.user_id')->leftJoin('users', 'users.id', '=', 'portal_join_users.user_id')->where('user_id', $userid)->first();
        //dd($userData);
        $post_body = http_build_query(
                array(
                    'user' => array(
                        'login' => rand(11,99).strtolower($userData->firstName),
                        'password' => 'quickblox',
                        'email' => $userData->email,
                        'external_user_id' => $userData->user_id,
                        'facebook_id' => '',
                        'twitter_id' => '',
                        'full_name' => $userData->firstName.' '.$userData->lastName,
                        'phone' => '',
                        'website' => '',
                        'tag_list' => '',
                    )
                )
        );

        $signUpCurl = curl_init();
        curl_setopt($signUpCurl, CURLOPT_URL, self::QUICKBLOX_API_URL . '/users.json');
        curl_setopt($signUpCurl, CURLOPT_HTTPHEADER, array("QB-Token: " . $token));
        curl_setopt($signUpCurl, CURLOPT_POST, true);
        curl_setopt($signUpCurl, CURLOPT_POSTFIELDS, $post_body);
        curl_setopt($signUpCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($signUpCurl, CURLOPT_SSL_VERIFYPEER, FALSE);

        $responce = curl_exec($signUpCurl);
        //dd($responce);
        //print_r($responce);die;
        // Check errors
        if ($responce) {
            $responceDecode = json_decode($responce);
            if ((!isset($responceDecode->errors))) { //updated code
                $quickblox_id = $responceDecode->user->id;
                //update quickblox id
                PortalJoinUser::where(['user_id' => $userid])->update(['quickblox_id' => $quickblox_id, 'quickblox_username' => strtolower($userData->firstName)]);
                return true;
            } else {
                return false;
            }//updated code ends
        } else {
            $error = curl_error($signUpCurl) . '(' . curl_errno($signUpCurl) . ')';
            return true;
        }

        // Close connection
        curl_close($signUpCurl);
    }

    public static function quickboxCreategroup($occ_ids = null, $postslug = NULL, $user_ids = NULL) {
        
        $token = self::quickboxTokenUser($occ_ids);  // genrate quickblox session
        
        $userData = User::getUserDetails(Yii::$app->user->id);
        $doctorData = User::getUserDetails($user_ids);
        
        $post_body = array(
            'type' => 3,
            'name' => $doctorData['username'] . ',' . $userData['username'],
            'occupants_ids' => $doctorData['quickblox_id'] . ',' . $occ_ids,
            "data" => ["class_name" => 'post', "slug" => $postslug]
        );
        $postDAta = json_encode($post_body);
        //print_r($postDAta);die;

        $groupCurl = curl_init();
        curl_setopt($groupCurl, CURLOPT_URL, self::QUICKBLOX_API_URL . '/chat/Dialog.json');
        curl_setopt($groupCurl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postDAta),
            "QB-Token: " . $token
                )
        );
        curl_setopt($groupCurl, CURLOPT_POST, true);
        curl_setopt($groupCurl, CURLOPT_POSTFIELDS, $postDAta);
        curl_setopt($groupCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($groupCurl, CURLOPT_SSL_VERIFYPEER, FALSE);

        $responce = curl_exec($groupCurl);
        if ($responce) {
            $responceDecode = json_decode($responce);
            //echo '<pre>'; print_r($responceDecode);die;
            if ((!isset($responceDecode->errors))) { //updated code
                return true;
            } else {
                return false;
            }//updated code ends
        } else {
            $error = curl_error($groupCurl) . '(' . curl_errno($groupCurl) . ')';
            return true;
        }
        // Close connection
        curl_close($groupCurl);
    }

    public function quickboxUserLogin($quickblox_id) {
        $token = self::quickboxTokenUser($quickblox_id);  // genrate quickblox session

        $userDetail = \common\models\UserProfile::getQuickBloxUser($quickblox_id);
        $post_body = http_build_query(array(
            'login' => $userDetail['quickblox_username'],
            'password' => $userDetail['quickblox_password']
        ));
        $userLoginCurl = curl_init();
        curl_setopt($userLoginCurl, CURLOPT_URL, self::QUICKBLOX_API_URL . '/login.json');
        curl_setopt($userLoginCurl, CURLOPT_HTTPHEADER, array("QB-Token: " . $token));
        curl_setopt($userLoginCurl, CURLOPT_POST, true);
        curl_setopt($userLoginCurl, CURLOPT_POSTFIELDS, $post_body);
        curl_setopt($userLoginCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($userLoginCurl, CURLOPT_SSL_VERIFYPEER, FALSE);

        $responce = curl_exec($userLoginCurl);
        if ($responce) {
            $responceDecode = json_decode($responce);
            $getSession = self::quickboxGetSession($responceDecode->user->id);  // genrate quickblox session
            if ((!isset($responceDecode->errors))) { //updated code
                return true;
            } else {
                return false;
            }//updated code ends
        } else {
            $error = curl_error($userLoginCurl) . '(' . curl_errno($userLoginCurl) . ')';
            return true;
        }

        // Close connection
        curl_close($userLoginCurl);
    }
}