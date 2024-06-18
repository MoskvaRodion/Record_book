<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$rsUser = CUser::GetByID($arParams["USER_ID"]);

while($arUser = $rsUser->Fetch()){
    $arParam = $arUser;
}

$group = $arParam["UF_GROUP"];
$student = $arParam["LAST_NAME"]." ". $arParam["NAME"]." ".$arParam["SECOND_NAME"];


$arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"],'DEPTH_LEVEL' => 1, "NAME" => $group);
$rsSect = CIBlockSection::GetList(array('sort' => 'asc'),$arFilter);
if ($arSect = $rsSect->GetNext())
{
    $groupSect =  $arSect;
}


$arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"],'DEPTH_LEVEL' => 2, "NAME" => $student, "SECTION_ID"=>$groupSect["ID"]);
$rsSect = CIBlockSection::GetList(array('sort' => 'asc'),$arFilter);
if ($arSect = $rsSect->GetNext())
{
    $studentSect =  $arSect;
}


if ($studentSect){
    $arSelect = Array("ID", "NAME", "PROPERTY_COMPLEX");
    $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "IBLOCK_SECTION_ID" => $studentSect["ID"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($arRes = $res->GetNext())
    {
        $arResult["ITEMS"][] = $arRes;
    }

}
else {
    $arResult["ITEMS"]= [];
}

$this->IncludeComponentTemplate();
?>