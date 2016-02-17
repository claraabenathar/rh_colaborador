<?php

namespace Rh\ColaboradorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endereco
 *
 * @ORM\Table(name="endereco", indexes={@ORM\Index(name="IDX_F8E0D60E6D026E38", columns={"id_funcionario"})})
 * @ORM\Entity
 */
class Endereco
{
    /**
     * @var string
     *
     * @ORM\Column(name="logradouro", type="string", length=120, nullable=true)
     */
    private $logradouro;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="complemento", type="string", length=120, nullable=true)
     */
    private $complemento;

    /**
     * @var string
     *
     * @ORM\Column(name="bairro", type="string", length=120, nullable=true)
     */
    private $bairro;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=8, nullable=true)
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="cidade", type="string", length=40, nullable=true)
     */
    private $cidade;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=2, nullable=true)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="endereco_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Rh\ColaboradorBundle\Entity\Funcionario
     *
     * @ORM\ManyToOne(targetEntity="Rh\ColaboradorBundle\Entity\Funcionario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_funcionario", referencedColumnName="id")
     * })
     */
    private $idFuncionario;



    /**
     * Set logradouro
     *
     * @param string $logradouro
     *
     * @return Endereco
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get logradouro
     *
     * @return string
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Endereco
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set complemento
     *
     * @param string $complemento
     *
     * @return Endereco
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get complemento
     *
     * @return string
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     *
     * @return Endereco
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set cep
     *
     * @param string $cep
     *
     * @return Endereco
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     *
     * @return Endereco
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Endereco
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idFuncionario
     *
     * @param \Rh\ColaboradorBundle\Entity\Funcionario $idFuncionario
     *
     * @return Endereco
     */
    public function setIdFuncionario(\Rh\ColaboradorBundle\Entity\Funcionario $idFuncionario = null)
    {
        $this->idFuncionario = $idFuncionario;

        return $this;
    }

    /**
     * Get idFuncionario
     *
     * @return \Rh\ColaboradorBundle\Entity\Funcionario
     */
    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }
}
