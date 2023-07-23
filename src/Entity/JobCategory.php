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
use App\Repository\JobCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobCategoryRepository::class)]
#[ApiResource(
    
    description: 'Catégories des métiers.',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),

    ], 
    normalizationContext: [
        'groups' => ['category:read']
    ],
    denormalizationContext: [
        'groups' => ['category:write']
    ],

)]
class JobCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['category:read', 'category:write'])]
    private ?string $Title = null;

    #[ORM\OneToMany(mappedBy: 'jobCategory', targetEntity: JobList::class)]
    #[Groups(['category:read', 'category:write'])]
    private Collection $jobLists;

    public function __construct()
    {
        $this->jobLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    /**
     * @return Collection<int, JobList>
     */
    public function getJobLists(): Collection
    {
        return $this->jobLists;
    }

    public function addJobList(JobList $jobList): self
    {
        if (!$this->jobLists->contains($jobList)) {
            $this->jobLists->add($jobList);
            $jobList->setJobCategory($this);
        }

        return $this;
    }

    public function removeJobList(JobList $jobList): self
    {
        if ($this->jobLists->removeElement($jobList)) {
            // set the owning side to null (unless already changed)
            if ($jobList->getJobCategory() === $this) {
                $jobList->setJobCategory(null);
            }
        }

        return $this;
    }
}
