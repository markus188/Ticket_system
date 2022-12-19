<!DOCTYPE HTML>
<html lang="en">
    <head>	
        <title>Firemní intranet
        </title>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge">  
        <meta name="viewport" content="width=device-width, initial-scale=1">	
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="600;url=https://intranet.pardubice.cmnet.cz/ticketsall">
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
  
   $today = date("Y-m-d"); 
   $nextday = date("Y-m-d", strtotime("$today -1 week"));  
  
          ?>              	                 
<?php //if (!empty($query) ) { 
                
              
               // $popis = "Moje oddělění (" .   $this->session->userdata('pocet_oddeleni') . ")"  ;
                
                    ?>     
        <section class="ptb-0 bg-11 ">     
            <div class=" bg-pozadi p-20 min-h-600x">		 		                         
                <!-- container -->                                                                                            
                                                    
                                             
                <div class="row">
                   
                	 <div class="col-md-12 col-lg-9">  
                      <div class="row">
                      <div class="col-md-12 col-lg-12">				                           
                        <div class="card-view-top bg-gogl p-10 plr-15 font-10 mb-20"><strong> 
                                <?php echo "Nově v okamžiku, kdy řešitel označí úkol za hotový (100%) -> se úkol automaticky uzavře. Pokud by zpracování ticketu uzavřeného řešitelem nebylo pro zadavatele OK, vystaví na opravu ticket nový."; 
                                ?></strong>                                
                                                                                              
                        </div>                         
                    </div>                                                
                    <div class="col-md-12 col-lg-12">				                           
                        <div class="card-view-top bg-primary color-white p-10 plr-15 font-10 "><strong> 
                                <?php echo $popis . " (" .   $pocet . ")"; 
                                ?></strong>                                
                                <strong><span class="float-right "><a href="/kalendar_odd/<?php echo Date("Y", Time());?>/<?php echo Date("m", Time());?>">Přehled uzavřených požadavků</a></span></strong>                                                              
                        </div>                                     
                    </div>                                                                                                                   				
                    <div class="col-md-12 col-lg-12">                                                                                                       
                        <div class="plr-10 card-view-bottom brder-grey">                    
                            <div class="row">                    
                                <div class="col-sm-1 form-rad text-left ptb-5">
                                    <strong>Číslo</strong>
                                </div>                    
                                <div class="col-sm-1 form-rad text-left ptb-5"><strong>Datum zadání</strong>
                                </div>                    
                                <div class="col-sm-1 form-rad text-left ptb-5"><strong>Autor</strong>
                                </div>                    
                                <div class="col-sm-4 form-rad text-left ptb-5"><strong>Předmět</strong>
                                </div>                    
                                <div class="col-sm-1 form-rad text-left ptb-5"><strong>Požadovaný termín</strong>
                                </div>
                                
                                <?php   if ($this->session->userdata('oddeleni') <> 2 and $this->session->userdata('oddeleni') <> 20){   ?>
                                                    
                                <div class="col-sm-1 form-rad text-left ptb-5"><strong>Potvrzený termín</strong>    
                                
                                 <?php }    else {   ?>   
                           
                                <div class="col-sm-1 form-rad text-left ptb-5"><strong>Zákaznické číslo</strong>  
                                 <?php }    ?>                                                                                                   
                                </div>                    
                                <div class="col-sm-1 form-rad text-left ptb-5"><strong>Stav</strong>
                                </div>                                                                                                      
                                <div class="col-sm-1 form-rad text-left ptb-5"><strong>Řeší</strong>
                                </div>
                                <div class="col-sm-1 form-rad text-left ptb-5">
                                    <span title= "čeká se ..." class=" pr-10 ion-android-settings ">
                                    </span>
                                </div>   					
<?php	                        
					
                $i=0; 
                foreach ($query as $zas) {
              
                      $odkaz = "ticket_filter/"  ;
                      
                       if($zas->termin_ok <> 0000-00-00){$terminok =  SubStr ($zas->termin_ok, 8, 2) . "." . SubStr ($zas->termin_ok, 5, 2) . "." . SubStr ($zas->termin_ok, 0, 4) ;       } 
                       else {$terminok =  "&nbsp;" ;      } 
                       if($zas->termin <> Null){$termin =  SubStr ($zas->termin, 8, 2) . "." . SubStr ($zas->termin, 5, 2) . "." . SubStr ($zas->termin, 0, 4) ;       } 
                       else {$termin =  "&nbsp;" ;      } 
                     
                      if ($zas->lastedit <> $this->session->userdata('oc') ) 
                      { $color4 = "color-red"; $color2 = "color-red"; }
                      else { $color4 = "";  $color2 = ""; }     
                     
                       
                     //  $testday = date("Y-m-d", strtotime("$zas->datum -1 week"));         
                    //   if ($zas->termin_ok == Null and $zas->datum < $nextday ) 
                    //   { $color4 = "color-red"; $color2 = "color-red"; }
                    
                   //    elseif ($zas->termin_ok < $today and $zas->stav < 7) 
                   //    { $color4 = "color-red"; $color2 = "color-red"; }
                       
                   //    else { $color4 = "";  $color2 = ""; }      
                     
                     if($i%2 == 0){  ?> 
                     
                     <div class="col-sm-1 ptb-5 bg-pozadi <?php   echo $color4 ; ?>">
                                    <a href="<?php echo site_url($odkaz . $zas->nasid);?>" title="
                                        <?php echo "řeší " . $zas->oddeleni_name;?>"> 
                                        <?php echo $zas->zkratka . "-" . $zas->nasid;?></a>
                                </div>  
                        
                    <?php
                     echo '<div class="col-sm-1 ptb-5 bg-pozadi ' . $color4 .  ' ">' . SubStr ($zas->datum, 8, 2) . "." . SubStr ($zas->datum, 5, 2) . "." . SubStr ($zas->datum, 0, 4) . '</div>
                                                     <div class="col-sm-1 ptb-5 bg-pozadi ' . $color4 .  ' ">' . $zas->autor . '</div>' ;    ?>                                                                 
                                <div class="col-sm-4 ptb-5 bg-pozadi <?php   echo $color4 ; ?>">
                                    <a href="<?php echo site_url($odkaz . $zas->nasid);?>" title="
                                        <?php echo "řeší " . $zas->oddeleni_name;?>"> 
                                        <?php echo $zas->predmet;?></a>
                                </div>                                                                 
<?php
                     echo '
                     
                     
                     <div class="col-sm-1 ptb-5 bg-pozadi ' . $color4 .  ' ">' . $termin .  '</div>' ; 
                     
                     
                                                                                    
                        
                     
                        if ($this->session->userdata('oddeleni') <> 2 and $this->session->userdata('oddeleni') <> 20){  
                                                    
                               echo '<div class="col-sm-1 ptb-5 bg-pozadi ' . $color4 .  ' ">' . $terminok .  '</div>';
                                
                                  }    else {   
                           
                               echo '<div class="col-sm-1 ptb-5 bg-pozadi ' . $color4 .  ' ">' . $zas->zakcis .  '</div>';
                                  }   
                     
                     
                                                                                                                              
                     echo '<div class="col-sm-1 ptb-5 bg-pozadi ' . $color4 .  ' ">' . $zas->tic_realizace . '</div>' ;  
                     echo '<div class="col-sm-1 ptb-5 bg-pozadi ' . $color4 .  ' ">' . $zas->prijmeni . '</div>';
                    
                    
                    
                     if ($zas->stav == 6 ) { 
                     echo '<div class="col-sm-1 ptb-5 bg-pozadi ' . $color4 .  ' ">';
                     ?><a href="<?php echo site_url('Ticket/auto_close/'. $zas->nasid);?>">
                     <?php
                     echo '<span title= "' . "čeká se na "  . $zas->nxt_stav . '" class=" ' . $color2 .  ' mr-10 font-12 ' . $zas->nxt_icon . ' "></span></a></div>';
                     
                     
                      } else { 
                     echo '<div class="col-sm-1 ptb-5 bg-pozadi ' . $color4 .  ' "><span title= "'. "čeká se na "  . $zas->nxt_stav . '" class=" ' . $color2 .  ' mr-10 font-12 ' . $zas->nxt_icon . ' "></span></div>';
                    } 
                                                              
                     
                    } 
                    else {
                    
                    ?> 
                     
                     <div class="col-sm-1 ptb-5 <?php   echo $color4 ; ?>">
                                    <a href="<?php echo site_url($odkaz . $zas->nasid);?>" title="
                                        <?php echo "řeší " . $zas->oddeleni_name;?>"> 
                                        <?php echo $zas->zkratka . "-" . $zas->nasid;?></a>
                                </div>  
                        
                    <?php
                     echo '<div class="col-sm-1 ptb-5 ' . $color4 .  ' ">' . SubStr ($zas->cas, 8, 2) . "." . SubStr ($zas->cas, 5, 2) . "." . SubStr ($zas->cas, 0, 4) .  '</div>
                                                     <div class="col-sm-1 ptb-5 ' . $color4 .  ' ">' . $zas->autor . '</div>' ;    ?>                                            
                                <div class="col-sm-4 ptb-5 <?php   echo $color4 ; ?>">
                                    <a href="<?php echo site_url($odkaz . $zas->nasid);?>" title="
                                        <?php echo "řeší " . $zas->oddeleni_name;?>"> 
                                        <?php echo $zas->predmet;?></a>
                                </div>                                                                 
<?php
                     echo '
                     
                     
                     <div class="col-sm-1 ptb-5 ' . $color4 .  ' ">' . $termin .  '</div>' ;
                     
                     
                     
                     
                     
                        if ($this->session->userdata('oddeleni') <> 2){  
                                                    
                               echo '<div class="col-sm-1 ptb-5 ' . $color4 .  ' ">' . $terminok .  '</div>';
                                
                                  }    else {   
                           
                               echo '<div class="col-sm-1 ptb-5 ' . $color4 .  ' ">' . $zas->zakcis .  '</div>';
                                  }   
                     
                     
                     
                     echo '<div class="col-sm-1 ptb-5 ' . $color4 .  ' ">' . $zas->tic_realizace . '</div>
                    
                     ' ;    
                    echo '<div class="col-sm-1 ptb-5  ' . $color4 .  ' ">' . $zas->prijmeni . '</div>';
                    
                    
                    
                     if ($zas->stav == 6 ) { 
                     echo '<div class="col-sm-1 ptb-5 ' . $color4 .  ' ">';
                     ?><a href="<?php echo site_url('Ticket/auto_close/'. $zas->nasid);?>">
                     <?php
                     echo '<span title= "' . "čeká se na "  . $zas->nxt_stav . '" class=" ' . $color2 .  ' mr-10 font-12 ' . $zas->nxt_icon . ' "></span></a></div>';
                     
                     
                      } else { 
                     echo '<div class="col-sm-1 ptb-5 ' . $color4 .  ' "><span title= "' . "čeká se na "  . $zas->nxt_stav . '" class=" ' . $color2 .  ' mr-10 font-12 ' . $zas->nxt_icon . ' "></span></div>';
                    } 
                                                                                                       
                  }$i++;  } 
                                                ?>                                			
                            </div>	    					
                        </div>			  	
                    </div>                	
                </div>    
                 </div>  
                 <div class="col-md-12 col-lg-3">
                <?php include $ticket_menu . ".php" ;?>     
                
                     </div>      	  	
            </div>  </div>         		
            <!-- container --> 	
        </section>           
<?php
                
            //     }else{ 
                 
                     //    $popis = "Nemáte žádné tickety."  ;    ?>                                                         
    <!--    <section class="ptb-0 bg-11 ">     
            <div class="container bg-pozadi p-20 min-h-600x">		 		                         
                 container                                     
                <div class="row">				                      
                    <div class="col-md-12 col-lg-12">				                         
                        <div class=" card-view-full bg-white p-10 plr-15 font-10 text-center">                                               <strong>
                                <?php 	echo $popis ;   ?></strong>                                                                                                          
                        </div>                         
                    </div>    
                </div>   
            </div>    
        </section>                          
        <!-- container -->                                      	                    
<?php
                 
       //           }
                 
                          ?>                
        <?php include 'footer.php';?> 	 	
<script src="/plugin-frameworks/jquery-3.2.1.min.js"></script> 	 	
<script src="/plugin-frameworks/tether.min.js"></script> 	 	
<script src="/plugin-frameworks/bootstrap.js"></script> 	 	
<script src="/common/scripts.js"></script> 	 
    </body>
</html>