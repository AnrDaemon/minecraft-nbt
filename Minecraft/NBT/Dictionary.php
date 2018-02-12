<?php
/** NBT dictionary and conversion tools
*
*
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

define('_IS_BE', unpack('v', pack('S', 1))[1] > 1);

final class Dictionary
{
  private static $typeMap;
  private static $nameMap;

  public function __construct()
  {
    if(!isset(self::$typeMap))
      self::init();
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
      "\xB" => __NAMESPACE__ . '\TAG_Int_Array',
    );

    self::$nameMap = array_flip(self::$typeMap);
  }

  public static function mapType($type)
  {
    if(!isset(self::$typeMap[$type]))
      throw new \OutOfBoundsException("Unknown tag type 0x" . bin2hex($type));

    return self::$typeMap[$type];
  }

  public static function mapName($name)
  {
    $tag = self::$nameMap[$name] ?? self::$nameMap[__NAMESPACE__ . "\\$name"] ?? null;
    if(!isset($tag))
      throw new \OutOfBoundsException("Unknown tag name '$name'");

    return $tag;
  }

// unpack() wrapper, because damned "machine byte order"
  public static function convert($value)
  {
    return _IS_BE ? $value : strrev($value);
  }
}

return new Dictionary;
