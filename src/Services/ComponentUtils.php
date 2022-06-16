<?php

namespace App\Services;

use App\Entity\Answer;
use App\Entity\ComponentEvaluationScale;
use App\Entity\ResearchTemplate;
use App\Entity\TemplateComponent;
use Doctrine\Persistence\ManagerRegistry;

class ComponentUtils
{
    private ManagerRegistry $doctrine;
    private array $checkErrors = [];

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getCheckErrors(): array
    {
        return $this->checkErrors;
    }

    public function loadEvaluationScale(array $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $evalScaleComponent = new ComponentEvaluationScale();

        $dataAnswers = [];
        for ($loop = 1; $loop < 6; $loop++) {
            $dataAnswers[] = $dataComponent['evaluation-scale-rate-' . $loop];
        }

        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'All fields are mandatory.';
            }
        }

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (strlen($dataComponent['low-label']) > 255) {
            $this->checkErrors[] = 'Maximum length for low label is 255 characters.';
        }

        if (strlen($dataComponent['high-label']) > 255) {
            $this->checkErrors[] = 'Maximum length for high label is 255 characters.';
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->doctrine->getManager();

            $evalScaleComponent->setName($dataComponent['name']);
            $evalScaleComponent->setQuestion($dataComponent['question']);
            $evalScaleComponent->setLowLabel($dataComponent['low-label']);
            $evalScaleComponent->setHighLabel($dataComponent['high-label']);
            $evalScaleComponent->setIsMultiple($dataComponent['is_multiple']);
            $evalScaleComponent->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->persist($evalScaleComponent);

            $orderAnswer = 0;
            foreach ($dataAnswers as $dataAnswer) {
                $answer = new Answer();
                $answer->setAnswer($dataAnswer);
                $answer->setQuestion($evalScaleComponent);
                $answer->setNumberOrder(++$orderAnswer);
                $entityManager->persist($answer);
            }

            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($evalScaleComponent);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }
}
