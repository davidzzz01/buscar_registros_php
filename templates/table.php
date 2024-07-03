<?php

require_once("db.php");

$sql = "SELECT p.id, p.nome AS produto, p.descricao, p.preco, c.nome AS categoria 
        FROM produtos p 
        JOIN categorias c ON p.categoria_id = c.id";
$query = $conn->query($sql);

if ($query === false) {
    die("Erro na consulta: " . $conn->error);
} else {
    $table = $query->fetch_all(MYSQLI_ASSOC);
}

$limit = 10; 
$page = isset($_GET['page']) ? $_GET['page'] : 1; 

$total_records = count($table); 
$total_pages = ceil($total_records / $limit); 

$offset = ($page - 1) * $limit;


$sql_paginate = "SELECT p.id, p.nome AS produto, p.descricao, p.preco, c.nome AS categoria 
                FROM produtos p 
                JOIN categorias c ON p.categoria_id = c.id
                LIMIT $limit OFFSET $offset";
$query_paginate = $conn->query($sql_paginate);

if ($query_paginate === false) {
    die("Erro na consulta de paginação: " . $conn->error);
} else {
    $paginated_table = $query_paginate->fetch_all(MYSQLI_ASSOC);
}

function paginate($total_pages, $current_page) {
    for ($p = 1; $p <= $total_pages; $p++) {
        if ($p == $current_page) {
            echo "<li class='page-item active'><span class='page-link'>$p</span></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='?page=$p'>$p</a></li>";
        }
    }
}
?>


