<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScanPieces
 *
 * @ORM\Table(name="scan_pieces", indexes={@ORM\Index(name="fk_sp_depense", columns={"sp_dp_id"}), @ORM\Index(name="fk_sp_bail", columns={"sp_bl_id"}), @ORM\Index(name="fk_appel_fonds", columns={"sp_af_id"})})
 * @ORM\Entity
 */
class ScanPieces
{
    /**
     * @var int
     *
     * @ORM\Column(name="sp_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $spId;

    /**
     * @var string
     *
     * @ORM\Column(name="NomFichier", type="string", length=50, nullable=false, options={"comment"="Pouvoir nommer le fichier meme si c'est pas comme ca qu'il est stocké"})
     */
    private $nomfichier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content_type", type="string", length=50, nullable=true, options={"comment"=" norme S-MIME"})
     */
    private $contentType;

    /**
     * @var \AppelFonds
     *
     * @ORM\ManyToOne(targetEntity="AppelFonds")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sp_af_id", referencedColumnName="af_id")
     * })
     */
    private $spAf;

    /**
     * @var \Bail
     *
     * @ORM\ManyToOne(targetEntity="Bail")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sp_bl_id", referencedColumnName="bl_id")
     * })
     */
    private $spBl;

    /**
     * @var \Depense
     *
     * @ORM\ManyToOne(targetEntity="Depense")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sp_dp_id", referencedColumnName="dp_id")
     * })
     */
    private $spDp;

    public function getSpId(): ?int
    {
        return $this->spId;
    }

    public function getNomfichier(): ?string
    {
        return $this->nomfichier;
    }

    public function setNomfichier(string $nomfichier): self
    {
        $this->nomfichier = $nomfichier;

        return $this;
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

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(?string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function getSpAf(): ?AppelFonds
    {
        return $this->spAf;
    }

    public function setSpAf(?AppelFonds $spAf): self
    {
        $this->spAf = $spAf;

        return $this;
    }

    public function getSpBl(): ?Bail
    {
        return $this->spBl;
    }

    public function setSpBl(?Bail $spBl): self
    {
        $this->spBl = $spBl;

        return $this;
    }

    public function getSpDp(): ?Depense
    {
        return $this->spDp;
    }

    public function setSpDp(?Depense $spDp): self
    {
        $this->spDp = $spDp;

        return $this;
    }


}
