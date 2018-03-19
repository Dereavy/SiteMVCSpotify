<?php
class Spotify {

   // * Lien API de spotify

  const API_URL = 'http://ws.spotify.com';

  private static $_extras = array('album', 'albumdetail', 'track', 'trackdetail');
 
   // * Rechercher artist par son nom

  public static function searchArtist($name, $page = 1) {
    return self::_makeCall('/search/1/artist', array('q' => $name, 'page' => $page));
  }

   // * Rechercher album par son nom

  public static function searchAlbum($title, $page = 1) {
    return self::_makeCall('/search/1/album', array('q' => $title, 'page' => $page));
  }

  // * Rechercher chanson par son nom

  public static function searchTrack($title, $page = 1) {
    return self::_makeCall('/search/1/track', array('q' => $title, 'page' => $page));
  }

  public static function lookup($uri, $detail = null) {
    $params = array('uri' => $uri);
    if (isset($detail) && in_array($detail, self::$_extras)) {
      $params['extras'] = $detail;
    }
    return self::_makeCall('/lookup/1/', $params);
  }

   // * Retourne l'URI de spotify

  public static function getUri($obj, $count = 0) {
    if (true === is_object($obj)) {
      $array = self::_objectToArray($obj);
      $type = $array['info']['type'] . 's';
      return $array[$type][$count]['href'];
    } else {
      throw new Exception("Error: getUri() - Requires JSON object returned by a search method.");
    }
  }
  
   // * Convertir JSON => array

  private static function _objectToArray($object) {
    if (!is_object($object) && !is_array($object)) {
      return $object;
    }
    if (is_object($object)) {
      $object = get_object_vars($object);
    }
    return array_map(array(self, '_objectToArray'), $object);
  }

   // * Faire un appel a l'API

  private static function _makeCall($function, $params) {
    $params = '.json?' . utf8_encode(http_build_query($params));
    $apiCall = self::API_URL.$function.$params;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiCall);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    
    $jsonData = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($jsonData);
  }
}