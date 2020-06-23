<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/css/reset.css">
    <link rel="stylesheet" href="../../src/css/generics.css">
    <link rel="stylesheet" href="../../src/css/modeloVisualizar.css">
</head>
<body>
    <h1 class=estiloBox>Painel de cadastros</h1>
    <aside class="estiloBox cardBox">
        <div class="estiloBox card">
            <h1 class="estiloBoxInset fullWidth">Artistas</h1>
            <label onClick="NormalRedirect('pages/registro/cadArtista')" type=button for=""><button class=estiloBoxInset>Ir até lá</button></label>
        </div>
        <div class="estiloBox card">
            <h1 class="estiloBoxInset fullWidth">Bandas</h1>
            <label onClick="NormalRedirect('pages/registro/cadBanda')" type=button for=""><button class=estiloBoxInset>Ir até lá</button></label>
        </div>
        <div class="estiloBox card">
            <h1 class="estiloBoxInset fullWidth">Albuns e Coletâneas</h1>
            <label onClick="NormalRedirect('pages/registro/cadAlbum')" href="a" type=button><button class=estiloBoxInset>Ir até lá</button></label>
        </div>
    </aside>
    <script src="../../src/js/interactions.js"></script>
</body>