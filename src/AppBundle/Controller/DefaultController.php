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
        $categoryFile = file_get_contents(__DIR__ ."../../../../app/Resources/categories.json");
        $categories = json_decode($categoryFile, true);
        //var_dump($categories);

        $linksFile = file_get_contents(__DIR__ ."../../../../app/Resources/links.json");
        $links = json_decode($linksFile, true);

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'categories' => $categories,
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
            'links' => $links,
        ));
    }
}
