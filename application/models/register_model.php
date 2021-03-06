<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of register_model
 *
 * @author Azarias
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class register_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_data() {
        $data['emplois'] = $this->get_emplois();
        $data['activites'] = $this->get_activites();
        $data['station'] = $this->get_stations();
        return $data;
    }

    private function get_all($name) {
        $this->db->select('*');
        $this->db->from($name);

        return $this->db->get()->result();
    }

    private function get_stations() {
        $stations = $this->get_all('Stations');

        $nom_station = array();
        foreach ($stations as $key => $value) {
            $nom_station[$value->nomS] = $value->massif;
        }

        array_multisort(array_values($nom_station), SORT_REGULAR, array_keys($nom_station), SORT_REGULAR);
        //Pour ordonner l'array par clé puis par valeur
        
        return $nom_station;
    }

    private function get_emplois() {
        $emploi = $this->get_all('Emplois');

        $nom_emploi = array();
        foreach ($emploi as $key => $value) {
            $nom_emploi[$key] = $value->nomE;
        }
        asort($nom_emploi);
        return $nom_emploi;
    }

    private function get_activites() {
        $activites = $this->get_all('Activites_fav');

        $nom_acts = array();
        foreach ($activites as $key => $value) {
            $nom_acts[$value->nomA] = $value->saison;
        }

        asort($nom_acts);
        return $nom_acts;
    }

}
