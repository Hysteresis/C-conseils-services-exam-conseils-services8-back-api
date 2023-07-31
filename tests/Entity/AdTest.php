<?php
namespace App\Tests\Entity;

use App\Entity\Ad;
use App\Entity\Town;
use App\Entity\Salary;
use App\Entity\JobList;
use App\Entity\Recruiter;
use App\Entity\EmploymentContract;
use App\Entity\Degree;
use PHPUnit\Framework\TestCase;

class AdTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $ad = new Ad();

        $town = new Town();
        $salary = new Salary();
        $job = new JobList();
        $recruiter = new Recruiter();
        $employmentContract = new EmploymentContract();
        $degree = new Degree();

        $this->assertNull($ad->getId());

        $ad->setTown($town);
        $this->assertSame($town, $ad->getTown());

        $ad->setSalary($salary);
        $this->assertSame($salary, $ad->getSalary());

        $ad->setJob($job);
        $this->assertSame($job, $ad->getJob());

        $ad->setRecruiter($recruiter);
        $this->assertSame($recruiter, $ad->getRecruiter());

        $ad->setEmploymentContract($employmentContract);
        $this->assertSame($employmentContract, $ad->getEmploymentContract());

        $ad->setDegree($degree);
        $this->assertSame($degree, $ad->getDegree());

        $ad->setSlug('job-ad-slug');
        $this->assertEquals('job-ad-slug', $ad->getSlug());

        $ad->setNumberAd('AD123');
        $this->assertEquals('AD123', $ad->getNumberAd());

        $ad->setIsVerified(true);
        $this->assertTrue($ad->isIsVerified());

        $ad->setTitle('Job Opening');
        $this->assertEquals('Job Opening', $ad->getTitle());

        $createdAt = new \DateTimeImmutable();
        $ad->setCreatedAt($createdAt);
        $this->assertSame($createdAt, $ad->getCreatedAt());

        $modifiedAt = new \DateTimeImmutable();
        $ad->setModifiedAt($modifiedAt);
        $this->assertSame($modifiedAt, $ad->getModifiedAt());

        $ad->setIsClosed(true);
        $this->assertTrue($ad->isIsClosed());

        $contractStartDate = new \DateTime();
        $ad->setContractStartDate($contractStartDate);
        $this->assertSame($contractStartDate, $ad->getContractStartDate());

        $ad->setDuration('Full-time');
        $this->assertEquals('Full-time', $ad->getDuration());

        $ad->setDescription('Job description...');
        $this->assertEquals('Job description...', $ad->getDescription());
    }


    public function testToString(): void
    {
        $ad = new Ad();
        $ad->setTitle('Job Opening');

        $this->assertEquals('Job Opening', $ad->__toString());
    }
}