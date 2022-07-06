<?php

namespace App\Service;

use App\Repository\AnswerRepository;
use App\Repository\MultipleChoiceRepository;
use App\Repository\OpenQuestionRepository;
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
    private MultipleChoiceRepository $multipleChoiceRepo;
    private OpenQuestionRepository $openQuestionRepo;

    public function __construct(
        EntityManagerInterface $entityManager,
        CheckDataUtils $checkDataUtils,
        SingleChoiceRepository $singleChoiceRepo,
        RetrieveAnswers $retrieveAnswers,
        AnswerRepository $answerRepository,
        MultipleChoiceRepository $multipleChoiceRepo,
        OpenQuestionRepository $openQuestionRepo,
    ) {
        $this->entityManager = $entityManager;
        $this->checkDataUtils = $checkDataUtils;
        $this->singleChoiceRepo = $singleChoiceRepo;
        $this->retrieveAnswers = $retrieveAnswers;
        $this->answerRepository = $answerRepository;
        $this->multipleChoiceRepo = $multipleChoiceRepo;
        $this->openQuestionRepo = $openQuestionRepo;
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

    public function loadUpdateMultipleChoice(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $multipleChoice = $this->multipleChoiceRepo->find($id);
        $answerUpdate = $this->answerRepository->findBy(['question' => $multipleChoice]);
        $answersUpdateValue = $this->retrieveAnswers->retrieveUpdateAnswers($dataComponent);
        $this->checkErrors = $this->checkDataUtils
        ->checkDataSingleAndMultipleChoice($dataComponent, $answersUpdateValue);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $multipleChoice->setName($dataComponent['name']);
            $multipleChoice->setQuestion($dataComponent['question']);
            $multipleChoice->setIsMandatory($dataComponent['is_mandatory']);

            $inputAnswerNumber  = $dataComponent['input-answer-count'];
            for ($i = 0; $i < $inputAnswerNumber; $i++) {
                $answerUpdate[$i]->setAnswer($answersUpdateValue[$i]);
            }
            $entityManager->flush();
        }
    }

    public function loadUpdateOpenQuestion(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $openQuestion = $this->openQuestionRepo->find($id);
        $answerUpdate = $this->answerRepository->findOneBy(['question' => $openQuestion]);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }
        if (!isset($dataComponent['addHelpertext'])) {
            $dataComponent['addHelpertext'] = false;
        }
        if (empty($this->checkErrors)) {
            $openQuestion->setName($dataComponent['name']);
            $openQuestion->setQuestion($dataComponent['open_question-question']);
            $openQuestion->setAddAHelpertext($dataComponent['addHelpertext']);
            if ($dataComponent['addHelpertext'] == true) {
                $openQuestion->setHelperText($dataComponent['helperText']);
            } elseif ($dataComponent['addHelpertext'] == false) {
                $openQuestion->setHelperText('');
            }
            $openQuestion->setIsMandatory($dataComponent['is_mandatory']);
            $answerUpdate->setAnswer($dataComponent['open-question-answer']);

            $this->checkErrors = $this->checkDataUtils->checkUpdateOpenQuestion($dataComponent);
            $entityManager->flush();
        }
    }
}
