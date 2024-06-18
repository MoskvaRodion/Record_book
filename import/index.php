<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Загрузка ведомости");

?>	<? global $USER;
if($USER->isAuthorized() && in_array(1, $USER->GetUserGroupArray())){?>
<section class="news _inner">
    <div class="container">
        <div class="">
            <form class="import-form" action="/import/import.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" value="" accept=".xlsx" multiple><br><br>
                <button class="btn_save_file" type="submit">Выполнить</button>
            </form>
        </div>
    </div>
</section>
<style>
    
.btn_save_file {
  border: none;
  border-radius: 36px;
  background-color: #ccf5e0;
  border: 1px solid #ccc;
  cursor: pointer;
  padding: 4px 16px;
  max-width: 120px;

  &:hover {
    background-color: #16683f;
    color: #fff;
  }
  &:active {
    background: #00000088;
  }
}
.import-form {
  padding-bottom: 100px;
  margin-top: 20px;
}

.import-form select {
  padding: 10px;
  max-width: 100%;
}

</style>
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