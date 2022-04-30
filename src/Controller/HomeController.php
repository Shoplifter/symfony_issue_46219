<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\User;
use App\Form\EmployeeType;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route("/{id}", name: 'home', requirements: ["id" => "\d+"], defaults: ["id" => null])]
    public function index(Request $request, ?int $id = null): Response
    {
        $employee = $this->getEmployee($id);
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->doctrine->getManager();
            $em->persist($employee);
            $em->flush();
            $this->addFlash('success', "Data saved.");
            return $this->redirectToRoute('home', ['id' => $employee->getId()]);
        }
        return $this->renderForm('home/index.html.twig', [
            'employee' => $employee,
            'employees' => $this->doctrine->getRepository(Employee::class)->findAll(),
            'form' => $form,
        ]);
    }


    #[Route("/user/{id}", name: 'edit_user', requirements: ["id" => "\d+"])]
    public function editUser(Request $request, int $id = null): Response
    {
        $user = $this->doctrine->getRepository(User::class)->find($id);
        if(null === $user) throw $this->createNotFoundException();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', "Data saved.");
            return $this->redirectToRoute('edit_user', ['id' => $user->getId()]);
        }
        return $this->renderForm('user/index.html.twig', [
            'user' => $user,
            'employees' => $this->doctrine->getRepository(Employee::class)->findAll(),
            'form' => $form,
        ]);
    }


    private function getEmployee(?int $id = null): Employee
    {
        if(null === $id) return new Employee();
        $employeeRepository = $this->doctrine->getRepository(Employee::class);
        $employee = $employeeRepository->find($id);
        if(null === $employee) throw $this->createNotFoundException();
        return $employee;
    }
}
