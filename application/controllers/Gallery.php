<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Gallery extends Application {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            //get all the images from our model
            $pix = $this->images->all();
            
            //build an array of formatted cells for them
            foreach($pix as $picture)
                $cells[] = $this->parser->parse('_cell', (array) $picture, true);
            
            //prime the table class
            $this->load->library('table');
            $parms = array(
                'table_open' => '<table class"gallery">',
                'cell_start' => '<td class="oneimage">',
                'cell_alt_start' => '<td class="oneimage">'
            );
            $this->table->set_template($parms);
            
            //finally! generate the table
            $rows = $this->table->makecolumns($cells, 3);
            $this->data['thetable'] = $this->table->generate($rows);

            //$this->load->view('gallery');
            $this->data['pagebody'] = 'gallery';
            $this->render();
	}
}
