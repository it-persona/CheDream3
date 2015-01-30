<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\View as RestView;
use FOS\RestBundle\View\View;

class EquipmentResourceController extends FOSRestController
{
    /**
     * Get EquipmentResources,
     *
     * @ApiDoc(
     * resource = true,
     * description = "Gets all EquipmentResources",
     * output = "AppBundle\Document\EquipmentResource",
     * statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Returned when the EquipmentResources is not found"
     * }
     * )
     *
     *
     * RestView()
     * @return View
     *
     * @throws NotFoundHttpException when page not exist
     */
    public function getEquipmentResourcesAction()
    {
        $manager = $this->get('doctrine_mongodb')->getManager();
        $equipment_resources = $manager->getRepository('AppBundle:EquipmentResource')->findAll();
        $restView = View::create();
        $restView->setData($equipment_resources);

        return $restView;
    }
}