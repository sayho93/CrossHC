<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminBase.php" ;?>
<?
/*
 * Web process
 * add by cho
 * */
if(!class_exists("AdminMain")){
    class AdminMain extends  AdminBase {
        function __construct($req)
        {
            parent::__construct($req);
        }

        function login(){
            $account = $_REQUEST["account"];
            $password = md5($_REQUEST["password"]);

            $sql = "
                SELECT * FROM tblAdmin
                WHERE adminId = '{$account}' AND adminPwd = '{$password}' AND status = 1
                LIMIT 1
            ";
            $res = $this->getRow($sql);
            if($res != ""){
                LoginUtil::doAdminLogin($res);
                return $this->makeResultJson(1, "succ", $res);
            }
            else{
                return $this->makeResultJson(-1, "fail");
            }

        }

        function logout(){
            LoginUtil::doAdminLogout();
            return $this->makeResultJson(1, "succ");
        }

        function adminList(){
            $sql = "
                SELECT * FROM tblAdmin
                WHERE status = 1
                ORDER BY regDate DESC
            ";

            return $this->getArray($sql);
        }

        function adminInfo(){
            $id = $_REQUEST["id"];
            $sql = "SELECT * FROM tblAdmin WHERE adminNo = '{$id}' AND status = 1";
            return $this->getRow($sql);
        }

        function manageAdminAccount(){
            $currentId = $this->admUser->adminNo;

            $id = $_REQUEST["id"];
            $name = $_REQUEST["adminName"];
            $phone = $_REQUEST["adminPhone"];
            $account = $_REQUEST["adminID"];
            $pwd = md5($_REQUEST["adminPwd"]);

            if($id == ""){
                $sql = "
                    INSERT INTO tblAdmin(adminName, adminPhone, adminID, adminPwd, regDate, status)
                    VALUES(
                      '{$name}',
                      '{$phone}',
                      '{$account}',
                      '{$pwd}',
                      NOW(),
                      1
                    )
                ";
            }
            else{
                $sql = "
                    UPDATE tblAdmin 
                    SET
                      adminName = '{$name}',
                      adminPhone = '{$phone}',
                      adminID = '{$account}'
                    WHERE adminNo = {$id}
                ";

                if($pwd != ""){
                    $tmp = "UPDATE tblAdmin SET adminPwd = '{$pwd}' WHERE adminNo = {$id}";
                    $this->update($tmp);
                }
            }
            $this->update($sql);

            if($currentId == $id){
                //조작한 정보가 현재 로그인 되어있는 계정일 시 쿠키 수정
                $sql = "SELECT * FROM tblAdmin WHERE adminNo = {$id}";
                LoginUtil::doAdminLogin($this->getRow($sql));
            }

            return $this->makeResultJson(1, "succ");
        }

        function deleteAdmin(){
            $noArr = $this->req["no"];

            $noStr = implode(',', $noArr);

            $sql = "
				UPDATE tblAdmin
				SET status = 0
				WHERE `adminNo` IN({$noStr})
			";
            $this->update($sql);

            return $this->makeResultJson(1, "succ");
        }

        function getAppList(){
            $sql = "
                SELECT * FROM tblApps
                ORDER BY regDate DESC
            ";

            return $this->getArray($sql);
        }

        function deleteApp(){
            $appId = $_REQUEST["appId"];
            $sql = "
                DELETE FROM tblApps WHERE id = {$appId}
            ";
            $this->update($sql);

            return $this->makeResultJson(1, "succ");
        }

        function manageApp(){
            $appName = $_REQUEST["appName"];
            $appDesc = $_REQUEST["appDesc"];

            $sql = "
                INSERT INTO tblApps(appName, appDesc, uptDate, regDate)
                VALUES(
                  '{$appName}',
                  '{$appDesc}',
                  NOW(),
                  NOW()
                )
            ";
            $this->update($sql);
            return $this->makeResultJson(1, "succ");
        }

        function recommendList(){
            $sql = "
                SELECT * FROM tblRecommend
                ORDER by `order` DESC
            ";

            return $this->getArray($sql);
        }

    }
}