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
