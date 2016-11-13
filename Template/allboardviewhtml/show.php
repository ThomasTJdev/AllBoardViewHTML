

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Font awesome.. not needed for now -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">-->

<style>
.projectnameh2 {
    padding-left: 30px;
}

.cn {
    background: #fafafa;
    /*min-height: 300px; /* Okay if some columns get large? Or equal height? min-height: 300px; */
    /*max-height: 500px;*/
    height: 300px;
    overflow: auto;
    padding: 10px;
    border-radius: 2px;
    border: 1px solid #e5e5e5;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-top-width: 0px;
}
.cnM1 {
    margin-left: 5px;
    margin-right: 5px;
}
.cnM2 {
    margin-right: 5px;
}
.cnL {
    margin-left: 20px;
}
.cnR {
    margin-right: 20px;
}
.tn {
    border: #cac9c9 solid 0.5px;
    padding: 10px;
    border-radius: 3px;
    box-shadow: 0 1px 2px rgba(186, 186, 186, 0.55);
    background-color: #fff; /*whitesmoke;*/
    color: black;
    margin-bottom: 6px;
}
.hcn {
    padding-left: 10px;
    padding-bottom: 10px;
    padding-top: 10px;
    font-size: 15px;
    font-weight: 700;
    border: 1px solid #e5e5e5;
    background-color: #fafafa
}
.hcn1 {
    margin-left: 20px;
}
.hcn2{
    margin-left: 5px;
    margin-right: 5px;
}
.hcn3{
    margin-right: 5px;
}
.hcn4{
    margin-right: 20px;
}
.colorstatus{
    display: inline-block;
    float: right;
    width: 5px;
    height: 20px;
}

</style>


<?php
// If this is the project specific table render project-header
if ($project != 'Allprojects') {
?>
<?= $this->projectHeader->render($project, 'ProjectOverviewController', 'show') ?>
<?php
}
?>

<?php
$task = array();
$haystack = "Backlog Ready Work in progress Done"; // Either change according to your columns or delete if statement below. If you decide to delete, remember to add all your columns to the JS in the cols:[].
$dummy = "0";
$pn = "";
$cn1 = "";
$cn2 = "";
$cn3 = "";
$cn4 = "";
$cs = ""; // Color status for icon
$dd = "";
foreach($AllBoardViewHTMLData as $task){
    if (strpos($haystack, $task['column_name']) !== false) {
        // First run needs some date
        if ($dummy == "0") {
          $pn = $task['project_name'];
          //$cn = $task['column_name'];
          $dummy = "1"; // Don't run this again
        }
        // Projectname is changing - the print var to screen
        if ($pn !== $task['project_name']) {
            ?>

            <br><hr />
            <h2><a class="projectnameh2" href="/kanboard/?controller=BoardViewController&action=show&project_id=<?php print $task['project_id']; ?>"><?php print $pn; ?></a></h2>
            <div class="row">
              <div class="col-sm-4 col-md-3"><div class="hcn hcn1">Backlog</div></div>
              <div class="col-sm-4 col-md-3"><div class="hcn hcn2">Ready</div></div>
              <div class="col-sm-4 col-md-3"><div class="hcn hcn3">Work in progress</div></div>
              <div class="col-md-3"><div class="hcn4 hcn">Done</div></div>
            </div>
            <div class="row rowboard">
              <?php
              print '<div class="col-sm-4 col-md-3"><div class="cn cnL">' . $cn1 . '</div></div>';
              print '<div class="col-sm-4 col-md-3"><div class="cn cnM1">' . $cn2 . '</div></div>';
              print '<div class="col-sm-4 col-md-3"><div class="cn cnM2">' . $cn3 . '</div></div>';
              print '<div class="col-md-3"><div class="cn cnR">' . $cn4 . '</div></div>';
              ?>
            </div>
            <?php

            // Empty column vars
            $cn1 = "";
            $cn2 = "";
            $cn3 = "";
            $cn4 = "";

            // Make sure that var $pn has latest projectname
            $pn = $task['project_name'];
        }
        // Make task ready
        if ($task['is_active']) { // Only include active tasks

            if ($task['color_id'] != "0"){
                $cs = 'style="border: black 1px solid; border-radius: 30px; background-color:' . $task['color_id'] . ';"';
            }

            $dd = '
            <div class="tn"><a class="idlink" href="kanboard/?controller=TaskViewController&action=show&task_id=' . $task['project_id'] . '&project_id=' . $task['id'] . '"><b>' . $task['id'] . '</b></a>
            '. $task['title'] . '<div class="colorstatus" ' . $cs . '></div>
             <br/>';

            if ($task['date_due'] != '0' && !$task['date_due']){
                $dd .= '<span style="visibility:hidden;"><b>'.$task['id'].' </b></span><span class="duedate"><b>Due date:</b> ' . date("Y-m-d\ H:i   ", $task['date_due']) . '</span>';
            }


            $dd .= '</div>';

            if ($task['column_name'] == "Backlog") {
                $cn1 .= $dd;
            }
            if ($task['column_name'] == "Ready") {
                $cn2 .= $dd;
            }
            if ($task['column_name'] == "Work in progress") {
                $cn3 .= $dd;
            }
            if ($task['column_name'] == "Done") {
                $cn4 .= $dd;
            }

            $cs = ""; // Cleaning colorstatus
            $dd = "";



    } // If task is active end

    }
}
?>

<br>
<br>
