<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Doctrine\DBAL\Driver\Connection;

use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BlogController extends Controller{
    /**
     * @Route(
     *      "/blog/qwerty"
     * )
     */

    public function list(){
        $this->addFlash('notice','Hello, world');
        return $this->RedirectToRoute("lucky_number");
    //    return new Response(
    //       '<html><body>' . __METHOD__.'</body></html>' 
    //  );
    }

    public function show(
        SomeService $service,
        Request $request,
        SessionInterface $session,
        //TranslatorInterface $translator,
        Connection $conn
        )
        {

        //$name = $request->query->get("name");
        //$this->addFlash('notice','Hello, world');
        //return $this->RedirectToRoute("lucky_number");

        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array(
                'label' => 'Создать задачу'
            ))->getForm();


        return $this->render('blog/task.html.twig',
        array(
            'form' => $form->createView(),
            'users' => $users,
        ));
    }
}