<?php
session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";
require_once "../model/m-dashboard.php";
@include '../../public/language/' . $_SESSION['aalang'] . '.php';

$pdo_conn = pdo_conn();
$now = timezone_time();

$start = $_GET["startIndex"];
$offset = $_GET["offset"];

$sql_d_a = "(SELECT ID, ID AS PID, User, Owner, Type, Subject, Message, Date_Added
								FROM " . $pdo_t['t_ticket'] . " AS t)
								UNION ALL (
								SELECT Ticket_ID, tu.ID, Update_By, u.Fname, Update_Type, t.Subject, Notes, Updated_At
								FROM " . $pdo_t['t_ticket_updates'] . " AS tu
								LEFT JOIN " . $pdo_t['t_users'] . " AS u ON tu.Update_By = u.UID
								LEFT JOIN " . $pdo_t['t_ticket'] . " AS t ON t.ID = tu.Ticket_ID
								)
								ORDER BY Date_Added DESC LIMIT $start, $offset";

$q_d_a = $pdo_conn->prepare($sql_d_a);
$q_d_a->execute();
$activities = $q_d_a->fetchAll();

foreach ($activities as $act) {
    //while ($act = mysqli_fetch_array($sel_ticket)) {

    $user_link = "p.php?p=user-profile&uid=" . $act["User"];
    $page_link = "p.php?p=ticket&tid=" . $act["ID"] . "#" . $act["PID"];

    $user = ($act['User']);
    $subject = decode_entities($act['Subject']);

    $time_ago = time_elapsed_string($act["Date_Added"]);

    // if type is web then submitted from add forms
    if ($act["Type"] == "Web" || $act["Type"] == "Email" || $act["Type"] == "Widget") {

        // if id is the same as pid it's new else it's an update
        if ($act['ID'] == $act['PID']) {

            echo "<b><a href=\"#\">" . $user . "</a></b> " . @$lang['dash-activity-new'] . " 
<a href=\"" . $page_link . "\">(" . $act["ID"] . ") " . $subject . "</a>
<br>" . $time_ago . "<p>";

        } else {

            echo "<b><a href=\"#\">" . $user . "</a></b> " . @$lang['dash-activity-user-replied'] . " <a href=\"" . $page_link . "\">(" . $act["ID"] . ") " . $subject . "</a><br>" . $time_ago . "<p>";
        }

        // if an update by an agent. user will be numberic
    } else if (is_numeric($user)) {


        // if logged in agent id matches user of update then it's the agent (You)
        if ($user == @$_SESSION["acornaid_user"]) {
            $name = @$lang['dash-activity-you'] . "</a> " . @$lang['dash-activity-have'];
        } else if ($user == 0) {
            $name = "System";
        } else {
            $name = "<b>" . $act["Owner"] . "</b></a> " . @$lang['dash-activity-has'];
        }

        // set text for each update type
        switch ($act["Type"]) {
            case "Change":
                echo "<a href=\"" . $user_link . "\">" . $name . " " . @$lang['dash-activity-change'] . " <a href=\"" . $page_link . "\">(" . $act["ID"] . ") " . decode_entities($act["Message"]) . "</a><br>" . $time_ago . "<p>";
                break;
            case "Note":
                echo "<a href=\"" . $user_link . "\">" . $name . " " . @$lang['dash-activity-note'] . " <a href=\"" . $page_link . "\">(" . $act["ID"] . ") " . $subject . "</a><br>" . $time_ago . "<p>";
                break;
            case "Close":
                echo "<a href=\"" . $user_link . "\">" . $name . " " . @$lang['dash-activity-closed'] . " <a href=\"" . $page_link . "\">(" . $act["ID"] . ") " . $subject . "</a><br>" . $time_ago . "<p>";
                break;
            default:
                echo "<a href=\"" . $user_link . "\">" . $name . " " . @$lang['dash-activity-reply'] . " <a href=\"" . $page_link . "\">(" . $act["ID"] . ") " . $subject . "</a><br>" . $time_ago . "<p>";
                break;
        }

        // else user will be user and replying
    } else {

        if ($act["Type"] == "Rating") {

            echo "<b><a href=\"#\">" . $user . "</a></b> " . @$lang['dash-activity-rating'] . " <a href=\"" . $page_link . "\">(" . $act["ID"] . ") " . $subject . "</a><br>" . $time_ago . "<p>";

        } else {

            echo "<b><a href=\"#\">" . $user . "</a></b> " . @$lang['dash-activity-user-replied'] . " <a href=\"" . $page_link . "\">(" . $act["ID"] . ") " . $subject . "</a><br>" . $time_ago . "<p>";

        }

    }

}
?>
