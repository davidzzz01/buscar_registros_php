<?php
require_once("db.php");

$buscar_item = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['busca'])) {
    $busca = $_GET['busca'];
    $busca_br = $conn->real_escape_string($busca);

    $buscar = "SELECT p.id, p.nome AS produto, p.descricao, p.preco, c.nome AS categoria 
    FROM produtos p 
    JOIN categorias c ON c.id = p.categoria_id 
    WHERE c.nome LIKE '%$busca_br%' OR p.nome LIKE '%$busca_br%'";;
    
    $busca_query = $conn->query($buscar);

    if ($busca_query === false) {
        die("Erro na consulta: " . $conn->error);
    } else {
        $buscar_item = $busca_query->fetch_all(MYSQLI_ASSOC);
    }
}


$conn->close();

header("Location: index.php?busca_result=" . urlencode(json_encode($buscar_item)));

exit;
?>
