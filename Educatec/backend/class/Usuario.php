<?php

class Usuario {

    private $email;
    private $idusuario;
    private $senha;
    private $dtcadastro;
    private $nome;
    private $sobrenome;
    private $endereco;
    private $numero;
    private $cidade;
    private $estado;

    public function getIdUsuario(){
        return $this->idusuario;
    }

    public function setIdUsuario($value){
        $this->idusuario = $value;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($value){
        $this->email = $value;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($value){
        $this->senha = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($value){
        $this->nome = $value;
    }

    public function getSobrenome(){
        return $this->sobrenome;
    }

    public function setSobrenome($value){
        $this->sobrenome = $value;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($value){
        $this->endereco = $value;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function setNumero($value){
        $this->numero = $value;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setCidade($value){
        $this->cidade = $value;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($value){
        $this->estado = $value;
    }

    // Lista um usuário ou curso passando ID
    public function findById($id){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        echo json_encode($results);
    }

    // Lista todos os usuários
    public static function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY email;");
    }

    // Pesquisa usuário ou curso
    public static function search($email){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE email LIKE :SEARCH ORDER BY email", array(
            ':SEARCH'=>"%".$email."%"
        ));
    }

    // Cadastro de usuário
    public function insert($email, $nome, $sobrenome, $senha, $endereco, $numero, $cidade, $estado){

        $sql = new Sql();
        
        $results = $sql->select("INSERT INTO tb_usuarios (EMAIL, NOME,  SOBRENOME, SENHA, ENDERECO, NUMERO, CIDADE, ESTADO) 
        VALUES ('$email', '$nome', '$sobrenome', '$senha', '$endereco', '$numero', '$cidade', '$estado')");

        if($results == null) {
            header("Location: /Educatec/frontend/view/html/TelaLogin.html");
        }
    }

    // Update de usuário
    public function update($email, $senha){

        $this->setEmail($email);
        $this->setSenha($senha);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET email = :EMAIL, senha = :SENHA WHERE idusuario = :ID", array(
            ':EMAIL'=>$this->getEmail(),
            ':PASSWORD'=>$this->getSenha(),
            ':ID'=>$this->getIdUsuario()
        ));
    }

    // Deleta usuário
    public function delete($id){

        $sql = new Sql();

        $sql->query("DELETE * FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID'=>$this->getIdUsuario()
        ));

        $this->setIdUsuario(0);
        $this->setEmail("");
        $this->setSenha("");
        $this->setDtcadastro(new DateTime());
    }

    public function __construct($nome = '', $sobrenome = '', $email = '', $senha = '', $endereco = '', $numero = '', $cidade = '', $estado = ''){

        $this->setNome($nome);
        $this->setSobrenome($sobrenome);
        $this->setEmail($email);
        $this->setSenha($senha);    
        $this->setEndereco($endereco);
        $this->setNumero($numero);
        $this->setCidade($cidade);
        $this->setEstado($estado);
    }

    public function __toString(){

        return json_encode(array(
            "idusuario"=>$this->getIdUsuario(),
            "email"=>$this->getEmail(),
            "senha"=>$this->getSenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

    // Login de usuário
    public function login($email, $senha){

        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE email = '$email' AND senha = '$senha'");
        
        if (count($results) > 0) {
            header("Location: /Educatec/frontend/view/html/TelaDeCursos.html");
        } else {
            header("Location: /Educatec/frontend/view/html/Error.html");
        }
    }
}

?>