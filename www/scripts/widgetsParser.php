<?php

  require_once('callApi.php');

  class widgetsParser {

    function __construct() {
    }

    function chuckNorrisWidget($value) {
      $api = new Api();
      $joke = $api->callApi('GET', "https://api.chucknorris.io/jokes/search?query=$value");
      $object = json_decode($joke);
      $result = $object->result[0]->value;
      return $result;
    }

    function weatherWidget($value) {
      $api = new Api();
      $weather = $api->callApi('GET', "https://api.openweathermap.org/data/2.5/weather?q=$value&appid=176220bfd4e85bd960573d3056b0c7c7&units=metric");
      $object = json_decode($weather);
      $result['description'] = $object->weather[0]->description;
      $result['name'] = $object->name;
      $result['temp'] = $object->main->temp;
      $result['temp_min'] = $object->main->temp_min;
      $result['temp_max'] = $object->main->temp_max;
      return $result;
    }

    function steamWidget($value) {
      $api = new Api();
      $steam = $api->callApi('GET', "https://cors-anywhere.herokuapp.com/http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=5BB9963627E6F058FD82D28B3C3C297B&steamids=$value");
      // $object = json_decode($steam);
      // $result= $object->weather[0]->description;
      return $steam;
    }

    function moviesWidget($value) {
      $api = new Api();
      $movie = $api->callApi('GET', "https://api.themoviedb.org/3/search/movie?api_key=15aebf8988e79f2453c6e3afb8845bca&query=$value");
      $object = json_decode($movie);
      $result['name'] = $object->results[0]->title;
      $result['overview'] = $object->results[0]->overview;
      $result['release_date'] = $object->results[0]->release_date;
      $result['poster_path'] = $object->results[0]->poster_path;
      return $result;
    }

    function youtubeInfoWidget($value) {
      $api = new Api();
      $view = $api->callApi('GET', "https://www.googleapis.com/youtube/v3/videos?part=statistics&id=$value&key=AIzaSyDbB8TFiUCVdenG1rk8ObLdBQFkTIMwtBw");
      $object = json_decode($view);
      $result['view_count'] = $object->items[0]->statistics->viewCount;
      $result['like_count'] = $object->items[0]->statistics->likeCount;
      $result['dislike_count'] = $object->items[0]->statistics->dislikeCount;
      return $result;
    }

    function youtubeVideoWidget($value) {
      return $value;
    }
  }

?>