<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_index", methods={"GET"})
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class)->findAll();

        return $this->render('user/search.html.twig', [
            'users' => $users,
        ]);
    }


    /**
     * @Route("/user/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->json($user);
    }

    /**
     * @Route("/user/search/{name}", name="user_search", methods={"GET"})
     */
    public function search(ManagerRegistry $doctrine, UserRepository $userRepository, $name)
    {
        $users = $userRepository->searchUsers($name);

        // Faites quelque chose avec les utilisateurs trouvés, comme les passer à une vue

        return $this->render('user/search.html.twig', [
            'users' => $users,
            'searchTerm' => $name,
        ]);

    }

    /**
     * @Route("/user", name="user_create", methods={"POST"})
     */
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setUserName($data['user_name']);
        $user->setEmail($data['email']);
        $user->setBirthdate(new \DateTime($data['birthdate']));
        $user->setAddress($data['address']);
        $user->setZipcode($data['zipcode']);
        $user->setTown($data['town']);

        $entityManager = $doctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user, Response::HTTP_CREATED);
    }

    /**
     * @Route("/user/{id}", name="user_update", methods={"PUT"})
     */
    public function update(ManagerRegistry $doctrine, Request $request, User $user): Response
    {
        $data = json_decode($request->getContent(), true);

        $user->setUserName($data['user_name']);
        $user->setEmail($data['email']);
        $user->setBirthdate(new \DateTime($data['birthdate']));
        $user->setAddress($data['address']);
        $user->setZipcode($data['zipcode']);
        $user->setTown($data['town']);

        $entityManager = $doctrine()->getManager();
        $entityManager->flush();

        return $this->json($user);
    }

    /**
     * @Route("/user/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, User $user): Response
    {
        $entityManager = $doctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
