<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan extends CI_Controller
{
    private $key = 'awe12rhsto1m23fsd/';

    public function index()
    {
        header('Content-type: application/json');
        $dir = 'Drive';
        if ($this->input->get('init') != null) {
            $dir = $this->input->get('init');
            $hidden = explode('/',$this->input->get('init'));
            array_pop($hidden);
            $hidden = implode('/',$hidden).'/';
        }
        else if ($this->input->get('key') != null && $this->input->get('key') == $this->key) {
            $hidden = '';
        }
        else {
            echo json_encode([]);
            return;
        }

        $response = $this->my_scan($dir, $hidden);

        echo json_encode(array(
            "name" => str_replace($hidden, '', $dir),
            "type" => "folder",
            "path" => str_replace($hidden, '', $dir),
            "items" => $response
        ));
    }

    public function my_scan($dir, $hidden){

        $files = array();
    
        // Is there actually such a folder/file?

        if(file_exists($this->key.$dir)){
            foreach(scandir($this->key.$dir) as $f) {
            
                if(!$f || $f[0] == '.') {
                    continue; // Ignore hidden files
                }
    
                if(is_dir($this->key.$dir . '/' . $f)) {
    
                    // The path is a folder
    
                    $files[] = array(
                        "name" => $f,
                        "type" => "folder",
                        "path" => str_replace($hidden, '', $dir . '/' . $f),
                        "items" => $this->my_scan($dir . '/' . $f, $hidden) // Recursively get the contents of the folder
                    );
                }
                
                else {
    
                    // It is a file
    
                    $files[] = array(
                        "name" => $f,
                        "type" => "file",
                        "path" => '/download?file='.$dir . '/' . $f,
                        "size" => filesize($this->key.$dir . '/' . $f) // Gets the size of this file
                    );
                }
            }
        
        }
        return $files;
    }
}
