<?php
// serve per prendere la risposta dalla precedente domanda
function getPost($id)
{
    if (isset($_POST["sel"])) {
        // risposta precedente
        $_SESSION["risposte"][$id] = $_POST["sel"];
    }
}

function SetCookieTheme($val)
{
    setcookie("theme", $val, time() + (86400), "/"); // 86400 = 1 day
}

function getCookieTheme()
{
    // tema di default: light
    $defaultTheme = "light";

    if (!isset($_COOKIE["theme"])) {
        SetCookieTheme($defaultTheme);
    }
    return $_COOKIE["theme"] ?? $defaultTheme;
}

?>