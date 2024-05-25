<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
global  $USER;

$rsUser = CUser::GetByID($USER->GetId());
while($arUser = $rsUser->Fetch()){
    $arParam = $arUser;
}

$group = $arParam["UF_GROUP"];
$LAST_NAME = $arParam["LAST_NAME"];
$NAME = $arParam["NAME"];
$SECOND_NAME = $arParam["SECOND_NAME"];
$short_name = $LAST_NAME ." ". mb_substr($NAME, 0, 1).".".mb_substr($SECOND_NAME, 0, 1).".";

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

if ($_POST["button"]=="delete"){
    $parent_name = explode(" ", $_POST["parent_name"]);
    $short_parent_name = $parent_name[0] ." ". mb_substr($parent_name[1], 0, 1).".".mb_substr($parent_name[2], 0, 1).".";

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('delete.docx');
    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);
    $templateProcessor->setValue('REASON', $_POST["reason"]);
    $templateProcessor->setValue('SECONS_SPECIAL', $_POST["second_special"]);
    $templateProcessor->setValue('AGE', $_POST["age"]);
    $templateProcessor->setValue('REGISTER', $_POST["register"]);

    $templateProcessor->setValue('NAME_STUDENT', $short_name);
    $templateProcessor->setValue('PARENT', $_POST["parent"]);
    $templateProcessor->setValue('NAME_PARENT', $short_parent_name);
    $templateProcessor->setValue('DATA', date('d.m.Y'));

    $templateProcessor->saveAs("v4.docx");

    header("Content-Disposition: attachment; filename=Отчисление_".$LAST_NAME.".docx");
    echo file_get_contents("v4.docx");
}
else if ($_POST["button"]=='pass'){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('pass.docx');
    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);
    $templateProcessor->setValue('REASON', $_POST["reason"]);
    $templateProcessor->setValue('NAME_STUDENT', $short_name);
    $templateProcessor->setValue('DATA', date('d.m.Y'));
    $templateProcessor->saveAs("v4.docx");
    header("Content-Disposition: attachment; filename=Замена_пропуска_".$LAST_NAME.".docx");
    echo file_get_contents("v4.docx");
}


?>