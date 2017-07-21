<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Data;
use AppBundle\Form\DataType;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Datum controller.
 *
 * @Route("/")
 */
class DataController extends FOSRestController
{
    /**
     * Lists all data entities.
     *
     * @View(serializerGroups={"data"})
     * @Route("/getRequest", name="_index")
     * @Method("GET")
     */
    public function getAction()
    {
        try {

            return $this->handleView(
                $this->view(
                    [
                        'Success' => true,
                        'Data'    => $this->get('app.data.request.service')
                            ->searchData(),
                    ],
                    Response::HTTP_OK
                )
            );
        } catch (\Exception $exception) {

            return $this->handleView(
                $this->view(
                    [
                        'Success' => false,
                        'Messages' => ['something is wrong'],
                    ],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                )
            );
        }
    }

    /**
     * Creates a new data entity.
     *
     * @Route(
     *     "/storeRequest/{route}",
     *     name="_new",
     *     defaults={"route": ""},
     * )
     */
    public function newAction($route)
    {
        try {

            $newItem = new Data();
            $form = $this->createForm(DataType::class, $newItem);
            $form->submit($this->get('app.data.request.service')->getFormData($route));

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newItem);
                $em->flush();

                return $this->handleView(
                    $this->view(
                        [
                            'Success' => true,
                            'id'      => $newItem->getId(),
                        ],
                        Response::HTTP_CREATED
                    )
                );
            } else {

                return $this->handleView(
                    $this->view(
                        [
                            'Success'  => false,
                            'Messages' => $form->getErrors(),
                        ],
                        Response::HTTP_BAD_REQUEST
                    )
                );
            }

        } catch (\Exception $exception) {

            echo $exception->getMessage();

            return $this->handleView(
                $this->view(
                    [
                        'Success' => false,
                        'Messages' => ['something is wrong'],
                    ],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                )
            );
        }
    }
}
