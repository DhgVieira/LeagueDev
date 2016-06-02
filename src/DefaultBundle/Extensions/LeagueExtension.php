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
            '24' => 'Jax.png',
            '126' => 'Jayce.png',
            '202' => 'Jhin.png',
            '222' => 'Jinx.png',
            '429' => 'Kalista.png',
            '43' => 'Karma.png',
            '30' => 'Karthus.png',
            '38' => 'Kassadin.png',
            '55' => 'Katarina.png',
            '10' => 'Kayle.png',
            '85' => 'Kennen.png',
            '121' => 'Khazix.png',
            '203' => 'Kindred.png',
            '96' => 'KogMaw.png',
            '7' => 'Leblanc.png',
            '64' => 'LeeSin.png',
            '89' => 'Leona.png',
            '127' => 'Lissandra.png',
            '236' => 'Lucian.png',
            '117' => 'Lulu.png',
            '99' => 'Lux.png',
            '54' => 'Malphite.png',
            '90' => 'Malzahar.png',
            '82' => 'Mordekaiser.png',
            '25' => 'Morgana.png',
            '267' => 'Nami.png',
            '75' => 'Nasus.png',
            '111' => 'Nautilus.png',
            '76' => 'Nidalee.png',
            '56' => 'Nocturne.png',
            '20' => 'Nunu.png',
            '2' => 'Olaf.png',
            '61' => 'Oriana.png',
            '80' => 'Pantheon.png',
            '78' => 'Poppy.png',
            '133' => 'Quinn.png',
            '33' => 'Rammus.png',
            '421' => 'RekSai.png',
            '58' => 'Renekton.png',
            '107' => 'Rengar.png',
            '92' => 'Riven.png',
            '68' => 'Rumble.png',
            '113' => 'Sejuani.png',
            '35' => 'Shaco.png',
            '98' => 'Shen.png',
            '102' => 'Shyvana.png',
            '27' => 'Singed.png',
            '14' => 'Sion.png',
            '15' => 'Sivir.png',
            '72' => 'Skaner.png',
            '37' => 'Sonia.png',
            '16' => 'Soraka.png',
            '50' => 'Swain.png',
            '134' => 'Syndra.png',
            '223' => 'TahmKench.png',
            '163' => 'Taliyah.png',
            '91' => 'Talon.png',
            '44' => 'Taric.png',
            '17' => 'Teemo.png  ',
            '412' => 'Thresh.png',
            '18' => 'Tristana.png',
            '23' => 'Tryndamere.png',
            '4' => 'TwistedFate.png',
            '29' => 'Twitch.png',
            '77' => 'Udyr.png',
            '6' => 'Urgot.png',
            '110' => 'Varus.png',
            '67' => 'Vayne.png',
            '45' => 'Veigar.png',
            '161' => 'Velkoz.png',
            '254' => 'Vi.png',
            '112' => 'Viktor.png',
            '106' => 'Volibear.png',
            '19' => 'Warwick.png',
            '62' => 'MonkeyKing.png',
            '101' => 'Xerath.png',
            '5' => 'XinZhao.png',
            '157' => 'Yasuo.png',
            '83' => 'Yorick.png',
            '154' => 'Zac.png',
            '238' => 'Zed.png',
            '115' => 'Ziggs.png',
            '26' => 'Zilean.png',
            '143' => 'Zyra.png',
            '11' => 'MasterYi.png',
            '11' => 'MasterYi.png',
        ];
        if (!isset($championIcon[$championId])) {
            return 'not_found.png';
        }

        return $championIcon[$championId];
    }

    public function getLane($lane, $role = null)
    {
        if (is_null($lane)) {
            return null;
        }

        $laneRole = [
            'BOTTOM' => ['DUO_CARRY' => 'ADC',
            'DUO_SUPPORT' => 'SUPORTE',
            'SOLO' => 'BOT'],
            'MIDDLE' => 'MID',
            'TOP' => 'TOP',
            'JUNGLE' => 'JUNGLE',
        ];
        if (!isset($laneRole[$lane])) {
            return 'not_found';
        }
        if ($lane == 'BOTTOM' ) {
            return $laneRole[$lane][$role];
        }

        return $laneRole[$lane];
    }
}
