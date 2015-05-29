<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */


namespace Plugin\SampleEvent;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Eccube\Event\RenderEvent;

class SamplePlugin implements EventSubscriberInterface
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
    
    public static function getSubscribedEvents() {
        return array(
            'eccube.event.controller.cart.before' => array(
                array('onCartIndexBefore', 10),
            ),
            'eccube.event.controller.cart.after' => array(
                array('onCartIndexAfter', 10),
            ),
            'eccube.event.controller.cart.finish' => array(
                array('onCartIndexFinish', 10),
            ),
            'eccube.event.render.cart.before' => array(
                array('onCartRenderBefore', 10),
            ),
        );
    }

    public function onCartIndexBefore()
    {
        echo 'Called method:: onCartIndexBefore()<br />';
    }

    public function onCartIndexAfter()
    {
        echo 'Called method:: onCartIndexAfter()<br />';
    }

    public function onCartIndexFinish()
    {
        echo 'Called method:: onCartIndexFinish()<br />';
    }

    public function onCartRenderBefore(RenderEvent $event)
    {
        echo 'Called method:: onCartRenderBefore()<br />';
        $source = $event->getSource();
        $source = str_replace(array('アイスクリーム'), array('３倍アイスクリーム'), $source);
        $event->setSource($source);
    }
}