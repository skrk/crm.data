<?php

\Bitrix\Main\Loader::includeModule("crm");

$arParams["USER"] = $USER->GetID();

$arOrder = array(
    "DATE_CREATE" => "DESC"
);

$arFilter = array(
    "ASSIGNED_BY_ID" => $arParams["USER"]
);

$arSelectFields = array();

$nPageTop = 50;

$arResult['LEADS'] = array();

if($resLead = CCrmLead::GetList($arOrder, $arFilter, $arSelectFields, $nPageTop)){
    while($arLead = $resLead->GetNext()){
        $arLead['STATUS'] = CCrmLead::GetStatusNames()[$arLead['STATUS_ID']];
        array_push($arResult['LEADS'], $arLead);
        
    }   
}
$arResult["TITLE"] = GetMessage("TITLE");

$this->includeComponentTemplate();