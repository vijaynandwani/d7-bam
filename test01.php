<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Patrick
 * Date: 13/03/13
 * Time: 22:26
 * To change this template use File | Settings | File Templates.
 */

  $bar = 1;
  function foo($var){
    $var = 3;
    return $var;
  }
  $bar2 = foo($bar);
  echo " $bar <br />";
  echo " $bar2 <br />";
