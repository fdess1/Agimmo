<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints\Collection;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="cl_id", type="smallint", nullable=false, options={"unsigned"=true,"comment"="pk client"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clId;

    /**
     * @var string
     *
     * @ORM\Column(name="cl_nom", type="string", length=50, nullable=false)
     */
    private $clNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cl_prenom", type="string", length=50, nullable=true)
     */
    private $clPrenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cl_raisonsociale", type="string", length=50, nullable=true)
     */
    private $clRaisonsociale;

    /**
     * @var string|null
     *
     * @ORM\Column(name="siren", type="string", length=50, nullable=true)
     */
    private $siren;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tel", type="string", length=50, nullable=true)
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    public function getClId(): ?int
    {
        return $this->clId;
    }

    public function getClNom(): ?string
    {
        return $this->clNom;
    }

    public function setClNom(string $clNom): self
    {
        $this->clNom = $clNom;

        return $this;
    }

    public function getClPrenom(): ?string
    {
        return $this->clPrenom;
    }

    public function setClPrenom(?string $clPrenom): self
    {
        $this->clPrenom = $clPrenom;

        return $this;
    }

    public function getClRaisonsociale(): ?string
    {
        return $this->clRaisonsociale;
    }

    public function setClRaisonsociale(?string $clRaisonsociale): self
    {
        $this->clRaisonsociale = $clRaisonsociale;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

  public function __toString()
  {
     return $this->clPrenom. ' ' .$this->clNom. ' '. $this->clRaisonsociale;
  }

/**
* @ORM\OneToMany(targetEntity="Bien",mappedBy="proprietaire")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="cl_id", referencedColumnName="bn_id_proprio")
 * })
*/
    private $biens;

    public function __construct()
    {
        $this->biens = new ArrayCollection();
    }

    /**
     * @return Collection|Bien[]
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }
}
