<?php

/*
 * CSV Class by Max Felker | felkerm@gmail.com
 * 
 * For parsing CSVs into an usuable PHP array
 * 
*/

class CSV {
	
    public $delimiter = ',';
	public $enclosure = '"';
	
	/* parse()
	 * 
	 * Parses the CSV and returns it as an array
	 * 
	 * @param $file : string : required
	 * @param $delimiter : string : optional
	 * @param $enclosure : string : optional
	*/
	
    public function parse($file,$delimiter,$enclosure) {
    	
		// if file doesn't exist, fail
		if(!is_file($file)) {
			die("CSV Parse Failed: Passed $file which does not exist or is not readable by the server");
		}
    	
		// instantiate temp object
		$CSV = new CSV();
		
		// if delimiter override, set it
		if($delimiter) {
			$CSV->delimiter = $delimiter;		
		}
		
		// if enclosure override, set it
		if($enclosure) {
			$CSV->$enclosure = $enclosure;		
		}
		
		// Create Return Array
		$csv = array();
		
		// Line Lenght Info
		$csv['line_count'] = 0;
		$csv["line_length"] = trim(`awk '{ if ( length > x ) { x = length } }END{ print x }' '$file'`);
		
		// Headers & Rows
		$csv['headers'] = array();
		$csv['rows'] = array();
    	
		// Open the file
    	$file_hook = fopen($file, "r");
		
		// if the file was opened
		if($file_hook){
			
			// get the first line 
			while (($buffer = fgets($file_hook)) !== false) {
		    	
				// get the headers if they're not set
	    		if(!$csv['headers']) {
	    			$csv['headers'] = explode($CSV->delimiter,trim($buffer));
	    		} else {
	    			break;
	    		}
				
		    } 
			
			// set the row number
			$row_number = 0;
			
			// while loop on the file
			while (!feof($file_hook)) {

				// add line data to row in return array
				$row_number++;
				$csv['line_count']++;
				$csv['rows'][$row_number] = fgetcsv($file_hook, $line_length,$CSV->delimiter,$CSV->enclosure);
				
				// loop through and map field to header
				foreach($csv['rows'][$row_number] as $id => $value) {
					
					// set header / cell association 
					$csv['rows'][$row_number][$csv['headers'][$id]] = $value;
					unset($csv['rows'][$row_number][$id]);
					
				} // end loop
			
			} // end while loop on file
			
			
		} //end if file opened
		
		// close file
		fclose($file);
	
		return $csv;
		
    } // end parse()
	
} // end CSV

?>