<?php
namespace DefaultBundle\Extensions;

use \Twig_SimpleFunction;

class LeagueExtension extends \Twig_Extension
{
    private $container;
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getName()
    {
        return 'league_extension';
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('teste', [$this, 'getChampionIcon']),
        );
    }
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('getChampionIcon', [$this, 'getChampionIcon']),
        );
    }

    public function getChampionIcon($championId)
    {
        if (is_null($championId)) {
            return null;
        }

        $championIcon = [
            '8' => 'Vladimir.png',
            '48' => 'Trundle.png',
            '13' => 'Ryze.png',
            '254' => 'Vi.png',
            '33' => 'Rammus.png',
            '266' => 'Aatrox.png',
            '103' => 'Ahri.png',
            '84' => 'Akali.png',
            '12' => 'Alistar.png',
            '32' => 'Amumu.png',
            '34' => 'Anivia.png',
            '1' => 'Annie.png',
            '22' => 'Ashe.png',
            '136' => 'AurelionSol.png',
            '268' => 'Azir.png',
            '432' => 'Bard.png',
            '53' => 'Blitzcrank.png',
            '63' => 'Brand.png',
            '201' => 'Braum.png',
            '51' => 'Caitlyn.png',
            '69' => 'Cassiopeia.png',
            '31' => 'Chogath.png',
            '42' => 'Corki.png',
            '122' => 'Darius.png',
            '131' => 'Diana.png',
            '36' => 'DrMundo.png',
            '119' => 'Draven.png',
            '245' => 'Ekko.png',
            '60' => 'Elise.png',
            '28' => 'Evelynn.png',
            '81' => 'Ezreal.png',
            '9' => 'FiddleSticks.png',
            '114' => 'Fiora.png',
            '105' => 'Fizz.png',
            '3' => 'Galio.png',
            '41' => 'Gangplank.png',
            '86' => 'Garen.png',
            '150' => 'Gnar.png',
            '79' => 'Gragas.png',
            '104' => 'Graves.png',
            '120' => 'Hecarim.png',
            '74' => 'Heimerdinger.png',
            '420' => 'Illaoi.png',
            '39' => 'Irelia.png',
            '40' => 'Janna.png',
            '59' => 'JarvanIV.png',
            '24' => 'Jax.png'
        ];
        if (!isset($championIcon[$championId])) {
            return 'not_found.png';
        }

        return $championIcon[$championId];
    }
}
