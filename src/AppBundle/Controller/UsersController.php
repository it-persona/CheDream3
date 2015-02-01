<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\View as RestView;
use FOS\RestBundle\View\View;

class UsersController extends FOSRestController
{
    /**
     * Get Users,
     *
     * @ApiDoc(
     * resource = true,
     * description = "Gets all Users",
     * output = "AppBundle\Document\UserContribute",
     * statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Returned when the user is not found"
     * }
     * )
     *
     * RestView()
     * @param
     * @return View
     *
     * @throws NotFoundHttpException when page not exist
     */
    public function getUsersAction()
    {
        $manager = $this->get('doctrine_mongodb')->getManager();
        $user = $manager->getRepository('AppBundle:User')->findAll();
        $restView = View::create();
        $restView->setData($user);

        return $restView;
    }
}