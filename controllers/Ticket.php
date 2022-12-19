<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

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
    
    function jeEmailPrihlasen($nasid) {
        if ($this->session->userdata('oc') == Null) {
            $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticket_read/'. $nasid); 
        }
    }
     
     
    function jePrihlasen() {
        if ($this->session->userdata('oc') == Null) {
            $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('upozorneni');
        }
    }
    
     function jeZakBrigadnik() {
        if ($this->session->userdata('opravneni') > 1) {
            $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticketadd');
        }
    }
    
      function jeZamestnanec() {
        if ($this->session->userdata('opravneni') < 2) {
            $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticketaddzak');
        }
    }
    
    function jeOddeleniresi($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid);
        if ($this->session->userdata('oddeleni') <> $ticket->oddeleni_resi or $this->session->userdata('typ') == 2){
            redirect('ticket_read2/'. $nasid); 
        }
    }
    
    function jeOddelenizadal($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid);
        if ($this->session->userdata('oddeleni') <> $ticket->oddeleni_zadal ){
            redirect('ticket_ne_submit/'. $nasid); 
        }
    }
    
    function jeAdminpristup($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid); 
        $pomoc = $this->Ticket_model->getpomocpristup($nasid); 
    //    $vedouci = $this->Ticket_model->getvedoucipristup($nasid); 
    //    $pomoc = $this->Ticket_model->getpomocpristup($nasid);
        if($this->session->userdata('oddeleni') <> $ticket->oddeleni_resi and $this->session->userdata('oddeleni') <> $ticket->oddeleni_zadal and $this->session->userdata('opravneni') < 6 and $pomoc == Null) {
    //   $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticket_read2/'. $nasid); 
        }
    }
    
    function jeEditpristup($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid);
        $pomoc = $this->Ticket_model->getpomocpristup($nasid);
     //   $vedouci2 = $this->Ticket_model->getvedoucipristup2($nasid);
        if($this->session->userdata('oc') <> $ticket->oc_zadal and $pomoc == Null and $this->session->userdata('opravneni') < 6) {
    //   $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticket_read2/'. $nasid); 
        }
    }
    
    
    
    function neniUzavren($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid);
        if($ticket->stav == 7) {
        //   $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticket_read2/'. $nasid); 
        }
    }
    
     function neniSubmit($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid);
        if($ticket->stav <> 5) {
        //   $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticket_ne_submit/'. $nasid); 
        }
    }
    
      function neniClose($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid);
        if($ticket->stav <> 6) {
        //   $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticket_read2/'. $nasid); 
        }
    }
    
      function neniOtevren($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid);
        if($ticket->stav <> 1) {
        //   $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticket_read2/'. $nasid); 
        }
    }
    
     function neniPrirazen($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid);
        if($ticket->stav <> 2) {
        //   $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticket_read2/'. $nasid); 
        }
    }
    
    
     function jezpracovan($nasid) {
        $ticket = $this->Ticket_model->getTicket($nasid);
        if($ticket->stav < 3 or $ticket->stav > 4) {
        //   $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
            redirect('ticket_read2/'. $nasid); 
        }
    }
    
     function ticket_filter($nasid = NULL) {
       
        $this->jePrihlasen(); 
        $ticket = $this->Ticket_model->getTicket($nasid);
    //    $pomoc = $this->Ticket_model->getpomocpristup($nasid);    
        
        
            
                      if($ticket->stav == 1){ 
                       
                      redirect('ticket_new/'. $nasid); } 
                     
                      if($ticket->stav == 2){ 
                     
                      redirect('ticket_new2/'. $nasid); }  
                     
                      if($ticket->stav == 3){ 
                    
                      redirect('ticket_detail/'. $nasid); 
                      
                      } 
                      
                      if($ticket->stav == 4){ 
                  
                      redirect('ticket_detail/'. $nasid); 
                      
                      } 
                      
                      if($ticket->stav == 5){ 
                  
                      redirect('ticket_submit/'. $nasid); }
                      
                     
                      
                      if($ticket->stav == 6){ 
                      
                      redirect('ticket_close/'. $nasid); }
                      
                     
                      
                      if($ticket->stav == 7){ 
                  
                     
                      redirect('ticket_read2/'. $nasid); 
                      
                      }   
    
    }
    
     function ticket_read2($nasid = NULL) {
       
        $this->jePrihlasen(); 
        $ticket = $this->Ticket_model->getTicket($nasid);
     //   if ( $this->session->userdata('oddeleni') == $ticket->oddeleni_resi or $this->session->userdata('oddeleni') == $ticket->oddeleni_zadal)   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $log = $this->Ticket_model->getTicketlog($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);                                                                                      
        $tic_realizace = $this->Ticket_model->aktustavrealizace($ticket->realizace); 
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        
      //  $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
      //  $resitel = $this->Ticket_model->getTicket_resi($nasid); 
        $seznam = $this->Main_model->getTym($ticket->oddeleni_resi); 
        $data = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $spoluprace = $this->Ticket_model->getSpoluprace($data);  
        $spolupracovani = $this->Ticket_model->gethelpvse($nasid);         
      //  $spolupracovani2 = $this->Ticket_model->getFullhelp($nasid);
        $vystup = array(
                 'ticket' => $ticket,
                 'log' => $log,
                 'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'seznam' => $seznam,
                 'spoluprace' => $spoluprace,
                 'spolupracovani' => $spolupracovani,
                 'zpet' => $this->session->userdata('zpet'),
                 'tic_realizace' => $tic_realizace,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
                  'tic_oddeleni' => $tic_oddeleni,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket,
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
        $this->Ticket_model->getViewUpdate($nasid);  
        $this->load->view('ticket_read2', $vystup);    
    } 
    
   // else  { 
    
    
    function ticket_read($nasid = NULL) {
       
     //   $this->jeEmailPrihlasen($nasid); 
        $ticket = $this->Ticket_model->getTicket($nasid);
     //   if ( $this->session->userdata('oddeleni') == $ticket->oddeleni_resi or $this->session->userdata('oddeleni') == $ticket->oddeleni_zadal)   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $log = $this->Ticket_model->getTicketlog($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);                                                                                      
        $tic_realizace = $this->Ticket_model->stavrealizace($ticket->realizace); 
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        
      //  $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
      //  $resitel = $this->Ticket_model->getTicket_resi($nasid); 
        $seznam = $this->Main_model->getTym($ticket->oddeleni_resi); 
        $data = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $spoluprace = $this->Ticket_model->getSpoluprace($data);  
        $spolupracovani = $this->Ticket_model->gethelpvse($nasid);         
      //  $spolupracovani2 = $this->Ticket_model->getFullhelp($nasid);
        $vystup = array(
                 'ticket' => $ticket,
                 'log' => $log,
                 'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'seznam' => $seznam,
                 'spoluprace' => $spoluprace,
                 'spolupracovani' => $spolupracovani,
                 'zpet' => $this->session->userdata('zpet'),
                 'tic_realizace' => $tic_realizace,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
                  'tic_oddeleni' => $tic_oddeleni,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket,
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
        $this->Ticket_model->getViewUpdate($nasid);  
        
         if ($this->session->userdata('oc') <> Null) 
        { redirect('ticket_filter/'. $nasid); }                  
        
        else
        { $this->load->view('ticket_read', $vystup);     }
        
        
    } 
    
   // else  { 
   // redirect('ticketsall');
   // }
  //  }
  
   function ticket_print($nasid = NULL) {
       
     
        $ticket = $this->Ticket_model->getTicket($nasid);
      
        $vystup = array(
                 'ticket' => $ticket,
                
        );
        
        
      $this->load->view('ticket_print', $vystup);  
        
        
    } 
    
   // else  { 
   // redirect('ticketsall');
   // }
  //  }
  
      function ticket_submit($nasid = NULL) {
       
        $this->jePrihlasen(); 
        $this->jeOddelenizadal($nasid);
        $this->neniSubmit($nasid);
        $ticket = $this->Ticket_model->getTicket($nasid);
   //    if ( $this->session->userdata('oddeleni') == $ticket->oddeleni_resi or $this->session->userdata('oddeleni') == $ticket->oddeleni_zadal)   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $log = $this->Ticket_model->getTicketlog($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);     
                                                                                              
        $tic_realizace = $this->Ticket_model->aktustavrealizace($ticket->realizace); 
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
      //  $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
      //  $resitel = $this->Ticket_model->getTicket_resi($nasid); 
        $seznam = $this->Main_model->getTym($ticket->oddeleni_resi); 
        $data = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $spoluprace = $this->Ticket_model->getSpoluprace($data);  
        $spolupracovani = $this->Ticket_model->gethelpvse($nasid); 
        
        
                
     //   $spolupracovani2 = $this->Ticket_model->getFullhelp($nasid);
        $vystup = array(
                 'ticket' => $ticket,
                 'log' => $log,
                 'seznam' => $seznam,
                 'spoluprace' => $spoluprace,
                 'spolupracovani' => $spolupracovani,
                 'zpet' => $this->session->userdata('zpet'),
                 'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'tic_realizace' => $tic_realizace,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
                  'tic_oddeleni' => $tic_oddeleni,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket,
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
        $this->Ticket_model->getViewUpdate($nasid);  
        $this->load->view('ticket_submit', $vystup);    
    }
    
    
      function ticket_ne_submit($nasid = NULL) {
       
        $this->jePrihlasen(); 
        $this->jeOddeleniresi($nasid);
        $this->neniSubmit($nasid);
        $ticket = $this->Ticket_model->getTicket($nasid);
   //    if ( $this->session->userdata('oddeleni') == $ticket->oddeleni_resi or $this->session->userdata('oddeleni') == $ticket->oddeleni_zadal)   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);     
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $log = $this->Ticket_model->getTicketlog($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
                                                                                              
        $tic_realizace = $this->Ticket_model->aktustavrealizace($ticket->realizace); 
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
      //  $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
      //  $resitel = $this->Ticket_model->getTicket_resi($nasid); 
        $seznam = $this->Main_model->getTym($ticket->oddeleni_resi); 
        $data = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $spoluprace = $this->Ticket_model->getSpoluprace($data);  
        $spolupracovani = $this->Ticket_model->gethelpvse($nasid);         
     //   $spolupracovani2 = $this->Ticket_model->getFullhelp($nasid);
        $vystup = array(
                 'ticket' => $ticket,
                 'log' => $log,
                 'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'seznam' => $seznam,
                 'spoluprace' => $spoluprace,
                 'spolupracovani' => $spolupracovani,
                 'zpet' => $this->session->userdata('zpet'),
                 'tic_realizace' => $tic_realizace,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
                  'tic_oddeleni' => $tic_oddeleni,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket,
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
        $this->Ticket_model->getViewUpdate($nasid);  
        $this->load->view('ticket_ne_submit', $vystup);    
    } 
    
    
      function ticket_close($nasid = NULL) {
       
        $this->jePrihlasen(); 
        $this->jeOddeleniresi($nasid);
        $this->neniClose($nasid);
        $ticket = $this->Ticket_model->getTicket($nasid);
   //    if ( $this->session->userdata('oddeleni') == $ticket->oddeleni_resi or $this->session->userdata('oddeleni') == $ticket->oddeleni_zadal)   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);     
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $log = $this->Ticket_model->getTicketlog($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
                                                                                              
        $tic_realizace = $this->Ticket_model->aktustavrealizace($ticket->realizace); 
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
      //  $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
      //  $resitel = $this->Ticket_model->getTicket_resi($nasid); 
        $seznam = $this->Main_model->getTym($ticket->oddeleni_resi); 
        $data = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $spoluprace = $this->Ticket_model->getSpoluprace($data);  
        $spolupracovani = $this->Ticket_model->gethelpvse($nasid);         
     //   $spolupracovani2 = $this->Ticket_model->getFullhelp($nasid);
        $vystup = array(
                 'ticket' => $ticket,
                 'log' => $log,
                 'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'seznam' => $seznam,
                 'spoluprace' => $spoluprace,
                 'spolupracovani' => $spolupracovani,
                 'zpet' => $this->session->userdata('zpet'),
                 'tic_realizace' => $tic_realizace,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
                  'tic_oddeleni' => $tic_oddeleni,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket,
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
        $this->Ticket_model->getViewUpdate($nasid);  
        $this->load->view('ticket_close', $vystup);    
    } 
    
    
     function ticket_autor($nasid = NULL) {
       
        $this->jePrihlasen(); 
        $this->jeEditpristup($nasid);
        $this->jezpracovan($nasid);
        $ticket = $this->Ticket_model->getTicket($nasid);
   //    if ( $this->session->userdata('oddeleni') == $ticket->oddeleni_resi or $this->session->userdata('oddeleni') == $ticket->oddeleni_zadal)   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $log = $this->Ticket_model->getTicketlog($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);   
                                                                                              
        $tic_realizace = $this->Ticket_model->aktustavrealizace($ticket->realizace); 
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
      //  $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
      //  $resitel = $this->Ticket_model->getTicket_resi($nasid); 
        $seznam = $this->Main_model->getTym($ticket->oddeleni_resi); 
        $data = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $spoluprace = $this->Ticket_model->getSpoluprace($data);  
        $spolupracovani = $this->Ticket_model->gethelpvse($nasid);         
      //  $spolupracovani2 = array_diff($spoluprace, $spolupracovani);
         
     //   $result = array_diff($spoluprace, $spolupracovani);
      
        $vystup = array(
                 'ticket' => $ticket,
                 'log' => $log,
                 'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'seznam' => $seznam,
                 'spoluprace' => $spoluprace,
                 'spolupracovani' => $spolupracovani,
                 'zpet' => $this->session->userdata('zpet'),
                 'tic_realizace' => $tic_realizace,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
                  'tic_oddeleni' => $tic_oddeleni,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket,
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
        $this->Ticket_model->getViewUpdate($nasid);  
      //  $this->load->view('ticket_autor', $vystup);    
        
       
        $this->load->view('ticket_autor', $vystup);              
        
        } 
        
        
        function ticket_detail_vykaz($nasid = NULL) {
       
        $this->jePrihlasen(); 
        $this->jeAdminpristup($nasid);
        $this->neniUzavren($nasid);
        $ticket = $this->Ticket_model->getTicket($nasid);
   //    if ( $this->session->userdata('oddeleni') == $ticket->oddeleni_resi or $this->session->userdata('oddeleni') == $ticket->oddeleni_zadal)   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $log = $this->Ticket_model->getTicketlog($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
        
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);  
        
        $this->db->select('sum(cas) as total');
        $this->db->where('id_ticket', $nasid); 
        $zamestnanci = $this->db->get('ticket_calendar'); 
        $zamestnanec = $zamestnanci->first_row();
        
        
        $stav =  $zamestnanec->total;
            
                                                                                              
        $tic_realizace = $this->Ticket_model->stavrealizace($ticket->realizace); 
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
      //  $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
      //  $resitel = $this->Ticket_model->getTicket_resi($nasid); 
        $seznam = $this->Main_model->getTym($ticket->oddeleni_resi); 
        $data = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $spoluprace = $this->Ticket_model->getSpoluprace($data);   
        $spolupracovani = $this->Ticket_model->gethelpvse($nasid);         
      //  $spolupracovani2 = $this->Ticket_model->getFullhelp($nasid);
        $vystup = array(
                 'ticket' => $ticket,
                 'log' => $log,
                 'seznam' => $seznam,
                 'spoluprace' => $spoluprace,
                 'spolupracovani' => $spolupracovani,
                 'stav' => $stav,
                 'tic_realizace' => $tic_realizace,
                 'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
                  'tic_oddeleni' => $tic_oddeleni,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket,
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
        $this->Ticket_model->getViewUpdate($nasid); 
        
        
        if($ticket->stav <> 6){ 
        $this->load->view('ticket_detail_vykaz', $vystup);              
                   }
        else {  redirect('ticket_filter/'. $nasid); }
    } 
       
     function auto_submit($nasid) {   
      $this->load->model("Ticket_model");
      $this->Ticket_model->auto_submit($nasid);
      redirect('ticketsall2'); 
      } 
      
      function auto_close($nasid) {   
      $this->load->model("Ticket_model");
      $this->Ticket_model->auto_close($nasid);
      redirect('ticketsall'); 
      }      
             
    
     
     function ticket_detail($nasid = NULL) {
       
        $this->jePrihlasen(); 
        $this->jeAdminpristup($nasid);
        $this->jezpracovan($nasid);
        $ticket = $this->Ticket_model->getTicket($nasid);
   //    if ( $this->session->userdata('oddeleni') == $ticket->oddeleni_resi or $this->session->userdata('oddeleni') == $ticket->oddeleni_zadal)   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $log = $this->Ticket_model->getTicketlog($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
        
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);      
        $supervizorccs = $this->Ticket_model->getSupervizor("2");                                                                                       
        $tic_realizace = $this->Ticket_model->stavrealizace("0"); 
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        $data2 = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                'oddeleni_resi' => $ticket->oddeleni_resi,
                );
        
        if ($this->session->userdata('oddeleni') == 2) {
         $seznam = $this->Main_model->getTymZakaznicke($data2); 
        }
        elseif ($this->session->userdata('oddeleni') == 20) {
         $seznam = $this->Main_model->getTymSupervizor($data2); 
        }
        
                                 
         else {
        
        $seznam = $this->Main_model->getTymZmena($data2); 
       }    
                              
                  
        
        $data = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $spoluprace = $this->Ticket_model->getSpoluprace($data);   
        $spolupracovani = $this->Ticket_model->gethelpvse($nasid);         
      //  $spolupracovani2 = $this->Ticket_model->getFullhelp($nasid);
        $vystup = array(
                 'ticket' => $ticket,
                 'log' => $log,
                 'seznam' => $seznam,
                 'spoluprace' => $spoluprace,
                 'spolupracovani' => $spolupracovani,
                 'supervizorccs' => $supervizorccs,
                 'tic_realizace' => $tic_realizace,
                 'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
                  'tic_oddeleni' => $tic_oddeleni,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket, 
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'zpet' => $this->session->userdata('zpet'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
        $this->Ticket_model->getViewUpdate($nasid);   
        
         $pomoc = $this->Ticket_model->getpomocpristup($nasid);  
         
        
         
        if($this->session->userdata('oc') == $ticket->oc_resi)
        { $this->load->view('ticket_detail', $vystup); } 
        
        elseif($this->session->userdata('oddeleni') == $ticket->oddeleni_resi and $this->session->userdata('opravneni') > 5)
        { $this->load->view('ticket_detail', $vystup); }     
        
        elseif($pomoc <> Null or $this->session->userdata('oc') == $ticket->oc_zadal)
        { redirect('ticket_autor/'. $nasid); }                 
        
        elseif($this->session->userdata('opravneni') > 11 or $this->session->userdata('oddeleni') == $ticket->oddeleni_zadal)
        { redirect('ticket_autor/'. $nasid); }
        else
        { redirect('ticket_read2/'. $nasid); }
       
                  
       
    } 
    
//   else  { 
//    redirect('ticketsall');
 //   }
 //   }
    
    function smazat_spolupraci($hlp_id) {  
    
     $this->jePrihlasen(); 
     $this->neniUzavren($nasid); 
     $ticket_id = $this->Ticket_model->del_spoluprace($hlp_id);
     redirect('ticket_filter/'. $ticket_id); 
    } 
    
    function smazat_soubor($fls_id) {  
    
     $this->jePrihlasen();
     $this->neniUzavren($nasid); 
     $ticket_id = $this->Ticket_model->del_soubor($fls_id);
     redirect('ticket_filter/'. $ticket_id); 
    } 
  
   function ticket_add() { 
        $this->jePrihlasen(); 
        $this->jeZamestnanec(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $menuodd = $this->Main_model->getMenuodd();
        $menuticket = $this->Ticket_model->getMenuticket();
     //   $oddeleniticket = $this->Ticket_model->getOddeleniticket();
     //   $prioritaticket = $this->Ticket_model->getPrioritaticket();
     
        $tic_id = Null; 
        $seznam = Null;     
       
     
        $this->form_validation->set_rules('text', 'Požadavek', 'required' );
        $this->form_validation->set_rules('predmet', 'Nadpis', 'required' );
        $this->form_validation->set_rules('tic_id', 'Oddělení', 'is_natural_no_zero' );
    //    $this->form_validation->set_rules('oc_resi', 'Řešitel', 'is_natural_no_zero' );
        
        $this->db->select('tic, zkratka, tic_oddeleni');
     //   $this->db->where('tic <>',$this->session->userdata('oddeleni')); 
        $this->db->order_by('tic_oddeleni', 'asc');
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        
         
        
        $zadav_seznam = $this->Main_model->getFullTym22();    
        
        
        if ($this->input->post('tic_id') > 0 ) {  
        
        $zprac = array ();
        $zprac['oddeleni'] = $this->input->post('tic_id');
        $zprac['zadavatel'] = $this->input->post('zadavatel');
        
        
        if ($this->input->post('zadavatel') <> $this->session->userdata('oc') ) {    
        $seznam = $this->Main_model->getTymTicket2($zprac); 
        $this->db->select('tic, zkratka, tic_oddeleni');
        $this->db->where('tic',$this->session->userdata('oddeleni')); 
        $this->db->order_by('tic_oddeleni', 'asc');
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        
         }      
        else { 
       
        $seznam = $this->Main_model->getTymTicket($zprac);       
       
        }
        
        } 
                
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
           'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Nový ticket"  . "</li>" ,
                 'today' => $today,
                 'seznam' => $seznam,
                 'zadav_seznam' => $zadav_seznam,
                 'tic_oddeleni' => $tic_oddeleni,
                  'menuwww' => $menuwww,
                  'menuobrazky' => $menuobrazky, 
                  'menuticket' => $menuticket,
                 
              //    'prioritaticket' => $prioritaticket, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'oddeleni' => $this->session->userdata('oddeleni'),
            'opravneni' => $this->session->userdata('opravneni'),
            'zpet' => $this->session->userdata('zpet'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'typ' => $this->session->userdata('typ'), 
            'menuodd' => $menuodd,                 
            
                 );
  
         $this->load->view('ticket_add', $vystup);
         
  
        } else { 
            $today = date("Y-m-d"); 
            $cas = date("Y-m-d H:i:s"); 
            
            
            $autor = $this->Main_model->getPrijmeniJmeno($this->input->post('zadavatel'));
            $prijmeni_autora = $autor['vedouci'] ;
            $oddeleni_autora = $autor['oddeleni'] ;   
            
             if($this->input->post('resitel') == Null){
             $resitel = 0 ;  
             } else { 
             $resitel = $this->input->post('resitel') ;   
             } 
            
            $data = array(
                
                'datum' => $today,
                'cas' => $cas, 
                'predmet' => $this->input->post('predmet'), 
                'text' => $this->input->post('text'), 
                'termin' => $this->input->post('termin'), 
                'zakcis' => $this->input->post('zakcis'), 
                'oc_resi' => $resitel, 
                'autor' => $prijmeni_autora, //. " " .  mb_substr ($this->session->userdata('jmeno'), 0, 1) . ".",
                'oc_zadal' => $this->input->post('zadavatel'),
                'oddeleni_zadal' => $oddeleni_autora,
                'oddeleni_resi' => $this->input->post('tic_id'),
                               
                
                );
            $this->db->insert('tickets', $data); 
            $idnew = $this->db->insert_id();
             
                        
                          
             $maildata = array ();
             $maildata['predmet'] = $this->input->post('predmet');
             $maildata['text'] = $this->input->post('text');
             $maildata['idnew'] = $idnew;  
             $maildata['autor'] = $prijmeni_autora; 
             $maildata['termin'] = $this->input->post('termin'); 
             $maildata['autor_oc'] = $this->input->post('zadavatel'); 
             $maildata['resitel_oc'] = $this->input->post('resitel'); 
             $maildata['zprava'] = "Nový ticket " ; 
             
                
            $email = $this->Email_model->getNewTicket($maildata);
            
            $log = array(                 
                'lg_autor' => $this->session->userdata('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 1,
                'tic_id' => $idnew,
                'lg_pozn' => $idnew,);
            $logupdate = $this->Ticket_model->getLogUpdate($log);
          
                       
            $this->load->library('upload');
            $image = array();
            $ImageCount = count($_FILES['image_name']['name']);
            for($i = 0; $i < $ImageCount; $i++){
            $_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
            $_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
            $_FILES['file']['size']       = $_FILES['image_name']['size'][$i];

            // File upload configuration
            $uploadPath = './tickets_files/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|xls|xlsx|doc|docx|csv|zip|rar';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
            // Uploaded file data
            $imageData = $this->upload->data();
            $uploadImgData[$i]['image_name'] = $imageData['file_name'];
            $uploadImgData[$i]['image_type'] = $imageData['file_type'];
            
              $file = array(
                
                'tic_id' => $idnew,
                'fls_autor' => $this->input->post('prijmeni'),
                'fls_oc' => $this->input->post('zadavatel'),
                'fls_datum' => $cas,
                'nazev' => $imageData['file_name'],
                'type' => $imageData['file_type'],
                
                   );
                                                               
                $this->db->insert('tickets_files', $file);  
             //   $poidnew = $this->db->insert_id();  
             
            $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 8,
                'tic_id' => $idnew,
                'lg_pozn' => $imageData['file_name'],);
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
             

            }
            }
           
          $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
          $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
           
                        
          //  $this->session->set_userdata('idnew', $idnew);
           redirect('ticket_filter/'. $idnew); 
            
            
            
            
            
            
            
            
         }
         }
         
          function ticket_add_zak() { 
        $this->jePrihlasen(); 
        $this->jeZakBrigadnik(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $menuodd = $this->Main_model->getMenuodd();
        $menuticket = $this->Ticket_model->getMenuticket();
     //   $oddeleniticket = $this->Ticket_model->getOddeleniticket();
     //   $prioritaticket = $this->Ticket_model->getPrioritaticket();
     
            
        $this->form_validation->set_rules('text', 'Požadavek', 'required' );
        $this->form_validation->set_rules('predmet', 'Nadpis', 'required' );
        $this->form_validation->set_rules('tic_id', 'Oddělení', 'is_natural_no_zero' );
        
        $this->db->select('tic, zkratka, tic_oddeleni');
        $this->db->where('(tic = 20 or tic < 3 or tic = 17)');
        $this->db->order_by('tic', 'asc');
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
    
        
        
        if ($this->input->post('zakcis') > 0  and $this->input->post('tic_id') <> 0 ) {  
        
        $zprac = array ();
        $zprac['oddeleni'] = $this->input->post('tic_id');
        $zprac['zakcis'] = $this->input->post('zakcis');
        $seznam = $this->Ticket_model->getZakazTicket($zprac); 
        $pocet = $this->db->affected_rows($seznam);
        
        $zakcis = $this->input->post('zakcis');  
        $hledej = 1;
        
        }  
             
        else { 
        
        $zakcis = Null;
        $seznam = Null;       
        $pocet = 0;
        $hledej = 0;   
       
        }
                  
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
           'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Nový zákaznický ticket"  . "</li>" ,
                 'today' => $today,
                 'seznam' => $seznam,  
                  'hledej' => $hledej,                 
                 'pocet' => $pocet,          
                 'tic_oddeleni' => $tic_oddeleni,
                  'menuwww' => $menuwww,
                  'menuobrazky' => $menuobrazky, 
                  'menuticket' => $menuticket,
                  'zakcis' => $zakcis, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'oddeleni' => $this->session->userdata('oddeleni'),
            'opravneni' => $this->session->userdata('opravneni'),
            'zpet' => $this->session->userdata('zpet'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'typ' => $this->session->userdata('typ'), 
            'menuodd' => $menuodd,                 
            
                 );
  
         $this->load->view('ticket_add_zak', $vystup);
         
  
        } else { 
            $today = date("Y-m-d"); 
            $cas = date("Y-m-d H:i:s"); 
            
            
            $prijmeni_autora = $this->Main_model->getPrijmJmenoZadav($this->input->post('zadavatel'));
            $resitel_oc = $this->Ticket_model->getSupervizor($this->input->post('tic_id'));
                                                  
            $data = array(
                
                'datum' => $today,
                'cas' => $cas, 
                'predmet' => $this->input->post('predmet'), 
                'text' => $this->input->post('text'), 
                'termin' => $this->input->post('termin'), 
                'zakcis' => $this->input->post('zakcis'), 
                'oc_resi' => $resitel_oc, 
                'autor' => $prijmeni_autora, //. " " .  mb_substr ($this->session->userdata('jmeno'), 0, 1) . ".",
                'oc_zadal' => $this->input->post('zadavatel'),
                'oddeleni_zadal' => $this->input->post('oddeleni_zadal'),
                'oddeleni_resi' => $this->input->post('tic_id'),
                               
                
                );
            $this->db->insert('tickets', $data); 
            $idnew = $this->db->insert_id();
             
                          
             $maildata = array ();
             $maildata['predmet'] = $this->input->post('predmet');
             $maildata['text'] = $this->input->post('text');
             $maildata['idnew'] = $idnew;  
             $maildata['autor'] = $prijmeni_autora; 
             $maildata['termin'] = $this->input->post('termin'); 
             $maildata['autor_oc'] = $this->input->post('zadavatel'); 
             $maildata['resitel_oc'] = $resitel_oc; 
             $maildata['zprava'] = "Nový ticket " ; 
                
            $email = $this->Email_model->getNewTicket($maildata);
            
            $log = array(                 
                'lg_autor' => $this->session->userdata('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 1,
                'tic_id' => $idnew,
                'lg_pozn' => $idnew,);
            $logupdate = $this->Ticket_model->getLogUpdate($log);
          
                       
            $this->load->library('upload');
            $image = array();
            $ImageCount = count($_FILES['image_name']['name']);
            for($i = 0; $i < $ImageCount; $i++){
            $_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
            $_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
            $_FILES['file']['size']       = $_FILES['image_name']['size'][$i];

            // File upload configuration
            $uploadPath = './tickets_files/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|xls|xlsx|doc|docx|csv|zip|rar';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
            // Uploaded file data
            $imageData = $this->upload->data();
            $uploadImgData[$i]['image_name'] = $imageData['file_name'];
            $uploadImgData[$i]['image_type'] = $imageData['file_type'];
            
              $file = array(
                
                'tic_id' => $idnew,
                'fls_autor' => $this->input->post('prijmeni'),
                'fls_oc' => $this->input->post('zadavatel'),
                'fls_datum' => $cas,
                'nazev' => $imageData['file_name'],
                'type' => $imageData['file_type'],
                
                   );
                                                               
                $this->db->insert('tickets_files', $file);  
             //   $poidnew = $this->db->insert_id();  
             
            $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 8,
                'tic_id' => $idnew,
                'lg_pozn' => $imageData['file_name'],);
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
             

            }
            }
           
          $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
          $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
           
                        
          //  $this->session->set_userdata('idnew', $idnew);
           redirect('ticket_filter/'. $idnew); 
            
            
            
            
            
            
            
            
         }
         }
         
         
         
        function ticket_detail_new2($nasid = NULL) { 
        $this->jePrihlasen();
        $this->jeOddeleniresi($nasid);
        $this->neniPrirazen($nasid);
        $ticket = $this->Ticket_model->getTicket($nasid);
      //  if ( $this->session->userdata('oc') == $ticket->oc_resi )   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
        
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);     
                                                                                              
        $tic_realizace = $this->Ticket_model->stavrealizace($ticket->realizace); 
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
      //  $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
      //  $resitel = $this->Ticket_model->getTicket_resi($nasid); 
        $seznam = $this->Main_model->getTym($ticket->oddeleni_resi); 
         $data = array(                 
                'oc_resi' => $ticket->oc_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $spoluprace = $this->Ticket_model->getSpoluprace($data);  
        $spolupracovani = $this->Ticket_model->gethelpvse($nasid);         
     //   $spolupracovani2 = $this->Ticket_model->getFullhelp($nasid);
        
              
             
        $this->load->helper('form');
        $this->load->library('form_validation');     
        $this->form_validation->set_rules('nasid', 'Ticket ID', 'required' );
        $this->form_validation->set_rules('termin_ok', 'Termín', 'required' );
        
                
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
                 'ticket' => $ticket,
                 'seznam' => $seznam,
                 'spoluprace' => $spoluprace,
                 'spolupracovani' => $spolupracovani,
                 'zpet' => $this->session->userdata('zpet'),
                 'tic_realizace' => $tic_realizace,
                 'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
                  'tic_oddeleni' => $tic_oddeleni,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket,
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
         $this->Ticket_model->getViewUpdate($nasid);  
         $this->load->view('ticket_detail_new2', $vystup);
         
  
        } else { 
        
            $cas = date("Y-m-d H:i:s"); 
            $ticket = $this->Ticket_model->getTicket($this->input->post('nasid')); 
                       
             
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 16,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $this->input->post('termin_ok'));
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
                'stav' => 3,
                'termin_ok' => $this->input->post('termin_ok'), 
                
                  
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
            
               
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Potvrzený");
            $logupdate = $this->Ticket_model->getLogUpdate($log);   
            
             $maildata = array ();
             $maildata['stav'] = "Potvrzený";
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
             $email = $this->Email_model->getNewStav($maildata); 
            
                     
              
             $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));          
             $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));      
             redirect('ticket_filter/'. $this->input->post('nasid')); 
            
           } 
           
           } 
           
       //    else  { 
       //    $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
       //    redirect('ticketsall');
   // } 
            
      //    } 
         
        function ticket_detail_new($nasid = NULL) { 
        $this->jePrihlasen();
        $this->jeOddeleniresi($nasid);
        $this->neniOtevren($nasid);
        $ticket = $this->Ticket_model->getTicket($nasid);
      //  if ( $this->session->userdata('oddeleni') == $ticket->oddeleni_resi )   {
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        
        $files = $this->Ticket_model->getTicketfiles($nasid);
        $answear = $this->Ticket_model->getTicketansw($nasid);
        $menuodd = $this->Main_model->getMenuodd();
        $menufamily = $this->Main_model->getMenuFamily();
        $menuticket = $this->Ticket_model->getMenuticket();
        
        $lastview = $this->Ticket_model->getLastview($nasid);
        $lastedit = $this->Ticket_model->getLastedit($nasid); 
        $next = $this->Ticket_model->getdalsiakce($ticket->stav);     
                                                                                              
        $tic_realizace = $this->Ticket_model->stavrealizace($ticket->realizace); 
    //    $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        $data2 = array(                 
                'oddeleni_resi' => $ticket->oddeleni_resi,
                'oc_zadal' => $ticket->oc_zadal,
                );
        $seznam = $this->Ticket_model->getResitel($data2); 
    //    $data = array(                 
    //            'oc_resi' => $ticket->oc_resi,
    //            'oc_zadal' => $ticket->oc_zadal,
    //            );
    //    $spoluprace = $this->Ticket_model->getSpoluprace($data);  
    //    $spolupracovani = $this->Ticket_model->gethelpvse($nasid);         
    //    $spolupracovani2 = $this->Ticket_model->getFullhelp($nasid);
        
               
             
        $this->load->helper('form');
        $this->load->library('form_validation');     
        $this->form_validation->set_rules('nasid', 'Ticket ID', 'required' );
        $this->form_validation->set_rules('oc_resi', 'Řeší', 'is_natural_no_zero' );
        $this->form_validation->set_rules('tic_id', 'Oddělení (řeší)', 'is_natural_no_zero' );
        
                
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
                 'ticket' => $ticket,
                 'seznam' => $seznam,
            //     'spoluprace' => $spoluprace,
            //     'spolupracovani' => $spolupracovani,
                 'zpet' => $this->session->userdata('zpet'),
                 'tic_realizace' => $tic_realizace,
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket detail "  . "</li>" ,
                 'today' => $today,
                 'menuobrazky' => $menuobrazky,     
                 'menuwww' => $menuwww,
                 'menufamily' => $menufamily,
            //      'tic_oddeleni' => $tic_oddeleni,
                  'next' => $next,
                 'lastview' => $lastview,
                 'lastedit' => $lastedit,
                 'files' => $files,
                 'answear' => $answear,
            'menuticket' => $menuticket,
            'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'email' => $this->session->userdata('email'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),
            'menuodd' => $menuodd, 
        );
          $this->Ticket_model->getViewUpdate($nasid);  
         $this->load->view('ticket_detail_new', $vystup);
         
  
        } else { 
        
            $cas = date("Y-m-d H:i:s"); 
            $ticket = $this->Ticket_model->getTicket($this->input->post('nasid')); 
                       
          
            
          
            
            $aktprijmeni = $this->Ticket_model->getTicket_prijmeni($this->input->post('oc_resi'));
            $oddeleni_zmena = $this->Ticket_model->getTicket_oddel_zmena($this->input->post('oc_resi')); 
            
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 12,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $aktprijmeni);
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
                'stav' => 2,
                'oc_resi' => $this->input->post('oc_resi'), 
                'oddeleni_resi' => $oddeleni_zmena, 
                  
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
            
               
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Přiřazený");
            $logupdate = $this->Ticket_model->getLogUpdate($log);    
            
            
             $maildata = array ();
             $maildata['editor'] = $aktprijmeni;
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový řešitel ticketu " ; 
                
             $email = $this->Email_model->getNewEditor($maildata);
            
            
                     
              
          
             $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));            
             $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
             redirect('ticket_filter/'. $this->input->post('nasid')); 
            
           } 
           
       //    } else  { 
  //  redirect('ticketsall');
    } 
            
      //    } 
    function ticket_admin_vykaz($nasid = NULL) { 
        $this->jePrihlasen(); 
        $this->neniUzavren($nasid); 
        
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $menuodd = $this->Main_model->getMenuodd();
        $menuticket = $this->Ticket_model->getMenuticket();
        
        
        
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        $tic_realizace = $this->db->get('ticket_realizace')->result();
        $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
        $seznam = $this->Main_model->getTym($id_oddeleni);      
             
        $this->load->helper('form');
        $this->load->library('form_validation');     
        $this->form_validation->set_rules('nasid', 'Ticket ID', 'required' );
        
        $this->db->select('sum(cas) as total');
        $this->db->where('id_ticket', $nasid); 
        $zamestnanci = $this->db->get('ticket_calendar'); 
        $zamestnanec = $zamestnanci->first_row();
        
        
        $stav =  $zamestnanec->total;
        
   
        
                
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
           'svatek_den' => $svatek_den,
           'stav' => $stav,
           'tic_oddeleni' => $tic_oddeleni,
           'tic_realizace' => $tic_realizace,
            'seznam' => $seznam,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Editace ticketu"  . "</li>" ,
                 'today' => $today,
                 'menuwww' => $menuwww,
                 'menuobrazky' => $menuobrazky, 
                 'menuticket' => $menuticket,
                 'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'oddeleni' => $this->session->userdata('oddeleni'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
            
                 );
  
         $this->load->view('ticket_detail_vykaz', $vystup);
         
  
        } else { 
        
            $cas = date("Y-m-d H:i:s"); 
            $datum_odprac = date("Y-m-d"); 
            $ticket = $this->Ticket_model->getTicket($this->input->post('nasid')); 
            
            if ($this->input->post('narocnost') <> $ticket->narocnost ) {  
            
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 14,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $this->input->post('narocnost') . "hod");
                
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
                
                
                'narocnost' => $this->input->post('narocnost'), 
                                                             
                
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
             }  
            
            if ($this->input->post('odpracovano') > 0 ) {  
            
            
          //  $stavreal = $this->Ticket_model->akt_stavrealizace($this->input->post('realizace'));
            
             $log = array(                 
                'autor' => $this->input->post('prijmeni'),
                'vytvoreno' => $cas,
                'cas' => $this->input->post('odpracovano'),
                'id_ticket' => $this->input->post('nasid'),
                'content' => $this->input->post('content'),
                'date' => $datum_odprac,
                'oddeleni' => $this->session->userdata('oddeleni'),
                'status' => $this->input->post('oc'));
                
           $this->db->insert('ticket_calendar', $log); 
            
             
            }
            
         
            
           
            
            if ($this->input->post('termin_ok') <> $ticket->termin_ok  ) {  
            
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 6,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $this->input->post('termin_ok'));
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
                
                
               
                'termin_ok' => $this->input->post('termin_ok'),
                  
                                              
                
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
             
            }
           
            
           
                       
          
            }
            
            $ticketdotaz = $this->Ticket_model->getTicket($this->input->post('nasid'));
            
            
             if ( $ticketdotaz->oc_resi > 0 and $ticketdotaz->termin_ok == Null and $ticketdotaz->stav < 2) {   
           
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Přiřazený");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
               
                'stav' => 2,
               
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
            
             
            }
            
            
            if ($ticketdotaz->termin_ok > 0 and $ticketdotaz->oc_resi > 0 and $ticketdotaz->stav < 3) {   
           
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Potvrzený");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
               
                'stav' => 3,
               
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
            
             
            }
            
             if ( $ticketdotaz->realizace > 0 and $ticketdotaz->stav < 4) {   
           
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Rozpracovaný");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
               
                'stav' => 4,
               
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
            
             
            }
            
              if ( $ticketdotaz->realizace == 5) {   
           
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Hotový");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
               
                'stav' => 5,
               
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
            
             
            }
            
            if ($this->input->post('pomoc') > 0 ) {   
            
            $zamestnanec = $this->Ticket_model->getPomoc($this->input->post('pomoc')); 
            $test = $this->input->post('nasid') . $this->input->post('pomoc');   
            $pomocexistuje = $this->Ticket_model->getpomocexistuje($test); 
            
            if($pomocexistuje < 1 ){ 
            
             $cas = date("Y-m-d H:i:s"); 
            $data = array(
                
                
                'hlp_id' => $this->input->post('nasid') . $zamestnanec->oc, 
                'tic_id' => $this->input->post('nasid'), 
                'hlp_oc' => $zamestnanec->oc, 
                'autor_oc' => $this->input->post('oc'), 
                'hlp_prijmeni' => $zamestnanec->prijmeni,
                'hlp_email' => $zamestnanec->mail,
                                              
                
                );
            $this->db->insert('tickets_help', $data);  
            
            $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 10,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $zamestnanec->prijmeni,);
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
             
            
             $maildata = array ();
             $maildata['pomoc'] = $zamestnanec->prijmeni;
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nová posila k ticketu " ; 
                
             $email = $this->Email_model->getNewHelp($maildata);
            
            
             
            }
            }
             $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));            
             $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));         
             redirect('ticket_detail_vykaz/'. $this->input->post('nasid')); 
            
            
            
          }     
         
        function ticket_admin($nasid = NULL) { 
        $this->jePrihlasen(); 
        $this->neniUzavren($nasid); 
        
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $menuodd = $this->Main_model->getMenuodd();
        $menuticket = $this->Ticket_model->getMenuticket();
        
        
        
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        $tic_realizace = $this->db->get('ticket_realizace')->result();
        $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
        $seznam = $this->Main_model->getTym($id_oddeleni);      
             
        $this->load->helper('form');
        $this->load->library('form_validation');     
        $this->form_validation->set_rules('nasid', 'Ticket ID', 'required' );
        
        
        
                
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
           'svatek_den' => $svatek_den,
           'tic_oddeleni' => $tic_oddeleni,
           'tic_realizace' => $tic_realizace,
            'seznam' => $seznam,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Editace ticketu"  . "</li>" ,
                 'today' => $today,
                 'menuwww' => $menuwww,
                 'menuobrazky' => $menuobrazky, 
                 'menuticket' => $menuticket,
                 'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'oddeleni' => $this->session->userdata('oddeleni'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'zpet' => $this->session->userdata('zpet'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
            
                 );
  
         $this->load->view('ticket_detail', $vystup);
         
  
        } else { 
        
            $cas = date("Y-m-d H:i:s"); 
            $ticket = $this->Ticket_model->getTicket($this->input->post('nasid')); 
            
            if ($this->input->post('narocnost') <> $ticket->narocnost ) {  
            
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 14,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $this->input->post('narocnost') . "hod");
                
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
                
                
                'narocnost' => $this->input->post('narocnost'), 
                                                             
                
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
             }  
            
            if ($this->input->post('realizace') <> $ticket->realizace ) {  
            
            
            $stavreal = $this->Ticket_model->akt_stavrealizace($this->input->post('realizace'));
            
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 11,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $stavreal);
                
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
                
                
                'realizace' => $this->input->post('realizace'), 
                                                             
                
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
             
            }
            
             if ($this->input->post('zmenaoc_resi') <> 0 ) {  
             $novyresitel = $this->Ticket_model->getTicket_prijmeni($this->input->post('zmenaoc_resi')); 
             $oddeleni_zmena = $this->Ticket_model->getTicket_oddel_zmena($this->input->post('zmenaoc_resi')); 
                                                 
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 12,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $novyresitel);
                
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
                
                
                'oc_resi' => $this->input->post('zmenaoc_resi'), 
                'oddeleni_resi' => $oddeleni_zmena, 
                                                             
                
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
             
             $maildata = array ();
             $maildata['editor'] = $novyresitel;
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový řešitel ticketu " ; 
                
             $email = $this->Email_model->getNewEditor($maildata);
            
             
            }
            
           
            
            if ($this->input->post('termin_ok') <> $ticket->termin_ok  ) {  
            
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 6,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $this->input->post('termin_ok'));
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
                
                
               
                'termin_ok' => $this->input->post('termin_ok'),
                  
                                              
                
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
             
            }
           
            
           
                       
          
            }
            
            $ticketdotaz = $this->Ticket_model->getTicket($this->input->post('nasid'));
            
            
             if ( $ticketdotaz->oc_resi > 0 and $ticketdotaz->termin_ok == Null and $ticketdotaz->stav < 2) {   
           
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Přiřazený");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
               
                'stav' => 2,
               
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
            
             $maildata = array ();
             $maildata['stav'] = "Přiřazený";
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
             $email = $this->Email_model->getNewStav($maildata);
            
            
             
            }
            
            
            if ($ticketdotaz->termin_ok > 0 and $ticketdotaz->oc_resi > 0 and $ticketdotaz->stav < 3) {   
           
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Potvrzený");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
               
                'stav' => 3,
               
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data);  
            
              $maildata = array ();
             $maildata['stav'] = "Potvrzený";
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
             $email = $this->Email_model->getNewStav($maildata);
             
            }
            
             if ( $ticketdotaz->realizace > 0 and $ticketdotaz->stav < 4) {   
           
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Rozpracovaný");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
               
                'stav' => 4,
               
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data);  
            
              $maildata = array ();
             $maildata['stav'] = "Rozpracovaný";
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
             $email = $this->Email_model->getNewStav($maildata);
             
            }
            
              if ( $ticketdotaz->realizace == 5) {   
           
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Hotový");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
            $close = date("Y-m-d"); 
            $data = array(
                'close_date' => $close,
                'stav' => 7,
               
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
             $maildata = array ();
             $maildata['stav'] = "Hotový -> Uzavřený";
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
             $email = $this->Email_model->getNewStav($maildata);
             
            }
            
            if ($this->input->post('pomoc') > 0 ) {   
            
            $zamestnanec = $this->Ticket_model->getPomoc($this->input->post('pomoc')); 
            $test = $this->input->post('nasid') . $this->input->post('pomoc');   
            $pomocexistuje = $this->Ticket_model->getpomocexistuje($test); 
            
            if($pomocexistuje < 1 ){ 
            
             $cas = date("Y-m-d H:i:s"); 
            $data = array(
                
                
                'hlp_id' => $this->input->post('nasid') . $zamestnanec->oc, 
                'tic_id' => $this->input->post('nasid'), 
                'hlp_oc' => $zamestnanec->oc, 
                'autor_oc' => $this->input->post('oc'), 
                'hlp_prijmeni' => $zamestnanec->prijmeni,
                'hlp_email' => $zamestnanec->mail,
                                              
                
                );
            $this->db->insert('tickets_help', $data);  
            
            $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 10,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $zamestnanec->prijmeni,);
            $logupdate = $this->Ticket_model->getLogUpdate($log);   
            
              $maildata = array ();
             $maildata['pomoc'] = $zamestnanec->prijmeni;
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nová posila k ticketu " ; 
                
             $email = $this->Email_model->getNewHelp($maildata);
             
            }
            }
             $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));            
             $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));      
             redirect('ticket_filter/'. $this->input->post('nasid')); 
            
            
            
          }
         
         function ticket_edit($nasid = NULL) { 
        $this->jePrihlasen(); 
        $this->neniUzavren($nasid); 
      
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $menuodd = $this->Main_model->getMenuodd();
        $menuticket = $this->Ticket_model->getMenuticket();
        
        
        
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        $tic_realizace = $this->db->get('ticket_realizace')->result();
        $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
        $seznam = $this->Main_model->getTym($id_oddeleni);      
             
        $this->load->helper('form');
        $this->load->library('form_validation');     
        $this->form_validation->set_rules('nasid', 'Ticket ID', 'required' );
        $this->form_validation->set_rules('oc_resi', 'Řeší', 'is_natural_no_zero' );
        
        
                
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
           'svatek_den' => $svatek_den,
           'tic_oddeleni' => $tic_oddeleni,
           'tic_realizace' => $tic_realizace,
            'seznam' => $seznam,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Editace ticketu"  . "</li>" ,
                 'today' => $today,
                 'menuwww' => $menuwww,
                 'menuobrazky' => $menuobrazky, 
                 'menuticket' => $menuticket,
                 'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'oddeleni' => $this->session->userdata('oddeleni'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'zpet' => $this->session->userdata('zpet'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
            
                 );
  
         $this->load->view('ticket_autor', $vystup);
         
  
        } else { 
        
            $cas = date("Y-m-d H:i:s"); 
            $ticket = $this->Ticket_model->getTicket($this->input->post('nasid')); 
            
            
            
            if ($this->input->post('pomoc') > 0 ) {   
            
            $zamestnanec = $this->Ticket_model->getPomoc($this->input->post('pomoc')); 
            $test = $this->input->post('nasid') . $this->input->post('pomoc');   
            $pomocexistuje = $this->Ticket_model->getpomocexistuje($test); 
            
            if($pomocexistuje < 1 ){ 
            
             $cas = date("Y-m-d H:i:s"); 
            $data = array(
                
                
                'hlp_id' => $this->input->post('nasid') . $zamestnanec->oc, 
                'tic_id' => $this->input->post('nasid'), 
                'hlp_oc' => $zamestnanec->oc, 
                'autor_oc' => $this->input->post('oc'), 
                'hlp_prijmeni' => $zamestnanec->prijmeni,
                'hlp_email' => $zamestnanec->mail,
                                              
                
                );
            $this->db->insert('tickets_help', $data);  
            
            $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 10,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $zamestnanec->prijmeni,);
            $logupdate = $this->Ticket_model->getLogUpdate($log);   
            
              $maildata = array ();
             $maildata['pomoc'] = $zamestnanec->prijmeni;
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nová posila k ticketu " ; 
                
             $email = $this->Email_model->getNewHelp($maildata);
             
            }
            }
            
              
            if ($this->input->post('stop') > 0  ) {  
            
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 23,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
             $data = array(
                
                
               
                'stav' => 6,
                  
                                              
                
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data); 
            
            
             $maildata = array ();
             $maildata['stav'] = "Potvrzený od zadavatele";
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
             $email = $this->Email_model->getNewStav($maildata);
             
            }
            
             if ($this->input->post('close') > 0  ) {  
            
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 2,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $this->input->post('narocnost') . "hod");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
            $close = date("Y-m-d"); 
             $data = array(
                
                
                'close_date' => $close,
                'stav' => 7,
                  
                                              
                
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data);  
            
             $maildata = array ();
             $maildata['stav'] = "Uzavřený";
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
             $email = $this->Email_model->getNewStav($maildata);
             
            }
             $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));            
             $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));         
             redirect('ticket_filter/'. $this->input->post('nasid')); 
            
            
               } 
          }
          
          
           function ticket_back($nasid = NULL) { 
        $this->jePrihlasen(); 
        $this->neniUzavren($nasid); 
      
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $menuodd = $this->Main_model->getMenuodd();
        $menuticket = $this->Ticket_model->getMenuticket();
        
        
        
        $tic_oddeleni = $this->db->get('ticket_oddeleni')->result();
        $tic_realizace = $this->db->get('ticket_realizace')->result();
        $id_oddeleni = $this->Ticket_model->getTicket_odd_id($nasid); 
        $seznam = $this->Main_model->getTym($id_oddeleni);      
             
        $this->load->helper('form');
        $this->load->library('form_validation');     
        $this->form_validation->set_rules('nasid', 'Ticket ID', 'required' );
        $this->form_validation->set_rules('oc_resi', 'Řeší', 'is_natural_no_zero' );
        
        
                
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
           'svatek_den' => $svatek_den,
           'tic_oddeleni' => $tic_oddeleni,
           'tic_realizace' => $tic_realizace,
            'seznam' => $seznam,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Editace ticketu"  . "</li>" ,
                 'today' => $today,
                 'menuwww' => $menuwww,
                 'menuobrazky' => $menuobrazky, 
                 'menuticket' => $menuticket,
                 'zpet' => $this->session->userdata('zpet'),
                 'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'oddeleni' => $this->session->userdata('oddeleni'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
            
                 );
  
         $this->load->view('ticket_autor', $vystup);
         
  
        } else { 
        
            $cas = date("Y-m-d H:i:s"); 
            $ticket = $this->Ticket_model->getTicket($this->input->post('nasid')); 
            
            
            
                      
              
                       
             if ($this->input->post('back') > 0  ) {  
            
             $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 26,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "80%");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
              $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 22,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => "Rozpracovaný");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
            
             $data = array(
                
                
               
                'stav' => 4,
                'realizace' => 4, 
                                              
                
                );
            $this->db->where('nasid', $this->input->post('nasid')); 
            $this->db->update('tickets', $data);   
            
               $maildata = array ();
             $maildata['stav'] = "Vrácený k přepracování";
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
             $email = $this->Email_model->getNewStav($maildata);
            
             
            }
             $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));            
             $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));         
             redirect('ticket_filter/'. $this->input->post('nasid')); 
            
            
               } 
          }
         
        function ticket_komentar($nasid = NULL) { 
        $this->jePrihlasen(); 
        $this->neniUzavren($nasid); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $menuodd = $this->Main_model->getMenuodd();
        $menuticket = $this->Ticket_model->getMenuticket();
             
             
        $this->form_validation->set_rules('text', 'Text', 'required' );
        $this->form_validation->set_rules('oc', 'Osobní číslo', 'required' );
                
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
           'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Editace ticketu"  . "</li>" ,
                 'today' => $today,
                 'menuwww' => $menuwww,
                  'menuobrazky' => $menuobrazky, 
                  'menuticket' => $menuticket,
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'oddeleni' => $this->session->userdata('oddeleni'),
            'opravneni' => $this->session->userdata('opravneni'),
            'zpet' => $this->session->userdata('zpet'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
            
                 );
  
         $this->load->view('ticket_detail', $vystup);
         
  
        } else { 
           
            $cas = date("Y-m-d H:i:s"); 
            $data = array(
                
                
                'ans_datum' => $cas, 
                'ans_text' => $this->input->post('text'), 
                'ans_oc' => $this->input->post('oc'), 
                'ans_autor' => $this->input->post('prijmeni'),
                'tic_id' => $this->input->post('nasid'),
                                              
                
                );
            $this->db->insert('tickets_answ', $data); 
            $idnew = $this->db->insert_id();
            
            
            $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 3,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $idnew,);
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
          
                       
          
            } 
            
             $maildata = array ();
             $maildata['komentar'] = $this->input->post('text');
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový komentář k ticketu " ; 
                
             $email = $this->Email_model->getNewComment($maildata);
           
                         
          //  $this->session->set_userdata('idnew', $idnew);
        //    redirect('ticketsall');
            
             redirect('ticket_filter/'. $this->input->post('nasid')); 
            
            
            
          }
          
           function ticket_komentar2($nasid = NULL) { 
        $this->jePrihlasen(); 
        $this->neniUzavren($nasid); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $menuodd = $this->Main_model->getMenuodd();
        $menuticket = $this->Ticket_model->getMenuticket();
             
             
        $this->form_validation->set_rules('text', 'Text', 'required' );
        $this->form_validation->set_rules('oc', 'Osobní číslo', 'required' );
                
        if ($this->form_validation->run() == FALSE) { 
        
        $vystup = array(
           'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Editace ticketu"  . "</li>" ,
                 'today' => $today,
                 'menuwww' => $menuwww,
                  'menuobrazky' => $menuobrazky, 
                  'menuticket' => $menuticket,
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'oddeleni' => $this->session->userdata('oddeleni'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'zpet' => $this->session->userdata('zpet'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
            
                 );
  
         $this->load->view('ticket_autor', $vystup);
         
  
        } else { 
           
            $cas = date("Y-m-d H:i:s"); 
            $data = array(
                
                
                'ans_datum' => $cas, 
                'ans_text' => $this->input->post('text'), 
                'ans_oc' => $this->input->post('oc'), 
                'ans_autor' => $this->input->post('prijmeni'),
                'tic_id' => $this->input->post('nasid'),
                                              
                
                );
            $this->db->insert('tickets_answ', $data); 
            $idnew = $this->db->insert_id();
            
            
            $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 3,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $idnew,);
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
          
                       
          
            } 
           
             $maildata = array ();
             $maildata['komentar'] = $this->input->post('text');
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový komentář k ticketu " ; 
                
             $email = $this->Email_model->getNewComment($maildata);
                         
          //  $this->session->set_userdata('idnew', $idnew);
        //    redirect('ticketsall');
            
             redirect('ticket_filter/'. $this->input->post('nasid')); 
            
            
            
          }
          
          
          function ticket_file($nasid = NULL) { 
        $this->jePrihlasen(); 
        $this->neniUzavren($nasid); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $menuodd = $this->Main_model->getMenuodd();
               
     
            $today = date("Y-m-d"); 
            $cas = date("Y-m-d H:i:s"); 
           
          
                       
            $this->load->library('upload');
            $image = array();
            $ImageCount = count($_FILES['image_name']['name']);
            for($i = 0; $i < $ImageCount; $i++){
            $_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
            $_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
            $_FILES['file']['size']       = $_FILES['image_name']['size'][$i];

            // File upload configuration
            $uploadPath = './tickets_files/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|xls|xlsx|doc|docx|csv|zip|rar';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
            // Uploaded file data
            $imageData = $this->upload->data();
            $uploadImgData[$i]['image_name'] = $imageData['file_name'];
            $uploadImgData[$i]['image_type'] = $imageData['file_type'];
            
              $file = array(
                
                'tic_id' => $this->input->post('nasid'),
                'fls_autor' => $this->input->post('prijmeni'),
                'fls_oc' => $this->input->post('oc'),
                'fls_datum' => $cas,
                'nazev' => $imageData['file_name'],
                'type' => $imageData['file_type'],
                
                   );
                                                               
                $this->db->insert('tickets_files', $file);  
             //   $poidnew = $this->db->insert_id();  
             
               $log = array(                 
                'lg_autor' => $this->input->post('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 8,
                'tic_id' => $this->input->post('nasid'),
                'lg_pozn' => $imageData['file_name'],);
            $logupdate = $this->Ticket_model->getLogUpdate($log);   
            
             $maildata = array ();
             $maildata['soubor'] = $imageData['file_name'];
             $maildata['idnew'] = $this->input->post('nasid');  
             $maildata['autor'] = $this->input->post('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový soubor k ticketu " ; 
                
             $email = $this->Email_model->getNewFile($maildata);

            }
            }
           
              
                        
          //  $this->session->set_userdata('idnew', $idnew);
           redirect('ticket_filter/'. $this->input->post('nasid')); 
            
            
            
            
            
            
            
            
         }
         
          function ticketsall_close() { 
          $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $realizace = $this->db->get('ticket_stav')->result();
        $menuodd = $this->Main_model->getMenuodd();
        $menuticket = $this->Ticket_model->getMenuticket();
        $odkaz_pocet = $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni'));
        
        $sorting = $this->db->get('ticket_sorting')->result();
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $filtr = array(
            'oddeleni_zadal' => $this->input->post('oddeleni_zadal'),
            'oddeleni_resi' => $this->input->post('oddeleni_resi'),
            'oc_zadal' => $this->input->post('oc_zadal'),
            'oc_resi' => $this->input->post('oc_resi'),
            'zadani_od' => $this->input->post('zadani_od'),
            'zadani_do' => $this->input->post('zadani_do'),
            'terminok_od' => $this->input->post('terminok_od'),
            'terminok_do' => $this->input->post('terminok_do'),
            'sort' => $this->input->post('sort'),
            'stav' => $this->input->post('stav'),
            );
        $query = $this->Ticket_model->getTicketsall_close($filtr);
        $tic_oddeleni = $this->Ticket_model->getTicket_odd_resi($filtr);
        $tic_oddeleni_zadal = $this->Ticket_model->getTicket_odd_zadal($filtr);
        $tic_oc_zadal = $this->Ticket_model->getTicket_oc_zadal($filtr);
        $tic_oc_resi = $this->Ticket_model->getTicket_oc_resi($filtr);
    //    $zadani_od = $this->Ticket_model->getTicket_zadani_od($filtr);
         
        if (($this->session->userdata('oddeleni')) <> 3) { 
        $odkaz_nazev =  "Moje oddělení - aktivní"; 
        $popis = "Moje oddělení - uzavřené"; 
        $pocet = $this->Ticket_model->getTickpocetoddeleni_close($this->session->userdata('oddeleni'));
        } 
        if (($this->session->userdata('oddeleni')) == 3) { 
        $odkaz_nazev =  "Firma - aktivní"; 
        $popis = "Firma - uzavřené"; 
        $pocet = $this->Ticket_model->getTicketsall_pocet2($filtr); 
         }     
                 
           
           
        $vystup = array(
                 'svatek_den' => $svatek_den,
                 'tic_oddeleni' => $tic_oddeleni,
                 'tic_oddeleni_zadal' => $tic_oddeleni_zadal,
                 'tic_oc_resi' => $tic_oc_resi,
                 'sorting' => $sorting,
                 'tic_oc_zadal' => $tic_oc_zadal,
                 'formular' => "ticketsall_close",
                 'popis_den' => $popis_den,
                 'filtr' => $filtr,
                 'realizace' => $realizace,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Moje oddělení - uzavřené"  . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                 'odkaz' => "ticketsall",
                 'odkaz_nazev' => $odkaz_nazev,
                 'popis' => $popis,
                 'odkaz_pocet' => $odkaz_pocet,
                 'pocet' => $pocet,
                 'menuwww' => $menuwww,
                 'menuticket' => $menuticket,
                  'menuobrazky' => $menuobrazky, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'zpet' => $this->session->userdata('zpet'),
            'menuodd' => $menuodd,                 
             );

             $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
             $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
        $this->load->view('ticketsall', $vystup);
        } 
  
    function ticketsall2() { 
        $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $sorting = $this->db->get('ticket_sorting')->result();
        $filtering = $this->Ticket_model->getFiltering2($this->session->userdata('oc'));
        $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
        $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
        $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
        $odd_name = $this->Ticket_model->getOddeleni_name($this->session->userdata('oddeleni'));
       
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        
        $this->form_validation->set_rules('oddeleni_resi', 'pole Text', 'required' );
         
        if (($this->session->userdata('filter2')) <> Null) { 
        $filter =  $this->session->userdata('filter2'); 
        }  
        else { 
        
    if (($this->session->userdata('opravneni')) > 11) { 
              
         $filter = array(
            'oddeleni_zadal' => $filtering->oddeleni_zadal,
            'oddeleni_resi' => $filtering->oddeleni_resi,
            'oc_zadal' => $filtering->oc_zadal,
            'oc_resi' => $filtering->oc_resi,
            'zadani_od' => $filtering->zadani_od,
            'zadani_do' => $filtering->zadani_do,
            'terminok_od' => $filtering->terminok_od,
            'terminok_do' => $filtering->terminok_do,
            'sort' => $filtering->sort,
            'stav' => $filtering->stav,
            'ticket_id' => $filtering->ticket_id,
            'zakcis' => $filtering->zakcis,
            );
            
            
            }
            
    if (($this->session->userdata('opravneni')) < 12 and ($this->session->userdata('opravneni')) > 5) { 
              
         $filter = array(
            'oddeleni_zadal' => $this->session->userdata('oddeleni'),
            'oddeleni_resi' => $filtering->oddeleni_resi,
            'oc_zadal' => $filtering->oc_zadal,
            'oc_resi' => $filtering->oc_resi,
            'zadani_od' => $filtering->zadani_od,
            'zadani_do' => $filtering->zadani_do,
            'terminok_od' => $filtering->terminok_od,
            'terminok_do' => $filtering->terminok_do,
            'sort' => $filtering->sort,
            'stav' => $filtering->stav,
            'ticket_id' => $filtering->ticket_id,
            'zakcis' => $filtering->zakcis,
            );
            
            
            }    
            
    if (($this->session->userdata('opravneni')) < 6) { 
              
         $filter = array(
            'oddeleni_zadal' => $this->session->userdata('oddeleni'),
            'oddeleni_resi' => $filtering->oddeleni_resi,
            'oc_zadal' => $this->session->userdata('oc'),
            'oc_resi' => $filtering->oc_resi,
            'zadani_od' => $filtering->zadani_od,
            'zadani_do' => $filtering->zadani_do,
            'terminok_od' => $filtering->terminok_od,
            'terminok_do' => $filtering->terminok_do,
            'sort' => $filtering->sort,
            'stav' => $filtering->stav,
            'ticket_id' => $filtering->ticket_id,
            'zakcis' => $filtering->zakcis,
            );
            
            
            }                
            
        }  
         
         
                   
        $query = $this->Ticket_model->getTicketsall2($filter);
        $tic_oddeleni = $this->Ticket_model->getTicket_odd_resi3($filter);
        $tic_oddeleni_zadal = $this->Ticket_model->getTicket_odd_zadal3($filter);
        $tic_oc_zadal = $this->Ticket_model->getTicket_oc_zadal3($filter);
        $tic_oc_resi = $this->Ticket_model->getTicket_oc_resi3($filter);
        $realizace = $this->Ticket_model->getTicket_realizace3($filter);
         
        
        $odkaz_nazev =  "Požadavky TT zadané"; 
        $popis = "Požadavky TT zadané"; 
        $pocet = $this->Ticket_model->getTicketsall_pocet($filter); 
     //   $pocetneuz = $this->Ticket_model->getTicketsall_pocetneuzav($filter); 
        $this->session->set_userdata('zpet', 'ticketsall2');  
           
           
      
        
        if ($this->form_validation->run() == FALSE) { 
              $vystup = array(
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'tic_oddeleni' => $tic_oddeleni,
                 'tic_oddeleni_zadal' => $tic_oddeleni_zadal,
                 'tic_oc_resi' => $tic_oc_resi,
                 'tic_oc_zadal' => $tic_oc_zadal,
                 'sorting' => $sorting,
                 'realizace' => $realizace,
                 'odd_name' => $odd_name,
                 'filtr' => $filter,
                 'ticket_menu' => "ticket_menu2",
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket systém"  . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                 'formular' => "ticketsall",
                 'odkaz' => "ticketsall_close",
                 'odkaz_nazev' => $odkaz_nazev,
                 'popis' => $popis,
               //  'odkaz_pocet' => $odkaz_pocet,
                 'pocet' => $pocet,
                 'menuwww' => $menuwww,
              //   'menuticket' => $menuticket,
                 'menuobrazky' => $menuobrazky, 
                'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'oddeleni' => $this->session->userdata('oddeleni'),
            'typ' => $this->session->userdata('typ'), 
          //  'menuodd' => $menuodd,                 
        );
            $this->load->view('ticketsall2', $vystup);
        } else { 
        
         if (($this->session->userdata('opravneni')) > 11) { 
              
          $filtr = array(
            'oddeleni_zadal' => $this->input->post('oddeleni_zadal'),
            'oddeleni_resi' => $this->input->post('oddeleni_resi'),
            'oc_zadal' => $this->input->post('oc_zadal'),
            'oc_resi' => $this->input->post('oc_resi'),
            'zadani_od' => $this->input->post('zadani_od'),
            'zadani_do' => $this->input->post('zadani_do'),
            'terminok_od' => $this->input->post('terminok_od'),
            'terminok_do' => $this->input->post('terminok_do'),
            'sort' => $this->input->post('sort'),
            'stav' => $this->input->post('stav'),
            'ticket_id' => $this->input->post('ticket_id'),
            'zakcis' => $this->input->post('zakcis'),
            );
            
            
            }
            
    if (($this->session->userdata('opravneni')) < 12 and ($this->session->userdata('opravneni')) > 5) { 
              
         $filtr = array(
            'oddeleni_zadal' => $this->session->userdata('oddeleni'),
            'oddeleni_resi' => $this->input->post('oddeleni_resi'),
            'oc_zadal' => $this->input->post('oc_zadal'),
            'oc_resi' => $this->input->post('oc_resi'),
            'zadani_od' => $this->input->post('zadani_od'),
            'zadani_do' => $this->input->post('zadani_do'),
            'terminok_od' => $this->input->post('terminok_od'),
            'terminok_do' => $this->input->post('terminok_do'),
            'sort' => $this->input->post('sort'),
            'stav' => $this->input->post('stav'),
            'ticket_id' => $this->input->post('ticket_id'),
            'zakcis' => $this->input->post('zakcis'),
            );
            
            
            
            }    
            
    if (($this->session->userdata('opravneni')) < 6) { 
              
        $filtr = array(
            'oddeleni_zadal' => $this->session->userdata('oddeleni'),
            'oddeleni_resi' => $this->input->post('oddeleni_resi'),
            'oc_zadal' => $this->session->userdata('oc'),
            'oc_resi' => $this->input->post('oc_resi'),
            'zadani_od' => $this->input->post('zadani_od'),
            'zadani_do' => $this->input->post('zadani_do'),
            'terminok_od' => $this->input->post('terminok_od'),
            'terminok_do' => $this->input->post('terminok_do'),
            'sort' => $this->input->post('sort'),
            'stav' => $this->input->post('stav'),
            'ticket_id' => $this->input->post('ticket_id'),
            'zakcis' => $this->input->post('zakcis'),
            );
            
            
            
            }                  
          
       
        $this->session->set_userdata('zpet', 'ticketsall2');   
        $this->session->set_userdata('filter2', $filtr);     
        $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
        $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
        $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
        $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
         redirect('ticketsall2');
         }   }  
  
      
  
  function ticketsall() { 
        $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $sorting = $this->db->get('ticket_sorting')->result();
        $filtering = $this->Ticket_model->getFiltering($this->session->userdata('oc'));
        $odd_name = $this->Ticket_model->getOddeleni_name($this->session->userdata('oddeleni'));
        $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
        $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
        $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
      
     //   $menuodd = $this->Main_model->getMenuodd();
    //    $menuticket = $this->Ticket_model->getMenuticket();
    //    $odkaz_pocet = $this->Ticket_model->getTickpocetoddeleni_close($this->session->userdata('oddeleni'));
       
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        
        $this->form_validation->set_rules('oddeleni_zadal', 'pole Text', 'required' );
         
        if (($this->session->userdata('filter')) <> Null) { 
        $filter =  $this->session->userdata('filter'); 
        }  
        else {   
        
    if (($this->session->userdata('opravneni')) > 11) { 
              
         $filter = array(
            'oddeleni_zadal' => $filtering->oddeleni_zadal,
            'oddeleni_resi' => $filtering->oddeleni_resi,
            'oc_zadal' => $filtering->oc_zadal,
            'oc_resi' => $filtering->oc_resi,
            'zadani_od' => $filtering->zadani_od,
            'zadani_do' => $filtering->zadani_do,
            'terminok_od' => $filtering->terminok_od,
            'terminok_do' => $filtering->terminok_do,
            'sort' => $filtering->sort,
            'stav' => $filtering->stav,
            'ticket_id' => $filtering->ticket_id,
            'zakcis' => $filtering->zakcis,
            
            );
            
            
            }
            
    if (($this->session->userdata('opravneni')) < 12 and ($this->session->userdata('opravneni')) > 5) { 
              
         $filter = array(
            'oddeleni_zadal' => $filtering->oddeleni_zadal,
            'oddeleni_resi' => $this->session->userdata('oddeleni'),
            'oc_zadal' => $filtering->oc_zadal,
            'oc_resi' => $filtering->oc_resi,
            'zadani_od' => $filtering->zadani_od,
            'zadani_do' => $filtering->zadani_do,
            'terminok_od' => $filtering->terminok_od,
            'terminok_do' => $filtering->terminok_do,
            'sort' => $filtering->sort,
            'stav' => $filtering->stav,
            'ticket_id' => $filtering->ticket_id,
            'zakcis' => $filtering->zakcis,
            );
            
            
            }    
            
    if (($this->session->userdata('opravneni')) < 6) { 
              
         $filter = array(
            'oddeleni_zadal' => $filtering->oddeleni_zadal,
            'oddeleni_resi' => $this->session->userdata('oddeleni'),
            'oc_zadal' => $filtering->oc_zadal,
            'oc_resi' => $this->session->userdata('oc'),
            'zadani_od' => $filtering->zadani_od,
            'zadani_do' => $filtering->zadani_do,
            'terminok_od' => $filtering->terminok_od,
            'terminok_do' => $filtering->terminok_do,
            'sort' => $filtering->sort,
            'stav' => $filtering->stav,
            'ticket_id' => $filtering->ticket_id,
            'zakcis' => $filtering->zakcis,
            );
            
            
            }                
            
        }  
         
         
                   
        $query = $this->Ticket_model->getTicketsall($filter);
        $tic_oddeleni = $this->Ticket_model->getTicket_odd_resi2($filter);
        $tic_oddeleni_zadal = $this->Ticket_model->getTicket_odd_zadal2($filter);
        $tic_oc_zadal = $this->Ticket_model->getTicket_oc_zadal2($filter);
        $tic_oc_resi = $this->Ticket_model->getTicket_oc_resi2($filter);
        $realizace = $this->Ticket_model->getTicket_realizace2($filter);
         
        
        $odkaz_nazev =  "Požadavky TT k řešení"; 
        $popis = "Požadavky TT k řešení"; 
        $pocet = $this->Ticket_model->getTicketsall_pocet($filter); 
        $this->session->set_userdata('zpet', 'ticketsall');   
           
           
      
        
        if ($this->form_validation->run() == FALSE) { 
              $vystup = array(
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'tic_oddeleni' => $tic_oddeleni,
                 'tic_oddeleni_zadal' => $tic_oddeleni_zadal,
                 'tic_oc_resi' => $tic_oc_resi,
                 'tic_oc_zadal' => $tic_oc_zadal,
                 'sorting' => $sorting,
                 'realizace' => $realizace,
                 'filtr' => $filter,   
                 'ticket_menu' => "ticket_menu",
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket systém"  . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                 'formular' => "ticketsall",
                 'odkaz' => "ticketsall_close",
                 'odkaz_nazev' => $odkaz_nazev,
                 'popis' => $popis,
                 'odd_name' => $odd_name,
                 'pocet' => $pocet,
                 'menuwww' => $menuwww,
              //   'menuticket' => $menuticket,
                 'menuobrazky' => $menuobrazky, 
                'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'oddeleni' => $this->session->userdata('oddeleni'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'typ' => $this->session->userdata('typ'), 
          //  'menuodd' => $menuodd,                 
        );
            $this->load->view('ticketsall', $vystup);
        } else {  
        
         if (($this->session->userdata('opravneni')) > 11) { 
              
          $filtr = array(
            'oddeleni_zadal' => $this->input->post('oddeleni_zadal'),
            'oddeleni_resi' => $this->input->post('oddeleni_resi'),
            'oc_zadal' => $this->input->post('oc_zadal'),
            'oc_resi' => $this->input->post('oc_resi'),
            'zadani_od' => $this->input->post('zadani_od'),
            'zadani_do' => $this->input->post('zadani_do'),
            'terminok_od' => $this->input->post('terminok_od'),
            'terminok_do' => $this->input->post('terminok_do'),
            'sort' => $this->input->post('sort'),
            'stav' => $this->input->post('stav'),
            'ticket_id' => $this->input->post('ticket_id'),
            'zakcis' => $this->input->post('zakcis'),
            );
            
            
            }
            
    if (($this->session->userdata('opravneni')) < 12 and ($this->session->userdata('opravneni')) > 5) { 
              
         $filtr = array(
            'oddeleni_zadal' => $this->input->post('oddeleni_zadal'),
            'oddeleni_resi' => $this->session->userdata('oddeleni'),
            'oc_zadal' => $this->input->post('oc_zadal'),
            'oc_resi' => $this->input->post('oc_resi'),
            'zadani_od' => $this->input->post('zadani_od'),
            'zadani_do' => $this->input->post('zadani_do'),
            'terminok_od' => $this->input->post('terminok_od'),
            'terminok_do' => $this->input->post('terminok_do'),
            'sort' => $this->input->post('sort'),
            'stav' => $this->input->post('stav'),
            'ticket_id' => $this->input->post('ticket_id'),
            'zakcis' => $this->input->post('zakcis'),
            );
            
            
            
            }    
            
    if (($this->session->userdata('opravneni')) < 6) { 
              
        $filtr = array(
            'oddeleni_zadal' => $this->input->post('oddeleni_zadal'),
            'oddeleni_resi' => $this->session->userdata('oddeleni'),
            'oc_zadal' => $this->input->post('oc_zadal'),
            'oc_resi' => $this->session->userdata('oc'),
            'zadani_od' => $this->input->post('zadani_od'),
            'zadani_do' => $this->input->post('zadani_do'),
            'terminok_od' => $this->input->post('terminok_od'),
            'terminok_do' => $this->input->post('terminok_do'),
            'sort' => $this->input->post('sort'),
            'stav' => $this->input->post('stav'),
            'ticket_id' => $this->input->post('ticket_id'),
            'zakcis' => $this->input->post('zakcis'),
            );
            
            
            
            }                  
          
       
        $this->session->set_userdata('zpet', 'ticketsall');   
        $this->session->set_userdata('filter', $filtr);     
        $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
        $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
        $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
        $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
         redirect('ticketsall');
         }   }    
        
         function ticket_oddeleni($oddeleni = NULL) { 
        $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $query = $this->Ticket_model->getTickets_odd($oddeleni);
        $menuodd = $this->Main_model->getMenuodd();
        $oblasttext = $this->Ticket_model->getTicket_name_odd($oddeleni);
        $menuticket = $this->Ticket_model->getMenuticket();
         
           
        $vystup = array(
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Ticket - " . $oblasttext . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                  'oblasttext' => $oblasttext,
                 'menuwww' => $menuwww,
                 'menuticket' => $menuticket,
                  'menuobrazky' => $menuobrazky, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
             );
        $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
        $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
        $this->load->view('ticket_oddeleni', $vystup);
        }
        
        
          function filter_reset2() {
        
                  
         $this->session->set_userdata('filter2', Null);   
         
       
                   
           
            redirect('ticketsall2'); 
        }  
        
          function filter_reset() {
        
                  
         $this->session->set_userdata('filter', Null); 
         
       
                   
           
            redirect('ticketsall'); 
        }  
        
         function filter_resetall() {
        
          
           $this->session->set_userdata('filter', Null);   
        
       
         $filter = array(
            'oddeleni_zadal' => "0",
            'oddeleni_resi' => "0",
            'oc_zadal' => "0",
            'oc_resi' => "0",
            'zadani_od' => "0000-00-00",
            'zadani_do' => "0000-00-00",
            'terminok_od' => "0000-00-00",
            'terminok_do' => "0000-00-00",
            'sort' => "0",
            'stav' => "0",
            'ticket_id' => "0",
            'zakcis' => "0",
            );
            
            
            $this->db->where('flt_oc', $this->session->userdata('oc')); 
            $this->db->update('tickets_filter', $filter); 
            
           
            redirect('ticketsall'); 
        }  
         
        
           function filter_resetall2() {
        
          
           $this->session->set_userdata('filter2', Null);   
        
       
         $filter = array(
            'oddeleni_zadal' => "0",
            'oddeleni_resi' => "0",
            'oc_zadal' => "0",
            'oc_resi' => "0",
            'zadani_od' => "0000-00-00",
            'zadani_do' => "0000-00-00",
            'terminok_od' => "0000-00-00",
            'terminok_do' => "0000-00-00",
            'sort' => "0",
            'stav' => "0",
            'ticket_id' => "0",
            'zakcis' => "0",
            );
            
            
            $this->db->where('flt_oc', $this->session->userdata('oc')); 
            $this->db->update('tickets_filter2', $filter); 
            
           
            redirect('ticketsall2'); 
        }  
         
       
        
        
           function filter_save2() {
        
          if (($this->session->userdata('filter2')) <> Null) {          
       
         $filtering =  $this->session->userdata('filter2'); 
       
         $filter = array(
            'oddeleni_zadal' => $filtering['oddeleni_zadal'],
            'oddeleni_resi' => $filtering['oddeleni_resi'],
            'oc_zadal' => $filtering['oc_zadal'],
            'oc_resi' => $filtering['oc_resi'],
            'zadani_od' => $filtering['zadani_od'],
            'zadani_do' => $filtering['zadani_do'],
            'terminok_od' => $filtering['terminok_od'],
            'terminok_do' => $filtering['terminok_do'],
            'sort' => $filtering['sort'],
            'stav' => $filtering['stav'],
            );
            
            
            $this->db->where('flt_oc', $this->session->userdata('oc')); 
            $this->db->update('tickets_filter2', $filter); 
             }  
           
            redirect('ticketsall2'); 
        }  
         
       
        
        
         function filter_save() {
        
          if (($this->session->userdata('filter')) <> Null) {            
       
         $filtering =  $this->session->userdata('filter'); 
       
         $filter = array(
            'oddeleni_zadal' => $filtering['oddeleni_zadal'],
            'oddeleni_resi' => $filtering['oddeleni_resi'],
            'oc_zadal' => $filtering['oc_zadal'],
            'oc_resi' => $filtering['oc_resi'],
            'zadani_od' => $filtering['zadani_od'],
            'zadani_do' => $filtering['zadani_do'],
            'terminok_od' => $filtering['terminok_od'],
            'terminok_do' => $filtering['terminok_do'],
            'sort' => $filtering['sort'],
            'stav' => $filtering['stav'],
            );
            
            
            $this->db->where('flt_oc', $this->session->userdata('oc')); 
            $this->db->update('tickets_filter', $filter); 
             }  
           
            redirect('ticketsall'); 
        }  
         
       
         function os_kalendar($year = NULL , $month = NULL)
	{
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
    //    $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
           
	   	$this->load->model('Mycal2_model');
        
         $this->db->select('user, SUM(ks) as total');
        $this->db->select('user, SUM(priceall) as total2');
        $this->db->select('prijmeni, as400');
        $this->db->where('rok', $year); 
        $this->db->where('mesic', $month); 
        $this->db->join('zamestnanci', 'zamestnanci.oc = atlas_prodej.user');  
        $this->db->group_by('user'); 
        $this->db->order_by('total', 'desc'); 
        $prodejtabul2 = $this->db->get('atlas_prodej',10)->result();
        
        
         $this->db->select('atlas_prodej.kat_id, SUM(ks) as total');
        $this->db->select('atlas_prodej.kat_id, SUM(priceall) as total2');
        $this->db->select('name,kat_c');
        $this->db->where('rok', $year); 
        $this->db->where('mesic', $month); 
        $this->db->where('user', $this->session->userdata('oc'));
        $this->db->join('atlas_products', 'atlas_products.id = atlas_prodej.kat_id');  
        $this->db->group_by('atlas_prodej.kat_id'); 
        $this->db->order_by('total', 'desc'); 
        $prodejtabul = $this->db->get('atlas_prodej')->result();
		
        $this->db->select('*');
        $this->db->where('rok', $year); 
        $this->db->where('mesic', $month); 
        $this->db->where('user', $this->session->userdata('oc'));
        $this->db->from('atlas_prodej');
        //$this->db->order_by('obj', 'desc');       
        $atlas_prodej_mesic = $this->db->get();  
        
        $prodejall=0;
        $vydelek=0;
        foreach($atlas_prodej_mesic->result() as $prodej2 ) {
                                                                                                                                                                                                         
        {$prodejall += $prodej2->ks;
        
        
        }   }
        $vydelek=$prodejall * 5;
                          
        $vystup = array(
            'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Osobní kalendář"  . "</li>" ,
                 'today' => $today,
                 'menuwww' => $menuwww,
            'prodejall' => $prodejall,
                'vydelek' => $vydelek,
                 'prodejtabul' => $prodejtabul,
           'prodejtabul2' => $prodejtabul2,
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'),  
            'email' => $this->session->userdata('email'),  
            'calender' => $this->Mycal2_model->getcalender($year , $month),
          
            
                 );
  
         $this->load->view('os_kalendar', $vystup);

		
}  
      
        
        
         function ticket_zadani($oc = NULL) { 
        $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
      //  $query = $this->Ticket_model->getTickets_zadani($this->session->userdata('oc'));
        $menuodd = $this->Main_model->getMenuodd();
      //  $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
        $menuticket = $this->Ticket_model->getMenuticket();
        
          $filter = array(
            'oddeleni_zadal' => 0,
            'oddeleni_resi' => 0,
            'oc_zadal' => $this->session->userdata('oc'),
            'oc_resi' => 0,
            'zadani_od' => 0,
            'zadani_do' => 0,
            'terminok_od' => 0,
            'terminok_do' => 0,
            'sort' => 0,
            'stav' => 9,
            );
      
         
                   
        $query = $this->Ticket_model->getTicketsall($filter);
      //  $this->session->set_userdata($this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));
        
        $pocet = $this->Ticket_model->getTicketsall_pocet($filter); 
         
           
        $vystup = array(
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Moje zadání - aktivní" . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                 'odkaz' => "os_add_close",
                 'odkaz_nazev' => "Moje zadání - uzavřené",
               //  'odkaz_pocet' => $odkaz_pocet,
                 'pocet' => $pocet,
                 'ticket_menu' => "ticket_menu_os",
                 'popis' => "Moje zadání - aktivní",
                 'menuwww' => $menuwww,
                 'menuticket' => $menuticket,
                  'menuobrazky' => $menuobrazky, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
             );
         $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
         $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
        $this->load->view('ticketsall', $vystup);
        }  
        
         function ticket_zadani_close($oc = NULL) { 
        $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $query = $this->Ticket_model->getTickets_zadani_close($this->session->userdata('oc'));
        $menuodd = $this->Main_model->getMenuodd();
    //    $pocet = $this->Ticket_model->getTickpocetzadani_close($this->session->userdata('oc'));
        $menuticket = $this->Ticket_model->getMenuticket();
        
        $odkaz_pocet = $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc'));
        $pocet = $this->Ticket_model->getTickpocetzadani_close($this->session->userdata('oc')); 
           
        $vystup = array(
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Moje zadání - uzavřené" . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                 'odkaz' => "os_add",
                 'odkaz_nazev' => "Moje zadání - aktivní",
                 'odkaz_pocet' => $odkaz_pocet,
                 'pocet' => $pocet,
                 'popis' => "Moje zadání - uzavřené",
                 'menuwww' => $menuwww,
                 'menuticket' => $menuticket,
                  'menuobrazky' => $menuobrazky, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
             );
          $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
          $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
        $this->load->view('ticket_zadani', $vystup);
        }  
        
        function spoluprace_moje_close($oc = NULL) { 
         $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $query = $this->Ticket_model->getTickets_spoluprace_close($this->session->userdata('oc'));
        $pocet = $this->Ticket_model->getTickpocetspoluprace_close($this->session->userdata('oc'));
        $menuodd = $this->Main_model->getMenuodd();
        $odkaz_pocet = $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc'));
        $menuticket = $this->Ticket_model->getMenuticket();
         
           
        $vystup = array(
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Moje spoluprace" . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                'odkaz' => "os_spoluprace",
                 'odkaz_nazev' => "Moje spolupráce - aktivní",
                 'odkaz_pocet' => $odkaz_pocet,
                 'pocet' => $pocet,
                 'popis' => "Moje spolupráce - uzavřené",
                 'menuwww' => $menuwww,
                 'menuticket' => $menuticket,
                  'menuobrazky' => $menuobrazky, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
             );
             $this->session->set_userdata('zpet', 'os_spoluprace_close'); 
        $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
        $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
        $this->load->view('spoluprace_moje', $vystup);
        }                       
     
       function spoluprace_moje($oc = NULL) { 
        $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $query = $this->Ticket_model->getTickets_spoluprace($this->session->userdata('oc'));
        $pocet = $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc'));
        $menuodd = $this->Main_model->getMenuodd();
        $odkaz_pocet = $this->Ticket_model->getTickpocetspoluprace_close($this->session->userdata('oc'));
        $menuticket = $this->Ticket_model->getMenuticket();
         
         
           
        $vystup = array(
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Moje spoluprace" . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                 'odkaz' => "os_spoluprace_close",
                 'odkaz_nazev' => "Moje spolupráce - uzavřené",
                 'odkaz_pocet' => $odkaz_pocet,
                 'pocet' => $pocet,
                 'popis' => "Moje spolupráce - aktivní",
                 'menuwww' => $menuwww,
                 'menuticket' => $menuticket,
                  'menuobrazky' => $menuobrazky, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
             );
             
             $this->session->set_userdata('zpet', 'os_spoluprace'); 
        $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
        $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
        $this->load->view('spoluprace_moje', $vystup);
        }         

      function ticket_moje($oc = NULL) { 
         $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
         $filter = array(
            'oddeleni_zadal' => 0,
            'oddeleni_resi' => 0,
            'oc_zadal' => 0,
            'oc_resi' => $this->session->userdata('oc'),
            'zadani_od' => 0,
            'zadani_do' => 0,
            'terminok_od' => 0,
            'terminok_do' => 0,
            'sort' => 0,
            'stav' => 9,
            );
      
         
                   
        $query = $this->Ticket_model->getTicketsall($filter);
      //  $this->session->set_userdata($this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));
        
        $pocet = $this->Ticket_model->getTicketsall_pocet($filter); 
        $menuodd = $this->Main_model->getMenuodd();
     //   $oblasttext = $this->Ticket_model->getTicket_name_odd($oddeleni);
        $menuticket = $this->Ticket_model->getMenuticket();
         
           
        $vystup = array(
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Moje tickety" . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                 'odkaz' => "os_ticket_close",
                 'odkaz_nazev' => "Moje tickety - uzavřené",
                 'ticket_menu' => "ticket_menu_os",
                 'pocet' => $pocet,
                 'popis' => "Moje tickety - aktivní",
                 'menuwww' => $menuwww,
                 'menuticket' => $menuticket,
                  'menuobrazky' => $menuobrazky, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
             );
         $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
         $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
        $this->load->view('ticketsall', $vystup);
        } 
        
         function ticket_moje_close($oc = NULL) { 
         $this->jePrihlasen(); 
        $svatek_den = $this->Main_model->getSvatek_den();
        $popis_den = $this->Main_model->getPopis_den();
        $today = $this->Main_model->getToday();
        $menuobrazky = $this->Main_model->getMenuobrazky();
        $menuwww = $this->Main_model->getMenuWWW();
        $query = $this->Ticket_model->getTickets_moje_close($this->session->userdata('oc'));
        $odkaz_pocet = $this->Ticket_model->getTickpocettickets($this->session->userdata('oc'));
        $pocet = $this->Ticket_model->getTickpocettickets_close($this->session->userdata('oc'));
        $menuodd = $this->Main_model->getMenuodd();
     //   $oblasttext = $this->Ticket_model->getTicket_name_odd($oddeleni);
        $menuticket = $this->Ticket_model->getMenuticket();
         
           
        $vystup = array(
                 'svatek_den' => $svatek_den,
                 'popis_den' => $popis_den,
                 'odkaz' => "os_ticket",
                 'odkaz_nazev' => "Moje tickety - aktivní",
                 'popis' => "Moje tickety - uzavřené",
                 'stranka' => '<li class="ptb-5 pl-0 pl-sm-10 pr-sm-0"  href="/"><span class="mr-5  ion-android-arrow-dropright"></span>' . "Moje tickety - uzavřené" . "</li>" ,
                 'today' => $today,
                 'query' => $query,
                 'pocet' => $pocet,
                 'odkaz_pocet' => $odkaz_pocet,
                 'menuwww' => $menuwww,
                 'menuticket' => $menuticket,
                  'menuobrazky' => $menuobrazky, 
                  'informace' => $this->session->userdata('informace'),
            'prihlasen' => $this->session->userdata('prihlasen'),
            'opravneni' => $this->session->userdata('opravneni'),
            'oc' => $this->session->userdata('oc'),
            'email' => $this->session->userdata('email'),
            'prijmeni' => $this->session->userdata('prijmeni'),
            'jmeno' => $this->session->userdata('jmeno'), 
            'menuodd' => $menuodd,                 
             );
        $this->session->set_userdata('pocet_oddeleni', $this->Ticket_model->getTickpocetoddeleni($this->session->userdata('oddeleni')));
        $this->session->set_userdata('pocet_spoluprace', $this->Ticket_model->getTickpocetspoluprace($this->session->userdata('oc')));            
             $this->session->set_userdata('pocet_zadani', $this->Ticket_model->getTickpocetzadani($this->session->userdata('oc')));
             $this->session->set_userdata('pocet_tickets', $this->Ticket_model->getTickpocettickets($this->session->userdata('oc')));    
        $this->load->view('ticket_moje', $vystup);
        }                 


}
