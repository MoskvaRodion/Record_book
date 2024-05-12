<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$rsUser = CUser::GetByID($arParams["USER_ID"]);

while($arUser = $rsUser->Fetch()){
    $arParam = $arUser;
}

$group = $arParam["UF_GROUP"];
$student = $arParam["LAST_NAME"]." ". $arParam["NAME"]." ".$arParam["SECOND_NAME"];

?>
<main>
      <div class="wrapper">
        <div class="main_content">
          <div class="main_content-left">
            <div class="main_content-leftInternal">
              <!-- <img
                src="img/logoUser.png"
                alt="User"
                class="main_content-leftInternal__img"
              /> -->
              <h1 class="main_content-leftInternal__title"><?=$student?></h1>
              <p class="main_content-leftInternal__group"><?=$group?></p>
              <div class="main_content-leftInternal__profession">
                <span>Специальность</span>
                <p class="main_content-leftInternal__profession-text">Информационные системы и програмирование</div>
              </div>
            </div>
            <div class="main_content-right">
                <div class="main_content-rightInternal">
                  <?
                
if (!empty($arResult)){
    foreach($arResult as $arItem){?>
      <div class="semestr"><?=$arItem['NAME'];?></div>
        <table class="table" width="867">
            <thead>
              <tr>
                <th scope="col">№</th>
                <th scope="col">Дисциплина</th>
                <th scope="col">Тип оценки</th>
                <th scope="col">Оценка</th>
                <th scope="col">Преподаватель</th>
              </tr>
            </thead>
            <tbody>
            <?foreach($arItem['~PROPERTY_COMPLEX_VALUE'] as $arSubGrade){?>
                <tr>
                  <td></th>
                  <td><?=$arSubGrade['subject'];?></td>
                  <td>Курсовая работа</td>
                  <td><span class="two"><?=$arSubGrade['estimation'];?></span></td>
                  <td>Гренадерова С. В.</td>
                </tr>
            <?}?>
            </tbody>
        </table>
    <?}
}
else {
    echo "Ничего не найдено";
}
?>
                </div>
              </div>
          </div>
        </div>
      </div>
    </main>