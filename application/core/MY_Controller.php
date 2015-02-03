<?php class MY_Controller extends CI_Controller{
    protected function resize_image($file, $path){
        $this->load->library('image_lib');

        $config['image_library'] = 'gd2';
        $config['source_image']	= $path.$file;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 1024;

        $this->image_lib->initialize($config);

        $this->image_lib->resize();
    }

    protected function make_thumb($file, $path){
        $this->load->library('image_lib');

        $config['image_library'] = 'gd2';
        $config['source_image']	= $path.$file;
        $config['new_image'] = $path."thumbs/".$file;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 148;
        $config['height'] = 98;

        $this->image_lib->initialize($config);

        $this->image_lib->resize();

    }
}