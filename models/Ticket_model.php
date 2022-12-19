<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_model extends CI_Model {
                                                                                                                                                                                                                               
  

function getToday(){
 
 $today = date("Y-m-d"); 

    return $today;
  }
  
    function getTicket($nasid = NULL){
 
        $this->db->select('tic_oddeleni,tic,oddeleni_resi,oc,nasid,oc_zadal,autor,narocnost,predmet,text,datum,cas,oddeleni_resi,prijmeni,oddeleni_zadal,termin,priorita,oc_resi,stav,zkratka,nasid,tic_st,tic_stav,tic_realizace,realizace,termin_ok,zakcis'); 
        $where = "nasid=$nasid";   
        $this->db->where($where);
        $this->db->join('ticket_oddeleni', 'ticket_oddeleni.tic = tickets.oddeleni_resi');
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_stav', 'ticket_stav.tic_st = tickets.stav');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');  
        $tickets = $this->db->get('tickets'); 
        $ticket = $tickets->first_row();
        
            
       
     
    return $ticket;
  }
  
  
    function getZakazTicket($zprac = NULL){
 
        $this->db->select('*');
     //   $this->db->where('oddeleni',$zprac['oddeleni']); 
        $this->db->where('zakcis',$zprac['zakcis']); 
        $this->db->limit(100);
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_next', 'ticket_next.nxt_st = tickets.stav', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');  
        $ticketsall = $this->db->get('tickets')->result();
        return $ticketsall;
            
       
     
   
  }
  
  
   function getSupervizor($oddeleni = NULL){
 
        $this->db->select('oc'); 
        $where = "oddeleni=$oddeleni";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('ticket_supervizor'); 
        $zamestnanec = $zamestnanci->first_row();
        $oc = $zamestnanec->oc;
               
             
     
    return $oc;
  }
  
  
     function getFiltering2($oc = NULL){
        $this->db->select('*');
        $where = "flt_oc=$oc";   
        $this->db->where($where);
     //   $this->db->limit(1); 
     //   $this->db->order_by('vie_id', 'desc');
        $tickets = $this->db->get('tickets_filter2'); 
        $lastview = $tickets->first_row();
    
    return $lastview;
  }
  
    function getFiltering($oc = NULL){
        $this->db->select('*');
        $where = "flt_oc=$oc";   
        $this->db->where($where);
     //   $this->db->limit(1); 
     //   $this->db->order_by('vie_id', 'desc');
        $tickets = $this->db->get('tickets_filter'); 
        $lastview = $tickets->first_row();
    
    return $lastview;
  }
  
    function getLastview($nasid = NULL){
        $this->db->select('*');
        $where = "tic_id=$nasid";   
        $this->db->where($where);
        $this->db->limit(1); 
        $this->db->order_by('vie_id', 'desc');
        $tickets = $this->db->get('tickets_views'); 
        $lastview = $tickets->first_row();
    
    return $lastview;
  }
  
     function getLastedit($nasid = NULL){
        $this->db->select('*');
        $where = "tic_id=$nasid";   
        $this->db->where($where);
        $this->db->limit(1); 
        $this->db->order_by('lg_id', 'desc');
        $tickets = $this->db->get('tickets_log'); 
        $lastedit = $tickets->first_row();
    
    return $lastedit;
  }
  
  
   function auto_close($nasid){
  
     $cas = date("Y-m-d H:i:s"); 
     
     $log = array(                 
                'lg_autor' => $this->session->userdata('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 2,
                'tic_id' => $nasid,
                'lg_pozn' => "Uzavřený");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
            $close = date("Y-m-d"); 
             $data = array(
                
                
                'close_date' => $close,
                'stav' => 7,
                  
                                              
                
                );
            $this->db->where('nasid', $nasid); 
            $this->db->update('tickets', $data); 
            
            
             $maildata = array ();
             $maildata['stav'] = "Uzavřený";
             $maildata['idnew'] = $nasid;  
             $maildata['autor'] = $this->session->userdata('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
             $email = $this->Email_model->getNewStav($maildata);
    
    
}
  
  
  function auto_submit($nasid){
  
     $cas = date("Y-m-d H:i:s"); 
     
     $log = array(                 
                'lg_autor' => $this->session->userdata('prijmeni'),
                'lg_datum' => $cas,
                'lg_zmena' => 23,
                'tic_id' => $nasid,
                'lg_pozn' => "Uzavřen od zadavatele");
            $logupdate = $this->Ticket_model->getLogUpdate($log); 
            
            $data = array(
                
                
               
                'stav' => 6,
                  
                                              
                
                );
            $this->db->where('nasid', $nasid); 
            $this->db->update('tickets', $data); 
            
            
             $maildata = array ();
             $maildata['stav'] = "Potvrzený od zadavatele";
             $maildata['idnew'] = $nasid;  
             $maildata['autor'] = $this->session->userdata('prijmeni'); 
             $maildata['cas'] = $cas; 
             $maildata['zprava'] = "Nový stav ticketu " ; 
                
 $email = $this->Email_model->getNewStav($maildata);
    
    
}
  
  
    function getLogUpdate($log = Null){
    $log2 = array(                 
                'lg_autor' => $log['lg_autor'],
                'lg_oc' => $this->session->userdata('oc'),
                'lg_datum' => $log['lg_datum'],
                'tic_id' => $log['tic_id'],
                'lg_zmena' => $log['lg_zmena'],
                'lg_pozn' => $log['lg_pozn']);
    $this->db->insert('tickets_log', $log2); 
    
    $data = array(
                'lastedit' => $this->session->userdata('oc'),
                );
            $this->db->where('nasid', $log['tic_id']); 
            $this->db->update('tickets', $data); 
            
    }
    
    function getViewUpdate($view){
    $cas = date("Y-m-d H:i:s"); 
    $view = array(                 
                'vie_datum' => $cas,
                'vie_oc' => $this->session->userdata('oc'),
                'tic_id' => $view,
                'vie_prijmeni' => $this->session->userdata('prijmeni'),
                );
            $this->db->insert('tickets_views', $view); 
            
    }
    
    
    function del_soubor($fls_id){
    
    $this->db->select('tic_id,nazev');
    $this->db->where('fls_id',$fls_id); 
    $tickets_files = $this->db->get('tickets_files'); 
    $zamestnanec = $tickets_files->first_row();
    $tickets_id = $zamestnanec->tic_id;
    $tickets_file = $zamestnanec->nazev;
    
    $ticket = $this->Ticket_model->getTicket($tickets_id);
     if($ticket->stav < 5) {
     
    $this -> db -> where('fls_id', $fls_id);
    $this -> db -> delete('tickets_files');
    
    $cas = date("Y-m-d H:i:s"); 
    $log2 = array(                 
                'lg_autor' => $this->session->userdata('prijmeni'),
                'lg_datum' => $cas,
                'tic_id' => $tickets_id,
                'lg_zmena' => 9,
                'lg_pozn' => $tickets_file);
    $this->db->insert('tickets_log', $log2); 
     }
    return $tickets_id;
}
    
    function del_spoluprace($hlp_id){
    
    $this->db->select('tic_id,hlp_prijmeni');
    $this->db->where('hlp_id',$hlp_id); 
    $tickets_help = $this->db->get('tickets_help'); 
    $zamestnanec = $tickets_help->first_row();
    $tickets_id = $zamestnanec->tic_id;
    $tickets_help = $zamestnanec->hlp_prijmeni;
    
     $ticket = $this->Ticket_model->getTicket($tickets_id);
     if($ticket->stav < 5) {
        //   $this->session->set_userdata('informace', 'Pro založení ticketu je nutné být přihlášen/a do intranetu.');
           
     
     
    $this -> db -> where('hlp_id', $hlp_id);
    $this -> db -> delete('tickets_help');
    
    $cas = date("Y-m-d H:i:s"); 
    $log2 = array(                 
                'lg_autor' => $this->session->userdata('prijmeni'),
                'lg_datum' => $cas,
                'tic_id' => $tickets_id,
                'lg_zmena' => 7,
                'lg_pozn' => $tickets_help);
    $this->db->insert('tickets_log', $log2); 
    
       }
    
    return $tickets_id;
}
  
   function getpomocexistuje($test = Null){  
                          
             $this->db->where('hlp_id',$test);
             $this->db->from('tickets_help');
             $count = $this->db->count_all_results();
             return $count;
  }
  
  function getPomoc($pomoc = Null){      
        $this->db->select('oc,prijmeni,oddeleni,mail');
        $this->db->where('oc',$pomoc); 
      //  $this->db->where('oddeleni',$id); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
       
    return $zamestnanec;
  }
  
  
   function getResitel($data = Null){      
        $this->db->select('oc,prijmeni,jmeno'); 
        if ($this->session->userdata('oddeleni') <> 2) {
        $this->db->where('oddeleni',$data['oddeleni_resi']); 
        }
        
        $this->db->where('oc <>',$data['oc_zadal']); 
        $this->db->where('oddeleni >',0); 
        $this->db->where('typ',1); 
      //  $this->db->where('oddeleni',$id); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
       $query = $this->db->get()->result();  
       
    return $query;
  }
  
  function getSpoluprace($data = Null){      
        $this->db->select('oc,prijmeni,jmeno'); 
        $this->db->where('oc <>',$data['oc_resi']); 
        $this->db->where('oc <>',$data['oc_zadal']); 
        $this->db->where('opravneni >',0); 
        $this->db->where('typ',1); 
      //  $this->db->where('oddeleni',$id); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
       $query = $this->db->get()->result();  
       
    return $query;
  }
  
  function getFullhelp($nasid = NULL){
 
    //    $this->db->select('*');
    //    $where = "tic_id=$nasid";   
    //    $this->db->where($where);
    //    $this->db->order_by('prijmeni', 'asc');
    //    $this->db->from('tickets_help');
    //    $this->db->join('zamestnanci', 'zamestnanci.oc = tickets_help.hlp_oc');
    //    $pomahani = $this->db->get()->result();  
       
        $where = "tic_id=$nasid";       
        $query = $this->db->select('*')
          
          ->from('tickets_help')
          ->join('zamestnanci', 'zamestnanci.oc = tickets_help.hlp_oc','RIGHT OUTER')
          ->where($where)
          ->get();
     
    return $query;
  }
  
   function getvedoucipristup($nasid = NULL){
 
        $this->db->select('oddeleni_resi,id');
        $this->db->where('nasid',$nasid); 
      //  $this->db->where('oddeleni_id',$this->session->userdata('oddeleni')); 
        $this->db->from('tickets');
        $this->db->join('dbnadrizeny', 'tickets.oddeleni_resi = dbnadrizeny.oddeleni_id');
        $fam_oblast = $this->db->get();
        $next = $fam_oblast->first_row();
        $nextstep = $next->id;
        
        if ($nextstep == $this->session->userdata('oc')) {
        $popis_den =  1;
        } else {
        $popis_den = Null;
        }
       
       
    return $popis_den;
  }
  
   function getvedoucipristup2($nasid = NULL){
 
        $this->db->select('oddeleni_resi,id');
        $this->db->where('nasid',$nasid); 
      //  $this->db->where('oddeleni_id',$this->session->userdata('oddeleni')); 
        $this->db->from('tickets');
        $this->db->join('dbnadrizeny', 'tickets.oddeleni_zadal = dbnadrizeny.oddeleni_id');
        $fam_oblast = $this->db->get();
        $next = $fam_oblast->first_row();
        $nextstep = $next->id;
        
        if ($nextstep == $this->session->userdata('oc')) {
        $popis_den =  1;
        } else {
        $popis_den = Null;
        }
       
       
    return $popis_den;
  }
  
   function getpomocpristup($nasid = NULL){
 
        $this->db->select('*');
        $this->db->where('tic_id',$nasid); 
        $this->db->where('hlp_oc',$this->session->userdata('oc')); 
        $this->db->order_by('hlp_prijmeni', 'asc'); 
        $this->db->from('tickets_help');
        $pomoc = $this->db->get()->result();  
        $pocet_pomoc = $this->db->affected_rows($pomoc);
       
       
    return $pocet_pomoc;
  }
  
  
   function gethelpvse($nasid = NULL){
 
        $this->db->select('*');
        $this->db->where('tic_id',$nasid); 
        $this->db->order_by('hlp_prijmeni', 'asc'); 
        $this->db->from('tickets_help');
        $answear = $this->db->get()->result();  
       
       
    return $answear;
  }
  
   function aktustavrealizace($stav = NULL){
 
        $this->db->select('tic_realizace');
        $this->db->where('tic_rlz =',$stav); 
        $this->db->order_by('tic_rlz', 'asc'); 
        $this->db->from('ticket_realizace');
        $tic_realizace = $this->db->get();  
        $aktstav = $tic_realizace->first_row();
        $nextstep = $aktstav->tic_realizace;
       
       
    return $nextstep;
  }
  
   function stavrealizace($stav = NULL){
 
        $this->db->select('*');
        $this->db->where('tic_rlz >=',$stav); 
        $this->db->order_by('tic_rlz', 'asc'); 
        $this->db->from('ticket_realizace');
        $tic_realizace = $this->db->get()->result();  
       
       
    return $tic_realizace;
  }
  
    function getdalsiakce($stav = NULL){
 
        $this->db->select('*');
        $this->db->where('nxt_st',$stav); 
        $fam_oblast = $this->db->get('ticket_next');
        $next = $fam_oblast->first_row();
        $nextstep = $next->nxt_stav;
       
       
    return $nextstep;
  }
  
  
   function getTicketansw($nasid = NULL){
 
        $this->db->select('*');
        $this->db->where('tic_id',$nasid); 
        $this->db->order_by('ans_datum', 'desc'); 
        $this->db->from('tickets_answ');
        $answear = $this->db->get()->result();  
       
       
    return $answear;
  }
  
  
   function getZkratka2 ($odd_resi = NULL){
   
       
        $this->db->select('zkratka'); 
        $where = "tic=$odd_resi";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('ticket_oddeleni');
        $oddeleni = $fam_oblast->first_row();
        $zkratka = $oddeleni->zkratka;   
               
             
     
    return $zkratka ;
  }
  
  
   function getZkratka ($nasid = NULL){
   
        $this->db->select('oddeleni_resi'); 
        $where = "nasid=$nasid";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('tickets');
        $oddeleni = $fam_oblast->first_row();
        $odd_resi = $oddeleni->oddeleni_resi;
 
        $this->db->select('zkratka'); 
        $where = "tic=$odd_resi";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('ticket_oddeleni');
        $oddeleni = $fam_oblast->first_row();
        $zkratka = $oddeleni->zkratka;   
               
             
     
    return $zkratka ;
  }
  
   function getOddeleni_name ($id = NULL){
 
        $this->db->select('oddeleni_name'); 
        $where = "id=$id";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('dboddeleni_copy');
        $oddeleni = $fam_oblast->first_row();
        $oddeleniname = $oddeleni->oddeleni_name;
               
             
     
    return $oddeleniname ;
  }
  
  function getoddeleniname ($oddelenid = NULL){
 
        $this->db->select('oddeleni_name'); 
        $where = "id=$oddelenid";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('dboddeleni_ticket');
        $oddeleni = $fam_oblast->first_row();
        $oddeleniname = $oddeleni->oddeleni_name;
               
             
     
    return $oddeleniname ;
  }
  
   function getTicket_oddel_zmena($prijmenioc = NULL){
 
        $this->db->select('oddeleni'); 
        $where = "oc=$prijmenioc";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('zamestnanci');
        $odd = $fam_oblast->first_row();
        $prijmeni = $odd->oddeleni;
               
             
     
    return $prijmeni;
  }
  
  
  function getTicket_prijmeni($prijmenioc = NULL){
 
        $this->db->select('prijmeni'); 
        $where = "oc=$prijmenioc";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('zamestnanci');
        $oddeleni = $fam_oblast->first_row();
        $prijmeni = $oddeleni->prijmeni;
               
             
     
    return $prijmeni;
  }
  
  
  function getTicket_resi($nasid = NULL){
 
        $this->db->select('oc_resi'); 
        $where = "nasid=$nasid";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('tickets');
        $oddeleni = $fam_oblast->first_row();
        $oc_resi = $oddeleni->oc_resi;
               
             
     
    return $oc_resi;
  }
  
  
  function akt_stavrealizace($stav = NULL){
 
        $this->db->select('tic_realizace');
        $this->db->where('tic_rlz',$stav); 
        $fam_oblast = $this->db->get('ticket_realizace');
        $oddeleni = $fam_oblast->first_row();
        $akt_stav = $oddeleni->tic_realizace;
        
       
    return $akt_stav;
  }
  
  
  function getTicket_odd_id($nasid = NULL){
 
        $this->db->select('oddeleni_resi'); 
        $where = "nasid=$nasid";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('tickets');
        $oddeleni = $fam_oblast->first_row();
        $oddeleni_id = $oddeleni->oddeleni_resi;
               
             
     
    return $oddeleni_id;
  }
  
   function getTicketfiles($nasid = NULL){
 
        $this->db->select('*');
        $this->db->where('tic_id',$nasid); 
        $this->db->from('tickets_files');
        $files = $this->db->get()->result();  
       
       
    return $files;
  }
  
  
   function getTicketlog($nasid = NULL){
 
     
        
        $this->db->select('*');
        $this->db->where('tic_id',$nasid); 
        $this->db->order_by('lg_id', 'desc'); 
        $this->db->from('tickets_log');
        $this->db->join('tickets_logdef', 'tickets_logdef.id = tickets_log.lg_zmena'); 
     //   $this->db->join('tickets_realizace', 'tickets_realizace.tic_rlz = tickets_log.lg_pozn', "left");   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $log = $this->db->get()->result();  
       
       
    return $log;
  }
  
   function getMenuticket(){
 
     
        
        $this->db->select('oddeleni_name,id,oddeleni_resi');
        $this->db->where('oddeleni_resi <>',0); 
        $this->db->where('oddeleni_resi <>',$this->session->userdata('oddeleni')); 
        $this->db->order_by('oddeleni_name', 'asc'); 
        $this->db->group_by('oddeleni_resi'); 
        $this->db->from('tickets');
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $dboddeleni = $this->db->get()->result();  
       
       
    return $dboddeleni;
  }
  
     function getTickpocetoddeleni($oddeleni = NULL){
        $this->db->select('nasid');
        if (($this->session->userdata('oddeleni')) <> 3) { 
        $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni')); 
         } 
        $this->db->where('stav <',7);
        $incident = $this->db->get('tickets')->result();
        $pocet_abs = $this->db->affected_rows($incident);
        return $pocet_abs;
        } 
    
    function getTickpocetoddeleni_close($oddeleni = NULL){
        $this->db->select('nasid');
        if (($this->session->userdata('oddeleni')) <> 3) { 
        $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni')); 
         }
        $this->db->where('stav',7);
        $incident = $this->db->get('tickets')->result();
        $pocet_abs = $this->db->affected_rows($incident);
        return $pocet_abs;
        }     
          
  
   function getTickets_moje_close($oc = NULL){
        $this->db->select('*');
        $this->db->where('oc_resi',$oc); 
        $this->db->where('tickets.stav',7);
        $this->db->order_by('nasid', 'desc');
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');    
        $incident = $this->db->get('tickets')->result();
        return $incident;
        }
  
    function getTickets_moje($oc = NULL){
        $this->db->select('*');
        $this->db->where('oc_resi',$oc); 
        $this->db->where('tickets.stav <',7);
        $this->db->order_by('nasid', 'desc');
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');    
        $incident = $this->db->get('tickets')->result();
        return $incident;
        }
        
    function getTickets_spoluprace_close($oc = NULL){
        $this->db->select('*');
        $this->db->where('hlp_oc',$oc); 
        $this->db->order_by('oc_resi', 'asc');
        $this->db->order_by('nasid', 'asc');
        $this->db->join('tickets', 'tickets_help.tic_id = tickets.nasid'); 
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');
        $this->db->where('tickets.stav',7);
        $incident = $this->db->get('tickets_help')->result();  
        return $incident;
        }
        
    function getTickets_spoluprace($oc = NULL){
        $this->db->select('*');
        $this->db->where('hlp_oc',$oc); 
        $this->db->order_by('oc_resi', 'asc');
        $this->db->order_by('nasid', 'asc');
        $this->db->join('tickets', 'tickets_help.tic_id = tickets.nasid'); 
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');
        $this->db->where('tickets.stav <',7);
        $incident = $this->db->get('tickets_help')->result();  
        return $incident;
        }
        
    function getTickpocetspoluprace_close($oc = NULL){
        $this->db->select('tic_id');
        $this->db->where('hlp_oc',$oc); 
     //   $this->db->from('tickets_help');
        $this->db->join('tickets', 'tickets_help.tic_id = tickets.nasid'); 
        $this->db->where('tickets.stav',7);
        $incident = $this->db->get('tickets_help')->result();  
        $pocet_abs = $this->db->affected_rows($incident);
        return $pocet_abs;
        }    
        
    function getTickpocetspoluprace($oc = NULL){
        $this->db->select('tic_id');
        $this->db->where('hlp_oc',$oc); 
     //   $this->db->from('tickets_help');
        $this->db->join('tickets', 'tickets_help.tic_id = tickets.nasid'); 
        $this->db->where('tickets.stav <',7);
        $incident = $this->db->get('tickets_help')->result();  
        $pocet_abs = $this->db->affected_rows($incident);
        return $pocet_abs;
        }    
        
     function getTickpocettickets($oc = NULL){
        $this->db->select('nasid');
        $this->db->where('oc_resi',$oc); 
        $this->db->where('stav <',7);
        $incident = $this->db->get('tickets')->result();
        $pocet_abs = $this->db->affected_rows($incident);
        return $pocet_abs;
        }  
        
    function getTickpocettickets_close($oc = NULL){
        $this->db->select('nasid');
        $this->db->where('oc_resi',$oc); 
        $this->db->where('stav',7);
        $incident = $this->db->get('tickets')->result();
        $pocet_abs = $this->db->affected_rows($incident);
        return $pocet_abs;
        }    
        
     function getTickpocetzadani($oc = NULL){
        $this->db->select('nasid');
        $this->db->where('oc_zadal',$oc); 
        $this->db->where('stav <',7);
        $incident = $this->db->get('tickets')->result();
        $pocet_abs = $this->db->affected_rows($incident);
        return $pocet_abs;
        } 
        
     function getTickpocetzadani_close($oc = NULL){
        $this->db->select('nasid');
        $this->db->where('oc_zadal',$oc); 
        $this->db->where('stav',7);
        $incident = $this->db->get('tickets')->result();
        $pocet_abs = $this->db->affected_rows($incident);
        return $pocet_abs;
        }   
        
    function getTickets_zadani_close($oc = NULL){
        $this->db->select('*');
        $this->db->where('oc_zadal',$oc); 
         $this->db->where('stav',7);
        
        $this->db->order_by('oddeleni_resi', 'asc');
        $this->db->order_by('nasid', 'asc');
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');    
        $incident = $this->db->get('tickets')->result();
        return $incident;
        }  
        
              
   function getTickets_zadani($oc = NULL){
        $this->db->select('*');
        $this->db->where('oc_zadal',$oc); 
         $this->db->where('stav <',7);
        
        $this->db->order_by('oddeleni_resi', 'asc');
        $this->db->order_by('nasid', 'asc');
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');    
        $incident = $this->db->get('tickets')->result();
        return $incident;
        }
  
   function getTickets_odd($oddeleni = NULL){
        $this->db->select('*');
        $this->db->where('oddeleni_resi',$oddeleni); 
         $this->db->where('stav <',7);
        $this->db->order_by('oc_resi', 'asc');
        $this->db->order_by('nasid', 'asc');
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');   
        $incident = $this->db->get('tickets')->result();
        return $incident;
        }
  
    function getTicket_name_odd($oddeleni = NULL){
 
        $this->db->select('oddeleni_name'); 
        $where = "id=$oddeleni";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('dboddeleni_ticket');
        $oddeleni = $fam_oblast->first_row();
        $oddeleni_name_text = $oddeleni->oddeleni_name;
               
             
     
    return $oddeleni_name_text;
  }
  
   function getTicketshome(){ 
        $this->db->select('autor, predmet, termin, oddeleni_resi, zkratka, nasid, oddeleni_name, prijmeni, tic_realizace, nxt_stav');
        $this->db->where('stav <',7);
        $this->db->order_by('nasid', 'desc');
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi'); 
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');  
        $this->db->join('ticket_next', 'ticket_next.nxt_st = tickets.stav');  
        $ticketshome = $this->db->get('tickets',20)->result();
        return $ticketshome;
        }
        
        function getTicket_odd_zadal($filtr = NULL){ 
          
        $this->db->select('oddeleni_zadal,oddeleni');
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
                      
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }   
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }   
        else { $this->db->where('stav',$filtr['stav']); }  
        
        $this->db->group_by('tickets.oddeleni_zadal'); 
        $this->db->join('dboddeleni', 'dboddeleni.id = tickets.oddeleni_zadal'); 
        $this->db->order_by('dboddeleni.oddeleni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
         function getTicket_oc_zadal($filtr = NULL){ 
          
        $this->db->select('oc_zadal,prijmeni');
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
       if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }   
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }   
        else { $this->db->where('stav',$filtr['stav']); }  
        
        $this->db->group_by('tickets.oc_zadal'); 
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_zadal'); 
        $this->db->order_by('zamestnanci.prijmeni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
        
          function getTicket_oc_resi($filtr = NULL){ 
          
        $this->db->select('oc_resi,prijmeni');
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
                      
        if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }   
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }   
        else { $this->db->where('stav',$filtr['stav']); }  
        
        $this->db->group_by('tickets.oc_resi'); 
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi'); 
        $this->db->order_by('zamestnanci.prijmeni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        }  
        
      function getTicket_odd_resi($filtr = NULL){ 
          
        $this->db->select('oddeleni_resi,tic_oddeleni');
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
                      
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }  
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }    
        else { $this->db->where('stav',$filtr['stav']); }  
        
        
        $this->db->group_by('tickets.oddeleni_resi'); 
        $this->db->join('ticket_oddeleni', 'ticket_oddeleni.tic = tickets.oddeleni_resi'); 
        $this->db->order_by('ticket_oddeleni.tic_oddeleni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
        
         function getTicket_odd_resi3($filtr = NULL){ 
          
        $this->db->select('oddeleni_resi,tic_oddeleni');
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }  
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }    
        else { $this->db->where('stav',$filtr['stav']); }  
        
       $this->db->group_by('tickets.oddeleni_resi'); 
        $this->db->join('ticket_oddeleni', 'ticket_oddeleni.tic = tickets.oddeleni_resi'); 
        $this->db->order_by('ticket_oddeleni.tic_oddeleni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
        
        
        function getTicket_odd_zadal2($filtr = NULL){ 
          
        $this->db->select('oddeleni_zadal,oddeleni');
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }   
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }   
        else { $this->db->where('stav',$filtr['stav']); }    
        
                               
        
        $this->db->group_by('tickets.oddeleni_zadal'); 
        $this->db->join('dboddeleni', 'dboddeleni.id = tickets.oddeleni_zadal'); 
        $this->db->order_by('dboddeleni.oddeleni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        }
        
        
                   function getTicket_realizace2($filtr = NULL){ 
          
        $this->db->select('tic_st,tic_stav,stav');
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); } 
        
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
    //    if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
    //    elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }  
    //    elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }    
   //     else { $this->db->where('stav',$filtr['stav']); }  
        
        $this->db->group_by('tickets.stav'); 
        $this->db->join('ticket_stav', 'ticket_stav.tic_st = tickets.stav'); 
        $this->db->order_by('ticket_stav.tic_st', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
        
           function getTicket_realizace3($filtr = NULL){ 
          
        $this->db->select('tic_st,tic_stav,stav');
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); } 
        
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
   //      if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
   //     elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }  
   //     elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }    
   //     else { $this->db->where('stav',$filtr['stav']); }  
        
        $this->db->group_by('tickets.stav'); 
        $this->db->join('ticket_stav', 'ticket_stav.tic_st = tickets.stav'); 
        $this->db->order_by('ticket_stav.tic_st', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
        
          function getTicket_oc_resi3($filtr = NULL){ 
          
        $this->db->select('oc_resi,prijmeni');
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }  
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }    
        else { $this->db->where('stav',$filtr['stav']); }   
        
        $this->db->group_by('tickets.oc_resi'); 
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi'); 
        $this->db->order_by('zamestnanci.prijmeni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
        
        
        
         function getTicket_oc_zadal2($filtr = NULL){ 
          
        $this->db->select('oc_zadal,prijmeni');
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }    
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }  
        else { $this->db->where('stav',$filtr['stav']); }    
        
        $this->db->group_by('tickets.oc_zadal'); 
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_zadal'); 
        $this->db->order_by('zamestnanci.prijmeni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
         
         
          function getTicket_oc_zadal3($filtr = NULL){ 
          
        $this->db->select('oc_zadal,prijmeni');
        
      //   if (($this->session->userdata('opravneni')) > 11) { 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
                      
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }   
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }   
        else { $this->db->where('stav',$filtr['stav']); }  
        
      //    }
         
         if (($this->session->userdata('opravneni')) < 12 and ($this->session->userdata('opravneni')) > 5)
         
         {  $this->db->where('oddeleni_zadal',$this->session->userdata('oddeleni')); } 
          
          
        if (($this->session->userdata('opravneni')) < 6) { 
         
        $this->db->where('oc_zadal',$this->session->userdata('oc')); 
        $this->db->where('oddeleni_zadal',$this->session->userdata('oddeleni')); 
         
        } 
        
        $this->db->group_by('tickets.oc_zadal'); 
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_zadal'); 
        $this->db->order_by('zamestnanci.prijmeni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
       
        
          function getTicket_oc_resi2($filtr = NULL){ 
          
        $this->db->select('oc_resi,prijmeni');
        
    //     if (($this->session->userdata('opravneni')) > 11) { 
        
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
           if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
                      
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }   
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }   
        else { $this->db->where('stav',$filtr['stav']); }  
    
      //    }
         
       if (($this->session->userdata('opravneni')) < 12 and ($this->session->userdata('opravneni')) > 5)
         
         {  $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni')); } 
          
          
        if (($this->session->userdata('opravneni')) < 6) { 
         
         $this->db->where('oc_resi',$this->session->userdata('oc')); } 
        
        $this->db->group_by('tickets.oc_resi'); 
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi'); 
        $this->db->order_by('zamestnanci.prijmeni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        } 
        
        
         function getTicket_odd_zadal3($filtr = NULL){ 
      
      $this->db->select('oddeleni_zadal,oddeleni');  
      
  //    if (($this->session->userdata('opravneni')) > 11) { 
          
        
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); } 
        
          if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }   
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }   
        else { $this->db->where('stav',$filtr['stav']); }  
        
        if (($this->session->userdata('opravneni')) < 12 and ($this->session->userdata('opravneni')) > 5)
         
         {  $this->db->where('oddeleni_zadal',$this->session->userdata('oddeleni')); } 
          
          
        if (($this->session->userdata('opravneni')) < 6) { 
         
        $this->db->where('oc_zadal',$this->session->userdata('oc')); 
         
         
        } 
                      
     //   $this->db->where('stav <>',7); 
         $this->db->group_by('tickets.oddeleni_zadal'); 
        $this->db->join('dboddeleni', 'dboddeleni.id = tickets.oddeleni_zadal'); 
        $this->db->order_by('dboddeleni.oddeleni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        }
        
        
      function getTicket_odd_resi2($filtr = NULL){ 
      
      $this->db->select('oddeleni_resi,tic_oddeleni');  
      
  //    if (($this->session->userdata('opravneni')) > 11) { 
          
        
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
          if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); } 
        
         if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }  
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }    
        else { $this->db->where('stav',$filtr['stav']); }  
        
         if (($this->session->userdata('opravneni')) < 12 and ($this->session->userdata('opravneni')) > 5)
         
         {  $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni')); } 
          
          
        if (($this->session->userdata('opravneni')) < 6) { 
         
        $this->db->where('oc_resi',$this->session->userdata('oc')); 
         
         
        } 
                      
     //   $this->db->where('stav <>',7); 
        $this->db->group_by('tickets.oddeleni_resi'); 
        $this->db->join('ticket_oddeleni', 'ticket_oddeleni.tic = tickets.oddeleni_resi'); 
        $this->db->order_by('ticket_oddeleni.tic_oddeleni', 'asc'); 
        $seznam = $this->db->get('tickets')->result();  
        
          return $seznam;
        }
        
        
        
         function getTicketsall_pocetneuzav($filtr = NULL){ 
        $this->db->select('nasid');
       
        if (($this->session->userdata('oddeleni')) <> 3) { 
        $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni')); 
         }
         
         if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
          if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
        $this->db->where('stav <',6);  
       
     //   $this->db->order_by('oc_resi', 'asc');
     //   $this->db->order_by('nasid', 'asc');
     //   $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
     //   $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
     //   $this->db->join('ticket_next', 'ticket_next.nxt_st = tickets.stav', 'left');  
     //   $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');  
        $ticketsall = $this->db->get('tickets')->result();
        $pocet_tickets = $this->db->affected_rows($ticketsall);
        return $pocet_tickets;
        } 
        
        
        function getTicketsall_pocet2($filtr = NULL){ 
        $this->db->select('nasid');
       
        if (($this->session->userdata('oddeleni')) <> 3) { 
        $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni')); 
         }
         
         if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
          if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
        if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }   
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }  
        else { $this->db->where('stav',$filtr['stav']); }  
     //   $this->db->order_by('oc_resi', 'asc');
     //   $this->db->order_by('nasid', 'asc');
     //   $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
     //   $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
     //   $this->db->join('ticket_next', 'ticket_next.nxt_st = tickets.stav', 'left');  
     //   $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');  
        $ticketsall = $this->db->get('tickets')->result();
        $pocet_tickets = $this->db->affected_rows($ticketsall);
        return $pocet_tickets;
        } 
        
        function getTicketsall_pocet($filtr = NULL){ 
        $this->db->select('nasid');
       
    //    if (($this->session->userdata('oddeleni')) <> 3) { 
    //    $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni')); 
    //     }
         
         if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }   
        
         if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
          if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
        if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }    
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }  
        else { $this->db->where('stav',$filtr['stav']); }  
     //   $this->db->order_by('oc_resi', 'asc');
     //   $this->db->order_by('nasid', 'asc');
     //   $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
     //   $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
     //   $this->db->join('ticket_next', 'ticket_next.nxt_st = tickets.stav', 'left');  
     //   $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');  
        $ticketsall = $this->db->get('tickets')->result();
        $pocet_tickets = $this->db->affected_rows($ticketsall);
        return $pocet_tickets;
        } 
        
        function getTicketsall($filtr = NULL){ 
          
        if ($filtr['sort'] == 0 )
        { $sloupec = "nasid"; $razeni = "desc"; }     
        else
        { $sort = $this->Ticket_model->Sorting_tickets($filtr['sort']);
        $sloupec = $sort['sloupec']; $razeni = $sort['razeni'];
        
          }    
        
        $this->db->select('*');
       
     //   if (($this->session->userdata('opravneni')) == 8) { 
     //   $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni'));}
         
         if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }  
        
         if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
         if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
        if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }  
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }       
        else { $this->db->where('stav',$filtr['stav']); }   
    
        $this->db->order_by($sloupec, $razeni);  
        $this->db->limit(200);
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_next', 'ticket_next.nxt_st = tickets.stav', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');  
        $ticketsall = $this->db->get('tickets')->result();
        return $ticketsall;
        }   
        
          function getTicketsall2($filtr = NULL){ 
          
        if ($filtr['sort'] == 0 )
        { $sloupec = "nasid"; $razeni = "desc"; }     
        else
        { $sort = $this->Ticket_model->Sorting_tickets($filtr['sort']);
        $sloupec = $sort['sloupec']; $razeni = $sort['razeni'];
        
          }    
        
        $this->db->select('*');
       
     //   if (($this->session->userdata('opravneni')) == 8) { 
     //   $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni'));}
         
         if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }  
        
         if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }  
        
         if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['zakcis'] == 0 ) {  }     
        else { $this->db->where('zakcis',$filtr['zakcis']); }  
        
         if ($filtr['ticket_id'] == 0 ) {  }     
        else { $this->db->where('nasid',$filtr['ticket_id']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
        if ($filtr['stav'] == 0 ) {$this->db->where('stav is  NOT NULL');  }  
        elseif ($filtr['stav'] == 9 ) {$this->db->where('stav <',7);  }  
        elseif ($filtr['stav'] == 10 ) {$this->db->where('stav <',6);  }       
        else { $this->db->where('stav',$filtr['stav']); }   
    
        $this->db->order_by($sloupec, $razeni);  
        $this->db->limit(200);
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');  
        $this->db->join('ticket_next', 'ticket_next.nxt_st = tickets.stav', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');  
        $ticketsall = $this->db->get('tickets')->result();
        return $ticketsall;
        }                        
        
        function getTicketsall_close($filtr = NULL){ 
        
         if ($filtr['sort'] == 0 ) { $sloupec = "nasid"; $razeni = "desc"; }     
        else { $sort = $this->Ticket_model->Sorting_tickets($filtr['sort']);
        $sloupec = $sort['sloupec']; $razeni = $sort['razeni'];
        
          }    
        
        $this->db->select('*');
       
        if (($this->session->userdata('oddeleni')) <> 3) { $this->db->where('oddeleni_resi',$this->session->userdata('oddeleni')); }
        
        if ($filtr['oc_zadal'] == 0 ) { $this->db->where('oc_zadal is  NOT NULL'); }     
        else { $this->db->where('oc_zadal',$filtr['oc_zadal']); } 
        
        if ($filtr['oc_resi'] == 0 ) { $this->db->where('oc_resi is  NOT NULL'); }     
        else { $this->db->where('oc_resi',$filtr['oc_resi']); }   
                
        if ($filtr['oddeleni_zadal'] == 0 ) { $this->db->where('oddeleni_zadal is  NOT NULL'); }     
        else { $this->db->where('oddeleni_zadal',$filtr['oddeleni_zadal']); } 
        
        if ($filtr['oddeleni_resi'] == 0 ) { $this->db->where('oddeleni_resi is  NOT NULL'); }     
        else { $this->db->where('oddeleni_resi',$filtr['oddeleni_resi']); }  
        
          if ($filtr['zadani_od'] == 0 ) {  }     
        else { $this->db->where('datum >=',$filtr['zadani_od']); }  
        
         if ($filtr['zadani_do'] == 0 ) { }     
        else { $this->db->where('datum <=',$filtr['zadani_do']); }   
        
          if ($filtr['terminok_od'] == 0 ) {  }     
        else { $this->db->where('termin_ok >=',$filtr['terminok_od']); }  
        
         if ($filtr['terminok_do'] == 0 ) { }     
        else { $this->db->where('termin_ok <=',$filtr['terminok_do']); }  
        
         if ($filtr['stav'] == 0 ) { }     
        else { $this->db->where('stav',$filtr['stav']); }  
              
     //   $this->db->where('stav',7); 
     //   $this->db->order_by('oc_resi', 'asc');
        
        
        $this->db->order_by($sloupec, $razeni);  
        
        
        $this->db->join('dboddeleni_ticket', 'dboddeleni_ticket.id = tickets.oddeleni_resi');  
        $this->db->join('zamestnanci', 'zamestnanci.oc = tickets.oc_resi', 'left');
        $this->db->join('ticket_next', 'ticket_next.nxt_st = tickets.stav', 'left');  
        $this->db->join('ticket_realizace', 'ticket_realizace.tic_rlz = tickets.realizace');  
        $ticketsall = $this->db->get('tickets')->result();
        return $ticketsall;
        }    
        
  
    function getPrioritaticket(){
 
     
        
        $this->db->select('def_priorita,pid');
        $this->db->where('pid <>',0); 
        $this->db->order_by('pid', 'desc'); 
        $this->db->from('ipriorita_new');
        $dbpriorita = $this->db->get()->result();  
       
       
    return $dbpriorita;
  }
  
  function getOddeleniticket(){
 
     
        
        $this->db->select('oddeleni_name,id');
        $this->db->where('id <>',0); 
        $this->db->order_by('oddeleni_name', 'asc'); 
        $this->db->from('dboddeleni_ticket');
        $dboddeleni = $this->db->get()->result();  
       
       
    return $dboddeleni;
  }
  
  
   function Sorting_tickets($filtr = Null){  
         
          $sort = array ();
         $this->db->select('*'); 
        $this->db->where('sort_st', $filtr); 
        $zamestnanci = $this->db->get('ticket_sorting'); 
        $zamestnanec = $zamestnanci->first_row();
         $sort['sloupec'] = $zamestnanec->sort_name;
        $sort['razeni'] = $zamestnanec->sort_arrow;
        
      
       
       return $sort;
       }

}
