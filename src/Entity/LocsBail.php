<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LocsBail
 *
 * @ORM\Table(name="locs_bail", indexes={@ORM\Index(name="fk_lc_bail", columns={"lc_bl_id"}), @ORM\Index(name="fk_cl_bail", columns={"lc_cl_id"})})
 * @ORM\Entity
 */
class LocsBail
{
    /**
     * @var int
     *
     * @ORM\Column(name="lc_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $lcId;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lc_cl_id", referencedColumnName="cl_id")
     * })
     */
    private $lcCl;

    /**
     * @var \Bail
     *
     * @ORM\ManyToOne(targetEntity="Bail")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lc_bl_id", referencedColumnName="bl_id")
     * })
     */
    private $lcBl;

    public function getLcId(): ?int
    {
        return $this->lcId;
    }

    public function getLcCl(): ?Client
    {
        return $this->lcCl;
    }

    public function setLcCl(?Client $lcCl): self
    {
        $this->lcCl = $lcCl;

        return $this;
    }

    public function getLcBl(): ?Bail
    {
        return $this->lcBl;
    }

    public function setLcBl(?Bail $lcBl): self
    {
        $this->lcBl = $lcBl;

        return $this;
    }


}
