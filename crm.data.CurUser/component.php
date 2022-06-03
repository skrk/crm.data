<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

\Bitrix\Main\Loader::includeModule("crm");

if(!$arParams["ENTITY"]){ die(GetMessage("ENTITY_ERROR")); }
if(!$arParams["ROLE"]){ die(GetMessage("ROLE_ERROR")); }


$arParams["USER"] = $USER->GetID();

$arOrder = array(
    "DATE_CREATE" => "DESC"
);

if($arParams["ROLE"] == "ASSIGNED_BY"){
    $arFilter = array("ASSIGNED_BY_ID" => $arParams["USER"]);
}elseif($arParams["ROLE"] == "CREATED_BY"){
    $arFilter = array("CREATED_BY_ID" => $arParams["USER"]);
}

$arSelectFields = array();

$nPageTop = 50;

$arResult['ENTITY'] = array();

switch($arParams["ENTITY"]){
    case "LEAD":
        if($resLead = CCrmLead::GetList($arOrder, $arFilter, $arSelectFields, $nPageTop)){
            while($arLead = $resLead->GetNext()){
                $arLead['STATUS'] = CCrmLead::GetStatusNames()[$arLead['STATUS_ID']];
                $arLead['DETAIL'] = "/crm/lead/details/".$arLead['ID']."/";
                array_push($arResult['ENTITY'], $arLead);
            }
        }
        $arResult["TITLE"] = GetMessage("TITLE_LEAD");
        break;
    case "DEAL":
        if($resDeal = CCrmDeal::GetList($arOrder, $arFilter, $arSelectFields, $nPageTop)){
            while($arDeal = $resDeal->GetNext()){
                $arDeal['STATUS'] = CCrmDeal::GetStageName($arDeal['STAGE_ID']);
                $arDeal['DETAIL'] = "/crm/deal/details/".$arDeal['ID']."/";
                array_push($arResult['ENTITY'], $arDeal);
            }
        }
        $arResult["TITLE"] = GetMessage("TITLE_DEAL");
        break;
    case "INVOICE":
        if($arParams["ROLE"] == "ASSIGNED_BY"){
            $arFilter = array("RESPONSIBLE_ID" => $arParams["USER"]);
        }elseif($arParams["ROLE"] == "CREATED_BY"){
            $arFilter = array("CREATED_BY" => $arParams["USER"]);
        }
        if($resInvoice = CCrmInvoice::GetList($arOrder, $arFilter, false, array("nTopCount" => $nPageTop), $arSelectFields, array())){
            while($arInvoice = $resInvoice->GetNext()){
                $arInvoice['STATUS'] = CCrmInvoice::GetStatusList()[$arInvoice['STATUS_ID']]["NAME"];
                $arInvoice['DETAIL'] = "/crm/invoice/show/".$arInvoice['ID']."/";
                $arInvoice['TITLE'] = GetMessage("EL_TITLE_INVOICE").$arInvoice['ACCOUNT_NUMBER']." - ".$arInvoice['ORDER_TOPIC'];
                $arInvoice['ASSIGNED_BY_LAST_NAME'] = $arInvoice['RESPONSIBLE_LAST_NAME'];
                $arInvoice['ASSIGNED_BY_NAME'] = $arInvoice['RESPONSIBLE_NAME'];
                $arInvoice['DATE_CREATE'] = $arInvoice['DATE_INSERT'];
                array_push($arResult['ENTITY'], $arInvoice);
            }
        }
        $arResult["TITLE"] = GetMessage("TITLE_INVOICE");
        break;
    case "QUOTE":
    if($resQuote = CCrmQuote::GetList($arOrder, $arFilter, false, array("nTopCount" => $nPageTop), $arSelectFields, array())){
            while($arQuote = $resQuote->GetNext()){
                $arQuote['STATUS'] = CCrmQuote::GetStatuses()[$arQuote['STATUS_ID']]["NAME"];
                $arQuote['DETAIL'] = "/crm/type/7/details/".$arQuote['ID']."/";
                array_push($arResult['ENTITY'], $arQuote);
            }
        }
        $arResult["TITLE"] = GetMessage("TITLE_QUOTE");
        break;
    default:
        break;
}

$this->includeComponentTemplate();