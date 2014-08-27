<?php

/**
 * [����������� CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: ctl_upload.php 2012/9/4  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

class ctl_upload
{
    public static function index()
    {
		try
		{
			$id = $_GET['id'];
			if (empty($id)) throw new Exception("��������");
			template::assign('id', $id, PATH_TPLS_ADMIN);

			if ('upfile' == $_POST['action'] )
			{
				// �ϴ�ͼƬ
				set_time_limit(60);
				if (empty($_FILES[$id]['name'])) throw new Exception("��ѡ��Ҫ�ϴ����ļ���");

				// ������ϴ��ļ����ͺʹ�С
				// �޶�Ϊ.JPG��ʽ��2M
				$acc_type = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
				$max_size = 2100000;

				// ���������֤
				$filetype = $_FILES[$id]['type'];
				$uploadflag = false;
				foreach ($acc_type as $v)
				{
					if (strpos($filetype, $v) !== false)
					{
						$uploadflag = true;
						break;
					}
				}
				//$file_type = strrchr( $_FILES[$id]['name'] , '.' );

				// �ϴ���֤
				if ($uploadflag && $_FILES[$id]['size'] < $max_size )
				{
					if ($_FILES[$id]['error']>0) throw new Exception("�ļ��ϴ�ʧ�ܡ�");

					// ԭʼ�ļ��洢λ�ú��ļ���������
					//$save_path = PATH_UPLOAD .'/images/'. date('Ym') ;
                    $save_path = PATH_UPLOAD .'/images';
					//$save_name = strtolower( time() . rand( 1 , 10000 ) ) ;
					//$file_path = $save_path .'/'. $save_name . $file_type;
                    $file_path = $save_path .'/'. $_FILES[$id]['name'];

					// ִ�������֤
					if (!file_exists($save_path))
					{
						if (!file_helper::mkdir_recursive($save_path, 0777))
						{
							throw new Exception("�޷����ϴ�Ŀ¼�½��ļ��У��������Ӧ��Ȩ�ޡ�");
						}
					}
					//if (file_exists($file_path)) throw new Exception("�ļ��Ѿ����ڡ�");
                    if (file_exists($file_path)) unlink($file_path);

					// ת�ƻ���ͼƬ��ָ��Ŀ¼
					if ( move_uploaded_file($_FILES[$id]['tmp_name'], $file_path) )
					{
						//if ($file_type == '.jpg')
						if (false)
						{
							// ���ɶ�������ͼ
							$pictures = array(array('width'=>120, 'height'=>90));
							$targetfile = '';
							foreach ($pictures as $picture)
							{
								$targetfile =  $save_path .'/'. $save_name ."_". $picture['width'] ."x". $picture['height'] . $file_type;
								self::resizeToFile($file_path, $picture['width'], $picture['height'], $targetfile, 100);
							}
							// ɾ��ԭʼͼ
							//unlink($file_path);
						}

						// ����ֵ������·�������踸ҳ��Ԫ��
						$file_path = str_replace(PATH_ROOT, '', $file_path);
						template::assign('msg', "<script type='text/javascript'> (function(){window.parent.document.getElementById('" .$id ."').value='$file_path';})(); </script> ͼƬ�ϴ��ɹ���", PATH_TPLS_ADMIN);
					} else {
						throw new Exception("�ļ�����ʧ�ܡ�");
					}
				} else {
					throw new Exception("�ļ����ͻ��С������Ҫ��");
				}
			}
		}
        catch( Exception $e )
        {
            template::assign('msg', $e->getMessage(), PATH_TPLS_ADMIN);
        }
        template::display('upload.tpl', PATH_TPLS_ADMIN);
	}



	/* resizeToFile resizes a picture and writes it to the harddisk
	*
	* $sourcefile = the filename of the picture that is going to be resized
	* $dest_x       = X-Size of the target picture in pixels
	* $dest_y       = Y-Size of the target picture in pixels
	* $targetfile = The name under which the resized picture will be stored
	* $jpegqual   = The Compression-Rate that is to be used
	*/

	private static function resizeToFile($sourcefile, $dest_x, $dest_y, $targetfile, $jpegqual)
	{


	/* Get the dimensions of the source picture */
		$picsize = getimagesize("$sourcefile");

		$source_x = $picsize[0];
		$source_y = $picsize[1];
		$source_id = imageCreateFromJPEG("$sourcefile");

	/* Create a new image object (not neccessarily true colour) */

		$target_id = imagecreatetruecolor($dest_x, $dest_y);

	/* Resize the original picture and copy it into the just created image
	   object. Because of the lack of space I had to wrap the parameters to
	   several lines. I recommend putting them in one line in order keep your
	   code clean and readable */


		$target_pic = imagecopyresampled($target_id,$source_id,
									   0,0,0,0,
									   $dest_x,$dest_y,
									   $source_x,$source_y);

	/* Create a jpeg with the quality of "$jpegqual" out of the
	   image object "$target_pic".
	   This will be saved as $targetfile */

		imagejpeg ($target_id,"$targetfile",$jpegqual);

		return true;

	}

}
