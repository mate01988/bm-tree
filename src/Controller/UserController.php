<?php

namespace App\Controller;

use App\Factory\UserFactory;
use App\Repository\UserRepository;

use App\Service\Tree;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController.
 *
 * @Route("/user")
 */
class UserController extends AbstractController
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * @var Tree
     */
    private $tree;


    public function __construct(
        UserRepository $userRepository,
        UserFactory $userFactory,
        Tree $tree
    )
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
        $this->tree = $tree;
    }

    /**
     * @Route("/generator", name="user-generator", methods={"GET"})
     *
     */
    public function generatorAction(Request $request): Response
    {

        $version = rand(1, 10000000000);
        UserFactory::setVersion($version);

        $this->tree->generateNode('1', null, false);

        $tree = $this->tree->flatTree($this->userRepository->findBy(['version' => $version]));


        return $this->render('user/generator.html.twig',
            [
                'tree' => $tree
            ]);
    }

}
