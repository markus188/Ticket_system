<!DOCTYPE HTML>
<html lang="en">
    <head>	
        <title>Firemní intranet
        </title>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge">  
        <meta name="viewport" content="width=device-width, initial-scale=1">	
        <meta charset="UTF-8">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link href="/plugin-frameworks/bootstrap.css" rel="stylesheet">
        <link href="/fonts/ionicons.css" rel="stylesheet">
        <link href="/common/styles.css" rel="stylesheet">
    </head>
    <body>  
<?php include 'header.php';
   $datum = date("Y-m-d H:i:s");
                   $zadani = date("d.m.Y H:i");
                   $today = date("Y-m-d"); 
                   $nextday = date("Y-m-d", strtotime("$today +1 year"));  
          ?>     
      <section class="ptb-0  mb-0 bg-11 ">
		<div class=" bg-pozadi p-20 min-h-600x">
			
                <div class="row">    					
                    <div class="col-md-12 col-lg-9">			                                  
                        <div class="row">  
                                       
                   <div class="col-md-12 col-lg-12">				
                        <div class=" card-view bg-primary color-white p-10 plr-15 ">                  
                            <strong>Ticket <?php echo $ticket->zkratka . "-" .  $ticket->nasid. "&nbsp;&nbsp;" . $ticket->predmet   . "&nbsp;&nbsp;(" . '<a href="/ticket_filter/' . $ticket->nasid . '">Aktualizace</strong></a>' . ")" ; ?></strong>
                                <span class="float-right "><strong>
                                        <a href="/<?php echo $zpet; ?>">Zpět na přehled</strong></a>
                                </span>
                               </div>                      
                        </div>	
                    
                        <div class="col-sm-12 col-md-4 ">                                 
                                <div class="ptb-5 plr-15 color-grey  "> Čeká se 
                                </div>                    			     
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey">
                                    <?php echo $next; ?> 
                                </div>                                 
                            </div>	
                      <div class="col-sm-12 col-md-4 ">                                 
                                <div class="ptb-5 plr-15 color-grey  "> Poslední zobrazení 
                                </div>                    			     
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey">
                                     <?php 
                                    
                                    if($lastview === NULL) {  
                                    
                                      echo "&nbsp;";
                                    
                                    
                                     } 
                                     else  {  
                                    
                                     echo  SubStr ($lastview->vie_datum, 8, 2) . "." . SubStr ($lastview->vie_datum, 5, 2) . "." . SubStr ($lastview->vie_datum, 0, 4) . "  "  . SubStr ($lastview->vie_datum, 11, 5) . " (" . $lastview->vie_prijmeni . ")" ;
                                   
                                    
                                     } 
                                    
                                     ?> 
                                </div>                                 
                            </div>	
                    <div class="col-sm-12 col-md-4 ">                                 
                                <div class="ptb-5 plr-15 color-grey  "> Poslední editace 
                                </div>                    			     
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey">
                                    <?php echo  SubStr ($lastedit->lg_datum, 8, 2) . "." . SubStr ($lastedit->lg_datum, 5, 2) . "." . SubStr ($lastedit->lg_datum, 0, 4) . "  "  . SubStr ($lastedit->lg_datum, 11, 5) . " (" . $lastedit->lg_autor . ")" . '&nbsp;&nbsp;&nbsp;<a href="#log">&raquo;</a>' ; ?> 
                                </div>                                 
                            </div>                                                                                                                                                                         
                            <div class="col-sm-12 col-md-2 ">                                 
                                <div class="ptb-5 plr-15 color-grey "> Stav ticketu 
                                </div>                    			     
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey"><strong>
                                    <?php echo $ticket->tic_stav; ?></strong> 
                                </div>                                 
                            </div>
                            <!-- col-sm-6 -->                                                                                                                                     
                            <div class="col-sm-12 col-md-2 ">                                 
                                <div class="ptb-5 plr-15 color-grey ">Datum zadání
                                </div>                    			     
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey"><strong>
                                    <?php echo SubStr ($ticket->cas, 8, 2) . "." . SubStr ($ticket->cas, 5, 2) . "." . SubStr ($ticket->cas, 0, 4) . "  "  . SubStr ($ticket->cas, 11, 5);?></strong> 
                                </div>								 
                            </div>
                            <!-- col-sm-6 -->                                                                                                   
                            <div class="col-sm-12 col-md-2 ">                                 
                                <div class="ptb-5 plr-15 color-grey">Zadavatel
                                </div>  								 
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey"><strong>
                                    <?php echo $ticket->autor; ?></strong> 
                                </div>								 
                            </div>
                            <!-- col-sm-6 -->                                                                   
                            <div class="col-sm-12 col-md-2 ">                                 
                                <div class="ptb-5 plr-15 color-grey">Požadovaný termín 
                                </div>                    		         
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey"><strong>
                                    <?php echo SubStr ($ticket->termin, 8, 2) . "." . SubStr ($ticket->termin, 5, 2) . "." . SubStr ($ticket->termin, 0, 4) ; ?> </strong>
                                </div>								 
                            </div>
                            
                            <div class="col-sm-12 col-md-2 ">                                 
                                <div class="ptb-5 plr-15 color-grey">Oddělení (řeší)
                                </div>  								 
                                         <div class="p-10 plr-15  card-view-bottom bg-white brder-grey"> <strong>
                                    <?php echo $ticket->tic_oddeleni; ?></strong> 
                                </div>	 								 
                                    
                                							 
                            </div>
                            <!-- col-sm-6 -->                                                                            
                            <div class="col-sm-12 col-md-2 ">   								 
                                <div class="ptb-5 plr-15 color-grey">Řeší
                                </div>  								 
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey"><strong>
                                    <?php echo $ticket->prijmeni; ?></strong> 
                              </div>     </div>	 
                              
                                <?php     if (!empty($ticket->zakcis) ) {     ?>
                              <div class="col-sm-12 col-md-2 ">   								 
                                <div class="ptb-5 plr-15 color-grey">Zákaznické č.
                                </div>  								 
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey"><strong>
                                    <?php echo $ticket->zakcis; ?></strong> 
                              </div>     </div>	 
                                             <?php       	 }      ?>                 
                  
                    <div class="col-sm-12 col-md-12">                                
                                <div class="ptb-5 plr-15 color-grey"><?php echo "Zadání"; ?>
                                </div> 
                                <div class="p-10 plr-15  card-view-bottom bg-white brder-grey">
                                <div class="pb-5   bg-white text-left"><strong><?php echo $ticket->predmet ; ?></strong></div>
                                <div class="pt-5  bg-white "><?php echo nl2br ($ticket->text); ?> </div>
                                
                                
                                
                               
                                </div>								
                            </div>   
                            
                            
                                  <?php 
                             
                                                                	 if (!empty($spolupracovani) ) {     ?>                  
                            
                              <div class="col-sm-12 col-md-12 ">                          
                                <div class="ptb-5 plr-15 color-grey">Spolupracuje
                                </div>
                                                   
                            <div class=" ptb-0 card-view-bottom brder-grey">    	                                                    
                                                   
                                    <div class="row">    								 
                                
                                    <?php 
			   
                foreach($spolupracovani as $row3 ){
                
            
             
            echo 	'<div class="col-md-2 "><div class="plr-15 ptb-10 bg-white text-left"><strong>' ;             
            echo 	$row3->hlp_prijmeni ; 
            echo    '</strong><span class="float-right ">' . anchor('Ticket/smazat_spolupraci/'. $row3->hlp_id, 'x', 'title="Smazat  ' .  $row3->hlp_prijmeni . '"') . '</span>';
           	echo 	'</div></div>' ;
            
          
            
            
            }   ?>   
                
               
                 </div></div>   </div>    
                
           
                 <?php       	 }      ?>              							 
                            
                   <?php        
                                                                	 if (!empty($files) ) {     ?>          
                            
                             <div class="col-sm-12 col-md-12  ">                          
                                <div class="ptb-5 plr-15 color-grey">Soubory
                                </div>
                                                     
                            <div class=" ptb-0 card-view-bottom brder-grey">    	                                                    
                                                   
                                    <div class="row">                                                         
           	                                                                                     		        
<?php    
             $i=0;
             foreach ($files as $zas) {
            
          
            
           
            
             
            echo 	'<div class="col-md-3 "><div class="ptb-10 plr-15 bg-white text-left">' ;             
            echo 	'<a  href="' . "/tickets_files/" . $zas->nazev . '"><span class="mr-10 font-12 ion-android-document"></span>' . $zas->nazev . '</a>' ; 
            echo    '<span class="float-right ">' . anchor('Ticket/smazat_soubor/'. $zas->fls_id, 'x', 'title="Smazat  ' .  $zas->nazev . '"') . '</span>';        
           	echo 	'</div></div>' ;
            
           
           
            
            $i++; 
            
            
            }
       
                                                          ?>                                                                                                           			                                 
                                            								
                                    </div>    </div> 
                                    <!-- container -->            
                                </div>
                                <!-- container -->				 			
                         
                            
                            
                               <?php     	 }        ?>                  
                            
                   
                              
                              
                              
                              
                              
                            <!-- col-sm-6 -->                                                                                                  
                            
                            <!-- col-sm-6 -->                                         
<?php        
                                                    	 if (!empty($answear) ) {     ?>                                                                        
                            <div class="col-sm-12 col-md-12">                                 
                                <div class="p-10 plr-15 card-view-top bg-primary color-white mt-20"><strong>Komentáře</strong>
                                </div>  								  								 
                           
                            <!-- col-sm-6 -->                                                                     
                             	                                                    
                                <div class=" card-view-bottom brder-grey">                   
                                    <div class="row">                                 
<?php  $i=0;     foreach ($answear as $ans) {
                                if($i%2 == 0){      
            
            echo 	'<div class="col-sm-12 "><div class="pt-10 pb-5 plr-15  bg-white text-left"><strong id="' . $ans->ansid . '">' ;             
            echo 	 $ans->ans_autor . '<span class="float-right bg-white">' . SubStr ($ans->ans_datum, 8, 2) . "." . SubStr ($ans->ans_datum, 5, 2) . "." . SubStr ($ans->ans_datum, 0, 4) . "  "  . SubStr ($ans->ans_datum, 11, 5) . '</span>' ; 
                    
           	echo 	'</strong></div>' ;
            echo 	'<div class="pb-10 pt-5 plr-15 bg-white ">' . nl2br ($ans->ans_text) . '</div>' ;
               
               
               
             echo 	'</div>' ;
              }
              
              else
               {      
            
            echo 	'<div class="col-sm-12 "><div class="pt-10 pb-5 plr-15  bg-pozadi text-left"><strong id="' . $ans->ansid . '">' ;           
            echo 	 $ans->ans_autor . '<span class="float-right bg-pozadi">' . SubStr ($ans->ans_datum, 8, 2) . "." . SubStr ($ans->ans_datum, 5, 2) . "." . SubStr ($ans->ans_datum, 0, 4) . "  "  . SubStr ($ans->ans_datum, 11, 5) . '</span>' ; 
                    
           	echo 	'</strong></div>' ;
            echo 	'<div class="pb-10 pt-5 plr-15 bg-pozadi ">' . nl2br ($ans->ans_text) . '</div>' ;
               
               
               
             echo 	'</div>' ;
              }         
            
            $i++;  } 
                
                
                
          
                                                       ?>                               	
                                    </div>
                                    <!-- col-sm-8 -->         	          	
                                   </div>
                                <!-- col-sm-8 -->                                 	
                            </div>
                            <!-- col-sm-8 -->                                               
<?php        
                                                    	 }      ?>                                                                             
                        </div>
                        <!-- col-sm-8 -->                        
                      </div>
                    <!-- col-sm-8 -->               
                    <div class="col-md-12 col-lg-3">	                                                                                                                   
<?php
                
                  $IP = $_SERVER['REMOTE_ADDR']; 
           //   echo $captcha['captcha'];  
            echo form_open('Ticket/ticket_admin/'. $ticket->nasid);              
          //  echo form_open('/ticket_edit');
            echo form_hidden('nasid', $ticket->nasid);
            echo form_hidden('oc', $oc);
            echo form_hidden('prijmeni', $prijmeni);
                                     ?>                                    
                        <div class="row">                                                                                                                                                              
                            
                  <?php 
                
                if ($ticket->termin_ok <> Null) {
                $termin =  $ticket->termin_ok;
                
                 $color = "";     
                } else {
                $termin  = $ticket->termin;
                
                $color = "color-red"; 
                }  
                
                 ?>   
            
                                							 
                            
                            <div class="col-md-12">                                                                  
                                <div class="ptb-10 plr-15 card-view-full color-white bg-primary "><strong>Editace ticketu</strong><span class="float-right pr-5 ion-android-create">                                
                                </div>  								  								                              
                            </div> 
                            
                            
                            <!-- col-sm-6 -->      			                                                                                          
                            <div class="col-md-6 ">
                                <div class="ptb-5 plr-15  <?php   echo $color ; ?>"><strong>Potvrzený termín</strong> <span class="float-right pr-5 ion-android-create">
                                </div>  
                                
                                
                                
                                                  				
                                <input class=" card-view-full brder-grey-full2" type="date" name="termin_ok" value="<?php   echo $termin ; ?>" onChange="this.form.submit()" min="<?php echo $today;?>" max="<?php echo $nextday;?>">                     
<?php    

                  echo "<font color='red'><b>";
                  echo form_error('termin_ok');
                  echo "</b></font>";
                  
                   if ($ticket->narocnost > 0) {
                
                 $color = " ";     
                } else {
                
                $color = "color-red"; 
                }    
                                                  ?>   								
                            </div>
                            
                             <div class="col-md-6 ">
                                <div class="ptb-5 plr-15  <?php   echo $color ; ?>"><strong>Změna řešitele</strong> <span class="float-right pr-5 ion-android-create">
                                </div>  								 
                                
                                    <?php $js = 'class="p-10 card-view-full brder-grey-full2 w-100 " title="Řeší (vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
				$zmenaoc_resi = array();                    
        
                $zmenaoc_resi[0] = "";
                if ($ticket->oddeleni_resi <> 2) {
                $zmenaoc_resi[$supervizorccs] = "Supervizor CCS";   } 
                foreach($seznam as $row2 ){
            
                $zmenaoc_resi[$row2->oc] = $row2->prijmeni . " " .  mb_substr ($row2->jmeno, 0, 1) . ".";
                }  
                                           
      
                echo form_dropdown('zmenaoc_resi', $zmenaoc_resi, set_value('zmenaoc_resi') , $js);   
                echo "<font color='red'><b>";
                echo form_error('zmenaoc_resi');
                echo "</b></font>"; 
                         
              ?> 
                                							 
                            </div>  
                            
                            
                            <!-- col-sm-6 -->                                                                                                   
                           <div class="col-md-6 ">   								 
                                <div class="ptb-5 plr-15 <?php   echo $color ; ?>"><strong>Čas. náročnost</strong><span class="float-right pr-5 ion-android-create">
                                </div>  								 
                                
                          
		                 	<input class=" card-view-full brder-grey-full2" type="text" name="narocnost" value="<?php  echo $ticket->narocnost ;?>"  onChange="this.form.submit() title="Náročnost" placeholder="Náročnost">
                
               
               
                
           
              
                                							 
                            </div>
                            
                             <div class="col-md-6 ">   								 
                                <div class="ptb-5 plr-15 "><strong>Požádat o pomoc</strong><span class="float-right pr-5 ion-android-create">
                                </div>  								 
                                
                                    <?php $js = 'class="p-10 brder-grey-full2 card-view-full brder-grey w-100 " title="Požádat o pomoc(vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
				$pomoc = array();
        
                $pomoc[0] = " ";  
                foreach($spoluprace as $row2 ){
                   
                 $pomoc[$row2->oc] = $row2->prijmeni . " " .  mb_substr ($row2->jmeno, 0, 1) . ".";
                   
                }  
                                           
                
                echo form_dropdown('pomoc', $pomoc, $pomoc[0] , $js);
                
               
                if ($ticket->realizace > 0) {
                
                 $color = " ";     
                } else {
                
                $color = "color-red"; 
                }    
                
                
           
              ?> 
                                							 
                            </div>
                                <div class="col-md-6 ">   								 
                                <div class="ptb-5 plr-15 <?php   echo $color ; ?>"><strong>Realizace</strong><span class="float-right pr-5 ion-android-create">
                                </div>  								 
                                
                                    
                                      <?php $js = 'class="p-10 card-view-full brder-grey-full2 w-100 " title="Realizace (stav)"' . '" onChange="this.form.submit()"';
				$realizace = array();
        
                
                foreach($tic_realizace as $row2 ){
            
                $realizace[$row2->tic_rlz] = $row2->tic_realizace;
                }  
                                           
      
                echo form_dropdown('realizace', $realizace, $ticket->realizace , $js);
           
              ?> 
                                    
                                    
                                    
                                   
                             								 
                            </div>
             <?php   //  if ($this->session->userdata('oddeleni') == 20) {   ?>           
                            
                   <div class="col-md-12 col-lg-6"><div class="ptb-5  plr-15"><strong>Tisk ticketu</strong><span class="float-right pr-5 ion-android-create"></div>   <div class="card-view-full brder-grey-full2 ptb-10 text-center bg-pozadi">
                                <?php  echo anchor('/ticket_print/'. $ticket->nasid, 'Tisk', 'title="Tisk ticketu číslo ' .  $ticket->nasid . '"');   ?>
                 
							</div><!-- col-sm-12 -->	
							</div><!-- row -->    
                   <?php  //   }  ?>      
                         
                            
                            
                            <div class="col-md-12 ">
                            
                            
            <?php
            
               
                 echo form_close();  
                
                  $IP = $_SERVER['REMOTE_ADDR']; 
           //   echo $captcha['captcha'];  
            echo form_open('Ticket/ticket_komentar/'. $ticket->nasid);              
          //  echo form_open('/ticket_edit');
            echo form_hidden('nasid', $ticket->nasid);
            echo form_hidden('oc', $oc);
            echo form_hidden('prijmeni', $prijmeni);
                                     ?>                 
                            
                            
                            <!-- col-sm-6 -->                                                                                                         	
                            
                                <div class="ptb-5 plr-15 "><strong>Vložit komentář</strong><span class="float-right pr-5 ion-android-create">
                                </div>    					
<textarea class="brder-grey-full2" name="text" value="<?php  echo set_value('text');?>" placeholder="Text zprávy"></textarea>
                                  <div class="nwsltr-primary-1 "><div class="ptb-5  plr-15 "><strong>Potvrdit</strong><span class="float-right pr-5 ion-android-create"></div> <div class="card-view-full brder-grey-full2">             
<?php  
                     
                  
                  echo "<font color='red'><b>";
                  echo form_error('text');
                  echo "</b></font>";
             
					
                 echo form_submit('pridat', '   Vložit komentář   ');
                 echo form_close();  
                 
                      
                                                ?>					   				 								
                                </div>	
                            </div>       </div>   
                            <!-- col-sm-12 -->                                                                                                                          
                            <div class="col-md-12 ">                          
                                <div class="ptb-5 plr-15 "><strong>Soubory</strong><span class="float-right pr-5 ion-android-create">
                                </div>
                                                 
              <?php     echo form_open_multipart('Ticket/ticket_file/'. $ticket->nasid);
                   echo form_hidden('nasid', $ticket->nasid);
                   echo form_hidden('oc', $oc);
                   echo form_hidden('prijmeni', $prijmeni);   ?>                                                            
                              
                                                                                                                                                       			                                 
                                        <input type="file" multiple="multiple" name="image_name[]" class="custom-file-upload brder-grey-full2" />                  
<?php
                  echo "<font color='red'><b>";
                  echo form_error('files');
                  echo "</b></font>";
                                                          ?>      								
                                  
                                <!-- container -->				 			
                            </div>
                            <!-- col-sm-8 -->                                      							 							
                            <!-- row -->    							 
                            <div class="col-sm-12 mb-20 ">
                                 <div class="nwsltr-primary-1 "><div class="ptb-5  plr-15"><strong> Potvrdit </strong><span class="float-right pr-5 ion-android-create"></div> <div class="card-view-full brder-grey-full2">             
<?php                       
                 echo form_submit('pridat', '   Vložit soubor  ');
                 echo form_close();
                                                                                ?> 					                      	                 	 				                             
                                </div>   
                            </div>                                                                                                                                                                                                                                            		     	                         
                                </div>
                            <!-- col-sm-12 -->	 		     	
                        </div>
                        <!-- col-sm-12 -->		
                   
                <!-- col-sm-12 -->	    
       
            <!-- col-sm-12 -->	
            
<?php include 'log.php';?> 

  </div>
                    <!-- col-sm-12 -->	     	
                </div>  
        </section>	 	 	 	 
        <?php include 'footer.php';?> 	 	
        <!-- SCIPTS --> 	 	
<script src="/plugin-frameworks/jquery-3.2.1.min.js"></script> 	 	
<script src="/plugin-frameworks/tether.min.js"></script> 	 	
<script src="/plugin-frameworks/bootstrap.js"></script> 	 	
<script src="/common/scripts.js"></script> 	 
    </body>
</html>