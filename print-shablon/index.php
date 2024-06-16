<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Заявления");
global  $USER;


if($USER->isAuthorized()) {
    ?>
    <head>
        <link rel="stylesheet" href="style_form.css">
    </head>
    <section class="news _inner">
        <select  id="allSelects" class="allSelects form-control">
            <option value="none">Выберите шаблон</option>
            <option value="0">Заявление на замену пропуска</option>
            <option value="1">Заявление на замену студенческого билета</option>
            <option value="2">Заявление на замену зачетной книжки</option>
            <option value="3">Заявление на отчисление (по собственому желанию)</option>
            <option value="4">Заявление на академический отпуск (армия)</option>
            <option value="5">Заявление на академический отпуск (по здоровью)</option>
            <option value="6">Заявление на замену ФИО</option>
            <option value="7">Заявление на перевод на другую специальность/форму обучения</option>
            <option value="8">Заявление на отчисление (в связи с переходом)</option>
        </select>
        <div class="container">
            <div style="visibility: hidden;"></div>

            <form action="/print-shablon/output-data.php" class="form form-status"  method="POST" enctype="multipart/form-data"  style="display: none;"> 
                <label class="label-10" for="reason">Причина замены пропуска</label>
                <select name="reason" id="reason" class="form-control" selected="selected">
                    <option value="был утерян" selected="selected">Потерял</option>
                    <option value="не работает">Не работает</option>
                </select>
                <button  class="submit btn btn_main" type="submit" name="button" value="pass">Сформировать</button>
            </form>

            <form action="/print-shablon/output-data.php" class="form form-status"  method="POST" enctype="multipart/form-data"  style="display: none;">
                <button  class="submit btn btn_main" type="submit" name="button" value="duplicate-IDcard">Сформировать</button>
            </form>

            <form action="/print-shablon/output-data.php" class="form form-status"  method="POST" enctype="multipart/form-data"  style="display: none;">
                <button  class="submit btn btn_main" type="submit" name="button" value="duplicate-record-book">Сформировать</button>
            </form>

            <form action="/print-shablon/output-data.php" class="form form-status"  method="POST" enctype="multipart/form-data"  style="display: none;"> 
                <input class="form-control" type="text" name="reason" placeholder="причина отчисления" minlength="6" autofocus required>
                <label class="label-10" id="second_special">Вы обучаетесь на второй специальности одновременно?</label>
                <select  class="form-control" name="second_special" id="second_special">
                    <option value="Нет" selected="selected">Нет</option>
                    <option value="Да">Да</option>
                </select>
                <input type="number"  class="form-control" id="validAge" name="age" placeholder="Возраст" maxlength="2" required>
                <input type="text" class="form-control" id="address" name="register" placeholder="Адрес регистрации" disabled required>
                <label class="label-10" id="parent" >Законный представитель</label>
                <select name="parent" id="parent" class="form-control">
                    <option value="мать" selected="selected">Мать</option>
                    <option value="отец">Отец</option>
                    <option value="опеку">Опеку</option>
                    <option value="представитель по доверенности">Представитель по доверенности</option>
                </select>
                <input type="text" class="form-control" placeholder="Фамилия И.О. законного представителя" name="parent_name" required>
                <button type="submit"  class="submit btn btn_main" name="button" value="delete">Сформировать</button>
            </form>

            <form action="/print-shablon/output-data.php" class="form form-status"  method="POST" enctype="multipart/form-data"  style="display: none;">
                <label class="label-10" for="FROM">Начало отпуска</label>
                <input  class="form-control" name="FROM" type="date" required>
                <label class="label-10" for="TO">Окончание отпуска</label>
                <input class="form-control" name="TO" type="date" required>
                <span>Не забудьте приложить копию повестки военного комиссариата</span>
                <button  class="submit btn btn_main" type="submit" name="button" value="army">Сформировать</button>
            </form>

            <form action="/print-shablon/output-data.php" class="form form-status"  method="POST" enctype="multipart/form-data"  style="display: none;">
                <label class="label-10" for="FROM">Начало отпуска</label>
                <input  class="form-control" name="FROM" type="date" required>
                <label class="label-10" for="TO">Окончание отпуска</label>
                <input  class="form-control" name="TO" type="date" required>
                <span>Не забудьте приложить копию медицинской справки</span>
                <button  class="submit btn btn_main" type="submit" name="button" value="health">Сформировать</button>
            </form>

            <form action="/print-shablon/output-data.php" class="form form-status"  method="POST" enctype="multipart/form-data"  style="display: none;">
                <label class="label-10">Выбирите что изменяете</label>
                <select name="CHANGE"  class="form-control">
                    <option value="фамилию" selected="selected">Фамилия</option>
                    <option value="имя">Имя</option>
                    <option value="отчество">Отчество</option>
                </select>
                <input  class="form-control" type="text" name="AFTER" placeholder="ФИО полностью после изменения" required>
                <label class="label-10">Укажите причину замены ФИО</label>
                <select name="REASON" id=""  class="form-control">
                    <option value="вступлением в брак" selected="selected">Вступление в брак</option>
                    <option value="сменой имени">Смена имени</option>
                </select>
                <span>Не забудьте приложить копию этого документа</span>
                <button  class="submit btn btn_main" type="submit" name="button" value="change">Сформировать</button>
            </form>

            <form action="/print-shablon/output-data.php" class="form form-status"  method="POST" enctype="multipart/form-data" style="display: none;">
                <div>
                    <input type="radio" name="choice" value="spec" checked>
                    <label for="choice" if>Специальность</label>
                </div>
                <div>
                    <input type="radio"  name="choice" value="formLearning">
                    <label for="choice">Форма обучения</label>
                </div>
                <input type="text" class="form-control" name="ANOTHER_SPECIALTY" id="ANOTHER_SPECIALTY" placeholder="Специальность" required>
                <select name="FORM_OF_EDUCATION" class="form-control" id="FORM_OF_EDUCATION" style="display: none;">
                    <option value="Очная">Очная</option>
                    <option value="Заочная">Заочная</option>
                </select>
                <span>Не забудте приложить копию зачетной книжки</span>
                <button  class="submit btn btn_main" type="submit" name="button" value="translation-specialty">Сформировать</button>
            </form>

            <form action="/print-shablon/output-data.php" class="form form-status"  method="POST" enctype="multipart/form-data" style="display: none;">
                <label class="label-10" for="ORG">Наименование принимающей организации</label>
                <input type="text" class="form-control" name="ORG" required>
                <label class="label-10" id="parent" >Законный представитель</label>
                <select name="PARENT" id="parent" class="form-control">
                    <option value="мать" selected="selected">Мать</option>
                    <option value="отец">Отец</option>
                    <option value="опеку">Опеку</option>
                    <option value="представитель по доверенности">Представитель по доверенности</option>
                </select>
                <input type="text" class="form-control" placeholder="Фамилия И.О. законного представителя" name="parent_name" required>
                <span>Не забудте приложить справку о переводе</span>
                <button  class="submit btn btn_main" type="submit" name="button" value="transfer-to-another-college">Сформировать</button>
            </form>
        </div>
    </section>
    <script src="select.js"></script>
    <script src="transletionSpeciality.js"></script>
    <script>
        const validAge = document.querySelector('#validAge');
        const ADDRESS = document.querySelector('#address');
        
        validAge.addEventListener('change', () => {
            (validAge.value < 18) ? ADDRESS.disabled = false : ADDRESS.disabled = true
        })
    </script>
    <?

}   
else {
    LocalRedirect("/");
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>