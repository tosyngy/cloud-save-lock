    </div>
    </body>
        <style>
                .kv-fileinput-error, .kv-fileinput-caption{
                    display: none !important;
                }
               input:hover{
                   border: 1px solid #337ab7;
                }
               .textarea:hover{
                   border: 1px solid #337ab7;
                }
            </style>
    <script>

        $("#file-1").fileinput({
            uploadUrl: 'http://localhost/savelock/public/uploads/uploads.php', // you must set a valid URL here else you will get an error
//            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize: 1000,
            maxFilesNum: 10,
            //allowedFileTypes: ['image', 'video', 'flash'],
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });

        $(document).ready(function () {
            $("#test-upload").fileinput({
                'showPreview': false,
                'dropZoneTitle':"add attachment here ...",
                'elErrorContainer': '#errorBlock'
            });

        });
    </script>
</html>