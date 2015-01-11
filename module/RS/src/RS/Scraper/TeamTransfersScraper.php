<?php
namespace RS\Scraper;

class TeamTransfersScraper extends Scraper
{
    private $teamid;

    const MAX_TRANSFER_AGE = "45 days ago";

    public function __construct($teamid)
    {
        $this->teamid = $teamid;
        parent::__construct(); 
    }

    protected function getURL()
    {
        //$URL = "http://rs.local:8080/testdata/team-transfers.html";
        $URL = 'http://rockingsoccer.com/en/soccer/info/team-%1$s/transfers';
        return sprintf($URL, $this->getTeamid());
    }

    protected function scrapeHTML()
    {
        $transfers = array();
        foreach($this->html->find('div#content') as $content)
        {
            foreach ($content->find('table.horizontal_table tr[class]') as $tr) {
                $dateString = $tr->find('td', 0)->find('span', 0)->title;
                
                //Example dateString: Thursday may 22 2014, 07:37
                $transferDate = \DateTime::createFromFormat('l F j Y, H:i', $dateString);
                $cmp = new \DateTime(self::MAX_TRANSFER_AGE);
                if ($transferDate <= $cmp) {
                    // Transfer max 15 days ago => skip this transfer
                    continue;
                }
                $transfer['date'] = $transferDate;

                $transfer['playername'] = $tr->find('td', 1)->find('a', 1)->plaintext;

                $playerlink = $tr->find('td', 1)->find('a', 1)->href;
                $playerlinkexplode = explode("-", $playerlink);
                $transfer['playerId'] = trim(end($playerlinkexplode));
            
                $teamHref = $tr->find('td', 2)->find('a', 1)->href;
                $teamArray = explode('-', $teamHref);
                $transfer['fromTeamId'] = trim(end($teamArray));

                $teamHref = $tr->find('td', 3)->find('a', 1)->href;
                $teamArray = explode('-', $teamHref);
                $transfer['toTeamId'] = trim(end($teamArray));

                $transfers[] = $transfer;
            }
        }
        return $transfers;
    }

    /**
     * Gets the value of teamid.
     *
     * @return mixed
     */
    public function getTeamid()
    {
        return $this->teamid;
    }
    
    /**
     * Sets the value of teamid.
     *
     * @param mixed $teamid the teamid
     *
     * @return self
     */
    public function setTeamid($teamid)
    {
        $this->teamid = $teamid;

        return $this;
    }
}