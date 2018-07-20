<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 2:37
 */
?>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
    $obj = new AdminMain($_REQUEST);

    $list = $obj->adminList();
    $cnt = sizeof($list);
?>
<script>
    $(document).ready(function(){
        $(".jLogout").click(function(){
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.logout", false, "json", new sehoMap());
            ajax.send(function(data){
                if(data.returnCode === 1){
                    location.href = "/admin";
                }
            });
        });

        $(".jManage").click(function(){
            var id = $(this).attr("id");
            location.href = "/admin/pages/detailA.php?id=" + id;
        });

        $("#jCheckAll").change(function(){
            if($(this).is(":checked"))
                $(".jUserNo").prop("checked", true);
            else
                $(".jUserNo").prop("checked", false);
        });

        $(".jDel").click(function(){
            var noArr = new Array();
            var noCount = $(".jUserNo:checked").length;
            if(noCount == 0){
                alert("삭제할 사용자를 하나 이상 선택해주세요.");
                return false;
            }
            if(noCount == "<?=$cnt?>"){
                alert("전체 사용자를 삭제할 수 없습니다");
                return false;
            }
            if(confirm("삭제하시겠습니까?")){
                for(var i = 0; i < noCount; i++ ) noArr[i] = $(".jUserNo:checked:eq(" + i + ")").val();
                deleteUser(noArr);
            }
        });

        function deleteUser(noArr){
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.deleteAdmin", false, "json", new sehoMap().put("no", noArr));
            ajax.send(function(data){
                if(data.returnCode == 1){
                    if(noArr.includes("<?=$obj->admUser->adminNo?>")){
                        alert("현재 로그인 되어있는 관리자 계정이 삭제되어 로그아웃 됩니다.");
                        $(".jLogout").trigger("click");
                        return;
                    }
                    alert("삭제되었습니다");
                    location.reload();
                }
            });
        }

        $(".jAdd").click(function(){
            location.href = "/admin/pages/detailA.php";
        });
    });
</script>

<!-- Nav -->
<nav id="menu">
    <ul class="links">
        <li><a href="appList.php">Application</a></li>
        <li><a href="accountList.php">Account</a></li>
        <li><a class="jLogout">Logout</a></li>
    </ul>
</nav>


<!-- Highlights -->
<section class="wrapper">
    <div class="inner">
        <header class="special">
            <h2>ACCOUNT LIST</h2>
            <p>관리할 관리자 계정를 선택하세요.</p>
        </header>
        <br/>

        <div class="col-6 col-12-small">
            <ul class="alt">
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="jCheckAll">

<!--                        <input type="checkbox" class="jUserNo" value="--><?//=$row["id"]?><!--"-->
                        <label for="jCheckAll">전체</label>
                        <a href="#" class="button primary small jDel">선택 항목 삭제</a>
                        <a href="#" class="button primary small jAdd">관리자 추가</a>
                        <!-- 전체 삭제되면 로그인이 불가하므로 고려 요망 -->
                    </div>
                </li>

                <?foreach($list as $item){?>
                    <li>
                        <div class="col-6 col-12-small">
                            <input type="checkbox" class="jUserNo" id="checkbox-alpha<?=$item["adminNo"]?>" value="<?=$item["adminNo"]?>">
                            <label for="checkbox-alpha<?=$item["adminNo"]?>"><?=$item["adminID"]?></label>
                        </div>
                        <a href="#" class="button primary small jManage" id="<?=$item["adminNo"]?>">관리</a>&nbsp;
                        등록일자 <b><?=$item["regDate"]?></b>
                    </li>
                <?}?>
            </ul>
        </div>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>
