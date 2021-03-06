<?php

/**
* Copyright (C) 2021 Edgio Inc. All Rights Reserved.
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*     http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/

/**
 * This example shows how to cache the output of ectoke_generate
 * for expiring tokens, using memcached.
 * This can be used to mitigate the impact of token generation, as a given token
 * should only be generated once. Memcache handles the expiration of tokens in cache.
 *
 */


$key        = "12345678";
$expires    = "1185943200";
$params     = "ec_secure=1&ec_expire=" . $expires . "&ec_clientip=111.11.111.11&ec_country_allow=US&ec_ref_allow=ec1.com";

// Concatenate the key and plaintext to use as a key for memcache
$mc_key = $key . ':' . $params;

if (extension_loaded('memcache')){
    // Connect to our local memcached
    $memcache   = memcache_connect('localhost', 11211);

    if ($token = $memcache->get($mc_key) != false){
        // It exists in memcache, so we can use it.
        break;
    } else {
        // Check to see if the extension properly loaded before using it.
        if (extension_loaded('ectoken')){
            // Generate the token
            $token = ectoken_encrypt_token($key, $params);
            // Insert the token into the cache, with the correct expiration
            // $expires is a date, as seconds since unix epoch, in the GMT timezone
            // memcached needs that converted to the local time zone.
            $memcache->set($mc_key, $token, date(intval($expires), 'U') );
        } else {
            trigger_error('The Edgio Token module could not be loaded.', E_USER_ERROR);
        }
    }
} else {
    trigger_error('The memcache module could not be loaded.', E_USER_ERROR);
}


echo $token;

?>
