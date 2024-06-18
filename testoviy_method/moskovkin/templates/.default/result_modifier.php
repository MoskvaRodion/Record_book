<?
 if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
 $rsUser = CUser::GetByID($arParams["USER_ID"]);

 while($arUser = $rsUser->Fetch()){
     $arParam = $arUser;
 }
 
 $group = $arParam["UF_GROUP"];
 $short_name = explode("-", $group)[0];
 $arSelect = Array("NAME");
$arFilter = Array("IBLOCK_ID"=>6, "PROPERTY_SHORT_NAME"=>$short_name);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
if($ar_res = $res->GetNext())
{
    $arResult["GROUP_BIG_NAME"] = $ar_res["~NAME"];
}
?>