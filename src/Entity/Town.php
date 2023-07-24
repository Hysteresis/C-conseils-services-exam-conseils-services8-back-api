<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Operations;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\TownRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TownRepository::class)]
#[ApiResource(
    
    description: 'Liste des villes',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),

    ],
    normalizationContext: [
        'groups' => ['towns:read']
    ],
    denormalizationContext: [
        'groups' => ['towns:write']
    ],
)]
class Town
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['towns:read', 'towns:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['towns:read', 'towns:write'])]
    private ?string $zipCode = null;

    #[ORM\ManyToOne(inversedBy: 'towns')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['towns:read', 'towns:write'])]
    private ?Department $departmentTown = null;

    #[ORM\OneToMany(mappedBy: 'town', targetEntity: Ad::class)]
    #[Groups(['towns:read', 'towns:write'])]
    private Collection $ads;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getDepartmentTown(): ?Department
    {
        return $this->departmentTown;
    }

    public function setDepartmentTown(?Department $departmentTown): self
    {
        $this->departmentTown = $departmentTown;

        return $this;
    }

    /**
     * @return Collection<int, Ad>
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads->add($ad);
            $ad->setTown($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getTown() === $this) {
                $ad->setTown(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}
