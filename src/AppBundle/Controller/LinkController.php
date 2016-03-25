<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        $urlGET = $request->query->get('url');
        $extractionResult = null;
        $title = null;
        $content = "";

        $file = file_get_contents(__DIR__ . "../../../../app/Resources/links.json");
        $json_a = json_decode($file, true);

        if($urlGET != null)
        {
            $url = $urlGET;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
            $extractionResult = WebArticleExtractor::extractFromURL($url);
            /*\Doctrine\Common\Util\Debug::dump($extractionResult);*/
            $extractionResult = json_encode($extractionResult);
            $extractionResult = json_decode($extractionResult, true);
            $title = $extractionResult['title'];

            foreach ($extractionResult['textBlocks'] as $child) {
                if ($child['isContent'] === true || $child['isContent'] === false && $child['labels'][0] === "POSSIBLY CONTENT") {
                    $content = $content . "\n" . $child['text'];
                }

            }
            array_push($json_a["links"], array("title" => $title, "content" => $content, "url" => $url, "archived" => "false", "category" => null));
            file_put_contents(__DIR__ . "../../../../app/Resources/links.json", json_encode($json_a, true));
        }

        $url = $this->get('router')->generate('app');

        return new RedirectResponse($url);

    }

    public function deleteAction(Request $request) {
        $articleUrl = $request->request->get("url");

        $linksFile = file_get_contents(__DIR__ . "../../../../app/Resources/links.json");
        $links = json_decode($linksFile, true);
        $i = 0;
        foreach ($links['links'] as $link) {
            if ($link['url'] == $articleUrl) {
                array_splice($links['links'], $i, 1);
            }
            $i++;
        }

        //Sauvegarde du fichier json modifié
        file_put_contents(__DIR__ . "../../../../app/Resources/links.json", json_encode($links, true));
        return $this->render('default/article_layout.html.twig', array('links' => $links['links']));
    }

    public function archiveAction(Request $request) {
        $articleUrl = $request->request->get("url");
        $archived = $request->request->get("archived");
        $linksFile = file_get_contents(__DIR__ . "../../../../app/Resources/links.json");
        $links = json_decode($linksFile, true);

        foreach ($links['links'] as $linkKey => $link) {
            if ($link['url'] == $articleUrl) {
                $links['links'][$linkKey]['archived'] = ($link['archived'] == "true" ? "false" : "true");
            }
        }

        //Sauvegarde du fichier json modifié
        file_put_contents(__DIR__ . "../../../../app/Resources/links.json", json_encode($links, true));
        $response = $this->forward('AppBundle:Default:archived', array(
            'archived' => $archived,
        ));
        return $response;

    }

    public function categoryAction(Request $request) {
        $articleUrl = $request->request->get("url");
        $category = $request->request->get("category");
        $linksFile = file_get_contents(__DIR__ . "../../../../app/Resources/links.json");
        $links = json_decode($linksFile, true);

        foreach ($links['links'] as $linkKey => $link) {
            if ($link['url'] == $articleUrl) {
                $links['links'][$linkKey]['category'] = $category;
            }
        }

        //Sauvegarde du fichier json modifié
        file_put_contents(__DIR__ . "../../../../app/Resources/links.json", json_encode($links, true));
        return $this->render('default/article_layout.html.twig', array('links' => $links['links']));
    }
}
