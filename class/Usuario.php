<?php

class Usuario {

    private $id;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;



    

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id) {
		$this->id = $id;
		
	}

	/**
	 * @return mixed
	 */
	public function getDeslogin() {
		return $this->deslogin;
	}

	/**
	 * @param mixed $deslogin 
	 * @return self
	 */
	public function setDeslogin($deslogin)  {
		$this->deslogin = $deslogin;
		
	}

	/**
	 * @return mixed
	 */
	public function getDessenha() {
		return $this->dessenha;
	}

	/**
	 * @param mixed $dessenha 
	 * @return self
	 */
	public function setDessenha($dessenha) {
		$this->dessenha = $dessenha;
		
	}

	/**
	 * @return mixed
	 */
	public function getDtcadastro() {
		return $this->dtcadastro;
	}

	/**
	 * @param mixed $dtcadastro 
	 * @return self
	 */
	public function setDtcadastro($dtcadastro)  {
		$this->dtcadastro = $dtcadastro;

	}

//carregar por Id
    public function loadById($id){
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios where id = :ID", array(
            ":ID" => $id
        )
        );
        if (count($result)>0) {
			$this->setData($result[0]);
        
        } }

		//carrega uma lista de usuarios
		public static function getList(){  //como não tem nenhum $this, foi possivel torna-lo static para assim poder atuar sem necessidade de declaração

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY id");
		}
		

		//busca por usuario
		public static function search($login)
		{
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios where deslogin Like :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		)
		);
		}

		public function login($login, $password)
	{
		# code...
		$sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios where deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN" => $login,
			":PASSWORD"=>$password
        )
        );
        if (isset($result)) {
			$this->setData($result[0]);
            
        }
		else {
			throw new Exception("Login e/ou senha invalidos.");
			
		}
	}


	public function setData($data)
	{
		$this->setId($data["id"]);
        
		$this->setDeslogin($data["deslogin"]);
	
		$this->setDessenha($data["dessenha"]);
	
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	
		# code...
	}
	public function insert()
	{
		$sql = new Sql();
		//                      chamado de uma procedure
		/*/
Uma PROCEDURE (também chamada stored procedure) é uma subrotina que fica armazenada no banco de dados. Uma PROCEDURE tem um nome, uma lista de parâmetros e declarações de comandos SQL.
		*/
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha()
		)
		);
		if (isset($results)) {
			# code...
			$this->setData($results[0]);
		}
	}

	public function update($login, $password){
		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();
		$sql->exequery("UPDATE tb_usuarios set deslogin =:LOGIN, dessenha = :PASSWORD WHERE id = :ID", array(
		':LOGIN'=>$this->getDeslogin(),
		':PASSWORD'=>$this ->getDessenha(),
		':ID'=>$this->getId()
		));
	}

	public function delete(){
		$sql = new Sql();
		$sql->exequery("DELETE FROM tb_usuarios WHERE id =:ID", array(
			':ID'=>$this->getId()
		)
		);

		$this->setId(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}
	
	public function __construct($login = "", $password="")
	{
		$this->setDeslogin($login);
		$this->setDessenha($password);
		
	}
    public function __toString()
    {
        return json_encode(
            array(
                "id"=>$this->getId(),
                "deslogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s"),

            )
        );
    }



}

?>