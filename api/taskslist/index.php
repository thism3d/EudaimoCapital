<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: X-Requested-With');

include '../../bot/config.php';
include '../../bot/functions.php';

$MySQLi = new mysqli('localhost',$DB['username'],$DB['password'],$DB['dbname']);
$MySQLi->query("SET NAMES 'utf8'");
$MySQLi->set_charset('utf8mb4');
if ($MySQLi->connect_error) die;
function ToDie($MySQLi){
$MySQLi->close();
die;
}

$query = "SELECT `id`, `slug`, `reward`, `title`, `iconName`, `taskType` FROM `tasks` ORDER BY `id` ASC, `taskType` DESC";
$result = mysqli_query($MySQLi, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($MySQLi));
}

$get_all_tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

$tasksExtraArray = [];
foreach ($get_all_tasks as $row) {
    $tasksExtraArray[] = [
        "title" => $row["title"],
        "iconName" => $row["iconName"],
        "slug" => $row["slug"]
    ];
}



include '../../cookies.php';
// Prepare the JSON output
$output = [
    [
        "title" => "Be a good {$coinName} Fan ⏳",
        "iconName" => "spotty",
        "slug" => "good-age"
    ],
    [
        "title" => "Subscribe to {$coinName} X.com",
        "iconName" => "x",
        "slug" => "follow-age-x"
    ],
    [
        "title" => "Invite 5 friends to {$coinName}",
        "iconName" => "users3",
        "slug" => "invite-frens"
    ],
    [
        "title" => "Add ⏳ in Telegram name",
        "iconName" => "bone",
        "slug" => "add-time-telegram"
    ],
    [
        "title" => "Subscribe to {$coinName}'s channel",
        "iconName" => "telegram",
        "slug" => "subscribe-age-telegram"
    ],
    ...$tasksExtraArray
];

// Output as JSON
header('Content-Type: application/json'); // Ensure the content type is set to JSON
echo json_encode($output, JSON_PRETTY_PRINT); // Optionally use JSON_PRETTY_PRINT for better readability


?>
