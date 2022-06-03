<?php

$arComponentDescription = array(
   "NAME" => GetMessage("COMP_NAME"),
   "DESCRIPTION" => GetMessage("COMP_DESCR"),
   "PATH" => array(
      "ID" => "skurko.crm.data",
      "NAME" => "Skurko",
      "CHILD" => array(
         "ID" => "curUserData",
         "NAME" => GetMessage("COMP_BRANCH_NAME"),
      )
   ),
   "CACHE_PATH" => "Y",
   "COMPLEX" => "N"
);