<?php
 
    class Templates {
   	 private $templates;  
   	 
   	 
   	 private $blocsVar=array ();
   	 private $globalVar=array ();
   	 private $templateVar=array ();
   	 private $superGlobalVar=array ();
            	private $bocIfVar=array ();
   	 
   	 
   	 private $debug=true;
    
//On ajoute les templates que l'on vas utilisé//    
   	 public function __construct($templatesLink) {
   		 
   		 foreach ($templatesLink as $cle => $void) {  
 
   			 $contenu="";
   			 if (!$fp = fopen($templatesLink[$cle],"r")) {
   				 echo "<div><b>Erreur fatale :</b> Echec de l'ouverture du template <b>$cle</b> dans le moteur de template : <b>templateEngine.php</b>sur la ligne <b>19</b>.</div>";
 
   				 exit;
   			 }
   			 else {
   				 while(!feof($fp)) {
   					 $ligne = fgets($fp);
   					 $contenu .= $ligne;
   				 }
   			 $this->templates[$cle]=$contenu;
   			 }
   		 }
   	 }
   	 
//On ajoute les templates au tableau//    	 
   	 public function set_template ($templatesLink) {
   		 $inter = array ();  
   		 foreach ($templatesLink as $cle => $void) {  
   			 
   			 $contenu="";
   			 if (!$fp = fopen($templatesLink[$cle],"r")) {
   				 echo "<div><b>Erreur fatale :</b> Echec de l'ouverture du template <b>$cle</b> dans le moteur de template : <b>templateEngine.php</b>sur la ligne <b>42</b>.</div>";
   				 exit;
   			 }
   			 else {
   				 while(!feof($fp)) {
   					 $ligne = fgets($fp);
   					 $contenu .= $ligne;
   				 }
   			 $inter[$cle]=$contenu;
   			 }
   		 }
   		 $this->templates= array_merge ($this->templates, $inter);  
   	 }   	 
   	 
//On modifie les varriables globales//    
   	 public function set_globalVar($templateName, $var) {
   		 foreach ($var as $cle => $valeur) {
   			 $this->globalVar [$templateName][$cle]=$valeur;
   		 }
   		 
   	 }

//On modifie les varriable sur les bloc coditionnels//
    	public function set_conditionalBlocVar($templateName, $blocName, $var){
            	foreach ($var as $cle => $valeur) {
                    	$this->bocIfVar[$templateName][$blocName][$cle]=$valeur;
            	}
    	}
 
//On modifie les varriables de bloc//  
   	 public function set_blocVar($templateName, $blocName, $var, $index) {
   		 foreach ($var as $cle => $valeur) {
   			 $this->blocsVar[$templateName][$blocName][$index][$cle] = $valeur;
   			 
   		 }
   		 
 
   	 }
 
//On inclu le template dans un autre//
   	 public function set_include ($templateName, $var) {
   		 foreach ($var as $clef => $valeur) {
   			 $this->templateVar [$templateName] [$clef]=$valeur;
   		 }  
   	 }
   	 
//On inclu les varriable superGlobales//   	 
   	 public function set_superGlobalVar ($var) {
   		 $this->superGlobalVar = array_merge ($this->superGlobalVar, $var);
   	 }
   	 
   	 
   	 
//On execute//  
   	 public function exec ($mainTemplate) {
   		 //global
   		 foreach ($this->globalVar as $templateName => $inter)    {
   			 foreach ($inter as $clef => $valeur) {
   				 $varriable="{T.".$clef."}";  
   				 if  (mb_substr_count($this->templates[$templateName], $varriable)==0) {
   					 if ($this->debug==true) {
   						 echo "<div><b>Erreur d'execution : </b> la varriable : <b>$varriable</b> est introuvable dans le template : <b>$templateName</b> dans le moteur <b>templateEngine.php</b> sur la ligne : <b>86</b></div>";
   					 }   					 
   				 }
   				 else {
   					 $this->templates[$templateName]=str_replace ($varriable, $valeur, $this->templates[$templateName]);
   				 }
   			 }
   		 }
   		 //End global
                   	 
                     	//bloc conditionels
                    	foreach ($this->bocIfVar as $templateName => $inter) {
   			 foreach ($inter as $blocName => $inter1) {
   				 //On regarde si le boc est présent dans le template avant de poursuivre l'imbrication de boucle//
   				 $begin = "<!-- IF ".$blocName." -->";
   				 $end ="<!-- END_IF -->";
   				 
   				 if  (mb_substr_count($this->templates[$templateName], $begin)==0 or mb_substr_count($this->templates[$templateName], $end)==0) {
   					 if ($this->debug==true) {
   						 echo "<div><b>Erreur d'execution : </b> le bloc IF : <b>$blocName</b> est introuvable dans le template : <b>$templateName</b> dans le moteur <b>templateEngine.php</b> sur la ligne : <b>85</b></div>";
   					 }
   				 }
   				 else {
   					 $code="";
   					 
   					 $posBegin= strpos ($this->templates[$templateName], $begin) ;
   					 $posEnd= strpos ($this->templates[$templateName], $end)+ strlen ($end)+2 ;
   					 $taille = $posEnd-$posBegin;
   					 
   					 $protoBloc= substr ($this->templates[$templateName], $posBegin, $taille);   					 
   						 $code=$protoBloc;
   						 foreach ($inter1 as  $cle=> $valeur) {
   							 if  (mb_substr_count($code, "IF.$blocName.$cle}")==0) {
   								 if ($this->debug==true) {
   									 echo "<div><b>Erreur d'execution : </b> la varriable local : <b>{IF.$blocName.$cle}</b> est introuvable dans le template : <b>$templateName</b> dans le moteur <b>templateEngine.php</b> sur la ligne : <b>122</b></div>";
   								 }   					 
   							 }
   							 $code= str_replace ("{IF.".$blocName.".".$cle."}", $valeur, $code);
                                                            	$code = str_replace ($begin, "", $code);
                                                             	$code = str_replace ($end, "", $code);
   						 }
   					 $this->templates[$templateName]= str_replace($protoBloc, $code, $this->templates[$templateName]);
   				 }
   			 }
   		 }
                    	//end bloc conditionnel

                    	 
   		 
   		 //bloc
   		 foreach ($this->blocsVar as $templateName => $inter) {
   			 foreach ($inter as $blocName => $inter1) {
   				 //On regarde si le boc est présent dans le template avant de poursuivre l'imbrication de boucle//
   				 $begin = "<!-- BEGIN ".$blocName." -->";
   				 $end ="<!-- END ".$blocName." -->";
   				 
   				 if  (mb_substr_count($this->templates[$templateName], $begin)==0 or mb_substr_count($this->templates[$templateName], $end)==0) {
   					 if ($this->debug==true) {
   						 echo "<div><b>Erreur d'execution : </b> le bloc : <b>$blocName</b> est introuvable dans le template : <b>$templateName</b> dans le moteur <b>templateEngine.php</b> sur la ligne : <b>85</b></div>";
   					 }
   				 }
   				 else {
   					 $code="";
   					 
   					 $posBegin= strpos ($this->templates[$templateName], $begin) + strlen ($begin)+2 ;
   					 $posEnd= strpos ($this->templates[$templateName], $end);
   					 $taille = $posEnd-$posBegin;
   					 
   					 $protoBloc= substr ($this->templates[$templateName], $posBegin, $taille);   					 
   					 foreach ($inter1 as $index => $inter2) {
   						 $modif=$protoBloc;
   						 foreach ($inter2 as  $cle=> $valeur) {
   							 if  (mb_substr_count($modif, "B.$blocName.$cle}")==0) {
   								 if ($this->debug==true) {
   									 echo "<div><b>Erreur d'execution : </b> la varriable local : <b>{B.$blocName.$cle}</b> est introuvable dans le template : <b>$templateName</b> dans le moteur <b>templateEngine.php</b> sur la ligne : <b>122</b></div>";
   								 }   					 
   							 }
   							 $modif= str_replace ("{B.".$blocName.".".$cle."}", $valeur, $modif);
   						 }
   						 $code.=$modif;
   					 }
   					 $this->templates[$templateName]= str_replace($protoBloc, $code, $this->templates[$templateName]);
   				 }
   			 }
   		 }
   		 //End bloc
   		 
 
   		 
   		 //inclusion
   		 foreach ($this->templateVar as $templateName => $inter)    {
   			 foreach ($inter as $clef => $valeur) {
   				 $varriable="{I.".$clef."}";  
   				 if  (mb_substr_count($this->templates[$templateName], $varriable)==0) {
   					 if ($this->debug==true) {
   						 echo "<div><b>Erreur d'execution : </b> la varriable : <b>$varriable</b> est introuvable dans le template : <b>$templateName</b> dans le moteur <b>templateEngine.php</b> sur la ligne : <b>86</b></div>";
   					 }   					 
   				 }
   				 else {
   					 $this->templates[$templateName]=str_replace ($varriable, $this->templates[$valeur], $this->templates[$templateName]);
   				 }
   			 }
   		 }   	 
   		 //End inclusion  
   		 
   		 //superGlobal
   		 foreach ($this->superGlobalVar as $clef => $valeur) {
   			 $varriable ="{".$clef."}";
   			 if  (mb_substr_count($this->templates[$mainTemplate], $varriable)==0) {
   					 if ($this->debug==true) {
   						 echo "<div><b>Erreur d'execution : </b> la varriable superGlobale : <b>$varriable</b> est introuvable par le moteur : <b>templateEngine.php</b> sur la ligne : <b>168</b></div>";
   					 }   					 
   			 }
   			 else  {
   				 $this->templates[$mainTemplate]=str_replace ($varriable, $valeur, $this->templates[$mainTemplate]);
   			 }
                    	}
   		 //End superGlobal
                   	 
                    	//déstruction des commentaire//

                    	while (mb_substr_count($this->templates[$mainTemplate], "<!-- BEGIN")!=0) {
                            	$pos1= strpos ($this->templates[$mainTemplate], "<!-- BEGIN");
                            	$pos2= strpos ($this->templates[$mainTemplate], " -->")+4;
                            	$taille = $pos2-$pos1;
                          	 
                            	$com =substr ($this->templates[$mainTemplate], $pos1, $taille);
                           	$this->templates[$mainTemplate] =  str_replace ($com , "", $this->templates[$mainTemplate]);
                          	 
                            	$pos1= strpos ($this->templates[$mainTemplate], "<!-- END");
                            	$pos2= strpos ($this->templates[$mainTemplate], " -->")+4;
                            	$taille = $pos2-$pos1;
                          	 
                            	$com =substr ($this->templates[$mainTemplate], $pos1, $taille);
                           	$this->templates[$mainTemplate] =  str_replace ($com , "", $this->templates[$mainTemplate]);
                    	}
                   	 
                    	while (mb_substr_count($this->templates[$mainTemplate], "<!-- IF")!=0) {
                            	$pos1= strpos ($this->templates[$mainTemplate], "<!-- IF");
                            	$pos2= strpos ($this->templates[$mainTemplate], "<!-- END_IF -->");
                            	$taille = $pos2-$pos1;
                          	 
                            	$com =substr ($this->templates[$mainTemplate], $pos1, $taille);
                            	 
                           	$this->templates[$mainTemplate] =  str_replace ($com , "", $this->templates[$mainTemplate]);
                    	}

           	 
                    	//END déstruction des commentaires  
   		 echo $this->templates[$mainTemplate];
   	 }
   	 
    }
    
 
?>
