<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_index.php 2012-5-17  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_index
{
    public static function index()
    {
		url::make_index();
        
		template::assign('title', config::get_one('title'));
		template::assign('keywords', config::get_one('metakeyword'));
		template::assign('description', config::get_one('metadescrip'));
		template::assign('site', config::get_configs());
		template::assign('path', '');
        //增加首页flash信息
        $contents=plate_content::get_banners();
        template::assign('banners', plate_content::get_banners());
        $doc = new DOMDocument; 
        $doc->load(PATH_ROOT."/template/default/static/CU3ER-config.xml");
        $slides = $doc->documentElement->getElementsByTagName('slide');
        $i=0;
        foreach($slides as $slide) 
        {   
            $purviews = $slide->getElementsByTagName('link');
            $purview = $purviews->item(0);
            $tmpNode = $purview->cloneNode();
            $newCDATA=$doc->createCDATASection($contents[$i]['link_url']);
            $tmpNode->appendChild($newCDATA);
            //$tmpNode->nodeValue ='<![CDATA['.$contents[$i]['link_url'].']]>';   
            $tmpNode = $purview->parentNode->appendChild($tmpNode);
            $purview->parentNode->replaceChild($tmpNode,$purview);
            $doc->save(PATH_ROOT."/template/default/static/CU3ER-config.xml");
            $i++; 
        } 
        

		template::registerPlugin('function', 'site_config', 'func_site_config');

		template::registerPlugin('function', 'func_article_category', 'func_article_category');
		template::registerPlugin('block', 'block_article_category', 'block_article_category');

		template::registerPlugin('function', 'func_article_list', 'func_get_article_list');
		template::registerPlugin('block', 'block_article_list', 'block_get_article_list');

		template::registerPlugin('function', 'func_page_category', 'func_page_category');
		template::registerPlugin('block', 'block_page_category', 'block_page_category');

		template::registerPlugin('function', 'func_page_list', 'func_get_page_list');
		template::registerPlugin('block', 'block_page_list', 'block_get_page_list');

		template::registerPlugin('function', 'plate', 'func_get_plate_content');
        template::registerPlugin('function', 'banner_link', 'func_get_banner_link');
        
		template::display('index.tpl');
	}
}
