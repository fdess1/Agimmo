<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppelFonds
 *
 * @ORM\Table(name="appel_fonds", indexes={@ORM\Index(name="fk_af_bien", columns={"af_bn_id"})})
 * @ORM\Entity
 */
class AppelFonds
{
    /**
     * @var int
     *
     * @ORM\Column(name="af_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $afId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="af_type", type="string", length=5, nullable=true, options={"comment"="PREVisionnel|REGULarisation"})
     */
    private $afType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="designation", type="string", length=200, nullable=true)
     */
    private $designation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="af_montant", type="decimal", precision=10, scale=2, nullable=true, options={"comment"="Montant total"})
     */
    private $afMontant;

    /**
     * @var string|null
     *
     * @ORM\Column(name="af_dontlocataire", type="decimal", precision=10, scale=2, nullable=true, options={"comment"="Partie imputable au locataire"})
     */
    private $afDontlocataire;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="periodeb", type="date", nullable=true, options={"comment"="Date de début periode concernee"})
     */
    private $periodeb;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="periofin", type="date", nullable=true, options={"comment"="Date de fin periode concernee"})
     */
    private $periofin;

    /**
     * @var \Bien
     *
     * @ORM\ManyToOne(targetEntity="Bien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="af_bn_id", referencedColumnName="bn_id")
     * })
     */
    private $afBn;

    public function getAfId(): ?int
    {
        return $this->afId;
    }

    public function getAfType(): ?string
    {
        return $this->afType;
    }

    public function setAfType(?string $afType): self
    {
        $this->afType = $afType;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getAfMontant()
    {
        return $this->afMontant;
    }

    public function setAfMontant($afMontant): self
    {
        $this->afMontant = $afMontant;

        return $this;
    }

    public function getAfDontlocataire()
    {
        return $this->afDontlocataire;
    }

    public function setAfDontlocataire($afDontlocataire): self
    {
        $this->afDontlocataire = $afDontlocataire;

        return $this;
    }

    public function getPeriodeb(): ?\DateTimeInterface
    {
        return $this->periodeb;
    }

    public function setPeriodeb(?\DateTimeInterface $periodeb): self
    {
        $this->periodeb = $periodeb;

        return $this;
    }

    public function getPeriofin(): ?\DateTimeInterface
    {
        return $this->periofin;
    }

    public function setPeriofin(?\DateTimeInterface $periofin): self
    {
        $this->periofin = $periofin;

        return $this;
    }

    public function getAfBn(): ?Bien
    {
        return $this->afBn;
    }

    public function setAfBn(?Bien $afBn): self
    {
        $this->afBn = $afBn;

        return $this;
    }


}
