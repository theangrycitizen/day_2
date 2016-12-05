<?php




	// Compress Style Files

	$style = fopen("resource/style.css", "w");
	$stylefiles = glob("resource/style/*");

    foreach($stylefiles as $stylefile)
    {
        $in = fopen($stylefile, "r");
        
    	while ($line = fgets($in))
    	{
        	fwrite($style, $line);
        }
        
        fclose($in);
    }
    
    fclose($style);
    
    
    
    
    // Compress Script Files

	$script = fopen("resource/script.js", "w");
	$scriptfiles = glob("resource/script/*");

    foreach($scriptfiles as $scriptfile)
    {
        $in = fopen($scriptfile, "r");
        
    	while ($line = fgets($in))
    	{
        	fwrite($script, $line);
        }
        
        fclose($in);
    }
    
    fclose($script);
    
?>