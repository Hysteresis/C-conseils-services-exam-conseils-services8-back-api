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
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ApiResource(
   
    description: 'Toutes nos entreprises.',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),

        ],
    normalizationContext: [
        'groups' => ['company:read']
    ],
    denormalizationContext: [
        'groups' => ['company:write']
    ],

)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Recruiter::class)]
    #[Groups(['company:read', 'company:write', 'ad:read'])]
    private Collection $recruiters;

    #[ORM\Column(length: 255)]
    #[Groups(['company:read', 'company:write', 'ad:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company:read', 'company:write'])]
    private ?string $siret = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['company:read', 'company:write'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company:read', 'company:write'])]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company:read', 'company:write', 'ad:read'])]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company:read'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->recruiters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Recruiter>
     */
    public function getRecruiters(): Collection
    {
        return $this->recruiters;
    }

    public function addRecruiter(Recruiter $recruiter): self
    {
        if (!$this->recruiters->contains($recruiter)) {
            $this->recruiters->add($recruiter);
            $recruiter->setCompany($this);
        }

        return $this;
    }

    public function removeRecruiter(Recruiter $recruiter): self
    {
        if ($this->recruiters->removeElement($recruiter)) {
            // set the owning side to null (unless already changed)
            if ($recruiter->getCompany() === $this) {
                $recruiter->setCompany(null);
            }
        }

        return $this;
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

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function __toString():string
    {
        return $this->getName();
    }
}
