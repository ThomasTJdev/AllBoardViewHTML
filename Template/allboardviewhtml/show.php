

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Font awesome.. not needed for now -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">-->

<?php
// SETTINGS
$MAXHEIGHT = "600px";
$MINHEIGHT = "300px";

/*
DO YOU NEED OTHER COLUMNS THAN:
- Backlog
- Ready
- Work in progress
- Done
Look for "//CHANGE" in the code below.

"Just 4 others, but with other name":
Find comment //CHANGE1 (haystack checker - include WHOLE name)
Find comment //CHANGE2 (just the headings for printing)
Find comment //CHANGE3 (just the if condition to match the heading)

"Ohh I want more, 5 columns, 10 columns!"
Create loop for //CHANGE1-3 AND //CHANGE4

*/
 ?>

<style>
/* PROJECT NAME OVER EACH BOARD (ALSO A LINK) */
.projectnameh2 {
    padding-left: 30px;
}
/* -- STYLING OF TASKS --*/
/* MAIN TASK HOLDER */
.tn {
    border: #cac9c9 solid 0.5px;
    padding: 10px;
    border-radius: 3px;
    box-shadow: 0 1px 2px rgba(186, 186, 186, 0.55);
    background-color: #fff; /*whitesmoke;*/
    color: black;
    margin-bottom: 6px;
}
/* TASK TITLE */
.idlink{
    font-size: 14px;
}
/* COLORSTATUS */
.colorstatus{
    display: inline-block;
    float: right;
    width: 5px;
    height: 20px;
}
/* HR TAG BETWEEN DETAILS*/
.taskseparator{
    margin-top: 8px;
    margin-bottom: 8px;
}
/* SIZE OF DETAILS IN TASKS*/
.taskdetails{
    font-size: 13px;
}
/* -- STYLING OF BOARD --*/
/* BOOTSTRAP EQUAL ROW HEIGHT AND STYLING OF COLUMNS*/
.row-eq-height {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  margin-right: 15px;
  margin-left: 15px;
}
/* STYLING OF HEADINGS HOLDER*/
[class*="colhcn"]{
    padding-left: 10px;
    padding-bottom: 10px;
    padding-top: 10px;
    margin-left: 8px;
    margin-right: 8px;
    font-size: 15px;
    font-weight: 700;
    border: 1px solid #e5e5e5;
    background-color: #fafafa
}
/* STYLING OF TASKS HOLDER*/
[class*="col-xs"] {
    padding-left: 0px;
    padding-right: 0px;
    margin-left: 8px;
    margin-right: 8px;
    background: #fafafa;
    min-height: <?php print $MINHEIGHT; ?>;
    max-height: <?php print $MAXHEIGHT; ?>;
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
// MAKE VARIABLES READY
$task = array(); // NOT NEEDED.. OR..
//CHANGE1
$haystack = "Backlog Ready Work in progress Done"; // Either change according to your columns or delete if statement below. If you decide to delete, remember to add all your columns to the JS in the cols:[].
$dummy = "0"; // USED FOR THE FIRST RUN
$pn = ""; // PROJECT NAME
$cn1 = ""; // COLOUMN NR1
$cn2 = ""; // COLOUMN NR2
$cn3 = ""; // COLOUMN NR3
$cn4 = ""; // COLOUMN NR4
$cs = ""; // COLOR STATUS
$dd = ""; // DATA COLLECTOR
$tt = ""; // DATA COLLECTOR FOR TAGS

foreach($AllBoardViewHTMLData as $task){
    if (strpos($haystack, $task['column_name']) !== false) {
        // First run needs some date
        if ($dummy == "0") {
          $pn = $task['project_name']; // Get first project name for var
          $dummy = "1"; // Don't run this again indicator
        }
        // Projectname is changing - the print var to screen
        if ($pn !== $task['project_name']) {
            // Make and print grid
            ?>
            <br><hr />
            <h2><a class="projectnameh2" href="/kanboard/?controller=BoardViewController&action=show&project_id=<?php print $pid; ?>"><?php print $pn; ?></a></h2>
            <div class="row row-eq-height">
            <?php //CHANGE2 ?>
              <div class="colhcn col-sm-4 col-md-3"><div class="hcn hcn1">Backlog</div></div>
              <div class="colhcn col-sm-4 col-md-3"><div class="hcn hcn2">Ready</div></div>
              <div class="colhcn col-sm-4 col-md-3"><div class="hcn hcn3">Work in progress</div></div>
              <div class="colhcn col-md-3"><div class="hcn4 hcn">Done</div></div>
            </div>
            <div class="row row-eq-height rowboard">
              <?php
              //CHANGE4
              print '<div class="col-xs-4"><div class="cn cnL">' . $cn1 . '</div></div>';
              print '<div class="col-xs-4"><div class="cn cnM1">' . $cn2 . '</div></div>';
              print '<div class="col-xs-4"><div class="cn cnM2">' . $cn3 . '</div></div>';
              print '<div class="col-xs-4"><div class="cn cnR">' . $cn4 . '</div></div>';
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

        $pid = $task['project_id']; //Used for link in projectname above

        // Make task ready
        if ($task['is_active']) { // Only include active tasks

            // Check colorstatus
            if ($task['color_id'] != "0"){
                $cs = 'style="border: black 1px solid; border-radius: 30px; background-color:' . $task['color_id'] . ';"';
            }

            // Generate task data
            $dd = '
            <div class="tn"><a class="idlink" href="?controller=TaskViewController&action=show&task_id=' . $task['id'] . '&project_id=' . $task['project_id'] . '"><b>' . $task['id'] . '</b>
            - '. $task['title'] . '</a><div class="colorstatus" ' . $cs . '></div>
             <br/>';

             // Include due date
             if ($task['date_due'] != '0' && !$task['date_due']){
                 $dd .= '<hr class="taskseparator"/>
                    <div class="taskdetails" style="margin-left: 15px;">
                    <b>Due date:</b> '
                    . date("Y-m-d\ H:i   ", $task['date_due']) .
                    '</div>';
            }

            // Loop through tags and include relevant
            foreach($AllBoardViewHTMLFullTags as $tags){
                //print 'project: ' . $tags['project_id'] . ' id: ' . $tags['task_id'] . ' name: ' . $tags['name'];
                if ($tags['project_id'] == $task['project_id'] && $tags['task_id'] == $task['id']){
                    $tt .= '<li class="tag-' . $tags['name'] . '">' .  $tags['name'] .'</li>';
                }
            }
            // Check if data collector for tags is empty, if not then include div
            if (!empty($tt)) {
                $tt = '<div class="task-tags" style="margin-left: 15px;"> <ul>'.$tt.'</ul></div>';
                $dd .= $tt;
            }

            // Loop through subtasks and include relevant
            foreach($AllBoardViewHTMLDataST as $subtasks){
                if ($subtasks['subtasks_status'] == "0" && $subtasks['tasks_id'] == $task['id']){
                    $dd .= '<div class="taskdetails" style="margin-left: 15px;">
                        <hr class="taskseparator"/>
                        <b>Subtask: </b>'
                        .$subtasks['subtasks_title'].
                        '</div>';
                }
            }

            $dd .= '</div>';
            //CHANGE3
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

            $tt = ""; // Cleaning data collector for tags
            $cs = ""; // Cleaning colorstatus
            $dd = ""; // Cleaning data collector

        } // If task is active end
    } // If column name fits haystack
} // Loop through tasks
?>

<br>
<br>
