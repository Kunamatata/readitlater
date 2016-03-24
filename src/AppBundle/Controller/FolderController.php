<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class FolderController extends Controller {

    public function indexAction($category) {
        var_dump($category);
        $categoryLinks = array();
        $linksFile = file_get_contents(__DIR__ . "../../../../app/Resources/links.json");
        $links = json_decode($linksFile, true);
        foreach ($links['links'] as $link) {
            if ($link['category'] == $category) {
                array_push($categoryLinks, $link);
            }
        }
        return $this->render('default/category_layout.html.twig', array('links' => $categoryLinks, 'categoryName' => $category));
    }

    public function addAction(Request $request) {
        $folderName = $request->request->get('folder');

        $file = file_get_contents(__DIR__ . "../../../../app/Resources/categories.json");
        $json_a = json_decode($file, true);
        array_push($json_a, $folderName);
        file_put_contents(__DIR__ . "../../../../app/Resources/categories.json", json_encode($json_a, true));
        $url = $this->get('router')->generate('app');

        return new RedirectResponse($url);
    }

    public function getCategoriesAction() {
        $categoryFile = file_get_contents(__DIR__ . "../../../../app/Resources/categories.json");
        $categories = json_decode($categoryFile, true);

        return $this->render('default/category_list_layout.html.twig', array('categories' => $categories));
    }

    public function getCategoriesForPopUpAction() {
        $categoryFile = file_get_contents(__DIR__ . "../../../../app/Resources/categories.json");
        $categories = json_decode($categoryFile, true);

        return $this->render('default/category_list_popup_layout.html.twig', array('categories' => $categories));
    }

}
