<?php
if (! function_exists('checkurl')) {
  function checkurl ($url) {
    if(empty(trim($url))) return false;
    if( ! preg_match('/^http(s)?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $url) ){
        return false;
    }
    $client = new GuzzleHttp\Client(['http_errors' => false]);
    $res = $client->request('GET', $url);
    $status = $res->getStatusCode();
    return $status === 200;
  }
}


if (! function_exists('getbody')) {
  function getbody ($url) {
    $client = new GuzzleHttp\Client(['http_errors' => false]);
    $res = $client->request('GET', $url);
    return $res->getBody()->getContents();
  }
}


if (! function_exists('useDarkText')) {
  function useDarkText($hex) {
    if ($hex[0] === '#') $hex = substr($hex, 1, 7);
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    $squared_contrast = (
        $r * $r * .299 +
        $g * $g * .587 +
        $b * $b * .114
    );
    return $squared_contrast > pow(139, 2);
  }
}


if (! function_exists('xmlToJson')) {
  function xmlToJson($xml) {
    return json_decode(json_encode(simplexml_load_string($xml)), TRUE);
  }
}

if (! function_exists('parse_query')) {
  function parse_query($url) {
    parse_str(parse_url($url)['query'], $query);
    return $query;
  }
}

if (! function_exists('upload_image')) {
  // path
  // width
  // height
  // quality
  function upload_image($r, $o) {
    if ($o['square']) $o['height'] = null;
    $file = $r->file('photo');
    $path = $file->hashName('public' . $o['path']);
    $img = \Image::make($file);
    $img->fit($o['width'], $o['height'], function ($constraint) {
        $constraint->aspectRatio();
      })
      ->encode('jpg', (string) $o['quality']);
    \Storage::put($path, (string) $img->encode(), 'public');
    return \Storage::cloud()->url($path);
  }
}

if (! function_exists('liveOnTwitch')) {
  function liveOnTwitch($username) {
    $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/streams?user_login=" . urlencode($username));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

          curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/vnd.twitchtv.v5+json',
            'Client-ID: '. env('TWITCH_HELIX_KEY')
          ]);
    $result = json_decode(curl_exec($ch));
    curl_close($ch);
    if (isset($result->data)) {
      return count($result->data) > 0;
    } else {
      return false;
    }
  }
}

if (! function_exists('getTwitchUserByLogin')) {
  function getTwitchUserByLogin($channel) {
    $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/kraken/users?login=" . urlencode($channel));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
          curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/vnd.twitchtv.v5+json',
            'Client-ID: '. env('TWITCH_HELIX_KEY')
          ]);
    $result = json_decode(curl_exec($ch));
    curl_close($ch);
    $empty = [
      "display_name" => null,
      "_id" => null,
      "name" => null,
      "type" => null,
      "bio" => null,
      "created_at" => null,
      "updated_at" => null,
      "logo" => null,
    ];
    return $result->users ? json_decode(json_encode($result->users[0])) : json_decode(json_encode($empty));
  }
}

if (! function_exists('getTwitchChannelByUser')) {
  function getTwitchChannelByUser($user) {
    $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/kraken/channels/" . urlencode($user));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
          curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/vnd.twitchtv.v5+json',
            'Client-ID: '. env('TWITCH_HELIX_KEY')
          ]);
    $result = json_decode(curl_exec($ch));
    curl_close($ch);
    return $result;
  }
}

if (! function_exists('getTwitchStreamByUser')) {
  function getTwitchStreamByUser($user) {
    $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/streams?user_id=" . urlencode($user));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
          curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/vnd.twitchtv.v5+json',
            'Client-ID: '. env('TWITCH_HELIX_KEY')
          ]);
    $result = json_decode(curl_exec($ch));
    curl_close($ch);
    return $result;
  }
}

function getYoutubeUploadsFromChannel($channel) {
  $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&id=". $channel ."&key=" . env('YOUTUBE_KEY'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  $result = json_decode(curl_exec($ch));
  curl_close($ch);
  dump($result);
  return isset($result->items) ? $result->items[0]->contentDetails->relatedPlaylists->uploads : (object)[];
}

function getYoutubeVideosFromPlaylist($playist, $max=10) {
  $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$max&playlistId=". $playist ."&key=" . env('YOUTUBE_KEY'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  $result = json_decode(curl_exec($ch));
  curl_close($ch);
  return isset($result->items) ? $result->items : (object)[];
}

function getYoutubeVideoStats($video) {
  $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/youtube/v3/videos?part=statistics&id=". $video ."&key=" . env('YOUTUBE_KEY'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  $result = json_decode(curl_exec($ch));
  curl_close($ch);
  return isset($result->items) ? $result->items[0]->statistics : (object)[];
}

if (! function_exists('in_array_r')) {
  function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
  }
}

if (!function_exists('pluck_r')) {
  function pluck_r($key, $arr) {
    $res=[];
    foreach($arr as $item) {
      if (isset($item[$key])) {
        array_push($res, $item[$key]);
        if (count($item['list']) > 0) {
          $res = array_merge($res, pluck_r($key, $item['list']));
        }
      }
    }
    return $res;
  }
}

function renderCategoryDesc($category, $divider=" > ", $res="") {
  if (!$category) return "-";
  $res = $category->name . $res;
  if ($category->parent) {
    $res = $divider . $res;
    $res = renderCategoryDesc($category->parent, $divider) . $res;
  }
  return $res;
}