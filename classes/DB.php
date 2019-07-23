<?php

	abstract class DB
	{
		public static function getAllMovies()

		{
			global $connection;

			$stmt = $connection->prepare("
				SELECT m.id AS 'movie_id', m.title, m.rating, m.awards, m.release_date, m.length, g.name AS 'genre'
				FROM movies as m
				LEFT JOIN genres as g
				ON g.id = m.genre_id
				ORDER BY m.title;
			");

			$stmt->execute();

			$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$moviesObject = [];

			foreach ($movies as $movie) {
				$finalMovie = new Movie($movie['title'], $movie['rating'], $movie['awards'], $movie['release_date']);

				$finalMovie->setLength($movie['length']);

				// 2. Corregir en el método getAllMovies la asignación de id de la película y el id del género:

				//$finalMovie->setGenreID($movie['movie_id']);
				$finalMovie->setID($movie['movie_id']);

				$finalMovie->setGenreName($movie['genre']);

				$moviesObject[] = $finalMovie;
			}

			return $moviesObject;
		}

		public static function getAllGenres()
		{
			global $connection;

			$stmt = $connection->prepare(" SELECT id, name, ranking, active FROM genres");

			$stmt->execute();

			$genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$genresObject = [];

			foreach ($genres as $genre) {
				$finalGenre = new Genre($genre['name'], $genre['ranking'], $genre['active']);

				$finalGenre->setID($genre['id']);

				$genresObject[] = $finalGenre;
			}

			return $genresObject;
		}




// 4. Agregar los métodos necesarios en la clase DB para obtener todos los actores y para guardar un actor:
// PARTE A: Obtener todos los actores

		public static function getAllActors()
		{
			global $connection;

			$stmt = $connection->prepare(" SELECT id, first_name, last_name, rating FROM actors ");

			$stmt->execute();

			$actors = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$actorsObject = [];

			foreach ($actors as $actor) {
				$finalActor = new Actor($actor['first_name'], $actor['last_name'], $actor['rating']);

				$finalActor->setID($actor['id']);

				$actorsObject[] = $finalActor;
			}

			return $actorsObject;
		}


		// 4. Agregar los métodos necesarios en la clase DB para obtener todos los actores y para guardar un actor:
		// PARTE B: Guardar un actor:
		public static function saveActor(Actor $actor)
		{
			global $connection;

			try {
				$stmt = $connection->prepare("
					INSERT INTO actors (first_name, last_name, rating, favorite_movie_id)
					VALUES(:first_name, :last_name, :rating, :favorite_movie_id)
				");

				$stmt->bindValue(':first_name', $actor->getFirst_name());
				$stmt->bindValue(':last_name', $actor->getLast_name());
				$stmt->bindValue(':rating', $actor->getRating());
				$stmt->bindValue(':favorite_movie_id', $actor->getFavorite_movie_id());

				$stmt->execute();

				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}






		public static function saveMovie(Movie $movie)
		{
			global $connection;

			try {
				$stmt = $connection->prepare("
					INSERT INTO movies (title, rating, awards, release_date, length, genre_id)
					VALUES(:title, :rating, :awards, :release_date, :length, :genre_id)
				");


				$stmt->bindValue(':title', $movie->getTitle());
				$stmt->bindValue(':rating', $movie->getRating());
				$stmt->bindValue(':awards', $movie->getAwards());
				$stmt->bindValue(':release_date', $movie->getReleaseDate());
				$stmt->bindValue(':length', $movie->getLength());
				$stmt->bindValue(':genre_id', $movie->getGenreID());

				$stmt->execute();

				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}

		public static function saveGenre(Genre $genre)
		{
			global $connection;

			$genres = self::getAllGenres();

			$finalGenres = [];

			foreach ($genres as $oneGenre) {
				$finalGenres[] = $oneGenre->getName();
			}

			if (!in_array($genre->getName(), $finalGenres)) {
				$stmt = $connection->prepare("
					INSERT INTO genres (name, ranking, active)
					VALUES(:name, :ranking, :active)
				");

				$stmt->bindValue(':name', $genre->getName());
				$stmt->bindValue(':ranking', $genre->getRanking());
				$stmt->bindValue(':active', $genre->getActive());

				$stmt->execute();

				return true;
			} else {
				return false;
			}
		}
	}
