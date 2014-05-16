<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class IndexController extends AbstractActionController
{

    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function indexAction()
    {
        //$em = $this->getEntityManager();
        //$matchesRepo = $em->getRepository('RS\Entity\Matches');
        //$matches = $matchesRepo->findAll();


        return new ViewModel(array());
    }

    public function testAction()
    {
        return new ViewModel();
    }

    public function getEntityManager()
    {
        if(null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
}
