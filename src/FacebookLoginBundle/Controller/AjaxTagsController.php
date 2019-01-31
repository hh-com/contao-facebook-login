<?php

declare(strict_types=1);

/*
 * This file is part of the FacebookLogin Bundle.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace FacebookLoginBundle\Controller;

use Contao\CoreBundle\Framework\FrameworkAwareInterface;
use Contao\CoreBundle\Framework\FrameworkAwareTrait;
use Contao\CoreBundle\Routing\UrlGenerator;
use Contao\CoreBundle\Security\User\UserChecker;
use Contao\FrontendUser;
use Contao\MemberGroupModel;
use Contao\MemberModel;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\FilesModel;
use Contao\Folder;
use Contao\File;
use Contao\Image;
use Contao\System;
use \ArtistHooks;
use Facebook\GraphNodes\GraphUser;
use FacebookLoginBundle\Facebook\FacebookFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class AjaxTags
{

    /** 
     * @Route("/ajax_tags/{param1}", name="nexper_ajax") 
     * @return JsonResponse 
     */ 
    public function ajaxAction(Request $request) 
    {         
        $this->container->get('contao.framework')->initialize();  

        if($request->isXmlHttpRequest()) { 
            
            return new JsonResponse(['Hello World!']); 
        } 
         
        throw new NotFoundHttpException("Page not found"); 
    } 
}