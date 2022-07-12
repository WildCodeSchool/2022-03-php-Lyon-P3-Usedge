<?php

namespace App\Service;

use App\Entity\ResearchPlan;
use App\Entity\ResearchPlanSection;
use App\Entity\ResearchRequest;
use App\Repository\ResearchRequestRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class ResearchPlanUtils
{
    private EntityManagerInterface $entityManager;
    private ResearchRequestRepository $resReqRepo;
    private array $checkErrors = [];

    public function __construct(
        EntityManagerInterface $entityManager,
        ResearchRequestRepository $resReqRepo,
    ) {
        $this->entityManager = $entityManager;
        $this->resReqRepo = $resReqRepo;
    }

    public function getCheckErrors(): array
    {
        return $this->checkErrors;
    }

    public function researchPlanCheckLength(array $dataComponent): void
    {
        if (strlen($dataComponent['research-request-coach']) > 255) {
            $this->checkErrors[] = "The coach field exceed 255 characters.";
        }

        if (strlen($dataComponent['research-request-status']) > 255) {
            $this->checkErrors[] = "The status field exceed 255 characters.";
        }

        if (strlen($dataComponent['research-plan-title']) > 255) {
            $this->checkErrors[] = "The title field exceed 255 characters.";
        }

        if (strlen($dataComponent['workshop_name']) > 255) {
            $this->checkErrors[] = "The workshop name field exceed 255 characters.";
        }
    }

    public function researchPlanCheckEmpty(array $dataComponent): void
    {
        if (empty($dataComponent['workshop_description'])) {
            $this->checkErrors[] = "The workshop description field is mandatory";
        }

        if (empty($dataComponent['research-plan-recommendation'])) {
            $this->checkErrors[] = "The recommendation field is mandatory";
        }

        if (empty($dataComponent['research-request-coach'])) {
            $this->checkErrors[] = "The coach field is mandatory";
        }

        if (empty($dataComponent['research-request-status'])) {
            $this->checkErrors[] = "The status field is mandatory";
        }

        if (empty($dataComponent['workshop_name'])) {
            $this->checkErrors[] = "The workshop name field is mandatory";
        }

        if (empty($dataComponent['research-plan-title'])) {
            $this->checkErrors[] = "The title field is mandatory";
        }
    }

    public function addResearchPlan(array $dataComponent): void
    {
        $researchRequest = $this->resReqRepo->findOneBy(['id' => $dataComponent['research-request-id']]);
        $creationDate = new DateTime("now");
        $researchPlan = new ResearchPlan();
        $researchPlanSection = new ResearchPlanSection();
        $entityManager = $this->entityManager;

        if ($researchRequest instanceof ResearchRequest) {
            $researchRequest->setStatus('Under review');
            $entityManager->persist($researchRequest);
        }

        if ($researchRequest instanceof ResearchRequest) {
            $researchPlan->setResearchRequest($researchRequest);
        }
        $researchPlan->setCoach($dataComponent['research-request-coach']);
        $researchPlan->setStatus($dataComponent['research-request-status']);
        $researchPlan->setCreationDate($creationDate);
        $entityManager->persist($researchPlan);

        $researchPlanSection->setTitle($dataComponent['research-plan-title']);
        $researchPlanSection->setWorkshopName($dataComponent['workshop_name']);
        $researchPlanSection->setWorkshopDescription($dataComponent['workshop_description']);
        $researchPlanSection->setRecommendation($dataComponent['research-plan-recommendation']);
        $researchPlanSection->setResearchPlan($researchPlan);
        $entityManager->persist($researchPlanSection);

        $entityManager->flush();
    }
}
