<div class="content">
  <div class="well">
    <fieldset>
      <legend>
        <h1>Login</h1>
      </legend>
      
      <form action="<?= site_url('login/do_login') ?>" method="POST">
        <input type="text" class="input-block-level" name="username" placeholder="Usuário" required>
        <input type="password" class="input-block-level" name="password" placeholder="Senha" required>
        <button type="submit" class="btn btn-info"><span class="icon-lock icon-white"></span> Login</button>        
      </form>
      
    </fieldset>
  </div>
</div>