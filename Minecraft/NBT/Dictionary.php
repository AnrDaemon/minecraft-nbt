<?php
/** NBT dictionary and conversion tools
*
*
*
* @version $Id: Dictionary.php 177 2016-07-17 23:33:03Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

define('_IS_BE', unpack('v', pack('S', 1))[1] > 1);

use
  BadMethodCallException, OutOfBoundsException;

final class Dictionary
{
  private static $typeMap;

  private function __construct()
  {
    throw new BadMethodCallException('May not initialize tools class.');
  }

  private static function init()
  {
    self::$typeMap = array(
      "\x0" => __NAMESPACE__ . '\TAG_End',
      "\x1" => __NAMESPACE__ . '\TAG_Byte',
      "\x2" => __NAMESPACE__ . '\TAG_Short',
      "\x3" => __NAMESPACE__ . '\TAG_Int',
      "\x4" => __NAMESPACE__ . '\TAG_Long',
      "\x5" => __NAMESPACE__ . '\TAG_Float',
      "\x6" => __NAMESPACE__ . '\TAG_Double',
      "\x7" => __NAMESPACE__ . '\TAG_Byte_Array',
      "\x8" => __NAMESPACE__ . '\TAG_String',
      "\x9" => __NAMESPACE__ . '\TAG_List',
      "\xA" => __NAMESPACE__ . '\TAG_Compound',
      "\xB" => __NAMESPACE__ . '\TAG_Int_Array'
    );
  }

  public static function mapType($type)
  {
    if(!is_array(self::$typeMap))
      self::init();

    if(!isset(self::$typeMap[$type]))
      throw new OutOfBoundsException("Unknown tag type " . ord($type));

    return self::$typeMap[$type];
  }

  public static function mapName($name)
  {
    if(!is_array(self::$typeMap))
      self::init();

    $tag = array_search($name, self::$typeMap);
    if($tag === false)
      $tag = array_search(__NAMESPACE__ . "\\$name", self::$typeMap);

    if($tag === false)
      throw new OutOfBoundsException("Unknown tag name " . ord($type));

    return $tag;
  }

// unpack() wrapper, because damned "machine byte order"
  public static function convert($value)
  {
    return _IS_BE ? $value : strrev($value);
  }
}
