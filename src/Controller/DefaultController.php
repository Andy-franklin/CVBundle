<?php

namespace AndyFranklin\CVBundle\Controller;

use AndyFranklin\CVBundle\DataManager\CVInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(CVInfo $CVInfo)
    {
        return $this->render('@AndyFranklinCV/AFCVTemplate1/index.html.twig', [
            'cvInfo' => $CVInfo
        ]);
    }
}
