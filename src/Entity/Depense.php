<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Depense
 *
 * @ORM\Table(name="depense", indexes={@ORM\Index(name="fk_dp_bail", columns={"dp_bl_id"})})
 * @ORM\Entity
 */
class Depense
{
    /**
     * @var int
     *
     * @ORM\Column(name="dp_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dpId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nature_depense", type="string", length=10, nullable=true, options={"comment"="Nature de depense (TRAVAUX|HONORAIRE) influant la case dans laquelle imputer en declaration de revenus"})
     */
    private $natureDepense;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descriptif", type="text", length=65535, nullable=true, options={"comment"="descriptif de la dépense"})
     */
    private $descriptif;

    /**
     * @var string|null
     *
     * @ORM\Column(name="HT", type="decimal", precision=5, scale=2, nullable=true, options={"comment"="Montant HTaxe de la depense"})
     */
    private $ht;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TVA", type="decimal", precision=5, scale=2, nullable=true, options={"comment"="Montant tva de la depense"})
     */
    private $tva;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TTC", type="decimal", precision=5, scale=2, nullable=true, options={"comment"="Montant TTC de la depense"})
     */
    private $ttc;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="debut_imput", type="date", nullable=true, options={"comment"="Date de début de l'imputation"})
     */
    private $debutImput;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fin_imput", type="date", nullable=true, options={"comment"="Date de fin de l'imputation"})
     */
    private $finImput;

    /**
     * @var \Bail
     *
     * @ORM\ManyToOne(targetEntity="Bail")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dp_bl_id", referencedColumnName="bl_id")
     * })
     */
    private $dpBl;

    public function getDpId(): ?int
    {
        return $this->dpId;
    }

    public function getNatureDepense(): ?string
    {
        return $this->natureDepense;
    }

    public function setNatureDepense(?string $natureDepense): self
    {
        $this->natureDepense = $natureDepense;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getHt()
    {
        return $this->ht;
    }

    public function setHt($ht): self
    {
        $this->ht = $ht;

        return $this;
    }

    public function getTva()
    {
        return $this->tva;
    }

    public function setTva($tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getTtc()
    {
        return $this->ttc;
    }

    public function setTtc($ttc): self
    {
        $this->ttc = $ttc;

        return $this;
    }

    public function getDebutImput(): ?\DateTimeInterface
    {
        return $this->debutImput;
    }

    public function setDebutImput(?\DateTimeInterface $debutImput): self
    {
        $this->debutImput = $debutImput;

        return $this;
    }

    public function getFinImput(): ?\DateTimeInterface
    {
        return $this->finImput;
    }

    public function setFinImput(?\DateTimeInterface $finImput): self
    {
        $this->finImput = $finImput;

        return $this;
    }

    public function getDpBl(): ?Bail
    {
        return $this->dpBl;
    }

    public function setDpBl(?Bail $dpBl): self
    {
        $this->dpBl = $dpBl;

        return $this;
    }


}
