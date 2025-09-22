<?php

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\DB;

if (! function_exists('action_button')) {
    /**
     * Generate a Bootstrap + FontAwesome action button.
     *
     * @param string $route   The route or URL
     * @param string $icon    FontAwesome class (e.g. 'fa fa-edit')
     * @param string $label   Button text
     * @param string $type    Bootstrap type (primary, success, danger, etc.)
     * @param string $method  GET|POST|DELETE
     * @return HtmlString
     */
    function en_de_crypt( $string, $action = 'e' ) {
        $secret_key = 'a1s3er1n5n7m3f3e45o5p9w3k2x3q32x';
        $secret_iv = 'a1snsd5nm3fssddsdgrkjlpdf9llkw22x';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
        return $output;
    }

    function get_added_fre_proj_wise($project_id='')
    {
        // 1. Get rows with project_wing_id = NULL or ''
        $assignments = DB::table('user_wing_assignments')
            ->where('project_id' , $project_id)
            // ->whereNull('project_wing_id')
            // ->orWhere('project_wing_id', '')
            ->get();

        $allUserIds = [];

        // 2. Collect user_ids (comma separated → explode)
        foreach ($assignments as $assignment) {
            $ids = explode(',', $assignment->user_id);
            $allUserIds = array_merge($allUserIds, $ids);
        }

        // 3. Remove duplicates & empty values
        $allUserIds = array_filter(array_unique($allUserIds));

        // 4. Fetch user details + emails
        $users = DB::table('users')
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->whereIn('users.id', $allUserIds)
            ->select('users.id', 'users.email', 'user_details.first_name', 'user_details.last_name')
            ->get()
            ->toArray();

        return $users;

    }
    
}
