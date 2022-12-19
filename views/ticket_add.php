<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Firemní intranet</title>
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

  <?php include 'header.php';?>
  

  
  
						<?php
                  echo form_open_multipart('/ticketadd'); 
                  echo form_hidden('oc', $oc);  
                  echo form_hidden('mail', $email);
                  echo form_hidden('prijmeni', $prijmeni); 
                  echo form_hidden('oddeleni_zadal', $oddeleni);   
                   $datum = date("Y-m-d H:i:s");
                   $zadani = date("d.m.Y H:i");
                   $today = date("Y-m-d"); 
                   $nextday = date("Y-m-d", strtotime("$today +1 year"));  
                   $nextweek = date("Y-m-d", strtotime("$today +1 week"));  
                   ?>     
    
   
 <section class="ptb-0  mb-0 bg-11 ">
		<div class="container bg-pozadi p-20 min-h-600x">
			
            <div class="row">
            
            <div class="col-md-12 col-lg-12">
				<div class="card-view-top bg-primary color-white ">
                  <div class="p-10 plr-15 font-10 "><strong>Nový ticket</strong><span class="float-right "><strong><a href="/ticketsall">Zpět na přehled</strong></a></span></div> 
                    </div><!-- container -->
                 </div>
                                
                                
                                
                                 <div class="col-md-12 col-lg-4"><div class=" ptb-5 plr-15 "><strong> Stav ticketu </strong></div> 
                  			
                                <input class=" card-view-bottom brder-grey-full" type="text" name="stav" value="<?php  echo "Nový" ;?>"  title="Stav ticketu" placeholder="Stav ticketu" disabled>
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('stav');
                  echo "</b></font>";
                  ?> 
								</div><!-- col-sm-6 -->
                                
                                 
                                  <div class="col-md-12 col-lg-4"><div class="ptb-5 plr-15 "><strong> Datum zadání </strong> </div> 
                  			
                                <input class=" card-view-bottom brder-grey-full" type="text"  name="datum2" value="<?php echo $zadani;?>"  disabled>
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('datum2');
                  echo "</b></font>";
                  ?> 
								</div><!-- col-sm-6 -->
                                
                       <?php       if ($oddeleni == 1) {       ?>  
                                 
                                 <div class="col-md-12 col-lg-4"><div class="ptb-5 plr-15 "><strong>Zadavatel </strong><span class="float-right pr-5 ion-android-create"></div> 
								 <?php 
               
                                 $js = 'class="p-10  brder-grey-full2 card-view-bottom w-100 br-3 " title="Oddělení (vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
				$zadavatel = array();
        
                $zadavatel[$oc] = $prijmeni . " " . $jmeno;
                foreach($zadav_seznam as $row2 ){
            
                $zadavatel[$row2->oc] = $row2->prijmeni . " " . $row2->jmeno;
                }  
                                           
      
                echo form_dropdown('zadavatel', $zadavatel, set_value('zadavatel'), $js);
                echo "<font color='red'><b>";
                echo form_error('zadavatel');
                echo "</b></font>"; 
                         
                                 
                                 ?> 
                   </div><!-- col-sm-6 -->   
                               
                          <?php         }
                 else {  echo form_hidden('zadavatel', $oc);   ?>     
                              
                               
                                <div class="col-md-12 col-lg-4"><div class=" ptb-5 plr-15 "><strong> Zadavatel</strong></div> 
                  			    
                                <input class=" card-view-bottom brder-grey-full" type="text" name="zadavatel" value="<?php  echo $prijmeni  . " " . $jmeno;?>"  title="Zadavatel" placeholder="Zadavatel" disabled>
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('zadavatel');
                  echo "</b></font>";
                  ?> 
								</div><!-- col-sm-6 -->
                                
                             <?php         }
                 ?>     
                       
                               
                  
                  
                   
                    <div class="col-md-12 col-lg-4"><div class="ptb-5 plr-15 "><strong>Požadavek na oddělení</strong><span class="float-right pr-5 ion-android-create"></div> 
								 <?php 
               
                                 $js = 'class="p-10  brder-grey-full2 card-view-bottom w-100 br-3 " title="Oddělení (vybrat ze seznamu)"' . '" onChange="this.form.submit()"';
				$tic_id = array();
        
                $tic_id[0] = "";
                foreach($tic_oddeleni as $row2 ){
            
                $tic_id[$row2->tic] = $row2->tic_oddeleni;
                }  
                                           
      
                echo form_dropdown('tic_id', $tic_id, set_value('tic_id'), $js);
                echo "<font color='red'><b>";
                echo form_error('tic_id');
                echo "</b></font>"; 
                                                 
                                 
                                 ?> 
                   </div><!-- col-sm-6 -->   
                   
                   
                       
								 <?php 
                echo "<font color='red'><b>";
                echo form_error('resitel');
                echo "</b></font>"; 
                
                   
                    
                if (set_value('tic_id') <> Null and $seznam <> Null) {
                
                echo '<div class="col-md-12 col-lg-4"><div class="ptb-5 plr-15 "><strong> Požadavek na (vyber ze seznamu) </strong><span class="float-right pr-5 ion-android-create"></div>' ;
        
                $js = 'class="p-10  brder-grey-full2 card-view-bottom w-100 br-3 " title="Řešitel"' ;
				$resitel = array();
        
                $resitel[0] = " ";
                foreach($seznam as $row2 ){
            
                $resitel[$row2->oc] = $row2->prijmeni . " " . $row2->jmeno;
                }  
                                           
      
                echo form_dropdown('resitel', $resitel, set_value('resitel') , $js);
                echo "</div>"; 
            
                } 
            
                                 ?> 
                   <!-- col-sm-6 -->    
                   
                      <div class="col-sm-12 col-lg-4"><div class="ptb-5 plr-15 "><strong> Požadovaný termín </strong><span class="float-right pr-5 ion-android-create"></span></div> 
                  				<input class=" card-view-bottom brder-grey-full2" type="date" name="termin" value="<?php  echo $nextweek;?>" min="<?php echo $today;?>" max="<?php echo $nextday;?>">
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('termin');
                  echo "</b></font>";
                  ?> 
								</div><!-- col-sm-6 -->                                 
                                               
                                
                  	<div class="col-sm-12 col-lg-12"><div class="ptb-5 plr-15 "><strong> Nadpis </strong><span class="float-right pr-5 ion-android-create"></div>
                 			<input class=" card-view-bottom brder-grey-full2" type="text" name="predmet" value="<?php  echo set_value('predmet');?>" title="Nadpis" placeholder="Nadpis">
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('predmet');
                  echo "</b></font>";
               //   echo $captcha;
                  
                  ?> 
								</div><!-- col-sm-6 -->              
                  
                                
                                
                                  
                                
                                		<div class="col-sm-12 "><div class="ptb-5 plr-15 "><strong> Požadavek </strong><span class="float-right pr-5 ion-android-create"></div>   
									<textarea class=" card-view-bottom brder-grey-full2" style="overflow-y:scroll;" name="text" value="<?php  echo set_value('text');?>" placeholder="Požadavek"></textarea>
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('text');
                  echo "</b></font>";
                  ?>
								</div><!-- col-sm-12 -->
                                
                       
                      
              
						
				   <div class="col-sm-6"><div class="ptb-5  plr-15 "><strong> Soubory </strong><span class="float-right pr-5 ion-android-create"></div>   
                  			
                                <input  type="file" multiple="multiple" name="image_name[]" class="custom-file-upload brder-grey-full2" />
                  <?php
                  echo "<font color='red'><b>";
                  echo form_error('files');
                  echo "</b></font>";
                  ?> 
								</div><!-- col-sm-6 -->        
                               


							
							<!-- row -->  
							 <div class="col-sm-6 nwsltr-primary-1"><div class="ptb-5  plr-15 "><strong> Potvrdit </strong><span class="float-right pr-5 ion-android-create"></div>
                             <div class="card-view-full brder-grey-full2">
              <?php  
                 echo form_submit('pridat', '   Zadat ticket   ');
                 echo form_close();
            ?>
					  
					    
          
          
          
            
				</div>	</div><!-- card-view -->
                    
						
                                 
                             
                     
             
                    
                    
                    
                    
                    </div>
			         </div>
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
