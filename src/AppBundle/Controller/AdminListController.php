<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdminListController extends Controller
{
    /**
     * @param string $entityName
     * @return RedirectResponse|Response
     * @Route("/admin/list/{entityName}", name="entity_list")
     */
    public function listAction($entityName)
    {
        $entities = $this->get('app.entity_list_mapper')->getEntitiesForList($entityName);
        $listProperties = $this->get('app.entity_list_mapper')->getPropertiesForList($entityName);

        return $this->render('pages/table-list.html.twig', [
            'title' => $entityName,
            'properties' => $listProperties,
            'entities' => $entities,
        ]);
    }

    /**
     * @param $entityName
     * @param $entityId
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/admin/edit/{entityName}/{entityId}",name="entity_edit")
     */
    public function editAction($entityName,$entityId,Request $request)
    {
        $entity = $this->get('app.entity_list_mapper')->getEntity($entityName,$entityId);
        $formTypeClass= $this->get('app.entity_list_mapper')->getFormClass($entityName);
        
        $form = $this->createForm($formTypeClass,$entity);
        
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($entity);
            $this->get('app.entity.listener')->preUpdate($em,$entity);
            $em->flush();
            
            $this->get('app.toaster')->addSuccess('Édition réussie');
            return $this->redirectToRoute('entity_list',['entityName'=>$entityName]);
        } elseif ($form->isSubmitted()) {
            $this->get('app.toaster')->addError('Édition échoué');
        }
        
        return $this->render('pages/simple-form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Edit '.$entityName,
        ]);
    }
    
    /**
     * @param $entityName
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/admin/add/{entityName}",name="entity_add")
     */
    public function addAction($entityName,Request $request)
    {
        $entity = $this->get('app.entity_list_mapper')->getNewEntity($entityName);
        $formTypeClass= $this->get('app.entity_list_mapper')->getFormClass($entityName);
        
        $form = $this->createForm($formTypeClass,$entity);
        
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($entity);
            $em->flush();
            
            $this->get('app.toaster')->addSuccess('Ajout réussie');
            return $this->redirectToRoute('entity_list',['entityName'=>$entityName]);
        } elseif ($form->isSubmitted()) {
            $this->get('app.toaster')->addError('Ajout échoué');
        }
        
        return $this->render('pages/simple-form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Add '.$entityName,
        ]);
    }
}
