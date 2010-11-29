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
 * This is just a little example how to implement the framework the most easily and get
 * a full featured authentication module.
 */

  /*
   * This lie is essential to get the session started, if you wish use
   * captcha support for the authentication process.
   */
  session_start();
  require 'classes_for_the_example.php';
  /*
   * Yes authentication can be done in such an easy way too.
   */
        include "page_elements/head.tpl";
  /*
   * Yes authentication can be done in such an easy way too.
   */
  $example = new example_02();
  $example->show();
  include "page_elements/footer.tpl";
?>