<?php                                                                              		        
  
  
                 echo form_open('ticketsall/');  
                 
                   if ($filtr['oddeleni_resi'] > 0) {
               
               $color = "color-red"; 
                      
                } else {
              
                $color = "";
                
                }  
                                     ?>                  
                <div class="row"> 
                 <div class="col-sm-12 col-md-12">                                                                  
                                <div class="ptb-10 plr-15 card-view-full color-white bg-primary "><strong>Filtr</strong><span class="float-right pr-5 ion-android-create">                                
                                </div>  								  								                              
                            </div>  
                                
                    <div class="col-sm-12 col-md-6"><div class="ptb-5  plr-15 <?php   echo $color; ?>  "><strong>Oddělení řeší</strong><span class="float-right pr-5 ion-android-create"></div>      
<?php 
                 
               
               
                $js = 'class="p-10  brder-grey-full2 card-view-bottom w-100 br-3 " title="Oddělení (vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
              
              
               $oddeleni_resi = array();
                if ( $opravneni > 11) {
         
               $oddeleni_resi[0] = "Všechna oddělení"; 
                  foreach($tic_oddeleni as $row2 ){
            
                $oddeleni_resi[$row2->oddeleni_resi] = $row2->tic_oddeleni;
                }  
                                           
            echo form_dropdown('oddeleni_resi', $oddeleni_resi, $filtr['oddeleni_resi'], $js);  
               
                  }  
                  
                 else {   ?> 
               
               <input class=" card-view-bottom brder-grey-full2" type="text" name="oddeleni_resi" value="<?php   echo $odd_name ; ?>" title="Oddělení řeší" placeholder="Oddělení řeší" disabled>                            
          
         <?php        }   
               
           
            
              if ($filtr['oc_resi'] > 0) {
               
                  $color = "color-red"; 
                      
                } else {
              
                $color = "";
                
                }     //       foreach ($this->session->userdata('filter') as $key => $val) {
 //  echo $val;
//}
                                       ?>                                                                    
                    </div>                                              
                  
                    <div class="col-sm-12 col-md-6"><div class="ptb-5  plr-15 <?php   echo $color; ?>  "><strong>Řešitel</strong><span class="float-right pr-5 ion-android-create"></div> 
                        
                                       
<?php 
               
               
               
                $js = 'class="p-10  brder-grey-full2 card-view-bottom w-100 br-3 " title="Řešitel (vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
              
              
            
            
            
            
              $oc_resi = array();
               if ( $opravneni > 5) {
               $oc_resi[0] = "Všichni"; 
               
             foreach($tic_oc_resi as $row2 ){
            
                $oc_resi[$row2->oc_resi] = $row2->prijmeni;
                }  
                                           
            echo form_dropdown('oc_resi', $oc_resi, $filtr['oc_resi'], $js);  
               
               
                  } 
                  
                  else {   ?> 
               
               <input class=" card-view-bottom brder-grey-full2" type="text" name="oc_resi" value="<?php   echo $prijmeni ; ?>" title="Řeší" placeholder="Řeší" disabled>                            
          
         <?php        }   
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
             if ($filtr['oddeleni_zadal'] > 0) {
               
                $color = "color-red"; 
                      
                } else {
              
                $color = "";
                
                }  
                
            
            
                                       ?>                                                                    
                    </div>                                        
                    <div class="col-sm-12 col-md-6"><div class="ptb-5  plr-15 <?php   echo $color; ?>  "><strong>Oddělení zadání</strong><span class="float-right pr-5 ion-android-create"></div>             
<?php 
               
               
               
                $js = 'class="p-10  brder-grey-full2 card-view-bottom w-100 br-3 " title="Oddělení (vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
              
              
               $oddeleni_zadal = array();
        
               $oddeleni_zadal[0] = "Všechna oddělení";
               
               
              foreach($tic_oddeleni_zadal as $row2 ){
            
                $oddeleni_zadal[$row2->oddeleni_zadal] = $row2->oddeleni;
                }  
                                           
            echo form_dropdown('oddeleni_zadal', $oddeleni_zadal, $filtr['oddeleni_zadal'], $js);   
            
            
                         
                
                if ($filtr['oc_zadal'] > 0) {
               
                 $color = "color-red"; 
                      
                } else {
              
                $color = "";
                
                }  
                
               
                                      ?>                                                        
                    </div>                                              
                     <div class="col-sm-12 col-md-6"><div class="ptb-5  plr-15 <?php   echo $color; ?>  "><strong>Zadavatel</strong><span class="float-right pr-5 ion-android-create"></div>            
<?php 
                                                                                                                                    
               
               
                $js = 'class="p-10  brder-grey-full2 card-view-bottom w-100 br-3 " title="Zadavatel (vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
              
              
               $oc_zadal = array();
        
               $oc_zadal[0] = "Všichni";
              foreach($tic_oc_zadal as $row2 ){
            
                $oc_zadal[$row2->oc_zadal] = $row2->prijmeni;
                }  
                                           
            echo form_dropdown('oc_zadal', $oc_zadal, $filtr['oc_zadal'], $js);  
            
               if ($filtr['zadani_od'] > 0) {
               
                 $color = "color-red"; 
                      
                } else {
              
                $color = "";
                
                }  
                
                 if ($filtr['zadani_do'] > 0) {
               
                 $color1 = "color-red"; 
                      
                } else {
              
                $color1 = "";
                
                }  
                
                 if ($filtr['terminok_od'] > 0) {
               
                 $color2 = "color-red"; 
                      
                } else {
              
                $color2 = "";
                
                }  
                
                 if ($filtr['terminok_do'] > 0) {
               
                 $color3 = "color-red"; 
                      
                } else {
              
                $color3 = "";
                
                }  
                
                   if ($filtr['sort'] > 0) {
               
                 $color4 = "color-red"; 
                      
                } else {
              
                $color4 = "";
                
                }     
                
                  if ($filtr['stav'] > 0) {
               
                 $color6 = "color-red"; 
                      
                } else {
              
                $color6 = "";
                
                }                     
            
                                       ?>                                                       
                    </div>                                                                                                                         
                    <div class="col-sm-12 col-md-6"><div class="ptb-5  plr-15 <?php   echo $color6; ?>  "><strong>Realizace<?php // foreach ($filtr as $value) {
  // echo $value;
//} ; ?></strong><span class="float-right pr-5 ion-android-create"></div>               
<?php 
               
                      
               
                $js = 'class="p-10  brder-grey-full2 card-view-bottom w-100 br-3 " title="Stav realizace(vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
              
              
               $stav = array();
        
              $stav[0] = "Vše";
              $stav[9] = "Aktivní";
              
           if ($this->session->userdata('oddeleni') == 2) {    $stav[10] = "Neuzavřený";    }     
              foreach($realizace as $row2 ){
            
                $stav[$row2->tic_st] = $row2->tic_stav;
                }  
                                           
            echo form_dropdown('stav', $stav, $filtr['stav'], $js);  
            
            
         
            
            
                                       ?>                                                                    
                    </div>                                                                                                                                                                                                                                                                                                                                                                                           
                    <div class="col-md-12 col-lg-6"><div class="ptb-5  plr-15 <?php   echo $color4 ; ?>"><strong> Řazení </strong><span class="float-right pr-5 ion-android-create">
                        </div>                   
<?php 
               
                      
               
                $js = 'class="p-10  brder-grey-full2 card-view-bottom w-100 br-3 " title="Řazení(vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
              
              
               $sort = array();
        
              $sort[0] = "Výchozí";
              foreach($sorting as $row2 ){
            
                $sort[$row2->sort_st] = $row2->sort_popis;
                }  
                                           
            echo form_dropdown('sort', $sort, $filtr['sort'], $js);  
            
            
         
            
            
                                       ?>                                                                    
                    </div>                                                     
                    <div class="col-md-12 col-lg-6">
                        <div class="ptb-5  plr-15 <?php   echo $color ; ?>"><strong>Zadání od</strong>
                            <span class="float-right pr-5 ion-android-create">
                        </div>                                                   
                        <input class="card-view-bottom brder-grey-full2" type="date" name="zadani_od" value="<?php   echo $filtr['zadani_od'] ; ?>" onChange="this.form.submit()"  max="<?php echo $filtr['zadani_do'];?>" >                                                                        
                    </div>                                                  
                    <div class="col-md-12 col-lg-6">
                        <div class=" ptb-5  plr-15 <?php   echo $color1 ; ?>"><strong>Zadání do</strong>
                            <span class="float-right pr-5 ion-android-create">
                        </div>                                                   
                        <input class=" card-view-bottom brder-grey-full2" type="date" name="zadani_do" value="<?php   echo $filtr['zadani_do'] ; ?>" onChange="this.form.submit()"  min="<?php echo $filtr['zadani_od'];?>">                                                                        
                    </div>                                                
                    <div class="col-md-12 col-lg-6">
                        <div class="ptb-5  plr-15 <?php   echo $color2 ; ?>"><strong> Termín od</strong>
                            <span class="float-right pr-5 ion-android-create">
                        </div>                                                   
                        <input class="card-view-bottom brder-grey-full2" type="date" name="terminok_od" value="<?php   echo $filtr['terminok_od'] ; ?>" onChange="this.form.submit()" max="<?php echo $filtr['terminok_do'];?>" >                                                                        
                    </div>                                                  
                    <div class="col-md-12 col-lg-6">
                        <div class="ptb-5  plr-15 <?php   echo $color3 ; ?>"><strong> Termín do</strong>
                            <span class="float-right pr-5 ion-android-create">
                        </div>                                                   
                        <input class=" card-view-bottom brder-grey-full2" type="date" name="terminok_do" value="<?php   echo $filtr['terminok_do'] ; ?>" onChange="this.form.submit()" min="<?php echo $filtr['terminok_od'];?>" >                                                                        
                    </div> 
                    
                       <div class="col-md-12 col-lg-6">
                        <div class="ptb-5  plr-15 "><strong> Filtr reset full</strong>
                            <span class="float-right pr-5 ion-android-create">
                        </div>                                                    
                      <div class="card-view-full brder-grey-full2 nwsltr-primary-1"> <input type="button" onclick="window.location.href='https://intranet.pardubice.cmnet.cz/Ticket/filter_resetall';" value="Vymazat filtr" />   </div>                                          
                    </div>         
                    
                    <div class="col-md-12 col-lg-6">
                        <div class="ptb-5  plr-15 "><strong> Filtr uložit</strong>
                            <span class="float-right pr-5 ion-android-create">
                        </div>                                                   
                      <div class="card-view-full nwsltr-primary-1 brder-grey-full2">   <input class=" nwsltr-primary-1" type="button" onclick="window.location.href='https://intranet.pardubice.cmnet.cz/Ticket/filter_save';" value="Potvrdit" />  </div>                                               
                    </div> 
                            <?php      if ( $oddeleni == 2 and $typ == 1 or $oddeleni == 20 ) {     ?>
                      
                                 <div class="col-sm-12 col-lg-6"><div class="ptb-5  plr-15"><strong>Zákaznické číslo</strong><span class="float-right pr-5 ion-android-create"></div> 
                  				<input class=" card-view-bottom brder-grey-full2" type="text" name="zakcis" value="<?php   echo $filtr['zakcis'] ; ?>" title="Zákaznické číslo" placeholder="Zákaznické číslo">
    								</div>
                     
                                 <div class="col-sm-12 col-lg-6"><div class="ptb-5  plr-15"><strong>Číslo ticketu</strong><span class="float-right pr-5 ion-android-create"></div> 
                  				<input class=" card-view-bottom brder-grey-full2" type="text" name="ticket_id" value="<?php   echo $filtr['ticket_id'] ; ?>" title="Číslo ticketu" placeholder="Číslo ticketu">
    								</div>
                                    
                                    
                                    <div class="col-sm-12 nwsltr-primary-1"><div class="ptb-5  plr-15"><strong> Potvrdit </strong><span class="float-right pr-5 ion-android-create"></div> <div class="card-view-full brder-grey-full2">
                                    
              <?php  
                 echo form_submit('pridat', '   Vyhledat   ');
                 echo form_close();
            ?>
					  
					    
          
          
          
            
				</div>	</div><!-- card-view -->    <?php      }    ?>
                   </div>  
        
