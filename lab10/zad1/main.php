<?php
$maxVisits = 10;
if (getVisitCount() >= $maxVisits) {
    echo "<p>Osiągnięto maksymalną liczbę odwiedzin!</p>";
}
function getVisitCount()
{
    if (isset($_COOKIE['visit_count'])) {
        return $_COOKIE['visit_count'];
    } else {
        return 0;
    }
}

function incrementVisitCount()
{
    $count = getVisitCount()+1;
    setcookie('visit_count', $count, time() + (86400 * 30), "/");
}

function resetVisitCount()
{
    setcookie('visit_count', '', time() - 3600, "/");
}

if (isset($_POST['reset'])) {
    resetVisitCount();
} else {
    incrementVisitCount();
}

include 'index.html';

?>