<?php

// 3. Agregar la clase "Actor" con sus correspondientos atributos y métodos

class Actor {
  // Atributos:
  protected $id;
  protected $first_name;
  protected $last_name;
  protected $rating;
  protected $favorite_movie_id;

  // Métodos:

  //Creo el constructor:
  public function __construct($first_name, $last_name, $rating, $favorite_movie_id = NULL)
  {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->rating = $rating;
    $this->favorite_movie_id = $favorite_movie_id;
  }

  // Creo los getters y setters:
  public function getID(){
    return $this->id;
  }
  public function setID($id){
    $this->id = $id;
  }

  public function getFirst_name(){
    return $this->first_name;
  }
  public function setFirst_name($first_name){
    $this->first_name = $first_name;
  }

  public function getLast_name(){
    return $this->last_name;
  }
  public function setLast_name($last_name){
    $this->last_name = $last_name;
  }

  public function getRating(){
    return $this->rating;
  }
  public function setRating($rating){
    $this->rating = $rating;
  }

  public function getFavorite_movie_id(){
    return $this->favorite_movie_id;
  }
  public function setFavorite_movie_id($favorite_movie_id){
    $this->favorite_movie_id = $favorite_movie_id;
  }

}

?>
