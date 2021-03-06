<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Static_pages
 *
 * @author Azarias
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Static_pages extends CI_Controller {

    //put your code here
    var $data;

    function __construct() {
        parent::__construct();
        //$this->data['pictures'] = base_url().'assets/others/images/';
        $this->load->helper('url');
    }

    function index() {
        redirect('welcome');
    }

    function accueil() {
        $this->load->view('required/links');
        $this->load->view('accueil/accueil_view');
        $this->load->view('required/footer');
    }

    function services() {
        $this->load->view('required/links');
        $this->navbar_collapse();
        $this->load->view('services/accueil');
    }

    function navbar_collapse() {
        $this->load->model('modals_model');
        //Tous les fichiers requis pour le js et le css
        $this->load->view('services/services_links');

        //La navbar en elle-même
        $this->load->view('required/navbar_collapse');

        //Tout les modaux qui vont avec
        $modal_data = array(
            'type_log' => array(
                'column_name' => 't_typeheb',
                'table_name' => 'Hebergement h',
                'column_id' => 'h.idh'
            ),
            'lieu_log' => array(
                'column_name' => 'lieu',
                'table_name' => 'Hebergement h',
                'column_id' => 'h.idh'
            ),
            'lieu_act' => array(
                'column_name' => 'lieu',
                'table_name' => 'Activite a',
                'column_id' => 'a.ida'
            ),
            'a_transport' => array(
                'column_name' => 'provenance',
                'table_name' => 'Transport t',
                'column_id' => NULL
            ),
            'd_transport' => array(
                'column_name' => 'destination',
                'table_name' => 'Transport t',
                'column_id' => NULL)
        );
        
        foreach ($modal_data as $key => $value){
            $modal_data[$key] = $this->modals_model->recup_infos($value);
        }
        
        $this->load->view('modals/t_logement',array('logement' =>$modal_data['type_log']));

        $this->load->view('modals/l_logement', array('logement' =>$modal_data['lieu_log']));

        $this->load->view('modals/l_activite', array('lieu' =>$modal_data['lieu_act']));
        
        //Pour la saison, pas besoin d'avoir accès à la BDD pour savoir qu'il y a 'Eté' ou Hiver !
        $this->load->view('modals/s_activite');

        $this->load->view('modals/a_transport', array('transport' =>$modal_data['a_transport']));

        $this->load->view('modals/d_transport', array('transport' =>$modal_data['d_transport']));
    }

    /*
     * Toutes les fonctions qui permettent d'accéder à des services
     */

    function activites() {
        $this->load->model('activite_model');
        $filter = $this->session->userdata('filter_activite');
        if ($filter == NULL || empty($filter)) {
            $data['data'] = $this->activite_model->all();
        } else {
            $data['data'] = $filter;
        }
        $this->load->view('required/links');
        $this->navbar_collapse();
        $this->load->view('services/activites', $data);
        $this->load->view('required/footer');
    }

    function transport() {
        $this->load->view('required/links');
        $this->navbar_collapse();
        $this->load->view('services/transport');
    }

    function logement() {       
        $this->load->view('required/links');
        $this->navbar_collapse();
        $this->load->view('services/logement');
    }

    function creer_pack() {
        /*
         * Quand l'utilisateur va pour créer un pack, il faut 'prévenir' les autres pages
         * Pour qu'on puisse ajouter un bouton 'ajouter au pack'
         * Si l'utilisateur annule la création d'un pack, on efface cette variable
         * 
         * 
         * On créer une variable pour y stocker les infos du pack
         * Si celle-ci n'a pas été créé
         */

        if ($this->session->userdata('creer') == NULL) {
            $creation = array(
                'logement' => 0,
                'transport' => 0,
                'activite' => 0
            );
        } else {
            $creation = $this->session->userdata('creer');
        }

        /*
         * Pour chaque service, on stock l'id pour pouvoir ensuite réafficher correctement la page
         * Tant que l'utilisateur est connecté on peut stocker dans un array (temp)
         * Quand il se deconnecte, il faut le prévenir qu'il faut qu'il enregistre ce qu'il a fait s'il veut continuer la prochaine fois
         */
        $this->session->set_userdata('creer', $creation);

        $this->load->view('required/links');
        $this->load->view('creerPack/style');
        $this->navbar_collapse();
        $this->load->view('creerPack/creerPack');
    }

    function contact() {
        ;
        $this->load->view('required/links');
        $this->load->view('othercss');
        $this->navbar_collapse();
        $this->load->view('contact');
    }

    function retrouver_mdp() {
        $this->load->view('required/links');
        $this->load->view('login/forgot_password');
    }

}
