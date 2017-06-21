<?php
include_once 'psl-config.php';
 
function sec_session_start() {
    if (ini_set('session.use_only_cookies', 1) === FALSE) { header("Location: ../error.php?err=Could not initiate a safe session (ini_set)"); exit(); }
	session_name('sec_session_id');
    $loginP = session_get_cookie_params();
    session_set_cookie_params($loginP["lifetime"], $loginP["path"], $loginP["domain"], $secure = SECURE, $httponly = true);
    session_start();
    session_regenerate_id(true);
}

function login($email, $password, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT userID, username, password, salt 
        FROM clients
        WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            if (checkbrute($user_id, $mysqli) == true) { return false;
            } else {
                if ($db_password == $password) {
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    return true;
                } else {
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(userFind, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else { return false; }
    }
}

function checkbrute($user_id, $mysqli) {
    $now = time();
    $valid_attempts = $now - (2 * 60 * 60);
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE userFind = ? 
                             AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 5) { return true;
        } else { return false; }
    }
}

function login_check($mysqli) {
    if (isset($_SESSION['user_id'], 
              $_SESSION['username'], 
              $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM clients
                                      WHERE userID = ? LIMIT 1")) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
                if ($login_check == $login_string) {
                    return true;
                } else { return false; }
            } else { return false; }
        } else { return false; }
    } else { return false; }
}

function esc_url($url) {
    if ('' == $url) { return $url; }
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
    $count = 1;
    while ($count) { $url = str_replace($strip, '', $url, $count); }
    $url = str_replace(';//', '://', $url);
    $url = htmlentities($url);
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
    if ($url[0] !== '/') {
        return '';
    } else { return $url; }
}