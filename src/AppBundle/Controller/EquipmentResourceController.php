<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\View as RestView;
use FOS\RestBundle\View\View;
use Symfony\Component\Config\Definition\Exception\Exception;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;

class EquipmentResourceController extends AbstractController
{
    /**
     * Get EquipmentResources,
     *
     * @ApiDoc(
     * resource = true,
     * description = "Gets all EquipmentResources",
     * output="array<AppBundle\Document\EquipmentResource>",
     * statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Returned when the EquipmentResources is not found"
     * }
     * )
     *
     * @QueryParam(name="limit", requirements="\d+", default="10", description="Count resources contributes at one page")
     * @QueryParam(name="page", requirements="\d+", default="1", description="Number of page to be shown")
     *
     * @RestView
     *
     * @param  ParamFetcher $paramFetcher
     * @return View
     *
     * @throws NotFoundHttpException when not exist
     */
    public function getEquipmentResourcesAction(ParamFetcher $paramFetcher)
    {
        $manager = $this->getMongoDbManager();
        $equipmentQuery = $manager->createQueryBuilder('AppBundle:EquipmentResource')->getQuery();

        if (count($equipmentQuery) == 0) {
            throw new Exception("204 No Content");
        }

        $limit = $paramFetcher->get('limit');
        $page = $paramFetcher->get('page');

        $paginator  = $this->get('knp_paginator');
        $equipmentQuery = $paginator->paginate(
            $equipmentQuery,
            $paramFetcher->get('page', $page),
            $limit
        );

        return $equipmentQuery;
    }
}
