<?php

#declare(strict_types=1);

/*
 * This file is part of the FacebookLogin Bundle.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace FacebookLoginBundle\Controller;

use Contao\System;
use Contao\CoreBundle\Framework\FrameworkAwareInterface;
use Contao\CoreBundle\Framework\FrameworkAwareTrait;
use Contao\CoreBundle\Routing\UrlGenerator;
use Contao\CoreBundle\Security\User\UserChecker;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;


class AjaxtagsController extends Controller
{

    public function __invoke($action = 1, Request $request)
    {     
        
        $return = array();

        #$data = $request->request->get('request');

        #$this->container->get('contao.framework')->initialize();  

        

        $objUser = \Contao\FrontendUser::getInstance();
        if ($objUser->id != null)
        {
            
            /**
             * Nur ausführen wenn usr numerisch ist!!! 
             */
            if ( is_numeric(\Input::post('usr')) )
            {
                $wantToFollowId = \Input::post('usr');
            }
            else
            {
                \ArtistHooks::adminAlertMail(__CLASS__, 
                    "!ACHTUNG Follower ID ist nicht numerisch! 
                    Angriffsversuch/Fehler? 
                    UserId: ".$objUser->id." wantToFollowId: ".\Input::post('usr')."" );

                return new JsonResponse( array('status' => false ) ); 
            } 
            /** zur tl_member_foloow hinzufügen */
            $addedStatus = \ArtistHooks::addIFollowYou($wantToFollowId);

            $return[] = array(
                'status'=> $addedStatus
                );

            #return new JsonResponse(["Please login"]); 
        }
        else {
            # User ist nicht eingeloggt.
            $return[] = array(
                'status'=>'loggedout'
            );
        }

        return new JsonResponse($return); 

        throw new NotFoundHttpException("Page not found"); 
    }

}

?>