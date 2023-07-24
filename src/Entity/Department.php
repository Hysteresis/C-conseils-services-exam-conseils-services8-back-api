<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Operations;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
#[ApiResource(
   
    description: 'Liste des départements.',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),

                ],
        normalizationContext: [
            'groups' => ['department:read']
        ],
        denormalizationContext: [
            'groups' => ['department:write']
        ],
)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['department:read', 'department:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['department:read', 'department:write'])]
    private ?string $number = null;

    #[ORM\Column(length: 255)]
    #[Groups(['department:read', 'department:write'])]
    private ?string $departmentUppercase = null;

    #[ORM\OneToMany(mappedBy: 'departmentTown', targetEntity: Town::class)]
    #[Groups(['department:read', 'department:write','ad:read'])]
    private Collection $towns;

    public function __construct()
    {
        $this->towns = new ArrayCollection();
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

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDepartmentUppercase(): ?string
    {
        return $this->departmentUppercase;
    }

    public function setDepartmentUppercase(string $departmentUppercase): self
    {
        $this->departmentUppercase = $departmentUppercase;

        return $this;
    }

    /**
     * @return Collection<int, Town>
     */
    public function getTowns(): Collection
    {
        return $this->towns;
    }

    public function addTown(Town $town): self
    {
        if (!$this->towns->contains($town)) {
            $this->towns->add($town);
            $town->setDepartmentTown($this);
        }

        return $this;
    }

    public function removeTown(Town $town): self
    {
        if ($this->towns->removeElement($town)) {
            // set the owning side to null (unless already changed)
            if ($town->getDepartmentTown() === $this) {
                $town->setDepartmentTown(null);
            }
        }

        return $this;
    }
}
