<?php

namespace DefaultBundle\Controller;
use ApiBundle\Services\SummonerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/teste")
     */
    public function indexAction()
    {
        $summonerName = 'allcrazydhg';
        $service = new SummonerService('07da5c2b-a3c3-43e6-a958-d8483a134c23', 'BR');
        $response = $service->getSummonerByName($summonerName);
        return $this->render('DefaultBundle:Default:index.html.twig',array('parameters' => $response->$summonerName));
    }
}
