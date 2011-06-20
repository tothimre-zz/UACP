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

namespace Uacp\Core\Globalhandlers;

/**
 * This is a reference implementation of the PhpSessionHandlerInterface it
 * works in the 99 percent of the cases so freely use it as the framework
 * uses it.
 * This class cannot be unittested, instead the PhpSessionHandlerInerface
 * is mocked for the tests
 *
 */
class PhpSessionHandler implements SessionHandlerInterface{

  /**
   * This function is a must have here because without this the program cannot garantee
   * the needed behaviour.
   */
  private function sessionCheck(){
    $sid=session_id();
    if(!$sid){
      if(!headers_sent()){
        session_start();
      }
      else{
        throw new Exception("If you would use the PHpSessionHandler in your Instance of AuthTemplate please start the php session before you send the headers!!");
      }
    }
  }
  public function setValue($index,$value){
    $this->sessionCheck();
    $_SESSION[$index]=$value;
  }

  public function getValue($index){
    $this->sessionCheck();
    if(isset($_SESSION[$index])){
      return $_SESSION[$index];
    }else{
      return null;
    }
  }
  /**
   * (non-PHPdoc)
   * @see core/templating/PhpSessionHandlerInerface#session_id()
   */
  public function session_id(){
    return session_id();
  }

  /**
   * (non-PHPdoc)
   * @see core/templating/PhpSessionHandlerInerface#session_start()
   */
  public function session_start(){
    session_start();
  }
}
?>
