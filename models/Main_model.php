<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {


function getAktccvizor() { 
        $this->db->select('*'); 
        $this->db->where('oddeleni',2); 
        $ticket_supervizor = $this->db->get('ticket_supervizor');
        $zamestnanec = $ticket_supervizor->first_row();
        return $zamestnanec;
        } 
        
function getDelabsence($autor_id) { 
        $this->db->select('*');
        $this->db->where('autor_id', $autor_id); 
        $absenceto = $this->db->get('absence_log'); 
        $absence = $absenceto->first_row();
        return $absence;
        } 
        
   function getJeAbsanswer($autor_id){
 
        $this->db->select('abs_id'); 
        $this->db->where('abs_id', $autor_id); 
        $absence_answer = $this->db->get('absence_answer'); 
        $pocet = $absence_answer->num_rows();  
        
        if ($pocet > 0) {
        $existuje = 1;
        } else {
        $existuje = 0;
        }            
             
     
    return $existuje;
  }
         
        
                   

public function send_email_login($prijmeni){
     
     $email_setting  = array('mailtype'=>'txt');
           
           $config['protocol']    = 'sendmail';
           $config['smtp_host']    = '192.168.78.67';
           $config['smtp_port']    = '25';
           $config['smtp_user']    = 'markus@gsm.cemod.cz';
           $config['smtp_pass']    = '7619';
           $config['mailtype'] = 'text'; // or html
                 
           
           $this->email->initialize($config);     
           $this->email->to('603253856@gsm.cemod.cz'); 
           $this->email->from('Intranet Packway');
           $this->email->subject('Predmet');
           $this->email->message($prijmeni);
           $this->email->send();    
    
    
}

public function del_smernice($poid){
     
    $this -> db -> where('poid', $poid);
    $this -> db -> delete('pokyny_intranet');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $id,
                'pozn' => "Smazani dokumentu - " . $poid );
    $this->db->insert('intralog', $ttst); 
    
    
}


public function del_prodej($sid){
     
    $this -> db -> where('sid', $sid);
    $this -> db -> delete('atlas_prodej');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $sid,
                'pozn' => "Smazani prodeje atlas - " . $sid );
    $this->db->insert('intralog', $ttst); 
    
    
}

public function del_akce($id){
     
    $this -> db -> where('id', $id);
    $this -> db -> delete('akce');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $id,
                'pozn' => "Smazani akce - " . $id );
    $this->db->insert('intralog', $ttst); 
    
    
}

 public function del_covid($ic){
     
    $this -> db -> where('ic', $ic);
    $this -> db -> delete('covid');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $ic,
                'pozn' => "Smazaní covid testu - " . $ic );
    $this->db->insert('intralog', $ttst); 
    
    
} 


 public function del_www($id){
     
    $this -> db -> where('id', $id);
    $this -> db -> delete('www');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $id,
                'pozn' => "Smazaní odkazu - " . $id );
    $this->db->insert('intralog', $ttst); 
    
    
} 

 public function del_brig($oc){
     
    $this -> db -> where('oc', $oc);
    $this -> db -> delete('zamestnanci');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $oc,
                'pozn' => "Smazaní brigádníka - " . $oc );
    $this->db->insert('intralog', $ttst); 
    
    
}

public function del_agent($oc){
     
    $this -> db -> where('oc', $oc);
    $this -> db -> delete('zamestnanci');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $oc,
                'pozn' => "Smazaní agenturní - " . $oc );
    $this->db->insert('intralog', $ttst); 
    
    
}

  public function del_user($oc){
  
  
 
     
    $this -> db -> where('oc', $oc);
    $this -> db -> delete('zamestnanci');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $oc,
                'pozn' => "Smazani zaměstnance - " . $oc );
    $this->db->insert('intralog', $ttst); 
 
    
}

public function del_hotline($id_num){
     
    $this -> db -> where('id_num', $id_num);
    $this -> db -> delete('hotline');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $id_num,
                'pozn' => "Smazani hotline - " . $id_num );
    $this->db->insert('intralog', $ttst); 
    
    
}
  
   public function did_delete_img($id){
    $this -> db -> where('id', $id);
    $this -> db -> delete('tv_galerie');
    
    
}


  public function did_delete_tv($id){
    $this -> db -> where('id', $id);
    $this -> db -> delete('tvcat_copy');
    
    
}
    

  public function did_delete_row($autor_id){
   
       
    
    $this -> db -> where('autor_id', $autor_id);
    $this -> db -> delete('absence_log');
      
    
}

 public function did_delete_firmcal($id){
    $this -> db -> where('id', $id);
    $this -> db -> delete('calendar');
    
    
}

   public function did_delete_news($nasid){
    $this -> db -> where('nasid', $nasid);
    $this -> db -> delete('nastenka');
}

  public function did_delete_pracoviste($id){
    $this -> db -> where('id', $id);
    $this -> db -> delete('dbpracoviste_copy');
}

   public function did_delete_oddeleni($id){
    $this -> db -> where('id', $id);
    $this -> db -> delete('dboddeleni_copy');
}

  public function did_delete_pozice($id){
    $this -> db -> where('id', $id);
    $this -> db -> delete('dbpozice_copy');
}
    public function did_delete_nadrizeny($id){
    $this -> db -> where('id', $id);
    $this -> db -> delete('dbnadrizeny');
}
  
   public function abs_email_nastaven($answid){
   $today = date("Y-m-d H:i:s");    
                  $ttst = array(                 
                 'abs_stav' => 1,
                 'abs_email' => $today,
                                  );
                  $this->db->where('answid', $answid);

                  $this->db->update('absence_answer', $ttst);
                  }

  public function did_untop_news($nasid){
                  $ttst = array(                 
                 'top' => 0,
                                  );
                  $this->db->where('nasid', $nasid);

                  $this->db->update('nastenka', $ttst);
                  }

  public function did_top_news($nasid){
                  $ttst = array(                 
                 'top' => 1,
                                  );
                  $this->db->where('nasid', $nasid);

                  $this->db->update('nastenka', $ttst);
                  }


  public function did_update_news($nasid){
                  $ttst = array(                 
                 'archiv' => "ano",
                                  );
                  $this->db->where('nasid', $nasid);

                  $this->db->update('nastenka', $ttst);
                  }
                  
  public function did_reupdate_news($nasid){
                  $ttst = array(                 
                 'archiv' => "ne",
                                  );
                  $this->db->where('nasid', $nasid);

                  $this->db->update('nastenka', $ttst);
                  }
                  
  public function del_news($nasid){
     
    $this->db->where('nasid', $nasid);
    $this -> db -> delete('nastenka');
    
    $cas = date("Y-m-d H:i:s"); 
    $ttst = array(                 
                'autor_oc' => $this->session->userdata('oc'),
                'datum' => $cas,
                'id' => $nasid,
                'pozn' => "Smazani zprávy - " . $nasid );
    $this->db->insert('intralog', $ttst); 
    
    
}

 public function did_delete_vab0($rezerv_id){
    $this -> db -> where('rezerv_id', $rezerv_id);
    $this -> db -> delete('vab0_rezervace');
}

   function gethome_top(){              
        $this->db->select('text,predmet,datum,podpis');
        $this->db->where('top', 1); 
        $this->db->order_by('cas', 'desc'); 
        $top = $this->db->get('nastenka')->result(); 
         return $top;
  }


  public function did_delete_vab0all($user_id){
    $this -> db -> where('user_id', $user_id);
    $this -> db -> delete('vab0_user');
    $this->db->where('rezv_user_id', $user_id);
    $vab0_rezervace = $this->db->get('vab0_rezervace')->result();
    foreach ($vab0_rezervace as $zas) {
    
    $this -> db -> where('rezerv_id', $zas->rezerv_id);
    $this -> db -> delete('vab0_rezervace');
    
   } 
}

   public function did_delete_vab1all($user_id){
    $this -> db -> where('user_id', $user_id);
    $this -> db -> delete('vab1_user');
    $this->db->where('rezv_user_id', $user_id);
    $vab1_rezervace = $this->db->get('vab1_rezervace')->result();
    foreach ($vab1_rezervace as $zas) {
    
    $this -> db -> where('rezerv_id', $zas->rezerv_id);
    $this -> db -> delete('vab1_rezervace');
    
   } 
}

 public function did_delete_vab3all($user_id){
    $this -> db -> where('user_id', $user_id);
    $this -> db -> delete('vab3_user');
    $this->db->where('rezv_user_id', $user_id);
    $vab3_rezervace = $this->db->get('vab3_rezervace')->result();
    foreach ($vab3_rezervace as $zas) {
    
    $this -> db -> where('rezerv_id', $zas->rezerv_id);
    $this -> db -> delete('vab3_rezervace');
    
   } 
}

   public function did_delete_mab1all($user_id){
    $this -> db -> where('user_id', $user_id);
    $this -> db -> delete('mab1_user');
    $this->db->where('rezv_user_id', $user_id);
    $mab1_rezervace = $this->db->get('mab1_rezervace')->result();
    foreach ($mab1_rezervace as $zas) {
    
    $this -> db -> where('rezerv_id', $zas->rezerv_id);
    $this -> db -> delete('mab1_rezervace');
    
   } 
}

  function getHomeAbsence(){
        $today = date("Y-m-d H:i:s"); 
        $this->db->where('aktiv',1);     
        $this->db->where('from <=',$today); 
        $this->db->where('to >=',$today); 
        $this->db->order_by('user_prijmeni, user_jmeno', 'asc');
        $absence_log = $this->db->get('absence_log')->result();
        return $absence_log;
  }
  
  
  function getPocet_absence(){
        $today = date("Y-m-d"); 
        $time = date("H:i:s"); 
        $this->db->where('from',$today); 
        $this->db->where('fromtime <',$time); 
        $this->db->where('totime >',$time); 
        $day_news = $this->db->get('absence_log')->result(); 
        $pocet_abs = $this->db->affected_rows($day_news);
        return $pocet_abs;
  }

   function getHotline(){
        $this->db->where('id_num <>',0); 
        $this->db->order_by('popis', 'asc');
        $hotline = $this->db->get('hotline')->result();
        return $hotline;
  }
  
  function getLoglogin($oc){
        $this->db->where('log_oc',$oc);  
        $this->db->order_by('log_datum', 'desc');
        $logons = $this->db->get('intranet_login')->result();
        return $logons;
  }

  function getNastenka(){
      //  $this->db->where('nasid <>',0); 
        $this->db->where('archiv <>',"ano");  
        $this->db->where('top <>',1);     
        $this->db->order_by('cas', 'desc');
        $this->db->join('nastenka_files', 'nastenka_files.nasid = nastenka.nasid', 'left'); 
        $nastenka = $this->db->get('nastenka',6)->result();
        return $nastenka;
  }
  
  function getLog_Nastenka(){
      //  $this->db->where('nasid <>',0); 
        $this->db->where('archiv <>',"ano");  
    //    $this->db->where('top <>',1);     
        $this->db->order_by('cas', 'desc');
        $this->db->join('nastenka_files', 'nastenka_files.nasid = nastenka.nasid', 'left'); 
        $nastenka = $this->db->get('nastenka',1)->result();
        return $nastenka;
  }
  
   function getNastArchiv(){
        $this->db->where('nasid <>',0); 
        $this->db->where('archiv <>',"ne");       
        $this->db->order_by('datum', 'desc');
        $nast_archiv = $this->db->get('nastenka',50)->result();
        return $nast_archiv;
  }
  
  function getPocet_zprav(){
        $this->db->select('nasid');
        $this->db->where('nasid <>',0); 
        $day_news = $this->db->get('nastenka')->result(); 
        $pocet_zprav = $this->db->affected_rows($day_news);
        return $pocet_zprav;
  }
  
  
   function getSmernicefull(){      
        $this->db->select('datum,nazev,type,priznak,soubor,autor,poid'); 
    //    $this->db->where('priznak', "N"); 
        
        $this->db->order_by('priznak', 'desc');
        $this->db->order_by('datum', 'desc');
        $narizeni_intranet = $this->db->get('pokyny_intranet')->result(); 
        return $narizeni_intranet;
  }
  
  function getNarizeni(){      
        $this->db->select('datum,nazev,type,priznak,soubor'); 
        $this->db->where('priznak', "N"); 
        $this->db->order_by('poid', 'desc');
        $narizeni_intranet = $this->db->get('pokyny_intranet')->result(); 
        return $narizeni_intranet;
  }
  
  function getPokyny(){      
        $this->db->select('datum,nazev,type,priznak,soubor'); 
        $this->db->where('priznak', "P"); 
        $this->db->order_by('poid', 'desc');
        $pokyny_intranet = $this->db->get('pokyny_intranet')->result(); 
        return $pokyny_intranet;
  }
  
  function getSmernice(){      
        $this->db->select('datum,nazev,type,priznak,soubor,autor'); 
       // $this->db->where('priznak', "S"); 
        $this->db->order_by('poid', 'desc');
        $pokyny_intranet = $this->db->get('pokyny_intranet')->result(); 
        return $pokyny_intranet;
  }
  
  function getCas_zpracovano(){
  
       $dat = StrFTime("%H", Time());
       $min = StrFTime("%M", Time());
       $dat0 = LTrim($dat,"0");
       $min0 = LTrim($min,"0");
       if ($min0 <= 14 ) {
            $minut = "00" ;
                    } 
       elseif ($min0 <= 29 and  $min0 >= 15) {
            $minut = "15" ;
                    } 
       elseif ($min0 <= 44 and  $min0 >= 30) {
            $minut = "30" ;
                    } 
       elseif ($min0 <= 59 and  $min0 >= 45) {
            $minut = "45" ;
                    }         
       $cas_zprac =  "do" . " " . $dat0 . ":" . $minut ;
       return $cas_zprac;
       }
  
   function getdnes_Zprac(){  
       $soubor = fopen("./ftp/STATISX.TXT", "r");
       $prvni=fgets($soubor); //prvni radek
       fclose($soubor);
       $dat = StrFTime("%H", Time());
       $min = StrFTime("%M", Time());
       $dat0 = LTrim($dat,"0");
       $min0 = LTrim($min,"0");
       if ($min0 <= 14 ) {
            $minut = "00" ;
                    } 
       elseif ($min0 <= 29 and  $min0 >= 15) {
            $minut = "15" ;
                    } 
       elseif ($min0 <= 44 and  $min0 >= 30) {
            $minut = "30" ;
                    } 
       elseif ($min0 <= 59 and  $min0 >= 45) {
            $minut = "45" ;
                    }         
       $cas_zprac =  "do" . " " . $dat0 . ":" . $minut ;
       $dat0 = LTrim($dat,"0");
       $bal = SubStr ($prvni, 20, 7);
       $obj = SubStr ($prvni, 10, 10);
       if ($dat0 <= 6 ) {
       $bal1 = 0 ;
       $obj1 = 0 ;
       } 
       else {
       $bal1= LTrim($bal,"0");
       $obj1 = LTrim($obj,"0");
       }
       
        $zprac = array ();
        $zprac['bal'] = $bal1;
        $zprac['obj'] = $obj1;
        $zprac['cas_zprac'] = $cas_zprac;
       
       return $zprac;
       }
    
    
     function getAtlas_products(){ 
        $this->db->select('name,stav,description,price,catalog,kat_c,katalog,priorita,html_color,color,html_text,atlas_products.id');
        $this->db->where('stav <>',0); 
        $this->db->from('atlas_products');
        $this->db->join('atlas_katalog', 'atlas_products.catalog = atlas_katalog.kat_id');  
        $this->db->join('atlas_barvy', 'atlas_products.catalog = atlas_barvy.id');  
        $this->db->order_by('priorita', 'desc');       
        $atlas_copy = $this->db->get();
        return $atlas_copy;
        }    
       
    function getMaily(){ 
        $this->db->select('mail');
        $this->db->where('mail <>',""); 
        $this->db->where('mail IS NOT NULL');
        $this->db->order_by('mail', 'acs'); 
        $zamestnanci = $this->db->get('zamestnanci')->result();  
        return $zamestnanci;
        } 
        
    function getMobily(){ 
        $this->db->select('mobil');
    //    $this->db->where('oc <',21); 
        $this->db->where('mobil >',0); 
        $this->db->order_by('mobil', 'acs'); 
        $zamestnanci = $this->db->get('zamestnanci')->result();  
        return $zamestnanci;
        }      
  
   
   function getNepritomen(){ 
        $datum = Date("Y-m-d", Time());
        $this->db->select('oc, prijmeni, pritomod, pritomdo, pritomnost, jmeno');
        $this->db->where('pritomod <=',$datum); 
        $this->db->where('pritomdo >=',$datum); 
        $this->db->order_by('prijmeni', 'acs'); 
        $zamestnanci = $this->db->get('zamestnanci')->result();  
        return $zamestnanci;
        }
  
   function getTVnewsletters(){ 
        $today = $this->Main_model->getToday(); 
        $this->db->select('*');
            $this->db->where('typ',"N");
            $this->db->where('od <=',$today); 
            $this->db->where('do >=',$today); 
            $this->db->order_by('id', 'acs');
            $newsletter = $this->db->get('tvcat_copy')->result();
        return $newsletter;
        }
  
   function getTVcatalogs(){ 
        $today = $this->Main_model->getToday(); 
        $this->db->select('*');
            $this->db->where('od <=',$today); 
            $this->db->where('do >=',$today); 
            $this->db->where('typ',"C");
            $this->db->order_by('id', 'desc');
            $catal = $this->db->get('tvcat_copy',)->result();
        return $catal;
        }
        
    function getTVpromos(){ 
        $today = $this->Main_model->getToday(); 
         $this->db->select('*');
            $this->db->where('od <=',$today); 
            $this->db->where('do >=',$today); 
            $this->db->where('typ',"P");
            $this->db->order_by('id', 'desc');
            $promo = $this->db->get('tvcat_copy')->result();
        return $promo;
        }   
        
     function getTVcatalogs2(){ 
        $today = $this->Main_model->getToday(); 
        $this->db->select('*');
         //   $this->db->limit(2);
         //   $this->db->where('od <=',$today); 
            $this->db->where('typ',"C");
            $this->db->order_by('od', 'acs');
            $catal = $this->db->get('tvcat_copy',)->result();
        return $catal;
        }
        
    function getTVpromos2(){ 
        $today = $this->Main_model->getToday(); 
         $this->db->select('*');
         //   $this->db->limit(2);
         //   $this->db->where('od <=',$today); 
            $this->db->where('typ',"P");
            $this->db->order_by('od', 'acs');
            $promo = $this->db->get('tvcat_copy')->result();
        return $promo;
        }        
         
  
    function getZased1(){ 
        $today = $this->Main_model->getToday(); 
        $this->db->where('zasdat',$today); 
        $this->db->order_by('zastmo', 'acs');
        $repzas = $this->db->get('repzas')->result();
        return $repzas;
        }
        
     function getMenuFamily(){ 
        $this->db->select('fam_id, fam_oblast');
        $this->db->order_by('fam_id', 'acs');
        $menu_family = $this->db->get('fam_oblast')->result();
        return $menu_family;
        }    
        
    function getMenuWWW(){ 
        $this->db->select('id, popis, odkaz');
        $this->db->order_by('popis', 'desc');
        $menu_www = $this->db->get('www')->result();
        return $menu_www;
        }
        
    function getFullakce(){  
        $this->db->select('nazev_akce,datum_akce,nazev_adresare,pocet_fotek,id'); 
      //  $this->db->limit(12);
        $this->db->order_by('datum_akce', 'desc');
        $fullakce = $this->db->get('akce')->result();   
    return $fullakce;
  }
        
      function getHomeakce(){  
        $this->db->select('nazev_akce,datum_akce,nazev_adresare,id'); 
        $this->db->limit(4);
        $this->db->order_by('datum_akce', 'desc');
        $homeakce = $this->db->get('akce')->result();   
    return $homeakce;
  }
        
    function getMenuobrazky(){ 
        $this->db->select('id, nazev_akce,datum_akce');
        $this->db->order_by('datum_akce', 'desc');
        $menu_akce = $this->db->get('akce',12)->result();
        return $menu_akce;
        }
        
     function getAktccsupervizor(){ 
        $this->db->where('oddeleni',2); 
        $repzas3 = $this->db->get('repzas3')->result();
        return $repzas3;
        }    
        
        
    function getZased3(){ 
        $today = $this->Main_model->getToday();     
        $this->db->where('zasdat',$today); 
        $this->db->order_by('zastmo', 'acs');
        $repzas3 = $this->db->get('repzas3')->result();
        return $repzas3;
        }
  
    function getFamily(){ 
        $this->db->select('nazev, datum, cislo, oblast');
        $this->db->order_by('cislo', 'desc');
        $incident = $this->db->get('incident',20)->result();
        return $incident;
        }
        
   function getFamilyall(){ 
        $this->db->select('nazev, datum, cislo, oblast, cislo, termin, zmena, fam_id, fam_oblast');
        $this->db->order_by('cislo', 'desc');
        $this->db->join('fam_oblast', 'fam_oblast.fam_id = incident.oblast');  
        $incident = $this->db->get('incident')->result();
        return $incident;
        }
        
  function getFamOblast($oblast = Null){ 
        $this->db->select('nazev, datum, cislo, oblast, cislo, termin, zmena, fam_id, fam_oblast');
        $this->db->where('oblast',$oblast); 
        $this->db->order_by('cislo', 'desc');
        $this->db->join('fam_oblast', 'fam_oblast.fam_id = incident.oblast');  
        $incident = $this->db->get('incident')->result();
        return $incident;
        }
        
    function getAtlasdetail($catalog = Null){ 
        $this->db->select('name,stav,description,price,catalog,kat_c,katalog,priorita,html_color,color,html_text,atlas_products.id');
        $this->db->where('catalog',$catalog); 
        $this->db->where('stav >',0); 
        $this->db->order_by('catalog', 'desc');
        $this->db->join('atlas_katalog', 'atlas_katalog.kat_id = atlas_products.catalog');  
        $this->db->join('atlas_barvy', 'atlas_products.catalog = atlas_barvy.id'); 
        $detail = $this->db->get('atlas_products')->result();
        return $detail;
        }
        
   function getHlasenidetail($hl_id = Null){ 
        $this->db->select('soubor, datum, rok, mesic, adresar, nazev');
        $this->db->where('hl_id',$hl_id); 
        $this->db->order_by('datum', 'desc');
        $this->db->join('hlaseni', 'hlaseni_files.hl_id = hlaseni.hl_i');  
        $detail = $this->db->get('hlaseni_files')->result();
        return $detail;
        }  
        
   function getHlaseniprehled(){ 
        $this->db->select('nazev, popis, adresar, hl_i');
        $this->db->order_by('hl_i', 'asc');
     //   $this->db->join('hlaseni', 'hlaseni_files.hl_id = hlaseni.hl_id');  
        $prehled = $this->db->get('hlaseni')->result();
        return $prehled;
        }     
        
   function getHlasenihome(){ 
        $today = $this->Main_model->getToday();
        $this->db->select('soubor, datum, nazev, popis, adresar');
        $this->db->where('datum',$today); 
        $this->db->join('hlaseni', 'hlaseni_files.hl_id = hlaseni.hl_i');  
        $hlaseni_file = $this->db->get('hlaseni_files')->result();
        return $hlaseni_file;
        }
  
   function getNeprit(){  
        $this->db->select('*'); 
        $this->db->where('id >',0); 
        $this->db->order_by('nepritomnost', 'asc');
        $db = $this->db->get('dbnepritomnost')->result();   
        return $db;
        }
  
  function getHlaseni(){  
        $this->db->select('hl_i, adresar, nazev'); 
     //   $this->db->where('hl_id ',23); 
        $this->db->order_by('hl_i', 'asc');
        $hlaseni = $this->db->get('hlaseni')->result();   
        return $hlaseni;
        }
        
   function getDBnadrizenyID(){  
        $this->db->select('*'); 
        $this->db->where('id >',0); 
        $this->db->order_by('id', 'asc');
        $dbnadrizeny = $this->db->get('dbnadrizeny')->result();   
        return $dbnadrizeny;
        } 
        
   function getDBnadrizeny(){  
        $this->db->select('*'); 
        $this->db->order_by('nadrizeny', 'asc');
        $dbnadrizeny = $this->db->get('dbnadrizeny')->result();   
        return $dbnadrizeny;
        } 
        
    function getDBpracovisteID(){  
        $this->db->select('*'); 
        $this->db->where('id >',0); 
        $this->db->order_by('id', 'asc');
        $dbpracoviste = $this->db->get('dbpracoviste_copy')->result();   
        return $dbpracoviste;
        }            
        
  function getDBoddeleniID(){  
        $this->db->select('*'); 
        $this->db->where('id >',0); 
        $this->db->order_by('id', 'asc');
        $dboddeleni = $this->db->get('dboddeleni_copy')->result();   
        return $dboddeleni;
        }                  
        
  function getDBpoziceID(){  
        $this->db->select('*'); 
        $this->db->where('id >',0); 
        $this->db->order_by('id', 'asc');
        $dbpozice = $this->db->get('dbpozice_copy')->result();   
        return $dbpozice;
        }           
        
  function getDBpozice(){  
        $this->db->select('*'); 
        $this->db->order_by('pozice_name', 'asc');
        $dbpozice = $this->db->get('dbpozice_copy')->result();   
        return $dbpozice;
        }
        
    function getDBpojistovny(){  
        $this->db->select('*'); 
        $this->db->order_by('pojistovna', 'asc');
        $pojistovny = $this->db->get('pojistovny')->result();   
        return $pojistovny;
        }     
        
   function getDBoddeleni(){  
        $this->db->select('*'); 
        $this->db->order_by('oddeleni_name', 'asc');
        $dboddeleni = $this->db->get('dboddeleni_copy')->result();   
        return $dboddeleni;
        }
        
   function getDBpracoviste(){  
        $this->db->select('*'); 
        $this->db->order_by('pracoviste_name', 'asc');
        $dbpracoviste = $this->db->get('dbpracoviste_copy')->result();   
        return $dbpracoviste;
        }
  
   function getSlider(){  
        $this->db->select('*'); 
        $this->db->where('aktivni', 2); 
        $this->db->order_by('vytvoreno', 'desc');
        $slider = $this->db->get('galerie')->result();   
        return $slider;
        }
     
     
      function getTVgalerie($oc = Null){   
      //  $today = date("Y-m-d");        
        $this->db->select('*');
      //  $this->db->where('to >=',$today); 
     //   $this->db->where('status',$oc); 
        $this->db->order_by('news', 'asc'); 
        $this->db->from('tv_galerie');
      //  $this->db->join('dbnepritomnost', 'dbnepritomnost.id = absence_log.duvod');  
        $galerie = $this->db->get()->result();  
               
    return $galerie;
  }         
        
     function getOsfirmkalendar($oc = Null){   
      //  $today = date("Y-m-d");        
        $this->db->select('*');
      //  $this->db->where('to >=',$today); 
        $this->db->where('status',$oc); 
        $this->db->order_by('id', 'desc'); 
        $this->db->from('calendar');
      //  $this->db->join('dbnepritomnost', 'dbnepritomnost.id = absence_log.duvod');  
        $kalendar = $this->db->get()->result();  
               
    return $kalendar;
  }      
        
    function getOszastup($oc = Null){   
        $today = date("Y-m-d");        
        $this->db->select('*');
        $this->db->where('to >=',$today); 
        $this->db->where('zastup_oc',$oc); 
        $this->db->order_by('from', 'asc'); 
        $this->db->from('absence_log');
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = absence_log.duvod');  
        $absence_log = $this->db->get()->result();  
               
    return $absence_log;
  }  
             
    function getPocetzprav($oc = Null){   
        $this->db->select('nasid');
        $this->db->where('archiv',"ne"); 
        $this->db->where('oc',$oc); 
        $this->db->from('nastenka');
        $nastenka = $this->db->get()->result();  
        $pocet_zprav = $this->db->affected_rows($nastenka);
        
    return $pocet_zprav;
  }    
  
   function getPocrezvab0($oc = Null){ 
        $today = date("Y-m-d");   
        $this->db->select('user_id,rezerv_date');
        $this->db->where('rezerv_date >=',$today); 
        $this->db->where('oc',$oc); 
        $this->db->from('vab0_user');
        $this->db->join('vab0_rezervace', 'vab0_rezervace.rezv_user_id = vab0_user.user_id'); 
        $this->db->group_by('rezv_user_id'); 
        $nastenka = $this->db->get()->result();   
        $pocet_rezerv0 = $this->db->affected_rows($nastenka);
        
        $this->db->select('user_id,rezerv_date');
        $this->db->where('rezerv_date >=',$today); 
        $this->db->where('oc',$oc); 
        $this->db->from('vab1_user');
        $this->db->join('vab1_rezervace', 'vab1_rezervace.rezv_user_id = vab1_user.user_id'); 
        $this->db->group_by('rezv_user_id'); 
        $nastenka = $this->db->get()->result();   
        $pocet_rezerv1 = $this->db->affected_rows($nastenka);
        
        $this->db->select('user_id,rezerv_date');
        $this->db->where('rezerv_date >=',$today); 
        $this->db->where('oc',$oc); 
        $this->db->from('vab3_user');
        $this->db->join('vab3_rezervace', 'vab3_rezervace.rezv_user_id = vab3_user.user_id'); 
        $this->db->group_by('rezv_user_id'); 
        $nastenka = $this->db->get()->result();   
        $pocet_rezerv3 = $this->db->affected_rows($nastenka);
        
        $this->db->select('user_id,rezerv_date');
        $this->db->where('rezerv_date >=',$today); 
        $this->db->where('oc',$oc); 
        $this->db->from('mab1_user');
        $this->db->join('mab1_rezervace', 'mab1_rezervace.rezv_user_id = mab1_user.user_id'); 
        $this->db->group_by('rezv_user_id'); 
        $nastenka = $this->db->get()->result();   
        $pocet_rezerv4 = $this->db->affected_rows($nastenka);
        
        $pocet_rezerv = $pocet_rezerv0 + $pocet_rezerv1 + $pocet_rezerv3 + $pocet_rezerv4 ;
        
    return $pocet_rezerv;
  }   
  
  
      function getPocetNepritomnost($oc = Null){   
        $today = date("Y-m-d");        
        $this->db->select('autor_id');
        $this->db->where('to >=',$today); 
        $this->db->where('user_oc',$oc); 
        $this->db->where('aktiv',1);  
        $this->db->from('absence_log');
        $absence_log = $this->db->get()->result();  
        $pocet_neprit = $this->db->affected_rows($absence_log);
        
    return $pocet_neprit;
  }    
  
  
    function getPocetzastup($oc = Null){   
        $today = date("Y-m-d");        
        $this->db->select('autor_id');
        $this->db->where('to >=',$today); 
        $this->db->where('zastup_oc',$oc);  
        $this->db->where('aktiv',1); 
        $this->db->from('absence_log');
        $absence_log = $this->db->get()->result();  
        $pocet_zastup = $this->db->affected_rows($absence_log);
        
    return $pocet_zastup;
  }    
   
   
    function getAbsencebohu(){   
        $today = date("Y-m-d");        
        $this->db->select('*');
        $this->db->where('to >=',$today); 
     //   $this->db->where('user_oc',$oc); 
        $this->db->order_by('autor_id', 'desc'); 
        $this->db->from('absence_log');
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = absence_log.duvod');  
        $this->db->join('absence_answer', 'absence_answer.abs_id = absence_log.autor_id' , 'left');  
        $absence_log = $this->db->get()->result();  
        
    return $absence_log;
  }
   
    function getAbsencefull(){   
        $today = date("Y-m-d");        
        $this->db->select('*');
        $this->db->where('to >=',$today); 
        $this->db->where('aktiv',1);  
        $this->db->order_by('from', 'asc'); 
        $this->db->from('absence_log');
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = absence_log.duvod');  
        $absence_log = $this->db->get()->result();  
        
    return $absence_log;
  }
   
    function getAbsence($oc = Null){   
        $today = date("Y-m-d");        
        $this->db->select('*');
        $this->db->where('to >=',$today); 
        $this->db->where('user_oc',$oc); 
        $this->db->where('aktiv',1); 
        $this->db->order_by('from', 'asc'); 
        $this->db->from('absence_log');
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = absence_log.duvod');  
        $this->db->join('absence_answer', 'absence_answer.abs_id = absence_log.autor_id' , 'left');  
        $absence_log = $this->db->get()->result();  
        
    return $absence_log;
  }
   
   
    function getOSnastenka($oc = Null){          
        $this->db->select('*');
        $this->db->where('oc',$oc); 
        $this->db->where('archiv',"ne"); 
        $this->db->order_by('nasid', 'desc'); 
        $this->db->from('nastenka');
        $nastenka = $this->db->get()->result();  
        
    return $nastenka;
  }    
    
    function getNastenkavse(){          
        $this->db->select('*');
      //  $this->db->where('oc',$oc); 
     //   $this->db->where('archiv',"ne"); 
        $this->db->order_by('nasid', 'desc'); 
        $this->db->from('nastenka');
        $nastenka = $this->db->get()->result();  
        
    return $nastenka;
  } 
  
   function getIntrapozice($id = Null){      
        $this->db->select('oc,jmeno,prijmeni,oddeleni_name,pozice_name,pozice,oddeleni,nadrizeny,telefon,mail,opravneni,mobil,absence,icon,nepritomnost,typ');
      //  $this->db->where('typ',1); 
        $this->db->where('pozice',$id); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left");   
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left");
        $query = $this->db->get()->result();  
       
    return $query;
  }  
  
  function getGRpozice($id = Null){      
        $this->db->select('oc,jmeno,prijmeni,oddeleni_name,pozice_name,pozice,oddeleni,nadrizeny,telefon,mail,opravneni,mobil,absence,icon,nepritomnost');
        $this->db->where('typ',1); 
        $this->db->where('pozice',$id); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left");   
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left");
        $query = $this->db->get()->result();  
       
    return $query;
  } 
  
   function getTymabsencefull(){      
        $this->db->select('oc,prijmeni,mail,jmeno');
        $this->db->where('opravneni >',0); 
     //   $this->db->where('oddeleni',$parameters['oddeleni']); 
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
  function getTymabsence($parameters = Null){      
        $this->db->select('oc,prijmeni,mail,jmeno');
        $this->db->where('oc <>',$parameters['oc']); 
        $this->db->where('oddeleni',$parameters['oddeleni']); 
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
   function getTymZmena($data2 = Null){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('oc <>',$data2['oc_resi']); 
        $this->db->where('oc <>',$data2['oc_zadal']); 
        $this->db->where('oddeleni',$data2['oddeleni_resi']); 
        $this->db->where('opravneni >',0); 
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();  
       
    return $query;
  }   
  
    function getTymZakaznicke($data2 = Null){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('oc <>',$data2['oc_resi']); 
        $this->db->where('oc <>',$data2['oc_zadal']); 
     //   $this->db->where('oddeleni',$data2['oddeleni_resi']); 
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();  
       
    return $query;
  } 
  
    function getTymSupervizor($data2 = Null){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('oddeleni <>',$data2['oddeleni_resi']); 
     //   $this->db->where('oddeleni',$data2['oddeleni_resi']); 
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('ticket_supervizor');
        $query = $this->db->get()->result();  
       
    return $query;
  }  
  
  
   function getTymbezprihlaseneho($id = Null){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('typ',1);
        $this->db->where('oddeleni',$id); 
        $this->db->where('oc <>',$this->session->userdata('oc')); 
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();  
       
    return $query;
  } 
  
  
   function getPracoviste_intra($id = Null){      
        $this->db->select('oc,jmeno,prijmeni,oddeleni_name,pozice_name,pozice,oddeleni,telefon,mail,nepritomnost,mobil,icon,typ');
     //  $this->db->where('typ',1);
        $this->db->where('pracoviste',$id); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left");   
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left");   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }  
  
   function getNadrizeny_intra($id = Null){      
        $this->db->select('oc,jmeno,prijmeni,oddeleni_name,pozice_name,pozice,oddeleni,telefon,mail,nepritomnost,mobil,icon,typ');
     //  $this->db->where('typ',1);
        $this->db->where('nadrizeny',$id); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left");   
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left");   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }  
  
  
   function getTym_intra($id = Null){      
        $this->db->select('oc,jmeno,prijmeni,oddeleni_name,pozice_name,pozice,oddeleni,telefon,mail,nepritomnost,mobil,icon,typ');
     //  $this->db->where('typ',1);
        $this->db->where('oddeleni',$id); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left");   
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left");   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }  
  
  
  function getTym($id = Null){      
        $this->db->select('oc,jmeno,prijmeni,oddeleni_name,pozice_name,pozice,oddeleni,telefon,mail,nepritomnost,mobil,icon');
        $this->db->where('typ',1);
        $this->db->where('oddeleni',$id); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left");   
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left");   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
  
   function getTymTicket($zprac = Null){ 
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('typ',1);
        $this->db->where('oddeleni',$zprac['oddeleni']); 
        $this->db->where('oc <>',$zprac['zadavatel']); 
        $this->db->where('opravneni >', 0); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
  
   function getTymTicket2($zprac = Null){ 
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('typ',1);
        $this->db->where('oddeleni',$this->session->userdata('oddeleni')); 
        $this->db->where('oc',$this->session->userdata('oc')); 
        $this->db->where('oddeleni >', 0); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
  function getFullTym22(){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('opravneni >',0);
        $this->db->where('typ',1);
        $this->db->where('oc <>',$this->session->userdata('oc')); 
        $this->db->where('oddeleni >', 0); 
      //  $this->db->where('oddeleni <>', $this->session->userdata('oddeleni')); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
  
  function getFullTym2(){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('typ',1);
        $this->db->where('oc <>',$this->session->userdata('oc')); 
        $this->db->where('oddeleni >', 0); 
        $this->db->where('oddeleni <>', $this->session->userdata('oddeleni')); 
      //  $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();  
       
    return $query;
  } 
  
    function getJeSuperCovidadmins($oc = NULL){
 
        $this->db->select('rules'); 
        $where = "id=$oc";   
        $this->db->where($where);
        $query = $this->db->get('covid_admins'); 
        $zaznam = $query->first_row();
        
        if ($query->num_rows() > 0) {
        $rules =  $zaznam->rules;
        } else {
        $rules = Null;
        }
     
    return $rules;
  }
        
  
  
  function getTesty_vysledek($result = Null){ 
        
        $rule = $this->Main_model->getJeSuperCovidadmins($this->session->userdata('oc'));     
       
        $this->db->select('ic,zamest_oc,zamest_odd,teplota,test_result,ic_mobil,cas_testu,datum_testu,jmeno,prijmeni,typ,oddeleni_name,pojistovna_id,vysledek,ockovani,karant_od,karant_do,nazev');
        $this->db->where('test_result',$result); 
         if ($rule  < 2 ) {    
        $this->db->where('zamest_odd',$this->session->userdata('oddeleni')); 
         }
        $this->db->order_by('ic', 'desc');
        $this->db->from('covid');
        $this->db->join('covid_test', 'covid.test_result = covid_test.tst_id', "left"); 
        $this->db->join('covid_files', 'covid.ic = covid_files.tic_id', "left"); 
        $this->db->join('zamestnanci', 'covid.zamest_oc = zamestnanci.oc', "left");  
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
         //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
   function getTesty_oddeleni($odd = Null){  
        $rule = $this->Main_model->getJeSuperCovidadmins($this->session->userdata('oc'));         
        $this->db->select('ic,zamest_oc,zamest_odd,test_result,teplota,ic_mobil,cas_testu,datum_testu,jmeno,prijmeni,typ,oddeleni_name,pojistovna_id,vysledek,ockovani,karant_od,karant_do,nazev');
        if ($rule  < 2 ) {    
          
        $this->db->where('zamest_odd',$odd); 
        }
        $this->db->order_by('ic', 'desc');
        $this->db->from('covid');
        $this->db->join('covid_test', 'covid.test_result = covid_test.tst_id', "left");
        $this->db->join('covid_files', 'covid.ic = covid_files.tic_id', "left"); 
        $this->db->join('zamestnanci', 'covid.zamest_oc = zamestnanci.oc', "left");  
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
         //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
   function getTesty_detail($oc = Null){  
            
        $this->db->select('ic,zamest_oc,zamest_odd,teplota,test_result,ic_mobil,cas_testu,datum_testu,jmeno,prijmeni,typ,oddeleni_name,pojistovna_id,vysledek,ockovani,karant_od,karant_do,nazev');
        $this->db->where('zamest_oc',$oc); 
        $this->db->order_by('ic', 'desc');
        $this->db->from('covid');
        $this->db->join('covid_test', 'covid.test_result = covid_test.tst_id', "left"); 
        $this->db->join('covid_files', 'covid.ic = covid_files.tic_id', "left"); 
        $this->db->join('zamestnanci', 'covid.zamest_oc = zamestnanci.oc', "left");  
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
         //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
    function getTesty_brg($odd = Null){ 
        $rule = $this->Main_model->getJeSuperCovidadmins($this->session->userdata('oc'));          
        $this->db->select('ic,zamest_oc,zamest_odd,teplota,test_result,ic_mobil,cas_testu,datum_testu,jmeno,prijmeni,typ,oddeleni_name,pojistovna_id,vysledek,ockovani,karant_od,karant_do,nazev');
        if ($rule  < 2 ) {    
          
        $this->db->where('zamest_odd',$odd); 
        }
        $this->db->order_by('ic', 'desc');
        $this->db->from('covid');
        $this->db->join('covid_test', 'covid.test_result = covid_test.tst_id', "left"); 
        $this->db->join('covid_files', 'covid.ic = covid_files.tic_id', "left"); 
        $this->db->where('zamestnanci.typ',2); 
        $this->db->join('zamestnanci', 'covid.zamest_oc = zamestnanci.oc', "left");  
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
         //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
  
   function getTesty_ag($odd = Null){ 
        $rule = $this->Main_model->getJeSuperCovidadmins($this->session->userdata('oc'));      
        $this->db->select('ic,zamest_oc,zamest_odd,teplota,test_result,ic_mobil,cas_testu,datum_testu,jmeno,prijmeni,typ,oddeleni_name,pojistovna_id,vysledek,ockovani,karant_od,karant_do,nazev');
        if ($rule  < 2 ) {    
          
        $this->db->where('zamest_odd',$odd); 
        }
        $this->db->order_by('ic', 'desc');
        $this->db->from('covid');
        $this->db->join('covid_test', 'covid.test_result = covid_test.tst_id', "left"); 
        $this->db->join('covid_files', 'covid.ic = covid_files.tic_id', "left"); 
        $this->db->where('zamestnanci.typ',3); 
        $this->db->join('zamestnanci', 'covid.zamest_oc = zamestnanci.oc', "left");  
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
         //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
   function getTesty($odd = Null){   
        $rule = $this->Main_model->getJeSuperCovidadmins($this->session->userdata('oc'));          
        $this->db->select('ic,zamest_oc,zamest_odd,teplota,test_result,ic_mobil,cas_testu,datum_testu,jmeno,prijmeni,typ,oddeleni_name,pojistovna_id,vysledek,ockovani,karant_od,karant_do,nazev');
        
        if ($rule  < 2 ) {    
          
        $this->db->where('zamest_odd',$odd); 
        }
        $this->db->order_by('ic', 'desc');
        $this->db->from('covid');
        $this->db->join('covid_test', 'covid.test_result = covid_test.tst_id', "left"); 
        $this->db->join('covid_files', 'covid.ic = covid_files.tic_id', "left"); 
        $this->db->where('zamestnanci.typ',1); 
        $this->db->join('zamestnanci', 'covid.zamest_oc = zamestnanci.oc', "left");  
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");   
         //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
   function getUrazy(){      
        $this->db->select('*');
        $this->db->order_by('ib', 'desc');
        $this->db->from('bozp');
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = bozp.oddeleni_num');   
        $query = $this->db->get()->result();  
       
    return $query;
  }
  
   function getDBnepritomnost(){ 
   
          
        $this->db->select('*');
        $this->db->order_by('id', 'asc');
        $this->db->from('dbnepritomnost');
        $query = $this->db->get()->result();      
       
    return $query;
  } 
  
   function getAbsenceSeznam(){ 
   
          
        $this->db->select('oc');
        $this->db->from('zamestnanci');
        $query = $this->db->get()->result();      
       
    return $query;
  } 
  
  
    function getAgenturni(){ 
  //  $today = date("Y-m-d H:i:s"); 
          
        $this->db->select('*');
        $this->db->where('typ',3); 
    //    $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left"); 
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left"); 
     //   $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left"); 
     //   $this->db->join('absence_log', 'absence_log.user_oc = zamestnanci.oc', 'left outer');  
     //   $this->db->where('absence_log.from',7);  
     //   $this->db->where('absence_log.from <=',$today); 
     //   $this->db->where('absence_log.to >=',$today);    
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();      
       
    return $query;
  } 
  
   function getBrigadnici(){ 
  //  $today = date("Y-m-d H:i:s"); 
          
        $this->db->select('*');
        $this->db->where('typ',2); 
    //    $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left"); 
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left"); 
     //   $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left"); 
     //   $this->db->join('absence_log', 'absence_log.user_oc = zamestnanci.oc', 'left outer');  
     //   $this->db->where('absence_log.from',7);  
     //   $this->db->where('absence_log.from <=',$today); 
     //   $this->db->where('absence_log.to >=',$today);    
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();      
       
    return $query;
  } 
  
  function getSeznamadmin(){ 
    $today = date("Y-m-d H:i:s"); 
          
        $this->db->select('oc,jmeno,prijmeni,oddeleni_name,pozice_name,pozice,oddeleni,nadrizeny,telefon,mail,opravneni,mobil,absence,icon,nepritomnost');
        $this->db->where('typ',1);
        $this->db->where('opravneni <>',0); 
     //   $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left");  
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");  
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left"); 
     //   $this->db->join('absence_log', 'absence_log.user_oc = zamestnanci.oc', 'left outer');  
     //   $this->db->where('absence_log.from',7);  
     //   $this->db->where('absence_log.from <=',$today); 
     //   $this->db->where('absence_log.to >=',$today);    
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();      
       
    return $query;
  } 
  
  function getSeznam(){ 
    $today = date("Y-m-d H:i:s"); 
          
        $this->db->select('oc,jmeno,prijmeni,oddeleni_name,pozice_name,pozice,oddeleni,nadrizeny,telefon,mail,opravneni,mobil,absence,icon,nepritomnost');
        $this->db->where('typ',1);
        $this->db->where('opravneni <>',0); 
        $this->db->where("(telefon <>'0' OR 'mail is  NOT NULL' OR mobil <>'0')");
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice', "left");  
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni', "left");  
        $this->db->join('dbnepritomnost', 'dbnepritomnost.id = zamestnanci.absence', "left"); 
     //   $this->db->join('absence_log', 'absence_log.user_oc = zamestnanci.oc', 'left outer');  
     //   $this->db->where('absence_log.from',7);  
     //   $this->db->where('absence_log.from <=',$today); 
     //   $this->db->where('absence_log.to >=',$today);    
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $query = $this->db->get()->result();      
       
    return $query;
  } 
  
  function getSeznam_nastenka(){      
        $this->db->select('prijmeni,mail');
        $this->db->where('opravneni <>',0); 
        $this->db->where("mail <>", 0);
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        
        $query = $this->db->get()->result();  
       
    return $query;
  } 
  
   function getUrazy_full(){      
        $this->db->select('prijmeni,jmeno,oc');
     //   $this->db->where('opravneni <>',0); 
      //  $this->db->where("mail <>", 0);
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        
        $query = $this->db->get()->result();  
       
    return $query;
  } 
  
   function getSeznam_full(){      
        $this->db->select('prijmeni,jmeno,oc');
        $this->db->where('opravneni <>',0); 
      //  $this->db->where("mail <>", 0);
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');
        
        $query = $this->db->get()->result();  
       
    return $query;
  } 
  
  function getSvatek_den(){
 
 
        $svatek_den = Null;
        $today = date("Y-m-d"); 
        $den = Date("j", Time());
        $mesic = Date("n", Time());
        $this->db->select('*'); 
        $where = "den=$den AND mesic=$mesic";   
        $this->db->where($where);
        $svatek = $this->db->get('svatky'); 
        $denD = $svatek->first_row();
        
        if ($svatek->num_rows() > 0) {
        $svatek_den =  $denD->jmeno;
        } else {
        $svatek_den = Null;
        }

    return $svatek_den;
  }
  
  function getGaler_Akce($id = NULL){
 
        $this->db->select('*'); 
        $where = "id=$id";   
        $this->db->where($where);
        $akce = $this->db->get('akce'); 
        $popis = $akce->first_row();
        
        
        $row = array ();
        $row['pocet'] = $popis->pocet_fotek;
        $row['nazev_adr'] = $popis->nazev_adresare;
        $row['nazev']= $popis->nazev_akce;
        $row['datum_akce'] = SubStr ($popis->datum_akce, 8, 2) . "." . SubStr ($popis->datum_akce, 5, 2) . "." . SubStr ($popis->datum_akce, 0, 4)  ; 
        
     
    return $row;
  }
  
   function getNadrizenyedit(){
  
       
        $this->db->select('nadrizeny, pop_prijmeni, pop_jmeno , count(zamestnanci.nadrizeny) as total');
        $this->db->where('nadrizeny >', 0); 
        $this->db->group_by('nadrizeny'); 
        $this->db->order_by('nadrizeny', 'asc'); 
        $this->db->from('zamestnanci');
        $this->db->join('zamestnanci_popis', 'zamestnanci_popis.pop_oc = zamestnanci.nadrizeny'); 
        $query = $this->db->get()->result();  
        
        
         foreach ($query as $value) {
     
         $data = array(
                'pocet' => $value->total,
                  
                );
            $this->db->where('id', $value->nadrizeny); 
            $this->db->update('dbnadrizeny', $data); 
            
     
      }  
            
            
     return $query;
  }
  
    function getPracovistedit(){
  
       
        $this->db->select('pracoviste_name, pracoviste, count(zamestnanci.pracoviste) as total');
        $this->db->where('pracoviste >', 0); 
        $this->db->group_by('pracoviste'); 
        $this->db->order_by('pracoviste', 'asc'); 
        $this->db->from('zamestnanci');
        $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste'); 
        $query = $this->db->get()->result();   
        
        
          foreach ($query as $value) {
     
         $data = array(
                'pocet' => $value->total,
                  
                );
            $this->db->where('id', $value->pracoviste); 
            $this->db->update('dbpracoviste_copy', $data); 
            
     
      }  
            
            
     return $query;
  }
  
   function getPozicedit(){
  
       
        $this->db->select('pozice_name, pozice, count(zamestnanci.pozice) as total');
        $this->db->where('pozice >', 0); 
        $this->db->group_by('pozice'); 
        $this->db->order_by('pozice', 'asc'); 
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice'); 
        $query = $this->db->get()->result();   
        
        foreach ($query as $value) {
     
         $data = array(
                'pocet' => $value->total,
                  
                );
            $this->db->where('id', $value->pozice); 
            $this->db->update('dbpozice_copy', $data); 
            
     
      } 
    
            
            
     return $query;
  } 
  
   function getOddeleniedit(){
  
       
        $this->db->select('oddeleni_name, oddeleni, count(zamestnanci.oddeleni) as total');
        $this->db->where('oddeleni >', 0); 
        $this->db->group_by('oddeleni'); 
        $this->db->order_by('oddeleni', 'asc'); 
        $this->db->from('zamestnanci');
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni'); 
        $query = $this->db->get()->result();  
        
        
         foreach ($query as $value) {
     
         $data = array(
                'pocet' => $value->total,
                  
                );
            $this->db->where('id', $value->oddeleni); 
            $this->db->update('dboddeleni_copy', $data); 
            
     
      }  
            
            
     return $query;
  }
  
  function getObjBal_total(){
  
            $rok = Date("Y", Time());
         
            $this->db->select('rok,SUM(baliky) as total,SUM(objednavky) as total2');
            $this->db->where('rok', $rok); 
            $this->db->group_by('rok');
            $roky = $this->db->get('obj_bal');   
            $total = $roky->first_row();
            
            $row = array ();
            $row['baliky'] = $total->total;
            $row['objednavky'] = $total->total2;
            
            
     return $row;
  }
  
  
  
  
   function getFamDetail($cislo = NULL){
 
        $this->db->select('*'); 
        $where = "cislo=$cislo";   
        $this->db->where($where);
        $this->db->join('fam_oblast', 'fam_oblast.fam_id = incident.oblast');   
        $zamestnanci = $this->db->get('incident'); 
        $zamestnanec = $zamestnanci->first_row();
        
             
     
    return $zamestnanec;
  }
  
   function getDetailAgent($oc = NULL){
 
        $this->db->select('*'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $this->db->where('typ',3); 
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
        
             
     
    return $zamestnanec;
  }
  
  
   function getDetailBrig($oc = NULL){
 
        $this->db->select('*'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $this->db->where('typ',2); 
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
        
             
     
    return $zamestnanec;
  }
  
    function getDetail($oc = NULL){
 
        $this->db->select('*'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $this->db->where('typ',1); 
        $this->db->join('zamestnanci_popis', 'zamestnanci_popis.pop_oc = zamestnanci.oc', 'left') ;
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
        
             
     
    return $zamestnanec;
  }
  
  
    function getUrazDetail($ib = NULL){
 
        $this->db->select('*'); 
        $where = "ib=$ib";   
        $this->db->where($where);
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = bozp.oddeleni_num', 'left') ;
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = bozp.pozice_num', 'left') ;
        $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = bozp.pracoviste_num', 'left') ;
        $this->db->join('dbnadrizeny', 'dbnadrizeny.id = bozp.nadrizeny_num', 'left') ;
        $zamestnanci = $this->db->get('bozp'); 
        
        $zamestnanec = $zamestnanci->first_row();
        
             
     
    return $zamestnanec;
  }
  
  
   function getAbsenceRun($oc){
        $today = date("Y-m-d H:i:s"); 
        $this->db->select('duvod'); 
        $where = "user_oc=$oc";   
        $this->db->where($where);
        $this->db->where('from <=',$today); 
        $this->db->where('to >=',$today); 
        $absence_log = $this->db->get('absence_log');
        
        if ($absence_log->num_rows() > 0) {
        $zamestnanec = $absence_log->first_row();
        $duvod = $zamestnanec->duvod;
        } else {
        $duvod = 0;
        }
        
           
        return $duvod;
  }
  
   function getIntrac_prac($oc = NULL){
 
        $this->db->select('pracoviste_name'); 
        $where = "id=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('dbpracoviste_copy'); 
        $zamestnanec = $zamestnanci->first_row();
        $pracoviste = $zamestnanec->pracoviste_name;
               
             
     
    return $pracoviste;
  }
  
  function getZastup_mail($oc = NULL){
 
        $this->db->select('mail'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
        $zastup_mail = $zamestnanec->mail;
               
             
     
    return $zastup_mail;
  }
  
  
  function getPrijmJmenoZadav($oc = NULL){
 
        $this->db->select('jmeno,prijmeni,typ'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
        $prijmeni = $zamestnanec->prijmeni;
        if ($zamestnanec->typ > 1 ) {  $typ = "BRG - " ; }  
        else  {  $typ = Null; }  
        $jmeno = $zamestnanec->jmeno;
        $celek = $typ . $zamestnanec->prijmeni . " " .  mb_substr ($zamestnanec->jmeno, 0, 1) . ".";
       
        
     
     
    return $celek;
  }
  
  
  function getCCSPrijmeniJmeno($oc = NULL){
 
        $this->db->select('jmeno,prijmeni'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
        $prijmeni = $zamestnanec->prijmeni;
        $jmeno = $zamestnanec->jmeno;
        $prijmeni = $zamestnanec->prijmeni ;
        
        
        $row = array ();
        $row['jmeno'] = $jmeno;
        $row['prijmeni'] = $prijmeni;
            
               
             
     
    return $row;
  }
  
  function getPrijmeniJmeno($oc = NULL){
 
        $this->db->select('jmeno,prijmeni,oddeleni'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
        $prijmeni = $zamestnanec->prijmeni;
        $jmeno = $zamestnanec->jmeno;
        $celek = $zamestnanec->prijmeni .  " " .  mb_substr ($zamestnanec->jmeno, 0, 1) . "." ;
        $celek2 = $zamestnanec->oddeleni;
        
        $row = array ();
        $row['vedouci'] = $celek;
        $row['oddeleni'] = $celek2;
            
               
             
     
    return $row;
  }
  
  
  function getZastup_name($oc = NULL){
 
        $this->db->select('jmeno'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
        $zastup_jmeno = $zamestnanec->jmeno;
               
             
     
    return $zastup_jmeno;
  }
  
    function getZastup($oc = NULL){
 
        $this->db->select('prijmeni'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('zamestnanci'); 
        $zamestnanec = $zamestnanci->first_row();
        $zastup_text = $zamestnanec->prijmeni;
               
             
     
    return $zastup_text;
  }
  
  function getJePaletSupervizor($oc = NULL){
 
        $this->db->select('prijmeni'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('palet_supervizor'); 
        $pocet = $zamestnanci->num_rows();  
        
        if ($pocet > 0) {
        $vedouci = 1;
        } else {
        $vedouci = 0;
        }            
             
     
    return $vedouci;
  }
  
  
   function getPopisexist($oc = NULL){
 
        $this->db->select('pop_oc'); 
        $where = "pop_oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('zamestnanci_popis'); 
        $pocet = $zamestnanci->num_rows();  
        
        if ($pocet > 0) {
        $stav = 1;
        } else {
        $stav = 0;
        }            
             
     
    return $stav;
  }
  
  
    function getJevDB($oc = NULL){
 
        $this->db->select('prijmeni'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('zamestnanci'); 
        $pocet = $zamestnanci->num_rows();  
        
        if ($pocet > 0) {
        $stav = 1;
        } else {
        $stav = 0;
        }            
             
     
    return $stav;
  }
  
    function getJeTVadmin($oc = NULL){
 
        $this->db->select('prijmeni'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('tv_admins'); 
        $pocet = $zamestnanci->num_rows();  
        
        if ($pocet > 0) {
        $vedouci = 1;
        } else {
        $vedouci = 0;
        }            
             
     
    return $vedouci;
  }
  
  
  function getJeCCSsupervizor($oc = NULL){
 
        $this->db->select('prijmeni'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('ccs_supervizor'); 
        $pocet = $zamestnanci->num_rows();  
        
        if ($pocet > 0) {
        $vedouci = 1;
        } else {
        $vedouci = 0;
        }            
             
     
    return $vedouci;
  }
  
  
   function getVedouci($oc = NULL){
 
        $this->db->select('prijmeni'); 
        $where = "oc=$oc";   
        $this->db->where($where);
        $zamestnanci = $this->db->get('zamestnanci'); 
        $pocet = $zamestnanci->num_rows();  
        
        if ($pocet > 0) {
        $zamestnanec = $zamestnanci->first_row();
        $vedouci_text = $zamestnanec->prijmeni;
        } else {
        $vedouci_text = Null;
        }            
             
     
    return $vedouci_text;
  }
     function getJeVedouci($oc = NULL){
 
        $this->db->select('id'); 
        $where = "id=$oc";   
        $this->db->where($where);
        $query = $this->db->get('dbnadrizeny'); 
        $pocet = $query->num_rows();  
               
        if ($pocet > 0) {
        $jevedouci =  1;
        } else {
        $jevedouci = Null;
        }     
     
    return $jevedouci;
  }
  
     function getJeCovidadmins($oc = NULL){
 
        $this->db->select('id'); 
        $where = "id=$oc";   
        $this->db->where($where);
        $query = $this->db->get('covid_admins'); 
        $pocet = $query->num_rows();  
               
        if ($pocet > 0) {
        $jevedouci =  1;
        } else {
        $jevedouci = Null;
        }     
     
    return $jevedouci;
  }
  
   
  
  
  
      function getPracoviste($id = NULL){
 
        $this->db->select('pracoviste'); 
        $where = "id=$id";   
        $this->db->where($where);
        $dbpracoviste = $this->db->get('dbpracoviste');
        $pracoviste = $dbpracoviste->first_row();
        $pracoviste_text = $pracoviste->pracoviste;
               
             
     
    return $pracoviste_text;
  }
    
    
     function getHlaseni_rok($hl_id = NULL){
 
     
        
        $this->db->select('rok');
        $this->db->where('hl_id',$hl_id); 
        $this->db->order_by('rok', 'desc'); 
        $this->db->group_by('rok'); 
        $this->db->from('hlaseni_files');
     //   $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice');   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $hlaseni_year = $this->db->get()->result();  
       
       
    return $hlaseni_year;
  }
    
    function getHlaseni_mesic($hl_id = NULL){
 
     
        $this->db->select('month, mesic');
        $this->db->where('hl_id',$hl_id); 
        $this->db->order_by('mesic', 'asc'); 
        $this->db->group_by('mesic'); 
        $this->db->from('hlaseni_files');
        $this->db->join('mesice', 'mesice.id = hlaseni_files.mesic');   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $hlaseni_mesic = $this->db->get()->result();  
       
       
    return $hlaseni_mesic;
  }
    
     function getMenupozic(){
 
     
        
        $this->db->select('pozice_name,id,oddeleni,pozice');
        $this->db->where('pozice <>',0); 
        $this->db->order_by('pozice_name', 'asc'); 
        $this->db->group_by('pozice'); 
        $this->db->from('zamestnanci');
        $this->db->join('dbpozice_copy', 'dbpozice_copy.id = zamestnanci.pozice');   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $dbpozice = $this->db->get()->result();  
       
       
    return $dbpozice;
  }
  
  
   function getCovid_tym3($id = Null){      
        $this->db->select('oc,jmeno,prijmeni');
      //  $this->db->where('typ',2);
        $this->db->where('oddeleni',$id); 
     //   $this->db->where('oc <>',$this->session->userdata('oc')); 
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('agenturni');   
        $query = $this->db->get()->result();  
       
    return $query;
  }  
  
  
    function getCovid_tym2($id = Null){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('typ',2);
        $this->db->where('oddeleni',$id); 
     //   $this->db->where('oc <>',$this->session->userdata('oc')); 
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');   
        $query = $this->db->get()->result();  
       
    return $query;
  }  
  
  
    
      function getCovid_tym1($zprac = Null){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('typ', $zprac['typ']);
        $this->db->where('oddeleni', $zprac['oddeleni']); 
        $this->db->where('oddeleni >',0); 
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');   
        $query = $this->db->get()->result();  
       
    return $query;
  }  
  
  
   function getCovid_hromag($oddeleni = Null){      
      $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('typ',3);
        $this->db->where('oddeleni',$oddeleni);
        $this->db->where('pojistovna_id IS NOT NULL');
     
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');   
        $query = $this->db->get();  
       
    return $query;
  }    
  
    function getCovid_hrombrg($oddeleni = Null){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('typ',2);
        $this->db->where('oddeleni',$oddeleni);
        $this->db->where('pojistovna_id IS NOT NULL');
     
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');   
        $query = $this->db->get();  
       
    return $query;
  }    
    
    function getCovid_hromzam($oddeleni = Null){      
        $this->db->select('oc,jmeno,prijmeni');
        $this->db->where('typ',1);
        $this->db->where('oddeleni',$oddeleni);
        $this->db->where('pojistovna_id IS NOT NULL');
     
        $this->db->order_by('prijmeni', 'asc');
        $this->db->from('zamestnanci');   
        $query = $this->db->get();  
       
    return $query;
  }   
   
     
   
    function getMenuoddtyp($zprac = Null){
 
     
        
        $this->db->select('oddeleni_name,id,oddeleni');
        $this->db->where('oddeleni >',0); 
        $this->db->where('typ',$zprac['typ']);
        $this->db->where('oddeleni', $zprac['oddeleni']);
        $this->db->order_by('oddeleni_name', 'asc'); 
        $this->db->group_by('oddeleni'); 
        $this->db->from('zamestnanci');
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni');   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $dboddeleni = $this->db->get()->result();  
       
       
    return $dboddeleni;
  }
   
    
     function getMenuodd(){
 
     
        
        $this->db->select('oddeleni_name,id,oddeleni');
        $this->db->where('oddeleni >',0); 
        $this->db->where('typ',1);
        $this->db->order_by('oddeleni_name', 'asc'); 
        $this->db->group_by('oddeleni'); 
        $this->db->from('zamestnanci');
        $this->db->join('dboddeleni_copy', 'dboddeleni_copy.id = zamestnanci.oddeleni');   
     //   $this->db->join('dbpracoviste_copy', 'dbpracoviste_copy.id = zamestnanci.pracoviste');      
        $dboddeleni = $this->db->get()->result();  
       
       
    return $dboddeleni;
  }
    
    function getOoblast($oblast = NULL){
 
        $this->db->select('fam_oblast'); 
        $where = "fam_id=$oblast";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('fam_oblast');
        $oddeleni = $fam_oblast->first_row();
        $oblast_text = $oddeleni->fam_oblast;
               
             
     
    return $oblast_text;
  }
    
    function getHlaseniname($hl_id = NULL){
 
        $this->db->select('nazev,popis'); 
        $where = "hl_i=$hl_id";   
        $this->db->where($where);
        $fam_oblast = $this->db->get('hlaseni');
        $oddeleni = $fam_oblast->first_row();
        $hlaseni_text = $oddeleni->nazev . " " . $oddeleni->popis;
               
             
     
    return $hlaseni_text;
  }
  
    function getOddeleni($id = NULL){
 
        $this->db->select('oddeleni'); 
        $where = "id=$id";   
        $this->db->where($where);
        $dboddeleni = $this->db->get('dboddeleni');
        $oddeleni = $dboddeleni->first_row();
        $oddeleni_text = $oddeleni->oddeleni;
               
             
     
    return $oddeleni_text;
  }
  
  
   function getTimeod($time_id = NULL){
 
        $this->db->select('time_cas'); 
        $where = "time_id=$time_id";   
        $this->db->where($where);
        $dbpozice = $this->db->get('zasedacky_time');
        $pozice = $dbpozice->first_row();
        $time_od = $pozice->time_cas;
               
             
     
    return $time_od;
  }
  
    function getTimedo($time_id = NULL){
 
        $this->db->select('time_end'); 
        $where = "time_id=$time_id";   
        $this->db->where($where);
        $dbpozice = $this->db->get('zasedacky_time');
        $pozice = $dbpozice->first_row();
        $time_do = $pozice->time_end;
               
             
     
    return $time_do;
  }
  
  
  
   function getPozice($id = NULL){
 
        $this->db->select('pozice_name'); 
        $where = "id=$id";   
        $this->db->where($where);
        $dbpozice = $this->db->get('dbpozice_copy');
        $pozice = $dbpozice->first_row();
        $pozice_text = $pozice->pozice_name;
               
             
     
    return $pozice_text;
  }
  
   function getVAB1vypis($to2 = NULL){
 
       
        $this->db->select('zasedacky_time.time_cas,zasedacky_time.time_end, vab1_rezervace.rezerv_date,zasedacky_time.time_id, vab1_rezervace.rezv_user_id, vab1_user.prijmeni,vab1_user.user_id, vab1_user.oc, vab1_user.poznamka')
         ->from('zasedacky_time')
         ->order_by('time_id', 'asc')
         ->join('vab1_rezervace', 'zasedacky_time.time_id = vab1_rezervace.rezv_time_id ANd vab1_rezervace.rezerv_date = "' . $to2 . '"'  , 'left')
         ->join('vab1_user', 'vab1_rezervace.rezv_user_id = vab1_user.user_id' , 'left');
         $query2 = $this->db->get();
      
      
               
             
     
    return $query2;
  }
  
  
  function getMAB1vypis($to2 = NULL){
 
       
        $this->db->select('zasedacky_time.time_cas,zasedacky_time.time_end, mab1_rezervace.rezerv_date,zasedacky_time.time_id, mab1_rezervace.rezv_user_id, mab1_user.prijmeni,mab1_user.user_id,  mab1_user.oc,mab1_user.poznamka')
         ->from('zasedacky_time')
         ->order_by('time_id', 'asc')
         ->join('mab1_rezervace', 'zasedacky_time.time_id = mab1_rezervace.rezv_time_id ANd mab1_rezervace.rezerv_date = "' . $to2 . '"'  , 'left')
         ->join('mab1_user', 'mab1_rezervace.rezv_user_id = mab1_user.user_id' , 'left');
         $query2 = $this->db->get();
      
      
               
             
     
    return $query2;
  }
    
        
  
   function getVAB0vypis($to2 = NULL){
 
       
        $this->db->select('zasedacky_time.time_cas,zasedacky_time.time_end, vab0_rezervace.rezerv_date,zasedacky_time.time_id, vab0_rezervace.rezv_user_id, vab0_user.prijmeni, vab0_user.user_id, vab0_user.oc, vab0_user.poznamka')
         ->from('zasedacky_time')
         ->order_by('time_id', 'asc')
         ->join('vab0_rezervace', 'zasedacky_time.time_id = vab0_rezervace.rezv_time_id ANd vab0_rezervace.rezerv_date = "' . $to2 . '"'  , 'left')
         ->join('vab0_user', 'vab0_rezervace.rezv_user_id = vab0_user.user_id' , 'left');
         $query2 = $this->db->get();
      
      
               
             
     
    return $query2;
  }
  
  
   function getVAB3vypis($to2 = NULL){
 
       
        $this->db->select('zasedacky_time.time_cas,zasedacky_time.time_end,vab3_rezervace.rezerv_date,zasedacky_time.time_id, vab3_rezervace.rezv_user_id, vab3_user.prijmeni,vab3_user.user_id, vab3_user.oc, vab3_user.poznamka')
         ->from('zasedacky_time')
         ->order_by('time_id', 'asc')
         ->join('vab3_rezervace', 'zasedacky_time.time_id = vab3_rezervace.rezv_time_id ANd vab3_rezervace.rezerv_date = "' . $to2 . '"'  , 'left')
         ->join('vab3_user', 'vab3_rezervace.rezv_user_id = vab3_user.user_id' , 'left');
         $query2 = $this->db->get();
      
      
               
             
     
    return $query2;
  }
  
    function getVAB3home(){
        $today = date("Y-m-d"); 
       
        $this->db->select('vab3_rezervace.rezv_time_id,vab3_rezervace.rezerv_date,zasedacky_time.time_cas,vab3_rezervace.rezv_time_end, vab3_rezervace.rezv_user_id,zasedacky_time.time_id,zasedacky_time.time_end,zasedacky_time.time_cas,vab3_user.prijmeni,vab3_user.poznamka')
         ->from('vab3_rezervace')
         ->where('rezerv_date', $today)
         ->order_by('rezv_time_id', 'asc')
         ->join('zasedacky_time', 'vab3_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ->join('vab3_user', 'vab3_rezervace.rezv_user_id = vab3_user.user_id' , 'left');
         $query2 = $this->db->get()->result();
      
      
               
             
     
    return $query2;
  }
  
  function getMAB1aktiv(){
        $today = date("Y-m-d"); 
        $this->db->select('mab1_rezervace.rezv_time_id,mab1_rezervace.rezerv_id,mab1_rezervace.rezerv_date,MIN(zasedacky_time.time_cas) AS start_time, mab1_rezervace.rezv_time_end, mab1_rezervace.rezv_user_id,zasedacky_time.time_id,MAX(zasedacky_time.time_end) as end_time,zasedacky_time.time_cas,mab1_user.datum,mab1_user.prijmeni,mab1_user.oc,mab1_user.poznamka,mab1_user.user_id')
         ->from('mab1_user')
       //  ->where('oc', $oc)
         ->where('rezerv_date >=', $today)
         ->order_by('mab1_user.user_id', 'asc')
         ->group_by('rezv_user_id')
         ->join('mab1_rezervace', 'mab1_rezervace.rezv_user_id = mab1_user.user_id' , 'left')
         ->join('zasedacky_time', 'mab1_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ;
         $query2 = $this->db->get()->result();
    return $query2;
  }
  
  function getVAB1aktiv(){
        $today = date("Y-m-d"); 
        $this->db->select('vab1_rezervace.rezv_time_id,vab1_rezervace.rezerv_id,vab1_rezervace.rezerv_date,MIN(zasedacky_time.time_cas) AS start_time,vab1_rezervace.rezv_time_end, vab1_rezervace.rezv_user_id,zasedacky_time.time_id,MAX(zasedacky_time.time_end) as end_time,zasedacky_time.time_cas,vab1_user.datum,vab1_user.prijmeni,vab1_user.oc,vab1_user.poznamka,vab1_user.user_id')
         ->from('vab1_user')
      //   ->where('oc', $oc)
         ->where('rezerv_date >=', $today)
         ->order_by('vab1_user.user_id', 'asc')
         ->group_by('rezv_user_id')
         ->join('vab1_rezervace', 'vab1_rezervace.rezv_user_id = vab1_user.user_id' , 'left')
         ->join('zasedacky_time', 'vab1_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ;
         $query2 = $this->db->get()->result();
    return $query2;
  }
  
  function getVAB0aktiv(){
        $today = date("Y-m-d"); 
        $this->db->select('vab0_rezervace.rezv_time_id,vab0_rezervace.rezerv_id,vab0_rezervace.rezerv_date,MIN(zasedacky_time.time_cas) AS start_time,vab0_rezervace.rezv_time_end, vab0_rezervace.rezv_user_id,zasedacky_time.time_id,MAX(zasedacky_time.time_end) as end_time,zasedacky_time.time_cas,vab0_user.datum,vab0_user.prijmeni,vab0_user.oc,vab0_user.poznamka,vab0_user.user_id')
         ->from('vab0_user')
      //   ->where('oc', $oc)
         ->where('rezerv_date >=', $today)
         ->order_by('vab0_user.user_id', 'asc')
         ->group_by('rezv_user_id')
         ->join('vab0_rezervace', 'vab0_rezervace.rezv_user_id = vab0_user.user_id' , 'left')
         ->join('zasedacky_time', 'vab0_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ;
         $query2 = $this->db->get()->result();
    return $query2;
  }
   function getVAB3aktiv(){
        $today = date("Y-m-d"); 
        $this->db->select('vab3_rezervace.rezv_time_id,vab3_rezervace.rezerv_id,vab3_rezervace.rezerv_date,MIN(zasedacky_time.time_cas) AS start_time,vab3_rezervace.rezv_time_end, vab3_rezervace.rezv_user_id,zasedacky_time.time_id,MAX(zasedacky_time.time_end) as end_time,zasedacky_time.time_cas,vab3_user.datum,vab3_user.prijmeni,vab3_user.oc,vab3_user.poznamka,vab3_user.user_id')
         ->from('vab3_user')
      //   ->where('oc', $oc)
         ->where('rezerv_date >=', $today)
         ->order_by('vab3_user.user_id', 'asc')
         ->group_by('rezv_user_id')
         ->join('vab3_rezervace', 'vab3_rezervace.rezv_user_id = vab3_user.user_id' , 'left')
         ->join('zasedacky_time', 'vab3_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ;
         $query2 = $this->db->get()->result();
    return $query2;
  }
  
  
  function getMAB1moje($oc = NULL){
        $today = date("Y-m-d"); 
        $this->db->select('mab1_rezervace.rezv_time_id,mab1_rezervace.rezerv_id,mab1_rezervace.rezerv_date,MIN(zasedacky_time.time_cas) AS start_time, mab1_rezervace.rezv_time_end, mab1_rezervace.rezv_user_id,zasedacky_time.time_id,MAX(zasedacky_time.time_end) as end_time,zasedacky_time.time_cas,mab1_user.datum,mab1_user.prijmeni,mab1_user.oc,mab1_user.poznamka,mab1_user.user_id')
         ->from('mab1_user')
         ->where('oc', $oc)
         ->where('rezerv_date >=', $today)
         ->order_by('mab1_user.user_id', 'asc')
         ->group_by('rezv_user_id')
         ->join('mab1_rezervace', 'mab1_rezervace.rezv_user_id = mab1_user.user_id' , 'left')
         ->join('zasedacky_time', 'mab1_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ;
         $query2 = $this->db->get()->result();
    return $query2;
  }
  
  function getVAB1moje($oc = NULL){
        $today = date("Y-m-d"); 
        $this->db->select('vab1_rezervace.rezv_time_id,vab1_rezervace.rezerv_id,vab1_rezervace.rezerv_date,MIN(zasedacky_time.time_cas) AS start_time,vab1_rezervace.rezv_time_end, vab1_rezervace.rezv_user_id,zasedacky_time.time_id,MAX(zasedacky_time.time_end) as end_time,zasedacky_time.time_cas,vab1_user.datum,vab1_user.prijmeni,vab1_user.oc,vab1_user.poznamka,vab1_user.user_id')
         ->from('vab1_user')
         ->where('oc', $oc)
         ->where('rezerv_date >=', $today)
         ->order_by('vab1_user.user_id', 'asc')
         ->group_by('rezv_user_id')
         ->join('vab1_rezervace', 'vab1_rezervace.rezv_user_id = vab1_user.user_id' , 'left')
         ->join('zasedacky_time', 'vab1_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ;
         $query2 = $this->db->get()->result();
    return $query2;
  }
  
  function getVAB0moje($oc = NULL){
        $today = date("Y-m-d"); 
        $this->db->select('vab0_rezervace.rezv_time_id,vab0_rezervace.rezerv_id,vab0_rezervace.rezerv_date,MIN(zasedacky_time.time_cas) AS start_time,vab0_rezervace.rezv_time_end, vab0_rezervace.rezv_user_id,zasedacky_time.time_id,MAX(zasedacky_time.time_end) as end_time,zasedacky_time.time_cas,vab0_user.datum,vab0_user.prijmeni,vab0_user.oc,vab0_user.poznamka,vab0_user.user_id')
         ->from('vab0_user')
         ->where('oc', $oc)
         ->where('rezerv_date >=', $today)
         ->order_by('vab0_user.user_id', 'asc')
         ->group_by('rezv_user_id')
         ->join('vab0_rezervace', 'vab0_rezervace.rezv_user_id = vab0_user.user_id' , 'left')
         ->join('zasedacky_time', 'vab0_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ;
         $query2 = $this->db->get()->result();
    return $query2;
  }
   function getVAB3moje($oc = NULL){
        $today = date("Y-m-d"); 
        $this->db->select('vab3_rezervace.rezv_time_id,vab3_rezervace.rezerv_id,vab3_rezervace.rezerv_date,MIN(zasedacky_time.time_cas) AS start_time,vab3_rezervace.rezv_time_end, vab3_rezervace.rezv_user_id,zasedacky_time.time_id,MAX(zasedacky_time.time_end) as end_time,zasedacky_time.time_cas,vab3_user.datum,vab3_user.prijmeni,vab3_user.oc,vab3_user.poznamka,vab3_user.user_id')
         ->from('vab3_user')
         ->where('oc', $oc)
         ->where('rezerv_date >=', $today)
         ->order_by('vab3_user.user_id', 'asc')
         ->group_by('rezv_user_id')
         ->join('vab3_rezervace', 'vab3_rezervace.rezv_user_id = vab3_user.user_id' , 'left')
         ->join('zasedacky_time', 'vab3_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ;
         $query2 = $this->db->get()->result();
    return $query2;
  }
  
  function getVAB1home(){
        $today = date("Y-m-d"); 
       
        $this->db->select('vab1_rezervace.rezv_time_id,vab1_rezervace.rezerv_date,zasedacky_time.time_cas,vab1_rezervace.rezv_time_end, vab1_rezervace.rezv_user_id,zasedacky_time.time_id,zasedacky_time.time_end,zasedacky_time.time_cas,vab1_user.prijmeni,vab1_user.poznamka')
         ->from('vab1_rezervace')
         ->where('rezerv_date', $today)
         ->order_by('rezv_time_id', 'asc')
         ->join('zasedacky_time', 'vab1_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ->join('vab1_user', 'vab1_rezervace.rezv_user_id = vab1_user.user_id' , 'left');
         $query2 = $this->db->get()->result();
      
      
               
             
     
    return $query2;
  }
 
 
  function getVAB0home2(){
  $today = date("Y-m-d"); 
  $this->db->select('MIN(rezv_time_id) as time_start, MAX(rezv_time_end) as time_end, rezv_user_id, rezerv_date');
 // $this->db->where('rezerv_date',$today); 
  $this->db->group_by('rezv_user_id'); 
  $this->db->from('mab1_rezervace');
  $query2 = $this->db->get()->result();
  return $query2;
  }
  
  
  function getVAB0home(){
        $today = date("Y-m-d"); 
       
        $this->db->select('vab0_rezervace.rezv_time_id,vab0_rezervace.rezerv_date,zasedacky_time.time_cas,vab0_rezervace.rezv_time_end, vab0_rezervace.rezv_user_id,zasedacky_time.time_id,zasedacky_time.time_end,zasedacky_time.time_cas,vab0_user.prijmeni,vab0_user.poznamka')
         ->from('vab0_rezervace')
         ->where('rezerv_date', $today)
         ->order_by('rezv_time_id', 'asc')
         ->join('zasedacky_time', 'vab0_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ->join('vab0_user', 'vab0_rezervace.rezv_user_id = vab0_user.user_id' , 'left');
         $query2 = $this->db->get()->result();
      
    
    return $query2;
  }
  
  function getMAB1home(){
        $today = date("Y-m-d"); 
       
        $this->db->select('mab1_rezervace.rezv_time_id,mab1_rezervace.rezerv_date,zasedacky_time.time_cas,mab1_rezervace.rezv_time_end, mab1_rezervace.rezv_user_id,zasedacky_time.time_id,zasedacky_time.time_end,zasedacky_time.time_cas,mab1_user.prijmeni,mab1_user.poznamka')
         ->from('mab1_rezervace')
         ->where('rezerv_date', $today)
         ->order_by('rezv_time_id', 'asc')
         ->join('zasedacky_time', 'mab1_rezervace.rezv_time_id = zasedacky_time.time_id' , 'left')
         ->join('mab1_user', 'mab1_rezervace.rezv_user_id = mab1_user.user_id' , 'left');
         $query2 = $this->db->get()->result();
      
      
               
             
     
    return $query2;
  }
  
   function getCal_select($date = NULL){
 
        $this->db->select('cal_id'); 
        $this->db->where('date', $date);
        $query = $this->db->get('calendar_date'); 
        $pocet = $query->num_rows();
        
        if ($pocet > 0) {
             
        $this->db->select('*');
        
        $this->db->from('calendar_date, time_tab');
        $this->db->where('calendar_date.date',$date) and ('calenda_date.time_id <> time_tab.id');
       // $this->db->where('calendar_date.time_id != time_tab.id');
       
        $query = $this->db->get()->result();
        
        
        
        
        } else {     
        $this->db->select('*'); // Select field
        $this->db->from('time_tab'); // from Table1
        $query = $this->db->get()->result();
     
     
        }
    return $query;           
  }

function getPopis_den(){
 
 
        $popis_den = Null;
        $den = Date("N", Time());
        $this->db->select('*'); 
        $where = "number=$den";   
        $this->db->where($where);
        $den = $this->db->get('dny'); 
        $popis = $den->first_row();
        
        if ($den->num_rows() > 0) {
        $popis_den =  $popis->name;
        } else {
        $popis_den = Null;
        }

    return $popis_den;
  }
  
  function getPocet_hlasenifiles(){
 
 
        $this->db->select('hl_id');
        $hlasenifiles = $this->db->get('hlaseni_files')->result(); 
        $pocet_files = $this->db->affected_rows($hlasenifiles);

    return $pocet_files;
  }
  
   function getPocet_hlaseni(){
 
 
        $this->db->select('hl_i');
        $hlaseni = $this->db->get('hlaseni')->result(); 
        $pocet_hlaseni = $this->db->affected_rows($hlaseni);

    return $pocet_hlaseni;
  }

  

  
  

function getToday(){
 
 $today = date("Y-m-d"); 

    return $today;
  }
  


}
