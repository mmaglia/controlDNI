<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListaControlRepository")
 */
class ListaControl
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BlackList", mappedBy="listaControl")
     */
    private $blackLists;

    public function __construct()
    {
        $this->blackLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection|BlackList[]
     */
    public function getBlackLists(): Collection
    {
        return $this->blackLists;
    }

    public function addBlackList(BlackList $blackList): self
    {
        if (!$this->blackLists->contains($blackList)) {
            $this->blackLists[] = $blackList;
            $blackList->setListaControl($this);
        }

        return $this;
    }

    public function removeBlackList(BlackList $blackList): self
    {
        if ($this->blackLists->contains($blackList)) {
            $this->blackLists->removeElement($blackList);
            // set the owning side to null (unless already changed)
            if ($blackList->getListaControl() === $this) {
                $blackList->setListaControl(null);
            }
        }

        return $this;
    }
}
