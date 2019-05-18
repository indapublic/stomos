<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    /** @var TaskRepository */
    private $taskRepository;

    /** @var RequestStack */
    private $requestStack;

    /** @var PaginatorInterface */
    private $paginator;

    const PAGE_SIZE = 3;

    public function __construct(
        TaskRepository $taskRepository,
        RequestStack $requestStack,
        PaginatorInterface $paginator
    )
    {
        $this->taskRepository = $taskRepository;
        $this->requestStack = $requestStack;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/", name="tasks_list")
     *
     * @Template("tasks/list.html.twig")
     *
     * @return array
     */
    public function indexAction(): array
    {
        $query = $this->taskRepository->fetchList();

        $page = $this->requestStack->getCurrentRequest()->get('page', 1);

        return [
            'pagination' => $this->paginator->paginate($query, $page, self::PAGE_SIZE),
        ];
    }

    /**
     * @Route("/create", name="tasks_create")
     *
     * @Template("tasks/item.html.twig")
     *
     * @return array|RedirectResponse
     *
     * @throws \Exception
     */
    public function newAction()
    {
        return $this->handle(new Task());
    }

    /**
     * @Route("/{task}", name="tasks_view")
     *
     * @Template("tasks/item.html.twig")
     *
     * @param Task $task
     *
     * @return array|RedirectResponse
     */
    public function viewAction(Task $task)
    {
        return $this->handle($task);
    }

    /**
     * @param Task $task
     *
     * @return array|RedirectResponse
     */
    private function handle(Task $task)
    {
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($this->requestStack->getCurrentRequest());

        if ($form->isSubmitted() and $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('tasks_list');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
