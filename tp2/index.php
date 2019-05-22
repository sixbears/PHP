<form method='post' action='<?php echo $_SERVER["PHP_SELF"];?>'>
<input type='submit' name='envoyer' id='envoyer' value="Générer un spawn" />
</form>



<?php
// Connexion à la BDD
session_name ('session1');
session_start ();

$database_host = 'localhost';
$database_port = '3306';
$database_dbname = 'fortnite_spawn';
$database_user = 'root';
$database_password = 'root';
$database_charset = 'UTF8';
$database_options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

$pdo = new PDO(
    'mysql:host=' . $database_host . 
    ';port=' . $database_port . 
    ';dbname=' . $database_dbname . 
    ';charset=' . $database_charset, 
    $database_user,
    $database_password,
    $database_options
);

function afficher() {
    global $spawns;
    global $_SESSION;
    $index = rand(0, count($spawns) - 1);
    while ($_SESSION['index'] == $index)
    {
        $index = rand(0, count($spawns) - 1);
    };
    $_SESSION['index'] = $index;
    echo $spawns[$index]["name"];
    echo "<img src='./Spawns/" .$spawns[$index]["name"]. ".png'/>";
    $index++;
}

$query = 'SELECT id,name FROM spawn';
$req = $pdo->prepare($query);
$req->execute();
$spawns = $req->fetchall();







if (!empty($_POST['envoyer'])){
    afficher();
}
?>

<form method='post' action= ''>
<p>
  <label for='login'>Login:</label>
  <input type='text' id='login' name='login'/>
</p
<p>
  <label for='passwd'>password:</label>
  <input type='text' id='passwd' name='passwd'/>
</p>
<p>
  <input type='submit' id='connection' name='connection' value='connection'/>
</p>
</form>





