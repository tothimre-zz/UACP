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
 * This interface unifies the nterfaceAuthDataSource and the
 * InterfaceAuthProcess interfaces. It is one key for the system flexibility.
 * If the problem you want to solve dont'n fits to the Auth class
 * implementation it is not a problem. You should implement his interface
 * and make an instance of it.
 *
 */
interface  InterfaceAuth extends InterfaceAuthDataSource,InterfaceAuthProcess {
}
?>