<?php



include '../../../bot/config.php';
include '../../../bot/functions.php';

// Create database connection
$MySQLi = new mysqli('localhost', $DB['username'], $DB['password'], $DB['dbname']);
$MySQLi->query("SET NAMES 'utf8'");
$MySQLi->set_charset('utf8mb4');

// Check connection
if ($MySQLi->connect_error) {
    die("Connection failed: " . $MySQLi->connect_error);
}

// Function to handle errors and close connection
function ToDie($MySQLi) {
    $MySQLi->close();
    die;
}

// Check if URL is valid
function isValidUrl($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

// Get task parameters from the request
$task = $_REQUEST['task'];
$user_id = $_REQUEST['user_id'];
$reference = $_REQUEST['reference'];

// Validate the user
$get_user = mysqli_fetch_assoc(mysqli_query($MySQLi, "SELECT * FROM `users` WHERE `id` = '{$user_id}' AND `hash` = '{$reference}' LIMIT 1"));

if (!$get_user) {
    http_response_code(300);
    echo json_encode(['ok' => false, 'message' => 'User not found'], JSON_PRETTY_PRINT);
    $MySQLi->close();
    die;
}

// Current timestamp
$now = time();

// Initialize response variable
$isOK = false;

// Process task based on the slug or URL
if (isValidUrl($task)) {
    $slug = $task;

    // Query the tasks table to get the task details by slug (URL)
    $task_result = mysqli_fetch_assoc(mysqli_query($MySQLi, "SELECT `title`, `reward` FROM `tasks` WHERE `slug` = '{$slug}' LIMIT 1"));

    if ($task_result) {
        $task_name = $slug;
        $reward = $task_result['reward'];
        
        // Update user and insert task record
        $MySQLi->query("UPDATE `users` SET `score` = `score` + {$reward}, `tasksReward` = `tasksReward` + {$reward} WHERE `id` = '{$user_id}' LIMIT 1");
        $MySQLi->query("INSERT INTO `user_tasks` (`user_id`, `task_name`, `check_time`) VALUES ('{$user_id}', '{$task_name}', '{$now}')");
        $isOK = true;
    } else {
        $isOK = false;
    }
} else {
    // Handle predefined task cases
    switch ($task) {
        case 'good-age':
            $task_name = 'good-age';
            $reward = 50;
            $MySQLi->query("UPDATE `users` SET `score` = `score` + {$reward}, `tasksReward` = `tasksReward` + {$reward} WHERE `id` = '{$user_id}' LIMIT 1");
            $MySQLi->query("INSERT INTO `user_tasks` (`user_id`, `task_name`, `check_time`) VALUES ('{$user_id}', '{$task_name}', '{$now}')");
            $isOK = true;
            break;

        case 'follow-age-x':
            $task_name = 'follow-age-x';
            $reward = 1000;
            $MySQLi->query("UPDATE `users` SET `score` = `score` + {$reward}, `tasksReward` = `tasksReward` + {$reward} WHERE `id` = '{$user_id}' LIMIT 1");
            $MySQLi->query("INSERT INTO `user_tasks` (`user_id`, `task_name`, `check_time`) VALUES ('{$user_id}', '{$task_name}', '{$now}')");
            $isOK = true;
            break;

        case 'invite-frens':
            $task_name = 'invite-frens';
            $reward = 20000;
            $get_referrals = mysqli_fetch_all(mysqli_query($MySQLi, "SELECT `id` FROM `users` WHERE `inviter_id` = '{$user_id}' LIMIT 10"));
            if (count($get_referrals) >= 5) {
                $MySQLi->query("UPDATE `users` SET `score` = `score` + {$reward}, `tasksReward` = `tasksReward` + {$reward} WHERE `id` = '{$user_id}' LIMIT 1");
                $MySQLi->query("INSERT INTO `user_tasks` (`user_id`, `task_name`, `check_time`) VALUES ('{$user_id}', '{$task_name}', '{$now}')");
                $isOK = true;
            }
            break;

        case 'add-time-telegram':
            $task_name = 'add-time-telegram';
            $reward = 2500;
            $name = json_decode(file_get_contents('https://api.telegram.org/bot'.$apiKey.'/getchat?chat_id='.$user_id), true)['result']['first_name'];
            if (strpos($name, '⏳') !== false) {
                $MySQLi->query("UPDATE `users` SET `score` = `score` + {$reward}, `tasksReward` = `tasksReward` + {$reward} WHERE `id` = '{$user_id}' LIMIT 1");
                $MySQLi->query("INSERT INTO `user_tasks` (`user_id`, `task_name`, `check_time`) VALUES ('{$user_id}', '{$task_name}', '{$now}')");
                $isOK = true;
            }
            break;

        case 'subscribe-age-telegram':
            $task_name = 'subscribe-age-telegram';
            $reward = 50;
            // $result = json_decode(file_get_contents('https://api.telegram.org/bot'.$apiKey.'/getChatMember?chat_id=-1001478594200&user_id='.$user_id));
            // if ($result->ok && in_array($result->result->status, ['member', 'administrator'])) {
                $MySQLi->query("UPDATE `users` SET `score` = `score` + {$reward}, `tasksReward` = `tasksReward` + {$reward} WHERE `id` = '{$user_id}' LIMIT 1");
                $MySQLi->query("INSERT INTO `user_tasks` (`user_id`, `task_name`, `check_time`) VALUES ('{$user_id}', '{$task_name}', '{$now}')");
                $isOK = true;
            // }
            break;

        default:
            $isOK = false;
    }
}

// Close database connection
$MySQLi->close();

// Output the result
if ($isOK) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

?>
