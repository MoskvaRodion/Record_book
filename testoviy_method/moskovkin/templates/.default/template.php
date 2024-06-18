<?

use function PHPSTORM_META\type;

 if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
 
$rsUser = CUser::GetByID($arParams["USER_ID"]);

while($arUser = $rsUser->Fetch()){
    $arParam = $arUser;
}

$group = $arParam["UF_GROUP"];
$student = $arParam["LAST_NAME"]." ". $arParam["NAME"]." ".$arParam["SECOND_NAME"];

/** 
*Вывод полной специальности
*@param string $group группа
*@return string возвращает полное название специальности 
*/
function nameSpecialnost($group){
  $dictSpec =  [
    "ИС" => "Информационные системы и программирование",
    "БАС" => "Обеспечение информационной безопасности автоматизированных систем",
    "САД" => "Сетевое и системное администрирование",
  ];
  $shortName = substr($group, 0, strpos($group, "-"));
  return $dictSpec[$shortName];
}

/** 
*Для изменения backgroung у оценки
*@param string $estimation оценка
*@return string возвращает название класса css 
*/
function colotEstimation($estimation){
  switch($estimation){
    case "5":
      return "fiveOrFour";
      break;
    case "4":
      return "fiveOrFour";
      break;
    case "3":
      return "three";
      break;
    case "2":
      return "two";
      break;
    default:
      return "";
  }
};
$arParamsTrans = array("replace_space"=>"-","replace_other"=>"-");
?>

<div class="main_content">
      <div class="main_content-left">
            <div class="main_content-leftInternal">
                <p class="main_content-leftInternal__group"><?= $group ?></p>
                <h1 class="main_content-leftInternal__title"><?= $student?></h1>
                <p class="main_content-leftInternal__profession-text"><?= $arResult["GROUP_BIG_NAME"] ?></p>
            </div>
        </div>
            <div class="main_content-right">
                <div class="main_content-rightInternal">
                    <select name="semester" id="select_semester" >
                        <option selected value="semesterAll">Все семестры</option>
                        <?foreach ($arResult["ITEMS"] as $arItem){?>
                          <option value="<?= Cutil::translit($arItem["NAME"],"ru",$arParamsTrans)?>"><?=$arItem['NAME'];?></option>
                        <?}?>
                    </select>
                    <div class="semestrs">
                    <?
        if (!empty($arResult["ITEMS"])){
            foreach($arResult["ITEMS"] as $arItem){?>
              <div class="semestr <?= Cutil::translit($arItem["NAME"],"ru",$arParamsTrans)?>">
                <div class="semester_name"><?=$arItem['NAME'];?></div>
                <table class="table-estimation">
                  <thead>
                    <tr>
                      <th scope="col">№</th>
                      <th scope="col">Дисциплина</th>
                      <th scope="col">Форма контроля</th>
                      <th scope="col">Оценка</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?foreach($arItem['~PROPERTY_COMPLEX_VALUE'] as $arSubGrade){?>
                        <tr>
                          <td></th>
                          <td><?=$arSubGrade['subject'];?></td>
                          <td><?=$arSubGrade['type'];?></td>
                          <td><span class="<?= colotEstimation($arSubGrade['estimation']); ?>"><?=$arSubGrade['estimation'];?></span></td>
                        </tr>
                    <?}?>
                    </tbody>
                </table>
              </div>
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
    <script>
      const SELECTS = document.getElementById("select_semester");
      const SEMESTRS = document.querySelectorAll(".semestrs .semestr");
      SELECTS.addEventListener("change", () => {
        if (SELECTS.value != "semesterAll"){
          SEMESTRS.forEach(el => {
            if (!el.classList.contains(SELECTS.value)){
              el.style.display = "none";
            }
            else {
              el.style.display = "block";
            }
          })
        }
        else {
          SEMESTRS.forEach(el => {
            if (!el.classList.contains(SELECTS.value)){
              el.style.display = "block";
            }
            
          })
        }
      });
  </script>
