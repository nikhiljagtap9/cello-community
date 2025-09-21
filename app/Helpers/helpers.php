<?php

use Illuminate\Support\HtmlString;

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
    
}
