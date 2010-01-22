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
 * This file includes the framework To your project
 */

include 'env_config.php';

include 'src/core/auth/InterfaceAuthDataSource.php';
include 'src/core/auth/InterfaceAuthProcess.php';
include 'src/core/auth/InterfaceAuth.php';
include 'src/core/auth/Auth.php';

include 'src/core/templating/Template.php';
include 'src/core/templating/TemplateLogin.php';
include 'src/core/templating/TemplateLoginCaptcha.php';
include 'src/core/templating/TemplateLogout.php';
include 'src/core/templating/AuthTemplate.php';

include 'src/ui/AuthBoxProto.php';
include 'src/ui/AuthBoxFromTemplateFiles.php';
include 'src/ui/AuthBoxSimple.php';

?>