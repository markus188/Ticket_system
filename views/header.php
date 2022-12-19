<header>
    <div class="top-header ptb-5 ">
			<div class="container">	
				<div class="oflow-hidden font-10 text-sm-center ptb-sm-5">
				  <ul class="float-left  ">
						<li class="pl-0 ptb-5 pr-10 pl-sm-10 " ><?php echo  $popis_den ; ?></li>
                        <li class="pl-10 ptb-5 pr-10 pl-sm-10 brdr-l-grey-3" ><?php echo ltrim(StrFTime("%d", Time()), "0") . "." . ltrim(StrFTime("%m", Time()), "0") . "." . StrFTime("%Y %H:%M", Time()); ?></li>    
						<li class="pl-10 ptb-5 pl-sm-10 brdr-l-grey-3" ><?php echo  $svatek_den  ; ?></li>  
					</ul>
					<ul class="float-right  ">
           <?php echo $stranka ; ?>
					</ul>
				</div>
			</div>
		</div>
    
    <div class="middle-header pt-0 mt-15 mb-15">
			<div class="container">	
				<div class="row">
				 <div class="col-sm-6"> 
           <a  href="/"><img  src="/images/logo.png" alt="Logo" title="Logo"></a>
         </div> 
         <div class="col-sm-3">
         </div> 
                <?php  if ($prihlasen) {
                 ?> 
         
                 <div class="col-sm-3 ptb-5">
                 <div class="card-view p-10 pr-20 bg-primary color-white"><div class="float-right font-10  pl-0 pl-sm-10 pr-sm-0">      
                              <?php  
                 echo "Přihlášený uživatel";
                 
                 ?>
                	</div></div><!-- col-sm-6 --> 
                  <div class="card-view p-10 pr-20 bg-white "><div class="float-right font-10  pl-0 pl-sm-10 pr-sm-0">      
                              <?php  
                 echo "<b>";
                 echo $prijmeni . " " . $jmeno;
                 echo "</b>";
                 ?>
                	</div></div><!-- col-sm-6 --> 
                                 
                                                    
                 	
                                                                                                                        
                 <div class="card-view p-10 pr-20">                                            
                 <div class="float-right font-10  pl-0 pl-sm-10 pr-sm-0">
                   			<?php   echo anchor('Administrace/unlogin2', 'Odhlásit');   ?> 
                  
								</div></div><!-- col-sm-6 -->
				
                                                                                                                                                                      
                              
				</div>
         
         
         
         
         
                 <?php         }
                 else {    ?> 
         
         
				 <div class="col-sm-3 nwsltr-primary-2 pt-5">
                 <?php  echo form_open('Administrace/login2');  ?>
                 <div >
                  				<input class="p-5 mb-0 text-sm-center " type="text" name="oc" value="<?php  echo set_value('oc');?>" placeholder="Zadej své osobní číslo">
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('OC');
                  echo "</b></font>";
                  ?> 
								</div><!-- col-sm-6 -->
								 <div >
									<input class="p-5 mb-0 text-sm-center" type="password" name="heslo" value="<?php  echo set_value('heslo');?>" placeholder="Zadej své heslo">
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('heslo');
                  echo "</b></font>";
                  ?>
								</div><!-- col-sm-6 -->
                                
                                     
                              <?php 
                 echo form_submit('pridat', ' Přihlásit ');
                 echo form_close();
                 ?>
                   
				</div>
                
                 <?php    }
                  ?> 
                
				</div>
			</div>
		</div>
    
<nav>
	<div class="bottom-menu">
	
       <a class="menu-nav-icon" data-menu="#main-menu" href="#"><span class="ion-navicon"></span></a>
	   <ul class="main-menu" id="main-menu">
        <li class="drop-down"><a href="/">Home&nbsp;</a></li>
        <li class="drop-down"><a href="/">Kontakty&nbsp;<span class="ion-android-arrow-dropdown"></span></a>
			<ul class="drop-down-menu drop-down-inner ">
                <li><a href="/seznam">Seznam zaměstnanců</a></li>
				<li><a href="/struktura">Struktura</a></li>
            </ul>
		</li>
        
         <?php  if ( $prihlasen ) {
                 ?>
         <li class="drop-down"><a href="/tv_vab">Info TV&nbsp;<span class="ion-android-arrow-dropdown"></span></a>
			<ul class="drop-down-menu drop-down-inner ">
                <li><a href="/tv_soubor">TV administrace</a></li>
			</ul>
		</li>
          <?php    }
                   else {
                 ?>
        <li class="drop-down"><a href="/tv_vab">Info TV&nbsp;</a></li>
         <?php    }
                  ?>  
        
        <li class="drop-down"><a href="/hlaseni">Hlášení&nbsp;</a></li>
        
        <?php  if (  $prihlasen and $opravneni > 11) {
                 ?>
        
        <li class="drop-down"><a href="/ticketsall">Požadavky TT&nbsp;<span class="ion-android-arrow-dropdown"></span></a>
			<ul class="drop-down-menu drop-down-inner">
				<li><a href="/ticketadd">Nový ticket</a></li>
                
                
                <li><?php 	echo anchor('os_spoluprace', "Spolupracuji" . " " . "(" .   $this->session->userdata('pocet_spoluprace') . ")" ) ;   ?></li>
            </ul>
		</li>
              <?php    }
                    elseif ( $prihlasen and $opravneni < 12 ) {
                 ?>
        
        <li class="drop-down"><a href="">Požadavky TT&nbsp;<span class="ion-android-arrow-dropdown"></span></a>
			<ul class="drop-down-menu drop-down-inner">
				<li><a href="/ticketadd">Nový ticket</a></li>
                
                <li><?php 	echo anchor('ticketsall2', "Požadavky zadané" . " " . "(" .   $this->session->userdata('pocet_zadani') . ")" ) ;   ?></li>
                <li><?php 	echo anchor('ticketsall', "Požadavky k řešení" . " " . "(" .   $this->session->userdata('pocet_tickets') . ")" ) ;   ?></li>
                <li><?php 	echo anchor('os_spoluprace', "Spolupracuji" . " " . "(" .   $this->session->userdata('pocet_spoluprace') . ")" ) ;   ?></li>
                
                  <?php  if (  $this->session->userdata('oddeleni') == 2 or $this->session->userdata('oc') == 2246) {
                 ?>
                  <li><a href="/atlas_vypis">Atlas prodej</a></li>
                  <li><a href="/atlas_komplet">Atlas přehled prodej</a></li>
                  <li><a href="/atlas_admin">Atlas produkt admin</a></li>
                  <li><a href="/atlas_admin2">Atlas katalog admin</a></li>
                  <li><a href="/seznamccs">Seznam CCS</a></li>
                  <li><a href="/ccsadmin">Volba CCSadmina</a></li>
                 <?php    }
                
                 ?>
			</ul>
		</li>
              <?php    }
                   else {
                 ?>
        
        <li class="drop-down"><a href="/ticketsall">Požadavky TT&nbsp;<span class="ion-android-arrow-dropdown"></span></a>
			<ul class="drop-down-menu drop-down-inner">
				<li><a href="/ticketadd">Nový ticket</a></li>
                
			</ul>
		</li>
              <?php    }
                  ?>  
        
        
        <li class="drop-down"><a href="/smernice">Směrnice&nbsp;</a></li>          
        <li class="drop-down"><a href="/zasedacky">Rezervace&nbsp;<span class="ion-android-arrow-dropdown"></span></a>
			<ul class="drop-down-menu drop-down-inner">
				<li><a href="/vab0">VAB Přízemí</a></li>
                <li><a href="/vab1">VAB 1.patro</a></li>
                <li><a href="/vab3">VAB 3.patro</a></li>
                <li><a href="/mab1">MAB 1.patro</a></li>
            </ul>
		</li>
        <li class="drop-down"><a href="">BOZP/Covid&nbsp;<span class="ion-android-arrow-dropdown"></span></a>
			<ul class="drop-down-menu drop-down-inner">
                <li><a href="/urazy">BOZP - Úrazy</a></li>
			    <li><a href="/uraz">BOZP - Nový úraz</a></li>
                <li><a href="/covid">Covid - Test</a></li>
                <li><a href="/testy">Covid - Přehled zaměstnanci</a></li>
                <li><a href="/testy_brg">Covid - Přehled brigádníci</a></li>
                <li><a href="/testy_ag">Covid - Přehled agenturní</a></li>
                <li><a href="/covid_hromzamadd">Covid - Hromadný zaměstnanci</a></li>
                <li><a href="/covid_hrombrgadd">Covid - Hromadný brigádnici</a></li>
                <li><a href="/covid_hromagadd">Covid - Hromadný agenturní</a></li>
                
                
            </ul> 
		</li>
		<li class="drop-down"><a href="">Logistika&nbsp;<span class="ion-android-arrow-dropdown"></span></a>
			<ul class="drop-down-menu drop-down-inner">
                <li><a href="/transportsall">Doprava</a></li>
			    <li><a href="/transportadd">Nová doprava</a></li>
                <li><a href="/transport_kontakty">Kontakty</a></li>
                <li><a href="/transport_adresy">Adresy</a></li>
                <li><a href="/palety">Palety</a></li>
                
                
                <?php 
                
                   $roknovy = StrFTime("%Y", Time());
                   $mesicnovy = StrFTime("%m", Time());
                   $odkaz = "/kalendar_nakl" . "/" . $roknovy . "/" . $mesicnovy ;
                
                 if (  $oc == 757 or $oc == 3266 or $oc == 2887 or $oc == 3145) {
                 ?>
                <li><a href="/uploads/Pracovni_ instrukce_SOP_dokument.pdf">SOP dokument</a></li>
                  <?php    }
                 
                 ?>
                 
                 <li><a href="<?php echo $odkaz; ?>">Truck management</a></li>
            </ul>
		</li>
        
        <li class="drop-down"><a href="/akce">Fotogalerie&nbsp;</a></li>
        <li class="drop-down"><a href="/odkazy">Odkazy&nbsp;</a>
			
		</li> 
       
        <?php  if ($prihlasen and $opravneni == 11) { ?> 
        <li class="drop-down"><a href="/">Administrace &nbsp;<span class="ion-android-arrow-dropdown"></span></a>
		 	<ul class="drop-down-menu drop-down-inner">
                <li><a href="/intra_admin">Intranet</a></li>
			    <li><a href="/prehled_zamestnancu">Zaměstnanci</a></li>
                <li><a href="/prehled_brigadniku">Brigádníci</a></li>
                <li><a href="/prehled_agenturni">Agenturní</a></li>
                <li><a href="/nastenkavse">Nástěnka</a></li>
                <li><a href="/hotline">Hotline</a></li>
                <li><a href="/rezervace">Rezervace</a></li>
                <li><a href="/smernicevse">Směrnice atd.</a></li>
                <li><a href="/absencevse">Absence</a></li>
                <li><a href="/www">Odkazy</a></li>
                <li><a href="/akce_prehled">Akce</a></li>
                <li><a href="/absencebohu">Mailserver</a></li>
                <li><a href="/soubor">Nahrát soubor</a></li>
                <li><a href="/tv_gal_edit">TV galerie</a></li>
            </ul>
		</li>
        <?php } ?> 
        
        <?php  if ($prihlasen ) { ?> 
        <li class="drop-down"><a href="/dochazka">Osobní složky &nbsp;<span class="ion-android-arrow-dropdown"></span></a>
			<ul class="drop-down-menu drop-down-inner">
			    <li><?php 	echo anchor('absence', "Moje absence". " " . "(" .   $this->session->userdata('pocet_neprit') . ")" ) ;   ?></li>
                <li><?php 	echo anchor('os_zastup', "Moje zástupy" . " " . "(" .   $this->session->userdata('pocet_zstp') . ")" ) ;   ?></li>
                <li><?php 	echo anchor('os_nastenka', "Moje nástěnka" . " " . "(" .   $this->session->userdata('pocet_zprav') . ")" ) ;   ?></li>
                <li><?php 	echo anchor('os_rezervace', "Moje rezervace" . " " . "(" .   $this->session->userdata('pocet_rezerv') . ")" ) ;   ?></li>
                <li><?php 	echo anchor('os_firm_kalendar', "Moje události" ) ;   ?></li>
                <li><?php 	echo anchor('dochazka', "Můj jídelníček" ) ;   ?></li>
                <li><?php 	echo anchor('pass', "Moje heslo");   ?></li>
                 <?php  if (  $this->session->userdata('oddeleni') == 2) {
                 $rok2022 = date("Y");        
                 $mesic2022 = date("m");  
                 
                 ?>
                  <li><a href="/os_kalendar/<?php echo $rok2022 . "/" . $mesic2022 ; ?>">Můj prodej</a></li>
                  
                 <?php    }
                
                 ?>
                
                </ul>
		</li>
        <?php } ?> 
        
        
       
        </ul>
			
		</div>
  </nav>
</header>