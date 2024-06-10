<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonda internetowa</title>
</head>
<body>
<h1>Sonda internetowa</h1>

<?php
    function hasVoted() {
        return isset($_COOKIE['voted']);
    }

    function setVotedCookie() {
        setcookie('voted', '1', time() + (86400 * 30), "/");
    }

    $votes = ['Tak' => 0, 'Nie' => 0, 'Nie mam zdania' => 0];

if (isset($_POST['vote']) && !hasVoted()) {
$selectedOption = $_POST['vote'];
if (array_key_exists($selectedOption, $votes)) {
$votes[$selectedOption]++;
setVotedCookie();
}
}
?>

<?php if (!hasVoted()) : ?>
<div id="voting-form">
    <p>Pytanie: Czy jesteś za wprowadzeniem nowego podatku?</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="radio" id="vote-yes" name="vote" value="Tak">
    <label for="vote-yes">Tak</label><br>
    <input type="radio" id="vote-no" name="vote" value="Nie">
    <label for="vote-no">Nie</label><br>
    <input type="radio" id="vote-no-opinion" name="vote" value="Nie mam zdania">
    <label for="vote-no-opinion">Nie mam zdania</label><br>
    <input type="submit" value="Oddaj głos">
    </form>
</div>
<?php else : ?>
<div id="thank-you">
    <p>Dziękujemy za udział w sondzie!</p>
</div>
<?php endif; ?>
</body>
</html>
