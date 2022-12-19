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
<?php 
   $datum = date("Y-m-d H:i:s");
                   $zadani = date("d.m.Y H:i");
                   $today = date("Y-m-d"); 
                   $nextday = date("Y-m-d", strtotime("$today +1 year"));  
          ?>     
      <section class="ptb-0  mb-0 ">
		<div class="container bg-pozadi p-20 min-h-600x">
			
                <div class="row">    					
                    <div class="col-md-12 col-lg-12">			                                  
                        <div class="row">  
                                       
                   <div class="col-md-12 col-lg-12">				
                        <div class=" card-view bg-primary color-white p-10 plr-15 ">                  
                            <strong>Ticket <?php echo $ticket->zkratka . "-" .  $ticket->nasid. "&nbsp;&nbsp;" . $ticket->predmet  ; ?></strong>
                                
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
                            
                           					 
                          
                   
                        <div class="col-sm-12 col-md-12"> 
                         <?php  echo form_open('Administrace/loginzemailu'); 
                        echo form_hidden('nasid', $ticket->nasid);  
                  ?> 		
				<div class="card-view-full bg-primary color-white mt-20">
                  <div class="p-10 plr-15 font-10 "><strong>Přihlášení do intranetu</strong></div> 
                    </div><!-- container -->
                 </div>
                                
                                
                                
                                 <div class="col-sm-3"><div class=" ptb-5 plr-15 "><strong> Osobní číslo </strong><span class="float-right pr-5 ion-android-create"></div> 
                  			
                                	<input class="p-10 plr-15 card-view-full brder-grey-full2" type="text" name="oc" value="<?php  echo set_value('oc');?>" placeholder="Zadej své osobní číslo">   
                                    	                                                                        
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('oc');
                  echo "</b></font>";
                  ?> 
								</div><!-- col-sm-6 -->       
                              
                                <div class="col-sm-3"><div class=" ptb-5 plr-15 "><strong> Heslo </strong><span class="float-right pr-5 ion-android-create"></div> 
                  			
                                <input class="p-10 plr-15 card-view-full brder-grey-full2" type="password" name="heslo" value="<?php  echo set_value('heslo');?>" placeholder="Zadej své heslo">
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('password');
                  echo "</b></font>";
                  ?> 
								</div><!-- col-sm-6 -->   
                                
                                <div class="col-sm-6 nwsltr-primary-1"><div class="ptb-5  plr-15 "><strong> Potvrdit </strong><span class="float-right pr-5 ion-android-create"></div>
                             <div class="card-view-full brder-grey-full2">
              <?php  
                 echo form_submit('pridat', '   Přihlásit   ');
                 echo form_close();
            ?>
					  
					    
          
          
          
            
				</div>	</div><!-- card-view -->    
                              
                              
                            <!-- col-sm-6 -->                                                                                                  
                            
                            <!-- col-sm-6 -->                                         
                                                       
                        </div>
                        <!-- col-sm-8 -->                        
                      </div>
                    <!-- col-sm-8 -->               

                    <!-- col-sm-12 -->	     	
                </div>  
        </section>	 	 	 	 
        
        <!-- SCIPTS --> 	 	
<script src="/plugin-frameworks/jquery-3.2.1.min.js"></script> 	 	
<script src="/plugin-frameworks/tether.min.js"></script> 	 	
<script src="/plugin-frameworks/bootstrap.js"></script> 	 	
<script src="/common/scripts.js"></script> 	 
    </body>
</html>