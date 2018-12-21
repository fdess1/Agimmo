<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse", indexes={@ORM\Index(name="fk_ad_clt", columns={"ad_cl_id"})})
 * @ORM\Entity
 */
class Adresse
{
    /**
     * @var int
     *
     * @ORM\Column(name="ad_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $adId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_attention_de", type="string", length=50, nullable=true)
     */
    private $aAttentionDe;

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
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=true)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_pays", type="string", length=5, nullable=true, options={"default"="FR"})
     */
    private $codePays = 'FR';

    /**
     * @var string|null
     *
     * @ORM\Column(name="tel", type="string", length=20, nullable=true)
     */
    private $tel;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ad_cl_id", referencedColumnName="cl_id")
     * })
     */
    private $adCl;

    public function getAdId(): ?int
    {
        return $this->adId;
    }

    public function getAAttentionDe(): ?string
    {
        return $this->aAttentionDe;
    }

    public function setAAttentionDe(?string $aAttentionDe): self
    {
        $this->aAttentionDe = $aAttentionDe;

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

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePays(): ?string
    {
        return $this->codePays;
    }

    public function setCodePays(?string $codePays): self
    {
        $this->codePays = $codePays;

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

    public function getAdCl(): ?Client
    {
        return $this->adCl;
    }

    public function setAdCl(?Client $adCl): self
    {
        $this->adCl = $adCl;

        return $this;
    }


}
