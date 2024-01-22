<?php

// Вежба 2.4– Форма за регистрација и користење на колачиња и сесија

session_start();

$ime = $_GET['ime'];
$_SESSION['last_access'] = time();
if (isset($_GET['zapamti_me']) && $_GET['zapamti_me'] == 'yes') {
    setcookie('ime', $ime, time() + 7200);
    setcookie('vreme', time(), time() + 7200);
    setcookie('session_id', session_id(), time() + 3600);
}

if (isset($_COOKIE['ime']) && isset($_COOKIE['vreme'])) {
    $ime = $_COOKIE['ime'];
    $vreme = $_COOKIE['vreme'];
    if ((time() - $vreme) < 7200) {
        echo "Hello " . htmlspecialchars($ime) . "<br>";
    }
    if (isset($_COOKIE['session_id']) && (time() - $_SESSION['last_access']) < 3600) {
        echo "Hello " . htmlspecialchars($ime) . ", you are still logged in!!!!" . "<br>";
    }

}

// Вежба 2.1 – Работа со форми
$ime = $_GET['ime'];
$prezime = $_GET['prezime'];
$email = $_GET['email'];
$pol = $_GET['pol'] == "1" ? "Masko" : "Zensko";
echo "Ime: " . htmlspecialchars($ime) . ", Prezime: " . htmlspecialchars($prezime) . ", Email: " . htmlspecialchars($email) . ", Pol: " . htmlspecialchars($pol) . "<br>";
// Reset
$ime = null;
$prezime = null;
$email = null;
$pol = null;

// Вежба 2.2– Валидација на форма

$ime = isset($_GET['ime']) ? $_GET['ime'] : '';
$prezime = isset($_GET['prezime']) ? $_GET['prezime'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$pol = isset($_GET['pol']) ? ($_GET['pol'] == "1" ? "Masko" : "Zensko") : '';

echo "Ime: " . htmlspecialchars($ime) . "<br>" .
    "Prezime: " . htmlspecialchars($prezime) . "<br>" .
    "Email: " . htmlspecialchars($email) . "<br>" .
    "Pol: " . htmlspecialchars($pol) . "<br>";
