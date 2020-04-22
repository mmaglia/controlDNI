<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControladoRepository")
 */
class Controlado
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dni;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BlackList", mappedBy="controlado")
     */
    private $blackList;

    public function __construct()
    {
        $this->blackList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(int $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @return Collection|BlackList[]
     */
    public function getBlackList(): Collection
    {
        return $this->blackList;
    }

    public function addBlackList(BlackList $blackList): self
    {
        if (!$this->blackList->contains($blackList)) {
            $this->blackList[] = $blackList;
            $blackList->setControlado($this);
        }

        return $this;
    }

    public function removeBlackList(BlackList $blackList): self
    {
        if ($this->blackList->contains($blackList)) {
            $this->blackList->removeElement($blackList);
            // set the owning side to null (unless already changed)
            if ($blackList->getControlado() === $this) {
                $blackList->setControlado(null);
            }
        }

        return $this;
    }
}
