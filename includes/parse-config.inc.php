<?php



class Config{
  protected $data;
  protected $default;

  public function load($filepath){
    $this->data = parse_ini_file($filepath, true);
  }

  public function get($key, $default = null){
    $this->default = $default;

    $segments = explode('.', $key);
    $data = $this->data;

    foreach ($segments as $segment) {
      if(isset($data[$segment])){
        $data = $data[$segment];
      }
      else {
        $data = $this->default;
        break;
      }
      
    }

    return $data;
  }

}

function updateConfig($data, $filepath){
  $content = ""; 
        
  //parse the ini file to get the sections
  //parse the ini file using default parse_ini_file() PHP function
  $parsed_ini =parseConfig($filepath);
  
  foreach($data as $section=>$values){
    //append the section 
    $content .= "[".$section."]n"; 
    //append the values
    foreach($values as $key=>$value){
        $content .= $key."=".$value."n"; 
    }
  }

  //write it into file
  if (!$handle = fopen($filepath, 'w')) { 
    return false; 
  }
  $success = fwrite($handle, $content);
  fclose($handle); 
  return $success;
}