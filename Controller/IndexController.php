<?php
declare(strict_types = 1);
namespace mgbs\Controller;

use mgbs\Model\ModelInterface;
use mgbs\Model\QuestionsModel;
use mgbs\ValueObject\JeopardyCollection;
use mgbs\ValueObject\JeopardyRowCollection;
use Symfony\Component\HttpFoundation\Response;
use mgbs\Library\DI;

/**
 * Created by PhpStorm.
 * User: mgbs
 * Date: 16.01.17
 * Time: 19:37
 */
class IndexController
{
    /**
     * @var QuestionsModel
     */
    private $questionsModel;

    public function indexAction()
    {

        $jeopardyCollectionFactory = new JeopardyCollectionFactory(new JeopardyCollection());
        $jeopardyCollectionFactory->setModel(DI::getContainer()->get('questionmodel'));

        $jeopardyCollectionFactory->addRowCollection(new JeopardyRowCollection, 10);
        $jeopardyCollectionFactory->addRowCollection(new JeopardyRowCollection, 20);
        $jeopardyCollectionFactory->addRowCollection(new JeopardyRowCollection, 30);
        $jeopardyCollectionFactory->addRowCollection(new JeopardyRowCollection, 40);
        $jeopardyCollectionFactory->addRowCollection(new JeopardyRowCollection, 50);

        $jeopardyCollection = $jeopardyCollectionFactory->getCollection();

        /** @var \Twig_Environment $twig */
        $twig = DI::getContainer()->get('twig');
        return new Response($twig->render('jeopardy.html.twig', ['jeopardy' => $jeopardyCollection]));
    }

    /**
     * @return ModelInterface
     */
    public function getQuestionsModel(): ModelInterface
    {
        return $this->questionsModel;
    }

    /**
     * @param ModelInterface $questionsModel
     */
    public function setQuestionsModel(ModelInterface $questionsModel)
    {
        $this->questionsModel = $questionsModel;
    }
}
