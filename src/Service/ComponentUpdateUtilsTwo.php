<?php

namespace App\Service;

use App\Repository\AnswerRepository;
use App\Repository\SingleChoiceRepository;
use Doctrine\ORM\EntityManagerInterface;

class ComponentUpdateUtilsTwo
{
    private array $checkErrors = [];
    private CheckDataUtils $checkDataUtils;
    private EntityManagerInterface $entityManager;
    private SingleChoiceRepository $singleChoiceRepo;
    private RetrieveAnswers $retrieveAnswers;
    private AnswerRepository $answerRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        CheckDataUtils $checkDataUtils,
        SingleChoiceRepository $singleChoiceRepo,
        RetrieveAnswers $retrieveAnswers,
        AnswerRepository $answerRepository,
    ) {
        $this->entityManager = $entityManager;
        $this->checkDataUtils = $checkDataUtils;
        $this->singleChoiceRepo = $singleChoiceRepo;
        $this->retrieveAnswers = $retrieveAnswers;
        $this->answerRepository = $answerRepository;
    }

    public function loadUpdateSingleChoice(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $singleChoice = $this->singleChoiceRepo->find($id);
        $answerUpdate = $this->answerRepository->findBy(['question' => $singleChoice]);
        $answersUpdateValue = $this->retrieveAnswers->retrieveUpdateAnswers($dataComponent);
        $this->checkErrors = $this->checkDataUtils
        ->checkDataSingleAndMultipleChoice($dataComponent, $answersUpdateValue);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $singleChoice->setName($dataComponent['name']);
            $singleChoice->setQuestion($dataComponent['question']);
            $singleChoice->setIsMandatory($dataComponent['is_mandatory']);

            $inputAnswerNumber  = $dataComponent['input-answer-count'];
            for ($i = 0; $i < $inputAnswerNumber; $i++) {
                $answerUpdate[$i]->setAnswer($answersUpdateValue[$i]);
            }
            $entityManager->flush();
        }
    }


/*     public function loadUpdateMultipleChoice(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $multipleChoice = $this->multipleChoiceRepo->find($id);
        $answersValue = $this->retrieveAnswers->retrieveAnswersMultiple($dataComponent);
        $this->checkErrors = $this->checkDataUtils->checkDataSingleAndMultipleChoice($dataComponent, $answersValue);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->entityManager;

            $multipleChoice->setQuestion($dataComponent['question']);
            $multipleChoice->setIsMandatory($dataComponent['is_mandatory']);
            $multipleChoice->setName($dataComponent['name']);
            $entityManager->persist($multipleChoice); */
/*             foreach ($answersValue as $answerValue) {
                $answer = $this->answerRepository->getId();
                $answer->setAnswer($answerValue);
            } */
/*             $orderAnswer = 0;
            foreach ($answersValue as $answerValue) {
                    $answer = new Answer();
                    $answer->setAnswer($answerValue);
                    $answer->setQuestion($multipleChoice);
                    $answer->setNumberOrder(++$orderAnswer);
                    $entityManager->persist($answer);
            }
            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($multipleChoice);
            $templateComponent->setNumberOrder(count($researchTemplate->getTemplateComponents()) + 1);
            $entityManager->persist($templateComponent); */

/*             $entityManager->flush();
        }
    } */
}
