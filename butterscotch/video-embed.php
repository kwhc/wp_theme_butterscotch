<?php 
$videoid=get_post_meta($post->ID,'videoID',true);
echo "<iframe src='http://player.vimeo.com/video/",$videoid,"?title=0&amp;byline=0&amp;portrait=0&amp;color=610813' width='640' height='361' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen class='video'></iframe>";

?>