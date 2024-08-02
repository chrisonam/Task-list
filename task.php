<?php
include 'db.php';

$action = $_REQUEST['action'];
switch($action)
{
 case 'add':
    
    $task = $_POST['task'];
    $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
    $stmt->bind_param("s",$task);
    $stmt->execute();
    break;
    
 case 'list':
    $result=$conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
    while($row= $result->fetch_assoc()){
        echo'<li class="list-group-item">'.htmlspecialchars($row['task']).'<button class="complete btn btn-outline-success" data-id="'.$row['id'].'">Complete</button>'.'<button class="delete btn-close" data-id="'.$row['id'].'"></button></li>';
    }
    break;

    case 'complete':
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE tasks SET status='complete' WHERE id =?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        break;

    case 'delete':
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM tasks  WHERE id =?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        break;

}
$conn->close();
?>