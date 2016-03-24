<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $categoryFile = file_get_contents(__DIR__ . "../../../../app/Resources/categories.json");
        $categories = json_decode($categoryFile, true);
        $nonArchivedLinks = array();
        $linksFile = file_get_contents(__DIR__ . "../../../../app/Resources/links.json");
        $links = json_decode($linksFile, true);

        foreach ($links['links'] as $link) {
            if ($link['archived'] == "false") {
                array_push($nonArchivedLinks, $link);
            }

        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'categories' => $categories,
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
            'links' => $nonArchivedLinks,
        ));
    }

    public function archivedAction(Request $request) {
        $isArchived = $request->request->get('archived');

        $linksFile = file_get_contents(__DIR__ . "../../../../app/Resources/links.json");
        $links = json_decode($linksFile, true);
        $nonArchivedLinks = array();
        foreach ($links['links'] as $link) {
            if ($link['archived'] == $isArchived) {
                array_push($nonArchivedLinks, $link);
            }

        }
        return $this->render('default/article_layout.html.twig', array('links' => $nonArchivedLinks));
        //return new Response(json_encode($nonArchivedLinks));

    }

}
