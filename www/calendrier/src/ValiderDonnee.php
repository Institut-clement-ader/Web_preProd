<?php
class ValiderDonnee{

    private $data;
    private $errors = [];


    public function validates(array $data){
        $this->error=[];
        $this->data=$data;
        $this->validate('name','minLength',3);
        return $this->errors;
    }

    public function validate(string $field, string $method,... $parameters){
        if(isset($this->data[$fiels])){
            $this->errors[$field] = "le champs $field n'est pas rempli";
        }else{
            call_user_func([$this,$method],$field,... $parameters);
        }
    }

    public function minLength(string $field, int $length){
        if(nb_strlen($field) < $length){
            $this->errors[$field]= "Le champs doit avoir plus de $length caractère";
        }
    }
}


?>