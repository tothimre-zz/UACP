<?php
 /*Copyright 2010 Imre Toth <tothimre at gmail>

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
   */

/**
 * I don't really prefer constants, but it is a case where I defined them.
 * It is a really convinient way for the usert to set up the URL_OF_UACP
 * constant It is an url where your framework resides it is really
 * important for the captcha support, if you don't define it, the default value is
 * 'changeme' in this case if you use a capcha template the framework throws
 * exception.
 *
 * Example:
 * If you have a site on
 * http://www.xyz.com
 * and the directory where you publicated the site
 * for instance contains a directory called 'libs' and you place it's UACP
 * directory the framework, you should assign the
 * http://ww.xyz.com/libs/UACP/framework
 * to the URL_OF_UACPconstant.
 *
 */

//	define('URL_OF_UACP','http://localhost/UACP/framework/');
	define('URL_OF_UACP_CHANGEME','changeme');
        if(!isset($unittesting)) {
	  define('URL_OF_UACP',URL_OF_UACP_CHANGEME);
        } else {
          define('URL_OF_UACP','unittesting');
        }
