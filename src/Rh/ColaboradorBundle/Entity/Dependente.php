<?php

namespace Rh\ColaboradorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dependente
 *
 * @ORM\Table(name="dependente", indexes={@ORM\Index(name="IDX_3EDA8DDC6D026E38", columns={"id_funcionario"})})
 * @ORM\Entity
 */
class Dependente
{
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=140, nullable=false)
     */
    private $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento", type="date", nullable=true)
     */
    private $dataNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="parentesco", type="string", length=16, nullable=false)
     */
    private $parentesco;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="dependente_id_seq", allocationSize=1, initialValue=1)
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
     * Construct
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }


    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Dependente
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     *
     * @return Dependente
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set parentesco
     *
     * @param string $parentesco
     *
     * @return Dependente
     */
    public function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    /**
     * Get parentesco
     *
     * @return string
     */
    public function getParentesco()
    {
        return $this->parentesco;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Dependente
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Dependente
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * @return Dependente
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

    public function __toString()
    {
        return $this->nome;
    }
}
