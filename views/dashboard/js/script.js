
$("#file-1").fileinput({
    uploadUrl: 'http://localhost/savelock/public/.uploads/uploads.php?file_name=' + Math.random().toString(36).substring(2),
    //    allowedFileTypes: "any",
    //    maxFileSize: "9999999999999",
    //    maxFilesNum: 20,
    //    'elErrorContainer': '#errorBlock',
    slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
    }
});


$(function () {
//    setPause();
//    function setPause() {
//        pause();
//    }
//   
    
    $("#post_form").submit(function (e) {
        e.preventDefault();
        var img = $("#post_form pre").text().replace("upload/", "");
        $.post("http://localhost/savelock/dashboard/save", {
            title: $("#title").val(), 
//            description: $("#description").val(), 
            img: img
        }, function (data) {
            $("#post_form .alert-success").fadeIn();
        });
    });
    $(".close").click(function () {
        $(this).parent().fadeOut();
    })
});



