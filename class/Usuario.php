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
        if (isset($result)) {
            $row = $result[0];
            $this->setId($row["id"]);
        
            $this->setDeslogin($row["deslogin"]);
        
            $this->setDessenha($row["dessenha"]);
        
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        
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
            $row = $result[0];
            $this->setId($row["id"]);
        
            $this->setDeslogin($row["deslogin"]);
        
            $this->setDessenha($row["dessenha"]);
        
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        
        }
		else {
			throw new Exception("Login e/ou senha invalidos.");
			
		}
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