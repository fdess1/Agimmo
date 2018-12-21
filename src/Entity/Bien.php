<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bien
 *
 * @ORM\Table(name="bien", indexes={@ORM\Index(name="fk_proprio", columns={"bn_id_proprio"})})
 * @ORM\Entity
 */
class Bien
{
    /**
     * @var int
     *
     * @ORM\Column(name="bn_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bnId;

    /**
     * @var int
     * @ORM\Column(name="bn_id_proprio", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $bnidproprio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bn_type", type="string", length=5, nullable=true, options={"comment"="type de bien"})
     */
    private $bnType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_usage", type="string", length=50, nullable=true, options={"comment"="Nom d'usage du bien"})
     */
    private $nomUsage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descr_acces", type="string", length=300, nullable=true, options={"comment"="Descriptif d'acces pour la Poste, les livreurs..."})
     */
    private $descrAcces;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ad1", type="string", length=50, nullable=true)
     */
    private $ad1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ad2", type="string", length=50, nullable=true)
     */
    private $ad2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ad3", type="string", length=50, nullable=true)
     */
    private $ad3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cp", type="string", length=10, nullable=true, options={"comment"="code postal"})
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="code_pays", type="string", length=5, nullable=false, options={"default"="FR"})
     */
    private $codePays = 'FR';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surface_habitable", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $surfaceHabitable;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbloyes_par_an", type="integer", nullable=true, options={"comment"="Nb de loyers par an (12 pour un loyer mensuel)"})
     */
    private $nbloyesParAn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_chauffage", type="string", length=20, nullable=true)
     */
    private $typeChauffage;
    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=50, nullable=true)
     */
    private $photo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="haut_debit", type="string", length=20, nullable=true, options={"comment"="ADSL|FIBRE|CABLE"})
     */
    private $hautDebit;

    public function getBnId(): ?int
    {
        return $this->bnId;
    }
    public function getBnidProprio(): ?int    {
        return $this->bnidproprio;
    }
    public function setBnidProprio(?int $idproprio): self    {
        $this->bnidproprio = $idproprio;
        return $this;
    }

    public function setBnType(?string $bnType): self
    {
        $this->bnType = $bnType;

        return $this;
    }
    public function getBnType(): ?string
    {
        return $this->bnType;
    }

    public function getNomUsage(): ?string
    {
        return $this->nomUsage;
    }

    public function setNomUsage(?string $nomUsage): self
    {
        $this->nomUsage = $nomUsage;

        return $this;
    }

    public function getDescrAcces(): ?string
    {
        return $this->descrAcces;
    }

    public function setDescrAcces(?string $descrAcces): self
    {
        $this->descrAcces = $descrAcces;

        return $this;
    }

    public function getAd1(): ?string
    {
        return $this->ad1;
    }

    public function setAd1(?string $ad1): self
    {
        $this->ad1 = $ad1;

        return $this;
    }

    public function getAd2(): ?string
    {
        return $this->ad2;
    }

    public function setAd2(?string $ad2): self
    {
        $this->ad2 = $ad2;

        return $this;
    }

    public function getAd3(): ?string
    {
        return $this->ad3;
    }

    public function setAd3(?string $ad3): self
    {
        $this->ad3 = $ad3;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePays(): ?string
    {
        return $this->codePays;
    }

    public function setCodePays(string $codePays): self
    {
        $this->codePays = $codePays;

        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getSurfaceHabitable()
    {
        return $this->surfaceHabitable;
    }

    public function setSurfaceHabitable($surfaceHabitable): self
    {
        $this->surfaceHabitable = $surfaceHabitable;

        return $this;
    }

    public function getNbloyesParAn(): ?int
    {
        return $this->nbloyesParAn;
    }

    public function setNbloyesParAn(?int $nbloyesParAn): self
    {
        $this->nbloyesParAn = $nbloyesParAn;

        return $this;
    }

    public function getTypeChauffage(): ?string
    {
        return $this->typeChauffage;
    }

    public function setTypeChauffage(?string $typeChauffage): self
    {
        $this->typeChauffage = $typeChauffage;

        return $this;
    }

    public function getHautDebit(): ?string
    {
        return $this->hautDebit;
    }

    public function setHautDebit(?string $hautDebit): self
    {
        $this->hautDebit = $hautDebit;

        return $this;
    }
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
    /**
     * @ORM\OneToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bn_id_proprio", referencedColumnName="cl_id")
     * })
     */
    private $proprietaire;

    public function getProprietaire(): ?Client
    {
        return $this->proprietaire;
    }
    public function setProprietaire(?Client $proprio): self
    {
        $this->proprietaire = $proprio;

        return $this;
    }
}
