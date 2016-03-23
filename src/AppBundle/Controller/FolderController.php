<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class FolderController extends Controller {

    public function indexAction($category) {
        var_dump($category);
        // replace this example code with whatever you need
        return $this->render('default/index_symfony.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ]);
    }

    public function addAction(Request $request) {

        $finder = new Finder();
        $folderName = $request->request->get('folder');
        /*$finder->files()->in("/home/etud/calymaxi/readitlater/app/Resources/")->name("categories.json");
        foreach ($finder as $file) {
        \Doctrine\Common\Util\Debug::dump($file->getRealPath());
        }*/
        $file = file_get_contents(__DIR__ . "../../../../app/Resources/categories.json");
        $json_a = json_decode($file, true);
        array_push($json_a, $folderName);
        file_put_contents(__DIR__ . "../../../../app/Resources/categories.json", json_encode($json_a, true));
        $url = $this->get('router')->generate('app');

        return new RedirectResponse($url);
    }

}
