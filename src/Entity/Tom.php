<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tom
 *
 * @ORM\Table(name="tom", indexes={@ORM\Index(name="fk_tom_bien", columns={"tom_bn_id"}), @ORM\Index(name="fk_scan_pieces", columns={"tom_sp_id"})})
 * @ORM\Entity
 */
class Tom
{
    /**
     * @var int
     *
     * @ORM\Column(name="tom_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tomId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="annee", type="smallint", nullable=false, options={"unsigned"=true,"comment"=" annee de la taxe annuelle"})
     */
    private $annee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant", type="decimal", precision=10, scale=2, nullable=true, options={"comment"="montant de l'impot payé par le proprio a rembourser par le locataire"})
     */
    private $montant;

    /**
     * @var \ScanPieces
     *
     * @ORM\ManyToOne(targetEntity="ScanPieces")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tom_sp_id", referencedColumnName="sp_id")
     * })
     */
    private $tomSp;

    /**
     * @var \Bien
     *
     * @ORM\ManyToOne(targetEntity="Bien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tom_bn_id", referencedColumnName="bn_id")
     * })
     */
    private $tomBn;

    public function getTomId(): ?int
    {
        return $this->tomId;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant($montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getTomSp(): ?ScanPieces
    {
        return $this->tomSp;
    }

    public function setTomSp(?ScanPieces $tomSp): self
    {
        $this->tomSp = $tomSp;

        return $this;
    }

    public function getTomBn(): ?Bien
    {
        return $this->tomBn;
    }

    public function setTomBn(?Bien $tomBn): self
    {
        $this->tomBn = $tomBn;

        return $this;
    }


}
