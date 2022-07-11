<?php

namespace App\Service;

use App\Entity\ResearchPlan;
use App\Entity\ResearchPlanSection;
use App\Repository\ResearchRequestRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class ResearchPlanUtils
{
    private EntityManagerInterface $entityManager;
    private ResearchRequestRepository $resReqRepo;
    //private array $checkErrors = [];

    public function __construct(
        EntityManagerInterface $entityManager,
        ResearchRequestRepository $resReqRepo/*, array $checkErrors*/
    ) {
        $this->entityManager = $entityManager;
        $this->resReqRepo = $resReqRepo;
        //$this->checkErrors = $checkErrors;
    }


    public function addResearchPlan(array $dataComponent): void
    {
        $researchRequest = $this->resReqRepo->findOneBy(['id' => $dataComponent['research-request-id']]);
        $creationDate = new DateTime("now");
        $researchPlan = new ResearchPlan();
        $researchPlanSection = new ResearchPlanSection();
        $entityManager = $this->entityManager;

        $researchPlan->setResearchRequest($researchRequest);
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
