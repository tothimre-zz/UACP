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

interface GlobalHandlerInterface{
  /**
   * This function stores values to the session
   *
   * @param mixed $index
   * The index of an array where you would store the value.
   *
   * @param mixed $value
   * The value you would to store to the given index.
   *
   * @return none
   */
  public function setValue($index,$value);

  /**
   * This function provides values stored in the session. If there is not
   * such an index it gives back null;
   *
   * @param mixed $index
   * @param mixed $value
   * @return mixed
   */

  public function getValue($index);

}