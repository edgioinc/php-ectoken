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

#ifndef PHP_ECTOKEN_H
#define PHP_ECTOKEN_H 1

#define PHP_ECTOKEN_VERSION "3.0"
#define PHP_ECTOKEN_EXTNAME "ectoken"

// v3
PHP_FUNCTION(ectoken_init);
PHP_FUNCTION(ectoken_decrypt_token);
PHP_FUNCTION(ectoken_encrypt_token);

extern zend_module_entry ectoken_module_entry;
#define phpext_ectoken_ptr &ectoken_module_entry

#endif
