<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bail
 *
 * @ORM\Table(name="bail", indexes={@ORM\Index(name="fk_bien", columns={"bl_id_bien"})})
 * @ORM\Entity
 */
class Bail
{
    /**
     * @var int
     *
     * @ORM\Column(name="bl_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $blId;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="bl_meuble", type="boolean", nullable=true)
     */
    private $blMeuble;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bl_type", type="string", length=5, nullable=true, options={"comment"="type de bail, 3/6/9, 3 ans autorenouvelable...)"})
     */
    private $blType;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dsigne_le", type="date", nullable=true, options={"comment"="date de signature du bail"})
     */
    private $dsigneLe;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dprise_effet", type="date", nullable=true, options={"comment"="date de prise d'effet du bail"})
     */
    private $dpriseEffet;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dureeM", type="integer", nullable=true, options={"comment"="duree du bail (en mois)"})
     */
    private $dureem;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ddebut", type="date", nullable=true, options={"comment"="date de debut du bail courant"})
     */
    private $ddebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dfin", type="date", nullable=true, options={"comment"="date de debut du bail courant"})
     */
    private $dfin;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dcree_le", type="datetime", nullable=true)
     */
    private $dcreeLe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cree_par", type="string", length=10, nullable=true)
     */
    private $creePar;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dmodifie_le", type="datetime", nullable=true)
     */
    private $dmodifieLe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="modifie_par", type="string", length=10, nullable=true)
     */
    private $modifiePar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant_loyer", type="decimal", precision=10, scale=0, nullable=true, options={"comment"="montant loyer actuel"})
     */
    private $montantLoyer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payable_le", type="string", length=5, nullable=true, options={"comment"="Ordre du jour de paiement : 5 pour le 5 du mois"})
     */
    private $payableLe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant_loyer1", type="decimal", precision=10, scale=0, nullable=true, options={"comment"="montant premier loyer lors de la signature du bail"})
     */
    private $montantLoyer1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant_loyerAvantBail", type="decimal", precision=10, scale=0, nullable=true, options={"comment"="montant loyer du locataire précédent"})
     */
    private $montantLoyeravantbail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="depot_garantie", type="decimal", precision=10, scale=0, nullable=true, options={"comment"="depot de garantie"})
     */
    private $depotGarantie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dIRL", type="decimal", precision=10, scale=0, nullable=true, options={"comment"="Indice de reference du dIRL debut de bail"})
     */
    private $dirl;

    /**
     * @var int|null
     *
     * @ORM\Column(name="DTrm", type="integer", nullable=true, options={"comment"="trimestre de reference du dIRL debutde bail"})
     */
    private $dtrm;

    /**
     * @var int|null
     *
     * @ORM\Column(name="DAnnee", type="integer", nullable=true, options={"comment"="Annee de reference du DIRL"})
     */
    private $dannee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cIRL", type="decimal", precision=10, scale=0, nullable=true, options={"comment"="IRL courant qui a servi a la derniere revalo"})
     */
    private $cirl;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cTrm", type="integer", nullable=true, options={"comment"="trimestre de reference cIRL"})
     */
    private $ctrm;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAnnee", type="integer", nullable=true, options={"comment"="Annee de reference du cIRL"})
     */
    private $cannee;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ddernRevisonLoy", type="date", nullable=true, options={"comment"="Date de derniere révision du loyer"})
     */
    private $ddernrevisonloy;

    /**
     * @var \Bien
     *
     * @ORM\ManyToOne(targetEntity="Bien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bl_id_bien", referencedColumnName="bn_id")
     * })
     */
    private $blBien;

    public function getBlId(): ?int
    {
        return $this->blId;
    }

    public function getBlMeuble(): ?bool
    {
        return $this->blMeuble;
    }

    public function setBlMeuble(?bool $blMeuble): self
    {
        $this->blMeuble = $blMeuble;

        return $this;
    }

    public function getBlType(): ?string
    {
        return $this->blType;
    }

    public function setBlType(?string $blType): self
    {
        $this->blType = $blType;

        return $this;
    }

    public function getDsigneLe(): ?\DateTimeInterface
    {
        return $this->dsigneLe;
    }

    public function setDsigneLe(?\DateTimeInterface $dsigneLe): self
    {
        $this->dsigneLe = $dsigneLe;

        return $this;
    }

    public function getDpriseEffet(): ?\DateTimeInterface
    {
        return $this->dpriseEffet;
    }

    public function setDpriseEffet(?\DateTimeInterface $dpriseEffet): self
    {
        $this->dpriseEffet = $dpriseEffet;

        return $this;
    }

    public function getDureem(): ?int
    {
        return $this->dureem;
    }

    public function setDureem(?int $dureem): self
    {
        $this->dureem = $dureem;

        return $this;
    }

    public function getDdebut(): ?\DateTimeInterface
    {
        return $this->ddebut;
    }

    public function setDdebut(?\DateTimeInterface $ddebut): self
    {
        $this->ddebut = $ddebut;

        return $this;
    }

    public function getDfin(): ?\DateTimeInterface
    {
        return $this->dfin;
    }

    public function setDfin(?\DateTimeInterface $dfin): self
    {
        $this->dfin = $dfin;

        return $this;
    }

    public function getDcreeLe(): ?\DateTimeInterface
    {
        return $this->dcreeLe;
    }

    public function setDcreeLe(?\DateTimeInterface $dcreeLe): self
    {
        $this->dcreeLe = $dcreeLe;

        return $this;
    }

    public function getCreePar(): ?string
    {
        return $this->creePar;
    }

    public function setCreePar(?string $creePar): self
    {
        $this->creePar = $creePar;

        return $this;
    }

    public function getDmodifieLe(): ?\DateTimeInterface
    {
        return $this->dmodifieLe;
    }

    public function setDmodifieLe(?\DateTimeInterface $dmodifieLe): self
    {
        $this->dmodifieLe = $dmodifieLe;

        return $this;
    }

    public function getModifiePar(): ?string
    {
        return $this->modifiePar;
    }

    public function setModifiePar(?string $modifiePar): self
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    public function getMontantLoyer()
    {
        return $this->montantLoyer;
    }

    public function setMontantLoyer($montantLoyer): self
    {
        $this->montantLoyer = $montantLoyer;

        return $this;
    }

    public function getPayableLe(): ?string
    {
        return $this->payableLe;
    }

    public function setPayableLe(?string $payableLe): self
    {
        $this->payableLe = $payableLe;

        return $this;
    }

    public function getMontantLoyer1()
    {
        return $this->montantLoyer1;
    }

    public function setMontantLoyer1($montantLoyer1): self
    {
        $this->montantLoyer1 = $montantLoyer1;

        return $this;
    }

    public function getMontantLoyeravantbail()
    {
        return $this->montantLoyeravantbail;
    }

    public function setMontantLoyeravantbail($montantLoyeravantbail): self
    {
        $this->montantLoyeravantbail = $montantLoyeravantbail;

        return $this;
    }

    public function getDepotGarantie()
    {
        return $this->depotGarantie;
    }

    public function setDepotGarantie($depotGarantie): self
    {
        $this->depotGarantie = $depotGarantie;

        return $this;
    }

    public function getDirl()
    {
        return $this->dirl;
    }

    public function setDirl($dirl): self
    {
        $this->dirl = $dirl;

        return $this;
    }

    public function getDtrm(): ?int
    {
        return $this->dtrm;
    }

    public function setDtrm(?int $dtrm): self
    {
        $this->dtrm = $dtrm;

        return $this;
    }

    public function getDannee(): ?int
    {
        return $this->dannee;
    }

    public function setDannee(?int $dannee): self
    {
        $this->dannee = $dannee;

        return $this;
    }

    public function getCirl()
    {
        return $this->cirl;
    }

    public function setCirl($cirl): self
    {
        $this->cirl = $cirl;

        return $this;
    }

    public function getCtrm(): ?int
    {
        return $this->ctrm;
    }

    public function setCtrm(?int $ctrm): self
    {
        $this->ctrm = $ctrm;

        return $this;
    }

    public function getCannee(): ?int
    {
        return $this->cannee;
    }

    public function setCannee(?int $cannee): self
    {
        $this->cannee = $cannee;

        return $this;
    }

    public function getDdernrevisonloy(): ?\DateTimeInterface
    {
        return $this->ddernrevisonloy;
    }

    public function setDdernrevisonloy(?\DateTimeInterface $ddernrevisonloy): self
    {
        $this->ddernrevisonloy = $ddernrevisonloy;

        return $this;
    }

    public function getBlBien(): ?Bien
    {
        return $this->blBien;
    }

    public function setBlBien(?Bien $blBien): self
    {
        $this->blBien = $blBien;

        return $this;
    }


}
