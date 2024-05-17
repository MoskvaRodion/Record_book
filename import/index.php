<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Загрузка ведомости");

?>
	<? global $USER;
if($USER->isAuthorized() && in_array(1, $USER->GetUserGroupArray())){?>
<section class="news _inner">
    <div class="container">
        <div class="">
            <form class="import-form" action="/import/import.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" value="" accept=".xlsx" multiple><br><br>
                <button class="btn" type="submit">Выполнить</button>
            </form>
        </div>
    </div>
</section>
<script>
    function IsJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
    
    $(document).ready(function(){
        $(document).on('submit', '.import-form', function(e){
            e.preventDefault();
            var form = $(this)[0];
            var formData = new FormData(form);
            alert('Началась обработка');
            $.ajax({
                url: '/import/import.php',
                data: formData,
                type: 'POST',
                contentType: false,
                processData: false,
                complete: function(data){
                    if(IsJsonString(data.responseText)){
                        var json = JSON.parse(data.responseText);
                        if(json.success){
                            alert(json.message);
                        }else{
                            alert(json.error);
                        }
                    }else{
                        alert('Завершено(возможно продолжается в фоне)');
                    }
                    
                }
            });
        });
    })
</script>
<?} else {
	$APPLICATION->SetTitle("Ошибка 404");
    CHTTP::SetStatus("404 Not Found");
    if (!defined("ERROR_404"))
        define("ERROR_404", "Y");
} ?>
	<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>