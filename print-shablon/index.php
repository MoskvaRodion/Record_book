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
                <label for="reason">Причина замены пропуска</label>
                <select name="reason" id="reason" class="form-control">
                    <option value="был утерян" selected="selected">Потерял</option>
                    <option value="не работает">Не работает</option>
                </select>
                <button  class="submit btn btn_main" type="submit" name="button" value="pass">Сформировать</button>
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