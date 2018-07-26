<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 3:05
 */
?>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
    $obj = new AdminMain($_REQUEST);
    $info = $obj->appInfo();
    $item = $obj->recommendDetail();
?>

<script>
    $(document).ready(function(){
        $(".jAdd").click(function(){
            var ajax = new AjaxSubmit("/action_front.php?cmd=AdminMain.manageRecommend", "post", true, "json", "#form");
            ajax.send(function(data){
                if(data.returnCode === 1) location.href = "/admin/pages/recommend.php?appId=<?=$info["id"]?>";
                else alert("이미지 저장 실패");
            });
        });

        $(".jCancel").click(function(){
            history.back();
        });

        $("[name=exposure]").change(function(){
            var checked = $(this).prop("checked");
            if(checked) $(this).val(1);
            else $(this).val(0);
        });

        $("[name=imgFile]").change(function(){
            readURL(this);
            $("#imgPath").val("");
        });

        function readURL(input){
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $(".jImg").attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>


<!-- Nav -->
<nav id="menu">
    <ul class="links">
        <li><a href="appList.php">Application</a></li>
        <li><a href="recommend.php">Recommendation</a></li>
        <li><a href="accountList.php">Account</a></li>
        <li><a class="jLogout">Logout</a></li>
    </ul>
</nav>


<!-- Highlights -->
<section class="wrapper">
    <div class="inner">

        <h2>추천 앱 등록/수정</h2>
        <h3>앱 <?=$info["appName"]?> - 추천 앱 <?=$item["appName"]?></h3> <!-- 수정모드일 경우 -->
        <form method="post" id="form" action="#" enctype="multipart/form-data">
            <input type="hidden" name="appId" desc="앱 번호" value="<?=$_REQUEST["appId"]?>"/>
            <input type="hidden" name="id" desc="기본키" value="<?=$item["id"]?>"/>
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h5>앱 제목</h5>
                    <input type="text" name="appName" id="name" value="<?=$item["appName"]?>" placeholder="앱 제목" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>앱 설명</h5>
                    <input type="text" name="appDesc" id="appDesc" value="<?=$item["appDesc"]?>" placeholder="앱 설명" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>앱 패키지명</h5>
                    <input type="text" name="packageName" id="packageName" value="<?=$item["packageName"]?>" placeholder="앱 패키지명" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>썸네일 이미지</h5>
                    <span class="image fit"><img class="jImg" src="<?=$obj->fileShowPath . $item["imgPath"]?>" alt="" /></span>
                    <input type="text" name="imgPath" id="imgPath" value="<?=$item["imgPath"]?>" placeholder="썸네일 이미지를 선택하세요" READONLY />
                    <br/>

                    <a class="button primary fit jFind small">
                        이미지 찾기/등록
                        <input type="file" class="" name="imgFile" style="opacity:0; position: absolute; left:0px; width:100%; " placeholder="이미지 찾기/등록"/>
                    </a>

                </div>
                <div class="col-6 col-12-small">
                    <input type="checkbox" name="exposure" id="checkbox-alpha" <?=$item["exposure"] == "1" ? "checked" : ""?> value="<?=$item["exposure"]?>">
                    <label for="checkbox-alpha">앱 리스트 내 노출 여부</label>
                </div>
                <!-- Break -->
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="button" class="jAdd" value="등록/수정" class="primary" /></li>
                        <li><input type="button" class="jCancel" value="취소" /></li>
                    </ul>
                </div>
            </div>
        </form>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>


