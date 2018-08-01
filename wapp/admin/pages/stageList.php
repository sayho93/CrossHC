<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 3:20
 */
?>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
    $obj = new AdminMain($_REQUEST);
    $list = $obj->stageList();

    $appId = $_REQUEST["appId"];
?>
<script>
    $(document).ready(function(){
        $(".jManage").click(function(){
            var id = $(this).attr("id");
            location.href = "/admin/pages/detailS.php?appId=<?=$appId?>&stageId=" + id;
        });

        //추첩앱 바로가기 기능
        $("#category").change(function(){
            var id = $("#category").val();
            location.href = "/admin/pages/detailS.php?appId=<?=$appId?>&stageId=" + id;
        });

        $(".jOrderUp").click(function(){
            var params = new sehoMap().put("type", 1).put("id", $(this).attr("id"));
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.changeStageOrder", false, "json", params);
            ajax.send(function(data){
                if(data.returnCode === 1) location.reload();
                else if(data.returnCode === -2) alert("이미 최상단에 위치해 있습니다");
            });
        });

        $(".jOrderDown").click(function(){
            var params = new sehoMap().put("type", -1).put("id", $(this).attr("id"));
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.changeStageOrder", false, "json", params);
            ajax.send(function(data){
                if(data.returnCode === 1) location.reload();
                else if(data.returnCode === -1) alert("이미 최하단에 위치해 있습니다");

            });
        });

        $("#jCheckAll").change(function(){
            if($(this).is(":checked"))
                $(".jStage").prop("checked", true);
            else
                $(".jStage").prop("checked", false);
        });

        $(".jAdd").click(function(){
            location.href = "/admin/pages/detailS.php?appId=<?=$appId?>";
        });

        $(".jDel").click(function(){
            var noArr = new Array();
            var noCount = $(".jStage:checked").length;
            if(noCount == 0){
                alert("삭제할 항목을 하나 이상 선택해주세요.");
                return false;
            }
            if(confirm("삭제하시겠습니까?")){
                for(var i = 0; i < noCount; i++ ) noArr[i] = $(".jStage:checked:eq(" + i + ")").val();
                deleteStage(noArr);
            }
        });

        function deleteStage(noArr){
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.deleteStage", false, "json", new sehoMap().put("no", noArr));
            ajax.send(function(data){
                if(data.returnCode == 1){
                    alert("삭제되었습니다");
                    location.reload();
                }
            });
        }
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
        <header class="special">
            <h2>STAGE LIST</h2>
            <h3>상위에서 선택한 앱 정보가 이곳에 표시됩니다.</h3>
            <p>관리할 스테이지를 선택하세요.</p>
        </header>

        <select name="category" id="category">
            <option value="">스테이지 바로가기</option>
            <?foreach($list as $item){?>
                <option value="<?=$item["id"]?>"><?=$item["stageDesc"]?></option>
            <?}?>
        </select>

        <br/>

        <div class="col-6 col-12-small">
            <ul class="alt">
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="jCheckAll">
                        <label for="jCheckAll">전체</label>
                        <a href="#" class="button primary small jDel">선택 항목 삭제</a>
                        <a href="#" class="button primary small jAdd">스테이지 추가</a>
                    </div>
                </li>
                <?$index = 0;?>
                <?foreach($list as $item){?>
                    <li>
                        <div class="col-6 col-12-small">
                            <input type="checkbox" class="jStage" id="checkbox-alpha<?=$item["id"]?>" value="<?=$item["id"]?>">
                            <label for="checkbox-alpha<?=$item["id"]?>">
                                <span class="badge badge-info"><?="(" . ++$index . ".) "?></span>
                                <?=$item["stageDesc"]?>
                            </label>
                        </div>
                        <a href="#" class="button primary small jManage" id="<?=$item["id"]?>">관리</a>&nbsp;
                        <a href="#" class="button small jOrderUp" id="<?=$item["id"]?>">▲</a>&nbsp;
                        <a href="#" class="button small jOrderDown" id="<?=$item["id"]?>">▼</a>&nbsp;
                        Updated At <b><?=$item["uptDate"]?></b>
                    </li>
                <?}?>

            </ul>
        </div>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>

