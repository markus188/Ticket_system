         			
                <div class="row">			 
                    <div class="col-md-12 col-lg-12">				
                        <div class=" card-view bg-primary color-white p-10 plr-15 font-10 ">                  
                            <strong id="log">LOG ticketu
                                    </strong>
                                
                                                  
                        </div>
                        <div class="p-10 card-view brder-grey">
                    <div class="row">
                   <div class="col-sm-3 form-rad text-left pb-5"><strong>Datum</strong></div>
                    <div class="col-sm-3 form-rad text-left pb-5"><strong>Autor</strong></div>
                    <div class="col-sm-6 form-rad text-left pb-5"><strong>Stav</strong></div>
                    
                  <?php      
                        
                         $i=0; 
                foreach ($log as $zas) {
                
                    if ($zas->lg_zmena == 3) { $odpoved = '<a href="#' . $zas->lg_pozn . '">komentář</a>';  }
                    elseif ($zas->lg_zmena == 6) { $odpoved = SubStr ($zas->lg_pozn, 8, 2) . "." . SubStr ($zas->lg_pozn, 5, 2) . "." . SubStr ($zas->lg_pozn, 0, 4);  }  
                    elseif ($zas->lg_zmena == 16) { $odpoved = SubStr ($zas->lg_pozn, 8, 2) . "." . SubStr ($zas->lg_pozn, 5, 2) . "." . SubStr ($zas->lg_pozn, 0, 4);  }  
                    else { $odpoved = $zas->lg_pozn;  }
                
                    if($i%2 == 0){      
                    echo '<div class="col-sm-3 ptb-5 bg-pozadi">' . SubStr ($zas->lg_datum, 8, 2) . "." . SubStr ($zas->lg_datum, 5, 2) . "." . SubStr ($zas->lg_datum, 0, 4) . " " . SubStr ($zas->lg_datum, 10, 6) .  '</div>' ;   
                     
                     
                     echo '
                     
                     
                     <div class="col-sm-3 ptb-5 bg-pozadi">' . $zas->lg_autor . '</div>
                     <div class="col-sm-6 ptb-5 bg-pozadi">' . $zas->text . " " . $odpoved . '</div>' ;  
                    
                    } 
                    else {
                    
                    echo '<div class="col-sm-3 ptb-5 ">' . SubStr ($zas->lg_datum, 8, 2) . "." . SubStr ($zas->lg_datum, 5, 2) . "." . SubStr ($zas->lg_datum, 0, 4) . " " . SubStr ($zas->lg_datum, 10, 6) .  '</div>' ;   
                     
                     
                     echo '
                     
                     
                     <div class="col-sm-3 ptb-5">' . $zas->lg_autor . '</div>
                     <div class="col-sm-6 ptb-5">' . $zas->text . " " . $odpoved . '</div>' ;  
                    
                    
                  }$i++;  } 
                  
                //   echo   $informace  ;  
                  
                  
                ?>
                        <!-- container -->                 
                    </div>			    
                </div>	 			
            </div>
           </div>  
         