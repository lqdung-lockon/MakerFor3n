<?php
/*
 * This file is part of the Maker plugin
 *
 * Copyright (C) 2016 LOCKON CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Maker\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Eccube\Application;
use Eccube\Controller\AbstractController;
use Eccube\Entity\Plugin;
use Plugin\Maker\Entity\Maker;
use Plugin\Maker\Form\Type\MakerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MakerController.
 */
class MakerController extends AbstractController
{
    /**
     * Maker index
     *
     * @Route("/{_admin}/maker/{id}", name="admin_plugin_maker_index", requirements={"id" = "\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     * @Template("Maker/Resource/template/admin/maker.twig")
     *
     * @param Application $app
     * @param Request     $request
     * @param int         $id
     * @return array
     */
    public function index(Application $app, Request $request, $id = null)
    {
        /**
         * @var \Plugin\Maker\Repository\MakerRepository $repos
         */
        $repos = $app['eccube.plugin.maker.repository.maker'];

        $TargetMaker = new Maker();

        if ($id) {
            $TargetMaker = $repos->find($id);
            if (!$TargetMaker) {
                throw new NotFoundHttpException();
            }
        }

//        $builder = $app->form(
//            $TargetMaker,
//            [
//                'data_class' => Maker::class,
//            ]
//        );

        $form = $app['form.factory']->createBuilder(MakerType::class, $TargetMaker)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $status = $repos->save($TargetMaker);
            if ($status) {
                $app->addSuccess('admin.plugin.maker.save.complete', 'admin');

                return $app->redirect($app->url('admin_plugin_maker_index'));
            } else {
                $app->addError('admin.plugin.maker.save.error', 'admin');
            }
        }
        /**
         * @var ArrayCollection $arrMaker
         */
        $arrMaker = $repos->findBy(array(), array('rank' => 'DESC'));

//        return $app->render('Maker/Resource/template/admin/maker.twig', array(
//            'form' => $form->createView(),
//            'arrMaker' => $arrMaker,
//            'TargetMaker' => $TargetMaker,
//        ));

//        $form = $builder->getForm();
//        $form->add('submit', SubmitType::class);

        return ['arrMaker' => $arrMaker, 'TargetMaker' => $TargetMaker, 'form' => $form->createView()];
    }

    /**
     * Delete Maker.
     *
     * @Route("/{_admin}/maker/{id}/delete", name="admin_plugin_maker_delete", requirements={"id" = "\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Application $app
     * @param Request     $request
     * @param int         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Application $app, Request $request, $id = null)
    {
        // Valid token
        $this->isTokenValid($app);

        // Check request
        if (!'POST' === $request->getMethod()) {
            throw new BadRequestHttpException();
        }

        // Id valid
        if (!$id) {
            $app->addError('admin.plugin.maker.not_found', 'admin');

            return $app->redirect($app->url('admin_plugin_maker_index'));
        }

        $repos = $app['eccube.plugin.maker.repository.maker'];

        $TargetMaker = $repos->find($id);

        if (!$TargetMaker) {
            throw new NotFoundHttpException();
        }

        $status = $repos->delete($TargetMaker);

        if ($status === true) {
            $app->addSuccess('admin.plugin.maker.delete.complete', 'admin');
        } else {
            $app->addError('admin.plugin.maker.delete.error', 'admin');
        }

        return $app->redirect($app->url('admin_plugin_maker_index'));
    }

    /**
     * Move rank with ajax.
     *
     * @Route("/{_admin}/maker/move", name="admin_plugin_maker_move_rank")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Application $app
     * @param Request     $request
     *
     * @return bool
     */
    public function moveRank(Application $app, Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $arrRank = $request->request->all();
            $arrMoved = $app['eccube.plugin.maker.repository.maker']->moveMakerRank($arrRank);
            log_info('Maker move rank', $arrMoved);
        }

        return true;
    }
}
