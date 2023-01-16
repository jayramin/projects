<?php
require_once '../config/config.php'; //include required dbconfig file
require_once 'labels.php'; //include required dbconfig file
//sanitize post value
if (isset($_POST["page"])) {
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if (!is_numeric($page_number)) {
        die('Invalid page number!');
    } //incase of invalid page number
} else {
    $page_number = 1;
}

//get current starting point of records
$position = (($page_number - 1) * ROWS_PER_PAGE);
$results = $db->prepare("SELECT * FROM test_videos ORDER BY video_id DESC LIMIT $position, " . ROWS_PER_PAGE);
$results->execute();

//getting results from database
?>
<ul class="page_result">
    <?php
    while ($row = $results->fetch(PDO::FETCH_ASSOC)) { ?>
        <li>
            <a href="<?php echo $row['video_id']; ?>"><?php echo $row['video_name']; ?></a>
        </li>
        <?php
    } ?>
</ul>