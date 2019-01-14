<?php
Session::init();
if (isset($this->details)) {
    $detail = $this->details;
}
if (isset($this->attachment)) {
    $attached = $this->attachment;
}
?>


<section id="main-content" style="margin-left: 210px;">
    <section class="wrapper">

        <div class="classes_cont">
            <?php foreach ($detail as $key => $value) { ?>
                <div class="class_category_section">
                    <div class="class_category_header"><?php echo $value["title"]; ?>
                    </div>
                    <div class="col-md-12 col-sm-12 " style="padding: 0;margin: auto">
                        <!--<div class="class_item" content_id="<?php echo $value["id"]; ?>" style="height: auto"><?php echo mc_decrypt($value["content"]); ?></div>-->
                    </div>
    <!--                    <span class="fa fa-attachment label"> attachment : </span>-->
                    <?php
                    foreach ($attached as $key1 => $value1) {
                        if ($value1["content_id"] == $value["id"]) {
                            ?>
                            <div class="col-md-3 col-sm-6 ">
                                <div class="class_item" attach_id="<?php echo $value1["id"]; ?>" style="height: 160px;padding: 1px;overflow: hidden">
                                    <i class="fa fa-save"> document: <?php echo $key1 + 1; ?></i>
                                    <?php
                                    $data = file_get_contents(URL . "picture/" . $value1["name"]);
                                    if (strpos($data, "end") > -1) {
                                        $data = explode("data", $data);
                                        $data = $data[1];
                                        $data = explode("end", $data);
                                        $data = $data[0];
                                        $data = "data" . $data . "end";
                                    }

                                    $data2 = file_get_contents(URL . "public/.uploads/" . $data);
                                    $address = URL . "public/.uploads/$data";
                                    ?>

                                    <object data="<?php echo $address; ?>"  width="100%" height="100%" style="overflow: hidden">
                                        <p><a href="<?php echo URL . "public/.uploads/" . $data ?>"></a></p>
                                    </object>

                                </div>
                                <div class="file-actions" style="  margin-top: 0; background-color: rgba(255,255,255,0.7);margin-left: 10px;">
                                    <div class="file-footer-buttons">
            <!--                                        <button type="button" class="kv-file-upload btn btn-xs btn-default" title="Upload file">   <i class="glyphicon glyphicon-upload text-info"></i>
                                        </button>-->
                                        <div class="kv-file-remove btn btn-xs btn-default" title="Delete file"><a href="<?php echo "http://localhost/savelock/dashboard/delete/file"; ?>"  file_id="<?php echo $value1["id"]; ?>" class="delete"  ><i class="glyphicon glyphicon-trash text-danger"></a></i></div>
                                    </div>
                                    <div class="file-upload-indicator" title="Download File"><a href="<?php echo URL . "public/.uploads/" . $data ?>" target="__blank" class="download"><i class="glyphicon glyphicon-hand-down text-warning"></i></a></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    ?>
                    <div class="clearfix"></div>
                    <!--                    <button type='button' class='btn-lg btn-success col-sm-12' > View</button>-->
                    <div class="file-actions" style=" background-color: rgba(255,255,255,0.7);margin-left: 10px; padding: 20px;">
                        <div class="file-footer-buttons">
    <!--                                        <button type="button" class="kv-file-upload btn btn-xs btn-default" title="Upload file">   <i class="glyphicon glyphicon-upload text-info"></i>
                            </button>-->
                            <div class="kv-file-remove btn btn-xs btn-default" title="Delete Document"><a  file_id="<?php echo $value["id"]; ?>" class="delete" href="<?php echo "http://localhost/savelock/dashboard/delete/document"; ?>"><i class="glyphicon glyphicon-trash text-danger"></i></a></div>
                        </div>
                        <div class="file-upload-indicator" title="Download Document"><a href="<?php echo URL . "public/.uploads/" . $data ?>" target="__blank" class="download"><i class="glyphicon glyphicon-hand-down text-warning"></i></a></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php } ?>

            <div class="information_display">
                <div class="exit_info_display">  <i class="fa fa-2x fa-angle-left"></i></div>
                <div id="info_content_disp" class="content">

                </div>
            </div>        
        </div>
    </section>
</section>
<bbbb id="bbbb" aaaa="<?php echo Session::get("code") ?>"style="display: none" />
<script>
    var i=0;
    $(function () {
        $(document).on("click", "a.delete", function (e) {
            e.preventDefault();
            var th = $(this);
            var hr = $(this).attr("href");
            var id = $(this).attr("file_id");
            i++;
            var b=$(this).attr("href")
            e.preventDefault();  
            var a= prompt("Enter your lock password");
            if(a===$("#bbbb").attr("aaaa")){
                i=0;
                $.post(hr + "/" + id, function () {
                    var p = $(th).parent().parent().parent().parent();
                    $(p).fadeIn(function () {
                        $(p).remove();
                    })
                });
            }else{
                if(i>=3){
                    $(location).attr("href","http://localhost/savelock/index/logout");
                }  
            }
            
            
        });
        $(document).on("click",".download",function(e){
            i++;
            var b=$(this).attr("href")
            e.preventDefault();  
            var a= prompt("Enter your lock password");
            if(a===$("#bbbb").attr("aaaa")){
                i=0;
                $(location).attr("href",b);
            }else{
                if(i>=3){
                    $(location).attr("href","http://localhost/savelock/index/logout");
                }  
            }
        })
    })
</script>

<?php

// Decrypt Function
function mc_decrypt($decrypt) {

    $key = ENCRYPTION_KEY;
    $decrypt = explode('|', $decrypt);
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    $key = pack('H*', $key);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decrypted, -64);
    $decrypted = substr($decrypted, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
    if ($calcmac !== $mac) {
        return false;
    }
    $decrypted = unserialize($decrypted);
    return $decrypted;
}
?>