<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 3:07
 */
?>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
    $obj = new AdminMain($_REQUEST);
    $info = $obj->appInfo();
    $item = $obj->stageDetail();
    $questionList = $obj->questionList();
?>
<script>
    $(document).ready(function(){
        $(".jManage").click(function(){
            var id = $(this).attr("id");
            location.href = "/admin/pages/answer.php?appId=<?=$info["id"]?>&stageId=<?=$_REQUEST["stageId"]?>&id=" + id;
        });

        $("[name=imgFile]").change(function(){
            readURL(this);
            $("#originalPath").val("");
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

        $("#jCheckAll").change(function(){
            if($(this).is(":checked"))
                $(".jQuestion").prop("checked", true);
            else
                $(".jQuestion").prop("checked", false);
        });

        $(".jAdd").click(function(){
            location.href = "/admin/pages/answer.php?appId=<?=$info["id"]?>&stageId=<?=$_REQUEST["id"]?>";
        });

        $(".jDel").click(function(){
            var noArr = new Array();
            var noCount = $(".jQuestion:checked").length;
            if(noCount == 0){
                alert("삭제할 항목을 하나 이상 선택해주세요.");
                return false;
            }
            if(confirm("삭제하시겠습니까?")){
                for(var i = 0; i < noCount; i++ ) noArr[i] = $(".jQuestion:checked:eq(" + i + ")").val();
                deleteQuestion(noArr);
            }
        });

        $(".jDelete").click(function(){
            var noArr = new Array();
            var id = $(this).attr("id");
            noArr[0] = id;
            deleteQuestion(noArr);
        });

        function deleteQuestion(noArr){
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.deleteQuestion", false, "json", new sehoMap().put("no", noArr));
            ajax.send(function(data){
                if(data.returnCode == 1){
                    alert("삭제되었습니다");
                    location.reload();
                }
            });
        }

        $(".jSubmit").click(function(){
            var ajax = new AjaxSubmit("/action_front.php?cmd=AdminMain.manageStage", "post", true, "json", "#form");
            ajax.send(function(data){
                if(data.returnCode === 1) location.href = "/admin/pages/stageList.php?appId=<?=$info["id"]?>";
                else alert("이미지 저장 실패");
            });
        });

        $(".jCancel").click(function(){
            history.back();
        });
    });
</script>

<!-- Nav -->
<nav id="menu">
    <ul class="links">
        <li><a href="appList.php">Application</a></li>
        <li><a href="recommend.php?appId=<?=$_REQUEST["appId"]?>">Recommendation</a></li>
        <li><a href="accountList.php">Account</a></li>
        <li><a class="jLogout">Logout</a></li>
    </ul>
</nav>


<!-- Highlights -->
<section class="wrapper">
    <div class="inner">

        <h2>스테이지 등록/수정</h2>
        <h3>앱 <?=$info["appName"]?> - 스테이지 <?=$item["stageDesc"]?></h3>
        <form method="post" id="form" action="#" enctype="multipart/form-data">
            <input type="hidden" name="appId" desc="앱 번호" value="<?=$_REQUEST["appId"]?>"/>
            <input type="hidden" name="id" desc="기본키" value="<?=$item["id"]?>"/>
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h5>스테이지명 - 관리용</h5>
                    <input type="text" name="stageDesc" id="stageDesc" value="<?=$item["stageDesc"]?>" placeholder="스테이지명 - 관리용" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>원본 이미지 - 게임화면 상단 표시</h5>

                    <span class="image fit"><img class="jImg" src="<?=$obj->fileShowPath . $item["originalPath"]?>" alt="" /></span>
                    <input type="text" name="originalPath" id="originalPath" value="<?=$item["originalPath"]?>" placeholder="이미지를 선택하세요" READONLY />
                    <br/>
                    <a class="button primary fit jFind small">
                        이미지 찾기/등록
                        <input type="file" class="" name="imgFile" style="opacity:0; position: absolute; left:0px; width:100%; " placeholder="이미지 찾기/등록"/>
                    </a>
                </div>
                <!-- Break -->
                <div class="col-12" >
                    <h5>스테이지 정답 관리</h5>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="jCheckAll">
                        <label for="jCheckAll">전체</label>
                        <a href="#" class="button primary small jAdd">항목 추가</a>
                        <a href="#" class="button small jDel">선택 항목 삭제</a>
                    </div>
                    <div class="highlights">
                        <?foreach($questionList as $questionItem){?>
                            <section>
                                <div class="content">
                                    <div class="col-6 col-12-small">
                                        <input type="checkbox" class="jQuestion" id="checkbox-alpha<?=$questionItem["id"]?>" value="<?=$questionItem["id"]?>">
                                        <label for="checkbox-alpha<?=$questionItem["id"]?>">선택</label>
                                    </div>
                                    <br/>
                                    <span class="image fit"><img src="<?=$obj->fileShowPath . $questionItem["imgPath"]?>" alt="" /></span>
                                    <div class="" appId="0">
                                        <a href="#" class="button primary small jManage" id="<?=$questionItem["id"]?>">관리</a>&nbsp;
                                        <a href="#" class="button small jDelete" id="<?=$questionItem["id"]?>">삭제</a>&nbsp;
                                        <!-- 이를 부모로 가진 tblAnswer 튜플도 삭제되어야 함 -->
                                        <br/><br/>Updated At <b><?=$questionItem["uptDate"]?></b>
                                    </div>
                                </div>
                            </section>
                        <?}?>
                    </div>

                </div>
                <!-- Break -->
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="button" value="등록/수정" class="primary jSubmit"/></li>
                        <li><input type="button" value="취소" class="jCancel"/></li>
                    </ul>
                </div>
            </div>
        </form>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>
