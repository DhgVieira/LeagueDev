<?php
namespace ApiBundle\Services;
use GuzzleHttp\Client;

class SummonerService {

    const URL_API      = "https://br.api.pvp.net/api/lol/";
    /**
     * @var
     */
    private $key;
    /**
     * @var
     */
    private $region;

    /**
     * @var Client
     */
    private $client;

    public function __construct($key, $region)
    {
        $this->key = $key;
        $this->region = $region;
        $this->client = new Client(array('base_uri' => self::URL_API . $this->region .'/'));
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function getSummonerIdByName($name)
    {
        $summoner = $this->getSummonerByName($name);
        return $summoner['id'];
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function getSummonerByName($name)
    {
        try {
            if (is_array($name)) {
                $name = implode(",", $name);
            }
            $response = $this->client->get('v1.4/summoner/by-name/' . $name . "?api_key=" . $this->key);
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Service Not Available');
            }
            return json_decode((String) $response->getBody());
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $id
     * @param string $meta
     * @return mixed
     * @throws \Exception
     */
    public function getSummoner($id, $meta = "")
    {
        try {
            if (isset($meta)) {
                $meta = "/" . $meta;
            }
            if (is_array($id)) {
                $id = implode(",", $id);
            }
            $response = $this->client->get('v1.4/summoner/' . $id . $meta .'?api_key=' . $this->key);
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Service Not Available');
            }
            return json_decode((String) $response->getBody());
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $summonerId
     * @param string $type
     * @return mixed
     * @throws \Exception
     */
    public function getSummonerStats($summonerId, $type = "summary")
    {
        try {
            $response = $this->client->get('v1.3/stats/by-summoner/' . $summonerId . "/" . $type . "?api_key=" . $this->key);
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Service Not Available');
            }
            return json_decode((String) $response->getBody());
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $name
     * @param string $type
     * @return array
     * @throws \Exception
     */
    public function getSummonerStatsByName($name, $type = "summary")
    {
        return $this->getSummonerStats($this->getSummonerIdByName($name), $type);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getChampions()
    {
        try {
            $response = $this->client->get('v1.2/champion?api_key=' .  $this->key);
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Service Not Available');
            }
            return json_decode((String) $response->getBody());
        }  catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $summonerId
     * @return mixed
     * @throws \Exception
     */
    public function getMatchHistory($summonerId)
    {
        try {
            $response = $this->client->get('v1.3/game/by-summoner/' . $summonerId . '/recent?api_key=' . $this->key);
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Service Not Available');
            }
            return json_decode((String) $response->getBody());
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $matchId
     * @return mixed
     * @throws \Exception
     */
    public function getMatch($matchId)
    {
        try {
            $response = $this->client->get('v2.2/match/' . $matchId . '?api_key=' . $this->key);
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Service Not Available');
            }
            return json_decode((String) $response->getBody());
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $summonerId
     * @return array
     * @throws \Exception
     */
    public function getSummonerMastery($summonerId)
    {
        return $this->getSummoner($summonerId, "masteries");
    }

    /**
     * @param $summonerId
     * @return array
     * @throws \Exception
     */
    public function getSummonerRunes($summonerId)
    {
        return $this->getSummoner($summonerId, "runes");
    }

    /**
     * @param $summonerId
     * @return mixed
     * @throws \Exception
     */
    public function getSummonerLeague($summonerId)
    {
        try {
            $response = $this->client->get('v2.5/league/by-summoner/' . $summonerId . '/entry?api_key=' . $this->key);
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Service Not Available');
            }
            return json_decode((String) $response->getBody());
        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * @param $summonerId
     * @return mixed
     * @throws \Exception
     */
    public function getSummonerTeam($summonerId)
    {
        try {
            $response = $this->client->get('v2.3/team/by-summoner/' . $summonerId . '?api_key=' . $this->key);
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Service Not Available');
            }
            return json_decode((String) $response->getBody());
        } catch (\Exception $e) {
            throw $e;
        }
    }

}