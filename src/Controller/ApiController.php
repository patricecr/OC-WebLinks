<?php

namespace WebLinks\Controller;

use Silex\Application;
use WebLinks\Domain\Link;
use WebLinks\Domain\User;

class ApiController {

    /**
     * API links controller.
     *
     * @param Application $app Silex application
     *
     * @return All links in JSON format
     */
    public function getLinksAction(Application $app) {
        $links = $app['dao.link']->findAll();
        // Convert an array of objects ($links) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($links as $link) {
            $responseData[] = $this->buildLinkArray($link);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API link details controller.
     *
     * @param integer $id Link id
     * @param Application $app Silex application
     *
     * @return Link details in JSON format
     */
    public function getLinkAction($id, Application $app) {
        $link = $app['dao.link']->find($id);
        $responseData = $this->buildLinkArray($link);
        // Create and return a JSON response
        return $app->json($responseData);
    }
    
    /**
     * Converts a Link object into an associative array for JSON encoding
     *
     * @param Link $link Link object
     *
     * @return array Associative array whose fields are the link properties.
     */
    private function buildLinkArray(Link $link) {
        $data  = array(
            'id' => $link->getId(),
            'title' => $link->getTitle(),
            'url' => $link->getUrl(),
            'user' => array(
                'id' => $link->getAuthor()->getId(),
                'name' => $link->getAuthor()->getUserName()
            )
        );
        return $data;
    }
}