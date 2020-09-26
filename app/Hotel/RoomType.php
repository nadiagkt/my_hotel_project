<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class RoomType extends BaseService  {

     public function getAllTypes(){

        return $this->fetchAll("SELECT * FROM room_type");
    }

    public static function findValueFromArrayKey($array = [], $key = ''){
        
        foreach ($array as $arrayElement){
          if($arrayElement['type_id'] == $key){
            $value = $arrayElement['title'] ;
          }
        }
        return $value;
    }
}

?>