<?php
if (isset($_FILES['imagem'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Validações...
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
        // Guarda $target_file e $descricao no BD
        // ...
        echo "O ficheiro foi enviado e guardado.";
    } else {
        echo "Erro ao enviar.";
    }
}
?>
<?php
