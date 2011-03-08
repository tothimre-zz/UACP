<?php
  session_start();

  require 'classes_for_the_example.php';
  $example = new example_03();
  $example->show();
  include 'logout/prelogout.tpl';
  echo $example->getMyAuthBox()->getLogoutUrl();
  include 'logout/postlogout.tpl';

?>