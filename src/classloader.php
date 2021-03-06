<?php
/** Universal stackable classloader.
*
* @version SVN: $Id: classloader.php 271 2018-03-25 16:17:22Z anrdaemon $
*/

namespace AnrDaemon\Minecraft;

return \call_user_func(function()
{
  $nsl = \strlen(__NAMESPACE__);
  return \spl_autoload_register(
    function($className)
    use($nsl)
    {
      if(\strncmp($className, __NAMESPACE__, $nsl) !== 0)
        return;

      $className = \substr($className, $nsl);
      if(\strlen($className) < 2)
        return;

      $path = \realpath(__DIR__ . \strtr("$className.php", '\\', '/'));
      if(!empty($path))
      {
        return include_once $path;
      }
    }
  );
}
);
