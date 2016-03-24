<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReadController extends Controller {

    public function indexAction($title) {
        $file = file_get_contents(__DIR__ . "../../../../app/Resources/links.json");
        $json_a = json_decode($file, true);
        $article = "";
        foreach ($json_a['links'] as $object) {
            if ($object['title'] === $title) {
                $article = $object;

            }
        }
        // replace this example code with whatever you need
        return $this->render('default/read.html.twig', array(
            'title' => $article['title'],
            'content' => $article['content'],
            'url' => $article['url'],
        ));
    }
}
