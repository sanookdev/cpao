<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{
    private $key = 'awe12rhsto1m23fsd/jdownloads/';

    function index($file = '')
    {
        $this->load->model('folder_Model');
        $this->load->model('folderFile_Model');
        $id = $this->input->get('id');
        $file_entity = $this->folderFile_Model->getByIdOne($id);
        if (!$file_entity) {
            $data['heading'] = '404 Page Not Found';
			$data['message'] = '<p>The page you requested was not found.</p>';
			$this->load->view('errors/html/error_404', $data);
			return;
        }
        $folder = $this->folder_Model->getByIdOne($file_entity['cat_id']);
        $this->folderFile_Model->increment($id);
        
        $file = $folder['cat_dir'].'/'.$file_entity['url_download'];
        $file_name = $file_entity['url_download'];
        $type = $this->getFileMimeType($_SERVER['DOCUMENT_ROOT'] . '/cpao/' . $this->key . $file);
        header("Content-Type: $type");
        header("Content-disposition: inline; filename=$file_name");
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        readfile($this->key . $file);
    }

    function finder($file='') 
    {
        $key = 'awe12rhsto1m23fsd/';
        $file = $this->input->get('file');
        $file_name = basename($file); 
        $type = $this->getFileMimeType($_SERVER['DOCUMENT_ROOT'] . '/cpao/' . $key . $file);
        header("Content-Type: $type");
        header("Content-disposition: inline; filename=$file_name");
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        readfile($key.$file);
    }

    function getFileMimeType($file)
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ($ext == 'zip' || $ext == 'rar' || $ext == '7z' ) {
            return 'application/zip';
        }
        if (function_exists('finfo_file')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($finfo, $file);
            finfo_close($finfo);
        } else {
            require_once 'upgradephp/ext/mime.php';
            $type = mime_content_type($file);
        }

        if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
            $secondOpinion = exec('file -b --mime-type ' . escapeshellarg($file), $foo, $returnCode);
            if ($returnCode === 0 && $secondOpinion) {
                $type = $secondOpinion;
            }
        }

        if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
            require_once 'upgradephp/ext/mime.php';
            $exifImageType = exif_imagetype($file);
            if ($exifImageType !== false) {
                $type = image_type_to_mime_type($exifImageType);
            }
        }

        return $type;
    }
}
