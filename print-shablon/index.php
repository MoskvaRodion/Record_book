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
        <select name="" id="" class="form-control">
            <option value="">Заявление на замену пропуска</option>
            <option value="">Заявление на замену студенческого</option>
            <option value="">Заявление на замену зачетной книжки</option>
            <option value="">Заявление на отчисление</option>   
        </select>
        <div class="container">
            <!-- --------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data" > 
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
                <input type="text" class="form-control" placeholder="ФИО законного представителя полностью" name="parent_name" required>
                <button type="submit"  class="submit btn btn_main" name="button" value="delete">Сформировать</button>
            </form>
            <!-- ------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data"> 
                <label class="label-10" for="reason">Причина замены пропуска</label>
                <select name="reason" id="reason" class="form-control">
                    <option value="был утерян" selected="selected">Потерял</option>
                    <option value="не работает">Не работает</option>
                </select>
                <button  class="submit btn btn_main" type="submit" name="button" value="pass">Сформировать</button>
            </form>
            <!-- ---------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data">
                <button  class="submit btn btn_main" type="submit" name="button" value="duplicate-IDcard">Сформировать</button>
            </form>
            <!-- ---------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data">
                <button  class="submit btn btn_main" type="submit" name="button" value="duplicate-record-book">Сформировать</button>
            </form>
            <!-- ---------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data">
                <label class="label-10" for="FROM">Начало отпуска</label>
                <input  class="form-control" name="FROM" type="date">
                <label class="label-10" for="TO">Окончание отпуска</label>
                <input class="form-control" name="TO" type="date">
                <span>Не забудьте приложить копию повестки военного комиссариата</span>
                <button  class="submit btn btn_main" type="submit" name="button" value="army">Сформировать</button>
            </form>
            <!-- ---------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data">
                <label class="label-10" for="FROM">Начало отпуска</label>
                <input  class="form-control" name="FROM" type="date">
                <label class="label-10" for="TO">Окончание отпуска</label>
                <input  class="form-control" name="TO" type="date">
                <span>Не забудьте приложить копию медицинской справки</span>
                <button  class="submit btn btn_main" type="submit" name="button" value="health">Сформировать</button>
            </form>
             <!-- ---------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data">
                <label class="label-10">Выбирите что изменяете</label>
                <select  class="form-control">
                    <option value="Фамилия">Фамилия</option>
                    <option value="Имя">Имя</option>
                    <option value="Отчество">Отчество</option>
                </select>
                <input  class="form-control" type="text" name="AFTER" placeholder="ФИО полностью после изменения">
                <label class="label-10">Выбирите документ удостовряющий смену ФИО</label>
                <select name="DOCUMENT" id=""  class="form-control">
                    <option value="Свидетельство о браке">Свидетельство о браке</option>
                    <option value="Свидетельство о смене имени">Свидетельство о смене имени</option>
                </select>
                <span>Не забудьте приложить копию этого документа</span>
                <button  class="submit btn btn_main" type="submit" name="button" value="change">Сформировать</button>
            </form>
            <!-- ------------------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data">
                <div>
                    <input type="radio" name="choice" checked>
                    <label for="choice" if>Специальность</label>
                </div>
                <div>
                    <input type="radio" name="choice">
                    <label for="choice">Форма обучения</label>
                </div>
                <input type="text" name="ANOTHER_SPECIALTY" id="" placeholder="Специальность" >
                <select name="FORM_OF_EDUCATION" id="">
                    <option value="Очная">Очная</option>
                    <option value="Заочная">Заочная</option>
                </select>
                <span>Не забудте приложить копию зачетной книжки</span>
                <button  class="submit btn btn_main" type="submit" name="button" value="translation-specialty">Сформировать</button>
            </form>
            <!-- ------------------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data">
                <label class="label-10" for="ORG">Наименование принимающей организации</label>
                <input type="text" name="ORG" id="">
                <button  class="submit btn btn_main" type="submit" name="button" value="transfer-to-another-college">Сформировать</button>
            </form>
        </div>
    </section>
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