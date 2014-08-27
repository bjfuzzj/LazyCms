<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_securimage.php 2012-5-8  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_securimage
{
	public function index() {
		$this->show();
	}

	public function show(){
		$img = new securimage();
		$img->image_width = "80";
		$img->image_height = "25";
		$img->text_x_start = 5;
		$img->text_minimum_distance = 18;
		$img->text_maximum_distance = 18;
		$img->gd_font_size = 10;
		$img->font_size = 16;
		$img->line_distance = 4;
		$img->arc_linethrough = false;
		$img->show();
	}
}
