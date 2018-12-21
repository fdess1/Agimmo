<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loyer
 *
 * @ORM\Table(name="loyer", indexes={@ORM\Index(name="fk_ly_bail", columns={"ly_bl_id"})})
 * @ORM\Entity
 */
class Loyer
{
    /**
     * @var int
     *
     * @ORM\Column(name="ly_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $lyId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mois_ref", type="date", nullable=false, options={"comment"="1er du mois/an de référence de la quittance"})
     */
    private $moisRef;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="date", nullable=false, options={"comment"="Date de début du loyer (pour que les loyers trimestriels puissent qd meme entrer)"})
     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false, options={"comment"="Date de fin du loyer (pour que les loyers trimestriels puissent qd meme entrer)"})
     */
    private $dateFin;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_appel", type="date", nullable=true, options={"comment"="Appelé le"})
     */
    private $dateAppel;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_exigibilite", type="date", nullable=true, options={"comment"="payable le "})
     */
    private $dateExigibilite;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_paiement", type="date", nullable=true, options={"comment"="Payé le "})
     */
    private $datePaiement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant_loyer", type="decimal", precision=5, scale=2, nullable=true, options={"comment"="Montant hors provisions pour charges"})
     */
    private $montantLoyer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prov_charges", type="decimal", precision=5, scale=2, nullable=true, options={"comment"="montant des provisions pour charge"})
     */
    private $provCharges;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant_verse", type="decimal", precision=5, scale=2, nullable=true, options={"comment"="(éventuel cumul) Montant verse"})
     */
    private $montantVerse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Reste_a_payer", type="decimal", precision=5, scale=2, nullable=true, options={"comment"="reste à verser pour acquît du loyer"})
     */
    private $resteAPayer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="declarant", type="string", length=10, nullable=true, options={"comment"="utilisateur de connexion ayant déclaré la reception de l'argent"})
     */
    private $declarant;

    /**
     * @var \Bail
     *
     * @ORM\ManyToOne(targetEntity="Bail")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ly_bl_id", referencedColumnName="bl_id")
     * })
     */
    private $lyBl;

    public function getLyId(): ?int
    {
        return $this->lyId;
    }

    public function getMoisRef(): ?\DateTimeInterface
    {
        return $this->moisRef;
    }

    public function setMoisRef(\DateTimeInterface $moisRef): self
    {
        $this->moisRef = $moisRef;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDateAppel(): ?\DateTimeInterface
    {
        return $this->dateAppel;
    }

    public function setDateAppel(?\DateTimeInterface $dateAppel): self
    {
        $this->dateAppel = $dateAppel;

        return $this;
    }

    public function getDateExigibilite(): ?\DateTimeInterface
    {
        return $this->dateExigibilite;
    }

    public function setDateExigibilite(?\DateTimeInterface $dateExigibilite): self
    {
        $this->dateExigibilite = $dateExigibilite;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(?\DateTimeInterface $datePaiement): self
    {
        $this->datePaiement = $datePaiement;

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

    public function getProvCharges()
    {
        return $this->provCharges;
    }

    public function setProvCharges($provCharges): self
    {
        $this->provCharges = $provCharges;

        return $this;
    }

    public function getMontantVerse()
    {
        return $this->montantVerse;
    }

    public function setMontantVerse($montantVerse): self
    {
        $this->montantVerse = $montantVerse;

        return $this;
    }

    public function getResteAPayer()
    {
        return $this->resteAPayer;
    }

    public function setResteAPayer($resteAPayer): self
    {
        $this->resteAPayer = $resteAPayer;

        return $this;
    }

    public function getDeclarant(): ?string
    {
        return $this->declarant;
    }

    public function setDeclarant(?string $declarant): self
    {
        $this->declarant = $declarant;

        return $this;
    }

    public function getLyBl(): ?Bail
    {
        return $this->lyBl;
    }

    public function setLyBl(?Bail $lyBl): self
    {
        $this->lyBl = $lyBl;

        return $this;
    }


}
