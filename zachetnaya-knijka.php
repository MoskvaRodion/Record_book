<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Зачетная книжка");
?>
<?

global $USER;
if($USER->IsAuthorized()){

    $APPLICATION->IncludeComponent("testoviy_method:moskovkin", "", array(
        "IBLOCK_ID"=>11,
        "USER_ID"=>$USER->GetId(),
    ),
        false
    );
}
else {
    LocalRedirect("/");
}
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>