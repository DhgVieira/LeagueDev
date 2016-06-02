<?php

namespace DefaultBundle\Controller;

use ApiBundle\Services\SummonerService;
use DefaultBundle\Extensions\LeagueExtension;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    protected $summoner;
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {

        return $this->render('DefaultBundle:Default:index.html.twig', array(
                'post' => false)
        );


    }
    /**
     * @Route("/summonerIndex")
     */
    public function getDataSummonerIndex(Request $request)
    {
        $summonerName = $request->request->get('name');
        $string = strtolower(str_replace(' ', '', $summonerName));
        $service = new SummonerService('07da5c2b-a3c3-43e6-a958-d8483a134c23', 'br');
        $this->summoner = $summonerName;
        try {
            $summonerData = $service->getSummonerByName($summonerName);
            $summonerStats = $service->getSummonerStats($summonerData->$string->id);
            $summonerTier = $service->getSummonerLeague($summonerData->$string->id);
            $idSummoner = (String)$summonerData->$string->id;
            $tierData = $summonerTier->$idSummoner;
            $divisionData = $tierData[0]->entries;
        } catch (\Exception $e) {
            return $this->render('DefaultBundle:Default:summonerIndex.html.twig', array('post' => true,
                    'code' => $e->getCode(), 'message' => $e->getMessage())
            );
        }
        return $this->render('DefaultBundle:Default:summonerIndex.html.twig', array('post' => true,
                'summonerData' => $summonerData->$string, 'summonerTier' => $tierData[0], 'summonerDivision' => $divisionData[0], 'summonerName' => $summonerName)
        );

    }
    
    /**
     * @Route("/summoner", name="Default_Summoner", options={"expose"=true})
     */
    public function getDataSummoner(Request $request)
    {
        $summonerName = $request->request->get('name');
        $string = strtolower(str_replace(' ', '', $summonerName));
        $service = new SummonerService('07da5c2b-a3c3-43e6-a958-d8483a134c23', 'br');
        $this->summoner = $summonerName;
        try {
            $summonerData = $service->getSummonerByName($summonerName);
            $summonerStats = $service->getSummonerStats($summonerData->$string->id);
            $summonerTier = $service->getSummonerLeague($summonerData->$string->id);
            $idSummoner = (String)$summonerData->$string->id;
            $tierData = $summonerTier->$idSummoner;
            $divisionData = $tierData[0]->entries;
        } catch (\Exception $e) {
            return $this->render('DefaultBundle:Default:summoner.html.twig', array('post' => true,
                    'code' => $e->getCode(), 'message' => $e->getMessage())
            );
        }
        return $this->render('DefaultBundle:Default:summoner.html.twig', array('post' => true,
                'summonerData' => $summonerData->$string, 'summonerTier' => $tierData[0], 'summonerDivision' => $divisionData[0], 'summonerName' => $summonerName)
        );

    }

    /**
     * @Route("/history", name="Default_History", options={"expose"=true})
     *
     */
    public function history(Request $request)
    {
        $summonerName = $request->request->get('name');
        $string = strtolower(str_replace(' ', '', $summonerName));
        $service = new SummonerService('07da5c2b-a3c3-43e6-a958-d8483a134c23', 'br');
        try {
            $summonerData = $service->getSummonerByName($summonerName);
            $summonerMathHistories = $service->getMatchHistory($summonerData->$string->id);
            $normalIterator = 0;
            $rankedIterator = 0;
            foreach ($summonerMathHistories->games as $summonerMathHistory) {
                if ($summonerMathHistory->subType == 'NORMAL') {
                    $arrGames['normal'][$normalIterator] = $summonerMathHistory;
                    $normalIterator++;
                } else if ($summonerMathHistory->subType == 'RANKED_SOLO_5x5') {
                    $arrGames['ranked'][$rankedIterator] = $summonerMathHistory;
                    $rankedIterator++;
                }
            }
        } catch (\Exception $e) {
            return $this->render('DefaultBundle:Default:history.html.twig', array('post' => true,
                    'code' => $e->getCode(), 'message' => $e->getMessage())
            );
        }
        return $this->render('DefaultBundle:Default:history.html.twig', array('post' => true,
            'summonerData' => $summonerData->$string, 'summonerName' => $summonerName, 'arrGames' => $arrGames, 'leagueExt' => new LeagueExtension($this->container)));
        
    }

    /**
     * @Route("/game", name="Default_game", options={"expose"=true})
     *
     */
    public function game(Request $request)
    {
//        $request->setLocale('pt');
        $gameId = $request->request->get('gameId');
        $service = new SummonerService('07da5c2b-a3c3-43e6-a958-d8483a134c23', 'br');
        $summonerMath = $service->getMatch($gameId);
        $teste = $summonerMath->participants;
        return $this->render('DefaultBundle:Default:match.html.twig', array(
                'post' => true, 'summoners' => $summonerMath->participants, 'leagueExt' => new LeagueExtension($this->container))
        );

    }
}
