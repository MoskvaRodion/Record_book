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

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('files/delete.docx');
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

    $templateProcessor->saveAs("files/v4.docx");

    header("Content-Disposition: attachment; filename=Отчисление_".$LAST_NAME.".docx");
    echo file_get_contents("files/v4.docx");
}
else if ($_POST["button"]=='pass'){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('files/pass.docx');
    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);
    $templateProcessor->setValue('REASON', $_POST["reason"]);
    $templateProcessor->setValue('NAME_STUDENT', $short_name);
    $templateProcessor->setValue('DATA', date('d.m.Y'));
    $templateProcessor->saveAs("files/v4.docx");
    header("Content-Disposition: attachment; filename=Замена_пропуска_".$LAST_NAME.".docx");
    echo file_get_contents("files/v4.docx");
}
elseif ($_POST["button"]=='duplicate-IDcard'){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('files/duplicate-student-ID-card.docx');
    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);

    $templateProcessor->setValue('NAME_STUDENT', $short_name);

    $templateProcessor->setValue('DATA', date('d.m.Y'));
    $templateProcessor->saveAs("files/v4.docx");

    header("Content-Disposition: attachment; filename=Дубликат_".$LAST_NAME.".docx");
    echo file_get_contents("files/v4.docx");
}
elseif ($_POST["button"]=='duplicate-record-book'){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('files/duplicate-record-book.docx');
    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);

    $templateProcessor->setValue('NAME_STUDENT', $short_name);

    $templateProcessor->setValue('DATA', date('d.m.Y'));
    $templateProcessor->saveAs("files/v4.docx");

    header("Content-Disposition: attachment; filename=Дубликат_".$LAST_NAME.".docx");
    echo file_get_contents("files/v4.docx");
}
elseif ($_POST["button"]=='army'){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('files/academic-leave-army.docx');
    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);

    $templateProcessor->setValue('FROM', $_POST["FROM"]);
    $templateProcessor->setValue('TO', $_POST["TO"]);

    $templateProcessor->setValue('NAME_STUDENT', $short_name);

    $templateProcessor->setValue('DATA', date('d.m.Y'));
    $templateProcessor->saveAs("files/v4.docx");

    header("Content-Disposition: attachment; filename=Академический_отпуск".$LAST_NAME.".docx");
    echo file_get_contents("files/v4.docx");
}
elseif ($_POST["button"]=='health'){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('files/academic-leave-health.docx');
    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);

    $templateProcessor->setValue('FROM', $_POST["FROM"]);
    $templateProcessor->setValue('TO', $_POST["TO"]);

    $templateProcessor->setValue('NAME_STUDENT', $short_name);

    $templateProcessor->setValue('DATA', date('d.m.Y'));
    $templateProcessor->saveAs("files/v4.docx");

    header("Content-Disposition: attachment; filename=Академический_отпуск".$LAST_NAME.".docx");
    echo file_get_contents("files/v4.docx");
}
elseif ($_POST["button"]=='change'){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('files/name-change.docx');
    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);

    $templateProcessor->setValue('BEFORE', $LAST_NAME . $NAME . $SECOND_NAME);
    $templateProcessor->setValue('AFTER', $_POST["AFTER"]);
    $templateProcessor->setValue('AFTER', $_POST["AFTER"]);

    $templateProcessor->setValue('DOCUMENT', $_POST["DOCUMENT"]);

    $templateProcessor->setValue('DATA', date('d.m.Y'));
    $templateProcessor->saveAs("files/v4.docx");

    header("Content-Disposition: attachment; filename=Смена_ФИО".$LAST_NAME.".docx");
    echo file_get_contents("files/v4.docx");
}
elseif ($_POST["button"]=='translation-specialty'){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('files/translation-specialty.docx');
    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);

    $templateProcessor->setValue('FORM_OF_EDUCATION', $_POST["FORM_OF_EDUCATION"]);
    $templateProcessor->setValue('ANOTHER_SPECIALTY', $_POST["ANOTHER_SPECIALTY"]);

    $templateProcessor->setValue('NAME_STUDENT', $short_name);
    $templateProcessor->setValue('DATA', date('d.m.Y'));
    $templateProcessor->saveAs("files/v4.docx");

    header("Content-Disposition: attachment; filename=Смена_специальности ".$LAST_NAME.".docx");
    echo file_get_contents("files/v4.docx");
}
else if ($_POST["button"]=='transfer-to-another-college'){
    $parent_name = explode(" ", $_POST["parent_name"]);
    $short_parent_name = $parent_name[0] ." ". mb_substr($parent_name[1], 0, 1).".".mb_substr($parent_name[2], 0, 1).".";

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('files/transfer-to-another-college.docx');

    $templateProcessor->setValue('GROUP', $arParam["UF_GROUP"]);
    $templateProcessor->setValue('LAST_NAME', $LAST_NAME);
    $templateProcessor->setValue('NAME', $NAME);
    $templateProcessor->setValue('SECOND_NAME', $SECOND_NAME);
    $templateProcessor->setValue('ORG', $_POST["ORG"]);

    $templateProcessor->setValue('NAME_STUDENT', $short_name);
    $templateProcessor->setValue('PARENT', $_POST["parent"]);
    $templateProcessor->setValue('NAME_PARENT', $short_parent_name);
    $templateProcessor->setValue('DATA', date('d.m.Y'));

    $templateProcessor->saveAs("files/v4.docx");

    header("Content-Disposition: attachment; filename=Отчисление_".$LAST_NAME.".docx");
    echo file_get_contents("files/v4.docx");
}


?>