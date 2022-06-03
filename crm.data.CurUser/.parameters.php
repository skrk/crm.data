<?php

$arEntityType = array(
   "LEAD" => "Лид",
   "DEAL" => "Сделка",
   "INVOICE" => "Счет",
   "QUOTE" => "Предложение"
);

$arRoles = array(
   "CREATED_BY" => "Создатель",
   "ASSIGNED_BY" => "Ответственный"
);

$arComponentParameters = array(
   "GROUPS" => array(),
   "PARAMETERS" => array(
      "ENTITY" => array(
         "PARENT" => "BASE",
         "NAME" => GetMessage("ENTITY"),
         "TYPE" => "LIST",
         "VALUES" => $arEntityType,
         "REFRESH" => "N"
      ),
      "ROLE" => array(
         "PARENT" => "BASE",
         "NAME" => GetMessage("ROLE"),
         "TYPE" => "LIST",
         "VALUES" => $arRoles,
         "REFRESH" => "N"
      )
   )
);