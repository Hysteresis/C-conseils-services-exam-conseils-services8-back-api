<?php

namespace App\Entity;

// use ApiPlatform\Core\Annotation\ApiResource;

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
use App\Repository\AdRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdRepository::class)]
#[ApiResource(
    shortName: 'Ad' ,
    description: 'Toutes nos annonces.',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),

    ],
    normalizationContext: [
        'groups' => ['ad:read']
    ],
    denormalizationContext: [
        'groups' => ['ad:write']
    ],
    )]
class Ad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ad:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ads')]
    #[Groups(['ad:read', 'ad:write'])]
    private ?Town $town = null;

    #[ORM\ManyToOne(inversedBy: 'ads')]
    #[Groups(['ad:read', 'ad:write'])]
    private ?Salary $salary = null;

    #[ORM\ManyToOne(inversedBy: 'ads')]
    #[Groups(['ad:read', 'ad:write'])]
    private ?JobList $job = null;

    #[ORM\ManyToOne(inversedBy: 'ads')]
    #[Groups(['ad:read', 'ad:write'])]
    private ?Recruiter $recruiter = null;

    #[ORM\ManyToOne(inversedBy: 'ads')]
    #[Groups(['ad:read', 'ad:write'])]
    private ?EmploymentContract $employmentContract = null;

    #[ORM\ManyToOne(inversedBy: 'ads')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['ad:read'])]
    private ?Degree $degree = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ad:read', 'ad:write'])]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ad:read', 'ad:write'])]
    private ?string $numberAd = null;

    #[ORM\Column]
    #[Groups(['ad:read', 'ad:write'])]
    private ?bool $isVerified = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ad:read', 'ad:write'])]
    private ?string $title = null;

    #[ORM\Column]
    #[Groups(['ad:read', 'ad:write'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['ad:read', 'ad:write'])]
    private ?\DateTimeImmutable $modifiedAt = null;

    #[ORM\Column]
    #[Groups(['ad:read', 'ad:write'])]
    private ?bool $isClosed = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['ad:read', 'ad:write'])]
    private ?\DateTimeInterface $contractStartDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['ad:read', 'ad:write'])]
    private ?string $duration = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['ad:read', 'ad:write'])]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'ad', targetEntity: AnswerAd::class)]
    #[Groups(['ad:read', 'ad:write'])]
    private Collection $answerAds;

    public function __construct()
    {
        $this->answerAds = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTown(): ?Town
    {
        return $this->town;
    }

    public function setTown(?Town $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getSalary(): ?Salary
    {
        return $this->salary;
    }

    public function setSalary(?Salary $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getJob(): ?JobList
    {
        return $this->job;
    }

    public function setJob(?JobList $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getRecruiter(): ?Recruiter
    {
        return $this->recruiter;
    }

    public function setRecruiter(?Recruiter $recruiter): self
    {
        $this->recruiter = $recruiter;

        return $this;
    }

    public function getEmploymentContract(): ?EmploymentContract
    {
        return $this->employmentContract;
    }

    public function setEmploymentContract(?EmploymentContract $employmentContract): self
    {
        $this->employmentContract = $employmentContract;

        return $this;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getNumberAd(): ?string
    {
        return $this->numberAd;
    }

    public function setNumberAd(string $numberAd): self
    {
        $this->numberAd = $numberAd;

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeImmutable $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function isIsClosed(): ?bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): self
    {
        $this->isClosed = $isClosed;

        return $this;
    }

    public function getContractStartDate(): ?\DateTimeInterface
    {
        return $this->contractStartDate;
    }

    public function setContractStartDate(?\DateTimeInterface $contractStartDate): self
    {
        $this->contractStartDate = $contractStartDate;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

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

    /**
     * @return Collection<int, AnswerAd>
     */
    public function getAnswerAds(): Collection
    {
        return $this->answerAds;
    }

    public function addAnswerAd(AnswerAd $answerAd): self
    {
        if (!$this->answerAds->contains($answerAd)) {
            $this->answerAds->add($answerAd);
            $answerAd->setAd($this);
        }

        return $this;
    }

    public function removeAnswerAd(AnswerAd $answerAd): self
    {
        if ($this->answerAds->removeElement($answerAd)) {
            // set the owning side to null (unless already changed)
            if ($answerAd->getAd() === $this) {
                $answerAd->setAd(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }
}
