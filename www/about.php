<?php

$ipaddress = $_SERVER['REMOTE_ADDR'];
$date = new DateTime();
$timeStamp = $date->getTimestamp();

?>
<pre>
{
  "client": {
    "host": "<?php echo $ipaddress ?>"
  },
  "server": {
    "current_time": <?php echo $timeStamp ?>,
    "services": [{
        "name": "Weather",
        "widgets": [{
            "name": "City Weather",
            "description": "Display temperature for a city with small description.",
            "params": [{
                "name": "city",
                "type": "string"
            }]
        }]
    }, {
        "name": "Youtube",
        "widgets": [{
            "name": "Load Video",
            "description": "Load video by Id.",
            "params": [{
                "name": "youtube_url",
                "type": "string"
            }]
        }, {
            "name": "Get Video Views",
            "description": "Get video likes & dislikes by Id.",
            "params": [{
                "name": "youtube_url",
                "type": "string"
            }]
        }]
    }, {
        "name": "Nasa",
        "widgets": [{
            "name": "APOD",
            "description": "The Astronomy Picture of the Day.",
            "params": [{
                "name": "day",
                "type": "string"
            }]
        }]
    }, {
        "name": "Cinema",
        "widgets": [{
            "name": "Get Movie Infos",
            "description": "Get movie information by name.",
            "params": [{
                "name": "name",
                "type": "string"
            }]
        }]
    }, {
        "name": "Get a Joke",
        "widgets": [{
            "name": "Get A Joke",
            "description": "Get Chuck Norris' joke by word.",
            "params": [{
                "name": "word",
                "type": "string"
            }]
        }]
    }]
  }
}
</pre>