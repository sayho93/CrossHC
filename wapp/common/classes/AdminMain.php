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
            LoginUtil::doAdminLogin($res);
            return $this->makeResultJson(1, "succ", $res);
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
            $sql = "SELECT * FROM tblAdmin WHERE adminNo = {$id} AND status = 1";
            return $this->getRow($sql);
        }

        function manageAdminAccount(){
            $id = $_REQUEST["id"];
            $name = $_REQUEST["adminName"];
            $phone = $_REQUEST["adminPhone"];
            $account = $_REQUEST["adminID"];
            $pwd = $_REQUEST["adminPwd"];

            if($id == ""){
                $sql = "
                    INSERT INTO tblAdmin(adminName, adminPhone, adminID, adminPwd, regDate)
                    VALUES(
                      {$name},
                      {$phone},
                      {$account},
                      {md5($pwd)},
                      NOW()
                    )
                ";
            }
            else{
                $sql = "
                    UPDATE tblAdmin 
                    SET
                      adminName = {$name},
                      adminPhone = {$phone},
                      adminID = {$account}
                    WHERE adminNo = {$id}
                ";

                if($pwd != ""){
                    $tmp = "UPDATE tblAdmin SET adminPwd = {md5($pwd)}";
                    $this->update($tmp);
                }
            }
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


    }
}