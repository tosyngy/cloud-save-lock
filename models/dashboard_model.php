<?php

class Dashboard_model extends Model {

    public function __construct() {
        Session::init();
        parent::__construct();
    }

    public function save($data) {
        $pix = explode("upload/", $data["img"]);
        $file = "";
        if ($pix[0] != "") {
            $file = "attached";
        }


        $param = array(
            'title' => $data["title"],
//            'content' => $this->mc_encrypt($data["description"]),
            'usr_id' => $this->user_id(Session::get("email")),
            'file' => $file,
            'save_date' => date("Y.m.d"),
            'save_time' => date("h:i:s"),
            'status' => "0",
        );
        $id = $this->db->insert("save", $param);

        foreach ($pix as $key => $value) {
            $this->savePix($id, $value, $this->user_id(Session::get("email")));
        }
    }

    public function savePix($id, $value, $user) {
        $name = "";
        for ($i = 0; $i < 30; $i++) {
            $key = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
            $name.= $key [array_rand($key)];
        }
        if (file_put_contents("picture/" . $name . "", "$value", FILE_USE_INCLUDE_PATH)) {
            $param = array(
                'name' => $name,
                'content_id' => $id,
                'comment' => "",
                'usr_id' => $user,
            );
            $id = $this->db->insert("attachment", $param);
        }
    }

    function getUserDetails() {
        $param = array(
            ':email' => $this->user_id(Session::get("email")),
        );
        $sql = $this->db->select("SELECT * FROM save WHERE usr_id=:email and status=0", $param);
        return $sql;
    }

    function attachments() {
        $param = array(
            ':email' => $this->user_id(Session::get("email")),
        );
        $sql = $this->db->select("SELECT * FROM attachment WHERE usr_id=:email and status=0", $param);
        return $sql;
    }

    function delete($whr, $id) {
        $param = array(
            'status' => "1",
        );
        if ($whr == "document") {
            $this->db->update("attachment", $param, "content_id=$id");
            $this->db->update("save", $param, "id=$id");
        } else {
            $this->db->update("attachment", $param, "id=$id");
        }
    }

    function user_id($data) {

        $param = array(
            ':email' => $data
        );
        $sql = $this->db->select("SELECT id FROM login WHERE (user_id=:email) limit 1", $param);
        return $sql[0]["id"];
    }

    function get_user() {
        $sql = $this->db->select("SELECT id,user_id,lock_code,user_type,status FROM login order by id desc ");
        return $sql;
    }

    function get_attachments() {
        $sql = $this->db->select("SELECT * FROM attachment WHERE status=0");
        return $sql;
    }

    function get_user_document() {
        $sql = $this->db->select("SELECT save.id,user_id,title,(select count(attachment.id) from attachment where save.id=attachment.content_id) as file_count,save_date,save_time,save.status FROM save,login where usr_id=login.id order by save.id desc");
        return $sql;
    }

    // Define a 32-byte (64 character) hexadecimal encryption key
// Note: The same encryption key used to encrypt the data must be used to decrypt the data
// Encrypt Function
    function mc_encrypt($encrypt) {
        $key = ENCRYPTION_KEY;
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt . $mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt) . '|' . base64_encode($iv);
        return $encoded;
    }

}
