<?php require_once("templates/table.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de busca</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<h1 class="text-center mt-5">Busca de Registros</h1>
<div class="container mt-5">
    <form action="busca.php" method="get">
        <label>Buscar produto:</label>
        <div class="input-group">
            <input type="text" class="form-control" name="busca" style="border-radius: 4px;" placeholder="Digite o nome de um produto">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary ml-2" ><i class="fas fa-search" ></i></button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_GET['busca_result'])) {
        $buscar_item = json_decode(urldecode($_GET['busca_result']), true);
        
        if (!empty($buscar_item)) {
            ?>
            <table class="table table-bordered table-striped table-condensed mt-3">
                <thead class="bg-primary text-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preço (R$)</th>
                        <th scope="col">Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($buscar_item as $item): ?>
                    <tr>
                        <td><?= $item["id"] ?></td>
                        <td><?= $item["produto"] ?></td>
                        <td><?= $item["descricao"] ?></td>
                        <td>R$ <?= number_format($item["preco"], 2, ',', '.') ?></td>
                        <td><?= $item["categoria"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php paginate($total_pages, $page); ?>
                </ul>
            </nav>
            <p><i>Quantidade de Registros:</i> <b><?= $_GET['busca_result'] ? count($buscar_item): $total_records ?></b></p>
            <?php
        } else {
            ?>
            <div class="alert alert-info mt-3">
                
                <p>Nenhum resultado encontrado.</p>
            </div>
            <?php
        }
    } else {
        
        ?>
        <table class="table table-bordered table-striped table-condensed mt-3">
            <thead class="bg-primary text-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço (R$)</th>
                    <th scope="col">Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paginated_table as $tabela): ?>
                <tr>
                    <td><?= $tabela["id"] ?></td>
                    <td><?= $tabela["produto"] ?></td>
                    <td><?= $tabela["descricao"] ?></td>
                    <td>R$ <?= number_format($tabela["preco"], 2, ',', '.') ?></td>
                    <td><?= $tabela["categoria"] ?></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <nav aria-label="Page navigation example">
    <ul class="pagination pagination-info">
        <?php 
           paginate($total_pages, $page);
        ?>
    </ul>
</nav>
<p><i>Quantidade de Registros:</i> <b><?=  $total_records?></b></p>
        <?php
    }
    ?>
 
</div>
<style>
        .container {
            width: 800px;
        }
        .btn-primary {
            border-radius: 5px;
        }
       
    </style>
</body>
</html>
