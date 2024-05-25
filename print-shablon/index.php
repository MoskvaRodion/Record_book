<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Зачетная книжка");

global  $USER;
if($USER->isAuthorized()) {
    
    
    ?>
    <section class="news _inner">
        <select name="" id="">
            <option value="">Заявление на замену пропуска</option>
            <option value="">Заявление на замену студенческого</option>
            <option value="">Заявление на замену зачетной книжки</option>
            <option value="">Заявление на отчисление</option>
        </select>
        <div class="container">
            <!-- --------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data"> 
                <input class="form-control" type="text" name="reason" placeholder="причина отчисления" autofocus>
                <label id="second_special">обучаетесь на второй специальности одновременно</label>
                <select  class="form-control" name="second_special" id="second_special">
                    <option value="Нет" selected="selected">НЕТ</option>
                    <option value="Да">ДА</option>
                </select>
                <input type="number" name="age" placeholder="Возраст">
                <input type="text" name="register" placeholder="Адрес регистрации">
                <label id="parent">Законный представитель</label>
                <select name="parent" id="parent">
                    <option value="мать" selected="selected">мать</option>
                    <option value="отец">отец</option>
                    <option value="опеку">опеку</option>
                    <option value="представитель по доверенности">представитель по доверенности</option>
                </select>
                <input type="text" placeholder="Имя законного представителя" name="parent_name">
                <button type="submit" name="button" value="delete">Сформировать</button>
            </form>
            <!-- ------- -->
            <form action="/print-shablon/output-data.php" class="form"  method="POST" enctype="multipart/form-data"> 
                <label for="reason">Причина замены пропуска</label>
                <select name="reason" id="reason">
                    <option value="был утерян" selected="selected">Потерял</option>
                    <option value="не работает">Не работает</option>
                </select>
                <button type="submit" name="button" value="pass">Сформировать</button>
            </form>
        </div>
    </section>
    <style>
    form {
        display: flex;
        flex-direction: column;
        
    }
    <?
}   
else {
    LocalRedirect("/");
}




require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>