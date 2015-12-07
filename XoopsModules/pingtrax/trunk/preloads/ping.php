<?php
/**
 * PingTrax Preloads
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   Chronolabs Cooperative http://sourceforge.net/projects/chronolabs/
 * @license     GNU GPL 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @author      Simon Antony Roberts <wishcraft@users.sourceforge.net>
 * @see			http://sourceforge.net/projects/xoops/
 * @see			http://sourceforge.net/projects/chronolabs/
 * @see			http://sourceforge.net/projects/chronolabsapi/
 * @see			http://labs.coop
 * @version     1.0.1
 * @since		1.0.1
 */

defined('XOOPS_ROOT_PATH') || die('XOOPS root path not defined');

/**
 * Class PingtraxPingPreload
 */
class PingtraxPingPreload extends XoopsPreloadItem
{
    /**
     * @param $args
    
    function eventCoreIncludeFunctionsRedirectheader($args)
    {
        $context = stream_context_create(array('http' => array(
       'method' => "POST",
       'header' => "Content-Type: text/xml\r\n",
       'content' => $xml
   )));
   $file = @file_get_contents($post_to, false, $context);
   if ($file === false) { echo '<p>Couldn\'t connect!</p>'; }
   elseif ($file) {
       echo '<p>The following response was returned:</p>';
      echo '<pre>'.htmlspecialchars($file).'</pre>';
  } else {
      echo '<p>Empty response!</p>';
  }
    }
    
    
1.   <?xml version="1.0"?>
2.   <methodCall>
3.     <methodName>weblogUpdates.extendedPing</methodName>
4.     <params>
5.       <param>
6.         <value>Example Blog</value>
7.       </param>
8.       <param>
9.         <value>http://www.example.com/blog/</value>
10.      </param>
11.      <param>
12.        <value>http://www.example.com/blog/new-post.html</value>
13.      </param>
14.      <param>
15.        <value>http://www.example.com/blog/feed.xml</value>
16.      </param>
17.    </params>
18.  </methodCall>
 	*/
   
}
