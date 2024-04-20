<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)){
    foreach($arResult as $arItem){?>
        <div class="semestr"><?=$arItem['NAME'];?></div>
        <table class="semestr-table">
            <thead>
            <tr>
                <th>
                    Предмет
                </th>
                <th>
                    Оценка
                </th>
            </tr>
            </thead>
            <tbody>
            <?foreach($arItem['~PROPERTY_COMPLEX_VALUE'] as $arSubGrade){?>
                <tr>
                    <td><?=$arSubGrade['subject'];?></td>
                    <td><?=$arSubGrade['estimation'];?></td>
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