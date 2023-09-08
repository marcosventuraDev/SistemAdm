<?php
if (isset($this->data['form'])) {

 
    $valorForm = $this->data['form'];

}
?>
<h1>Área Restrita</h1>

<form action="" method="post">

    <?php
    $user = "";
    if (isset($valorForm['user'])) {
        $user = $valorForm['user'];
      
    } else {
    } ?>
    <label for="">Usuário: </label>
    <input type="text" name="user" id="user" placeholder="Digite o usuário" value="<?php echo $user?>"><br><br>

  
    <label for="">Password: </label>
    <input type="password" name="password" id="password" placeholder="Digite a Senha" ><br><br>

    <input type="submit" name="SendLogin" value="Acessar">
</form>