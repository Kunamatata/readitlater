<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WebArticleExtractor\Extract as WebArticleExtractor;

class LinkController extends Controller {
    /**
     * @Route("/link", name="link")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('default/index_symfony.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ]);
    }

    public function addAction(Request $request) {
        $url = $request->request->get('url');
        $extractionResult = null;
        $title = null;
        $content = "";
        if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
            $extractionResult = WebArticleExtractor::extractFromURL($url);
            /*\Doctrine\Common\Util\Debug::dump($extractionResult);*/
            $extractionResult = json_encode($extractionResult);
            $extractionResult = json_decode($extractionResult, true);
            $title = $extractionResult['title'];

            foreach ($extractionResult['textBlocks'] as $child) {
                if ($child['isContent'] === true) {
                    $content = $content . $child['text'];
                }

            }

        }
        return $this->render('default/add.html.twig', array(
            'url' => $url,
            'title' => $title,
            'json' => json_encode($extractionResult, JSON_PRETTY_PRINT),
            'content' => $content,
        ));
    }

}
