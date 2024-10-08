<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Incluir o arquivo de conexão
include '../central/includes/conexao.php';
include "../central/includes/validar_sessao.php";

// Consultar imóveis no banco de dados
$sql = "SELECT id_imovel, codigo, tipo_imovel, qtd_comodos, m2, cidade, estado, status FROM imoveis";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardex de Imóveis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php //include "central/includes/menu_site_externo.php"; ?>

    <!-- Cardex de Imóveis -->
    <div class="container my-5">
        <h3 class="text-center mb-4">Cardex de Imóveis</h3>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Cômodos</th>
                    <th scope="col">Área (m²)</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["codigo"] . '</td>';
                        echo '<td>' . $row["tipo_imovel"] . '</td>';
                        echo '<td>' . $row["qtd_comodos"] . '</td>';
                        echo '<td>' . $row["m2"] . '</td>';
                        echo '<td>' . $row["cidade"] . '</td>';
                        echo '<td>' . $row["estado"] . '</td>';
                        echo '<td>' . ($row["status"] == '1' ? 'Ativo' : 'Inativo') . '</td>';
                        echo '<td>
                                <a href="imoveis_detalhes.php?imovel=' . $row["codigo"] . '" class="btn btn-info btn-sm">Ver Detalhes</a>
                                <a href="imovel_editar.php?imovel='   . $row["codigo"] . '" class="btn btn-warning btn-sm">Editar</a>
                                <a href="imovel_excluir.php?imovel='  . $row["codigo"] . '" class="btn btn-danger btn-sm">Excluir</a>
                              </td>'; 
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="8" class="text-center">Nenhum imóvel encontrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3 bg-dark text-white">
            <p>© 2024 Imobiliária ImovelNet - Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
