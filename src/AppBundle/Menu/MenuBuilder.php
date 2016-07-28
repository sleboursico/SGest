<?php

  namespace AppBundle\Menu;

  use Knp\Menu\FactoryInterface;
  use Symfony\Component\HttpFoundation\Request;

  class MenuBuilder
  {
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createBreadcrumbMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('id', 'breadcrumb');  
        // cet item sera toujours affiché
        $menu->addChild("Accueil", array('route' => 'app_exercices_index'));

        // crée le menu en fonction de la route
        switch($request->get('_route')){
            case 'app_exercices_edit':
                $menu
                    ->addChild('label.edit.exercice')
                    ->setCurrent(true)
                    // setCurrent est utilisé pour ajouter une classe css "current"
                ;
            break;
            case 'app_exercices_creer':
                $menu
                    ->addChild('label.create.exercice')
                    ->setCurrent(true)
                    // setCurrent est utilisé pour ajouter une classe css "current"
                ;
            break;
            case 'Acme_view_post':
                $menu->addChild('label.list.post', array(
                    'route' => 'Acme_list_post'
                ));
                
                $menu
                    ->addChild('label.view.post')
                    ->setCurrent(true)
                    ->setLabel($request->get('label'))
                    // le paramètre "label" doit être passé dans votre controller
                    // avec $request->attributes->set('label','Mon libellé');
                ;
            break;
            case 'Acme_add_comment_on_post':
                $menu->addChild('label.list.post', array(
                    'route' => 'Acme_list_post'
                ));
                
                $menu
                    ->addChild('label.view.post', array(
                        'route' => 'Acme_view_post',
                        'routeParameters' => array('slug' => $request->get('slug'))
                        /* le paramètre "slug" est un paramètre de la route
                           Acme_add_comment_on_post. Si votre route n'a pas de paramètre, vous
                           devrez utiliser la méthode $request->attributes->set()
                        */
                    ))
                    ->setLabel($request->get('label'))
                ;
                $menu
                    ->addChild('label.add.comment')
                    ->setCurrent(true)
                ;                    
            break;            
        }

        return $menu;
    }
}