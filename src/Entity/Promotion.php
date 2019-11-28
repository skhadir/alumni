<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PromotionRepository")
 * @UniqueEntity(fields={"degree","year"}, message="Cette formation est déjà associée à cette année.")
 */
class Promotion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Degree", inversedBy="promotions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $degree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Year", inversedBy="promotions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $year;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="promotions")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $StartDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EndDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDegree(): ?Degree
    {
        return $this->degree;
    }

    public function setDegree(?Degree $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getYear(): ?Year
    {
        return $this->year;
    }

    public function setYear(?Year $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addPromotion($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removePromotion($this);
        }

        return $this;
    }

    public function getStartDate(): ?string
    {
        return $this->StartDate;
    }

    public function setStartDate(?string $StartDate): self
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->EndDate;
    }

    public function setEndDate(?string $EndDate): self
    {
        $this->EndDate = $EndDate;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }


}
