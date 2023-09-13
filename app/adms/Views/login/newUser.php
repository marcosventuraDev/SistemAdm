<?php

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

if(isset($valorForm['name'])||isset($valorForm['email'])){
    $name = $valorForm['name'];
    $email = $valorForm['email'];
    
}else{
    $name = "";
    $email ="" ;
}


//Criptografar

/* $cripto = password_hash('123456', PASSWORD_DEFAULT); */

?>
<h1>Novo Usuário</h1>

<?php

    if(isset($_SESSION['msg'])){
    
       echo $_SESSION['msg'];
       unset($_SESSION['msg']);
    }

?>
<span id="msg"></span>
<div style=" display: flex;flex-direction:column;position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);width: 25%;height: 20%;">
    <form action="" method="POST" id="form-new-user" style="display: flex; flex-direction:column;justify-content:space-around;   border:1px solid; border-radius:5px; padding:20px;" >
        <label for="">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Digite o nome Completo" value="<?php echo $name?>"><br>
        <label for="">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Email do usuário" value="<?php echo $email?>" ><br>
        <label for=""> Senha:</label>
        <input type="text" name="password" id="password" placeholder="Senha" value="" ><br>
    
      
        <button type="submit" name="SendNewUser" value="Acessar">Cadastrar</button>
    </form>
    
    <p>Clique aqui<a href="<?php echo  URLADM;?> ">Acessar</a></p>
</div>