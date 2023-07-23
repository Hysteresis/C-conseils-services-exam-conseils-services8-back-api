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
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\SalaryCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaryCategoryRepository::class)]
#[ApiResource(
    
    description: 'Catégories des salaires',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),

    ], 
    normalizationContext: [
        'groups' => ['salaryCategory:read']
    ],
    denormalizationContext: [
        'groups' => ['salaryCategory:write']
    ],
)]
class SalaryCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['salaryCategory:read', 'salaryCategory:write', 'ad:read'])]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'salaryCategory', targetEntity: Salary::class)]
    #[Groups(['salaryCategory:read', 'salaryCategory:write', 'ad:read'])]
    private Collection $salaries;

    public function __construct()
    {
        $this->salaries = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Salary>
     */
    public function getSalaries(): Collection
    {
        return $this->salaries;
    }

    public function addSalary(Salary $salary): self
    {
        if (!$this->salaries->contains($salary)) {
            $this->salaries->add($salary);
            $salary->setSalaryCategory($this);
        }

        return $this;
    }

    public function removeSalary(Salary $salary): self
    {
        if ($this->salaries->removeElement($salary)) {
            // set the owning side to null (unless already changed)
            if ($salary->getSalaryCategory() === $this) {
                $salary->setSalaryCategory(null);
            }
        }

        return $this;
    }



}
