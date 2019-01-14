<?php
if ($this->attachment) {
    $attachment = $this->attachment;
}
if ($this->document) {
    $document = $this->document;
}
?>


</div>
<div style="margin-left: 210px;margin-top: 50px;text-align: center">           
    <div class="title bg-primary" style="padding: 5px; margin-top: 5px; text-align: center"><h1>Users' Information</h1></div>
    <table class="table-responsive  table-hover" style="margin: auto">
        <tr class="active" style="padding: 10px;font-size: 16px">
            <th class="col-xs-1" scope="row">S.N</th>
            <th class="col-xs-4">User_id</th>
            <th class="col-xs-2">Content Title</th>
            <th class="col-xs-2">File Attached</th>
            <th class="col-xs-1">Date</th>
            <th class="col-xs-1">Time</th>
            <th class="col-xs-1">status</th>
        </tr>
        <?php
        foreach ($document as $key => $value) {
            echo "<tr class='success'>";
            foreach ($value as $key => $data) {
                echo "<td>$data</td>";
            }
            echo '</tr>';
        }
        ?>

    </table>

</div> 

<style>
    table, td, th {
        border: 1px solid #337ab7;
    }
    th {
        text-align: left;
    }
    th {
        background-color: #337ab7;
        color: white;
    }
    td {
        padding: 15px;
    }
    td {
        height: 50px;
        vertical-align: bottom;
    }
    tr:hover + td {
        color: #eee;
    }
</style>
<script src="<?php echo URL; ?>public/js/jTable.js"></script>
<script>

    $(document).ready(function () {
        var table = $('table').DataTable();
    });
</script>