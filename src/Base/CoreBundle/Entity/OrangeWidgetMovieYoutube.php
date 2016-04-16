<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Guzzle\Http\Client;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * OrangeWidgetMovieYoutube
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrangeWidgetMovieYoutube extends OrangeWidget
{
    use Translatable;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", nullable=true)
     * @Groups({
     *     "orange_series_and_cie"
     * })
     */
    private $url;

    /**
     * Set url
     *
     * @param string $url
     * @return OrangeWidgetMovieYoutube
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @VirtualProperty()
     *
     * @Groups({
     *     "orange_series_and_cie"
     * })
     */
    public function getYoutubePlaylistVideos()
    {
        $items = array();
        if (!$this->url) {
            return $items;
        }
        $playlistId = null;

        parse_str(parse_url($this->url, PHP_URL_QUERY));
        if (!empty($list)) {
            $playlistId = $list;

            $apiKey = 'AIzaSyBjMYBFumo4tT-3iu8-qa6BqnPLkn7LSiM';
            $url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId="
                . "$playlistId&key=$apiKey";

            $client = new Client();
            $request = $client->createRequest('GET', $url);
            $response = $request->send();
            $json = json_decode((string)$response->getBody(), true);
            if (array_key_exists('items', $json) && $json['items']) {
                $items = $json['items'];
            }

            while (array_key_exists('nextPageToken', $json) && $json['nextPageToken']) {
                $newUrl = $url . '&pageToken=' . $json['nextPageToken'];

                $request = $client->createRequest('GET', $newUrl);
                $response = $request->send();
                $json = json_decode((string)$response->getBody(), true);
                if (array_key_exists('items', $json) && $json['items']) {
                    $items = array_merge($items, $json['items']);
                }
            }
        }
        return $items;
    }
}
