<?php

	class Movie
	{
		// Agrego el atributo $id a la clase Movie
		private $id;
		private $title;
		private $rating;
		private $awards;
		private $release_date;
		private $length;
		private $genre_id;
		private $genre_name;

		public function __construct($title, $rating, $awards, $release_date)
		{
			$this->title = $title;
			$this->rating = $rating;
			$this->awards = $awards;
			$this->release_date = $release_date;
		}

		// 1. Agregar en la clase Movie los métodos getId y setId:
		// Agrego el getter del atributo $id:
		public function getID(){
			return $this->id;
		}
		// Agrego el setter del atributo $id:
		public function setID($id){
			$this->id = $id;
		}


		public function setTitle($title)
		{
			$this->title = $title;
		}

		public function getTitle()
		{
			return $this->title;
		}

		public function setRating($rating)
		{
			$this->rating = $rating;
		}

		public function getRating()
		{
			return $this->rating;
		}

		public function setAwards($awards)
		{
			$this->awards = $awards;
		}

		public function getAwards()
		{
			return $this->awards;
		}

		public function setReleaseDate($release_date)
		{
			$this->release_date = $release_date;
		}

		public function getReleaseDate()
		{
			return $this->release_date;
		}

		public function setLength($length)
		{
			$this->length = $length;
		}

		public function getLength()
		{
			return $this->length;
		}

		public function setGenreName($genre_name)
		{
			$this->genre_name = $genre_name;
		}

		public function getGenreName()
		{
			if ($this->genre_name) {
				return $this->genre_name;
			}
			return 'Sin género';
		}

		public function setGenreID($genre_id)
		{
			$this->genre_id = $genre_id;
		}

		public function getGenreID()
		{
			return $this->genre_id;
		}
	}
