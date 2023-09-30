<?php
$user = 'naoki';
$pass = 'Naoki0987';
if (empty($_GET['id'])) {
    echo 'IDを正しく入力してください。';
    exit;
}
$id = (int)$_GET['id'];
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
$category = (int)$_POST['category'];
$difficulty = (int)$_POST['difficulty'];
$budget = (int)$_POST['budget'];
$dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'UPDATE recipes SET recipe_name = ?, category = ?, difficulty = ?, budget = ?, howto = ? WHERE id = ?';
try{
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $recipe_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $category, PDO::PARAM_INT);
    $stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
    $stmt->bindValue(4, $budget, PDO::PARAM_INT);
    $stmt->bindValue(5, $howto, PDO::PARAM_STR);
    $stmt->bindValue(6, $id, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    echo 'レシピの更新が完了しました。';
}catch(Exception $e){
    echo 'エラー発生：' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>