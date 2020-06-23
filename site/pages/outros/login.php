<button onclick="FormLogin('hidden')" class="btnFechar">X</button>
<main class="loginContent">
    <aside>
        <img src="" alt="">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus laudantium eveniet excepturi natus temporibus, obcaecati consequatur iusto magnam doloribus dignissimos? Adipisci neque quos consequuntur soluta mollitia corrupti ut esse vel?</p>
        <button>Botão 1</button>
        <button>Botão 2</button>
    </aside>

    <section>
        <form action="usuario.php" method="POST">
            <label>
                <span>Usuário</span>
                <input type="text" name="txbUsuario">
            </label>
            <label>
                <span>Senha</span>
                <input type="text" name="txbSenha">
            </label>
            <input type="hidden" name="txbPagina" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
            <button>Entrar</button>    
        </form>
    </section>    
</main>