<?php

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

if(isset($valorForm['user'])||isset($valorForm['password'])){
    $user = $valorForm['user'];
    $pass = $valorForm['password'];
    
}else{
    $user = "";
    $pass ="" ;
}


//Criptografar

/* $cripto = password_hash('123456', PASSWORD_DEFAULT); */

?>
<h1>Área de Login</h1>

<?php

    if(isset($_SESSION['msg'])){
    
       echo $_SESSION['msg'];
       unset($_SESSION['msg']);
    }

?>
<span id="msg"></span>
<div style=" display: flex;flex-direction:column;position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);width: 25%;height: 20%;">
    <form action="" method="POST" id="form-login" style="display: flex; flex-direction:column;justify-content:space-around;   border:1px solid; border-radius:5px; padding:20px;" >
        <label for="">Usuário:</label>
        <input type="email" name="user" id="user" placeholder="Email do usuário" value="<?php echo $user?>"><br>
        <label for=""> Senha:</label>
        <input type="text" name="password" id="password" placeholder="Senha" value=""><br>
    
      
        <button type="submit" name="SendLogin" value="Acessar">Acessar</button>
    </form>
    
    <p><a href="<?php echo  URLADM;?>new-user/index">Cadastrar</a></p>
</div>