<?php

$ipaddress = $_SERVER['REMOTE_ADDR'];
$date = new DateTime();
$timeStamp = $date->getTimestamp();

?>

{
  "client": {
    "host": <?php echo $ipaddress ?>
  },
  "server": {
    "current_time":  <?php echo $timeStamp ?>,
    "services": [{
        "name": "weather",
        "widgets": [{
            "name": "weatherWidget",
            "description": "Display temperature for a city with small description.",
            "params": [{
                "name": "cityWeather",
                "type": "string"
            }]
        }]
    }, {
        "name": "youtube",
        "widgets": [{
            "name": "loadVideo",
            "description": "Load video by Id.",
            "params": [{
                "name": "videoId",
                "type": "string"
            }]
        }, {
            "name": "getVideoLikesDislikes",
            "description": "Get video likes & dislikes by Id.",
            "params": [{
                "name": "videoId",
                "type": "string"
            }]
        }]
    }, {
        "name": "steam",
        "widgets": [{
            "name": "getPlayerInformation",
            "description": "Get player information by Id.",
            "params": [{
                "name": "playerId",
                "type": "string"
            }]
        }]
    }, {
        "name": "cinema",
        "widgets": [{
            "name": "getMovieInformation",
            "description": "Get movie information by name.",
            "params": [{
                "name": "movieName",
                "type": "string"
            }]
        }]
    }, {
        "name": "joke",
        "widgets": [{
            "name": "getChuckNorrisJoke",
            "description": "Get Chuck Norris joke by word.",
            "params": [{
                "name": "jokeWord",
                "type": "string"
            }]
        }]
    }]
  }
}