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

  public function update($new, $filepath){
    $data = $this->data;

    $data = array_merge($data, $new); //merge dengan new akan update $data jika punya key yang sama di $new

    //dibawah ini untuk cetak format file ini ke dalam string $content
    $content ='';
    foreach($data as $section=>$values){
      //append section 
      $content .= "[".$section."]\n"; 
      //append values
      if(isset($values)){
        foreach($values as $key=>$value){
          $content .= $key."=".$value."\n"; 
        }
      }
      $content .= "\n";
    }

    //write ke file
    if (!$handle = fopen($filepath, 'w')) { 
      return false; 
    }
    fwrite($handle, $content);
    fclose($handle);  
  }

}