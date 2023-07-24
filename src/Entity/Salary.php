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
use App\Repository\SalaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaryRepository::class)]
#[ApiResource(
    
    description: 'Différents types de salaires',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),

    ], 
    normalizationContext: [
        'groups' => ['salary:read']
    ],
    denormalizationContext: [
        'groups' => ['salary:write']
    ],
)]
class Salary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $amount = null;



    #[ORM\OneToMany(mappedBy: 'salary', targetEntity: Ad::class)]
    #[Groups(['salary:read'])]
    private Collection $ads;

    #[ORM\ManyToOne(inversedBy: 'salaries')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['salary:read', 'salary:write'])]
    private ?SalaryCategory $salaryCategory = null;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

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
            $ad->setSalary($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getSalary() === $this) {
                $ad->setSalary(null);
            }
        }

        return $this;
    }

    public function getSalaryCategory(): ?SalaryCategory
    {
        return $this->salaryCategory;
    }

    public function setSalaryCategory(?SalaryCategory $salaryCategory): self
    {
        $this->salaryCategory = $salaryCategory;

        return $this;
    }

    public function __toString()
    {
        return $this->amount;
    }
}
