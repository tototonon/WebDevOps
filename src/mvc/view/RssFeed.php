<?php


namespace TononT\Webentwicklung\mvc\view;


class RssFeed
{

    var $feed;

    /**
     * RssFeed constructor.
     * @param $feed
     */
    public function __construct($feed)
    {
        $this->feed = $feed;
    }

    /**
     * @return array
     */
    function parse()

    {
        if(!$xml = simplexml_load_file($this->feed)) {
            die("Error reading xml file");
        }

// Ausgabe Array
        $out = array();

// auszulesende Datensaetze
        $i = 5;

// Items vorhanden?
        if( !isset($xml->channel[0]->item) ) {
            die('Keine Items vorhanden!');
        }

// Items holen
        foreach($xml->channel[0]->item as $item) {
            if( $i-- == 0 ) {
                break;
            }

            $out[] = array(
                'title'        => (string) $item->title,
                'description'  => (string) $item->description,
                'link'         => (string) $item->link,
            );
        }


// Eintraege ausgeben
        foreach ($out as $value) {
            echo $value['title'];
            echo $value['description'];
            echo $value['link'];

        }

    }


}