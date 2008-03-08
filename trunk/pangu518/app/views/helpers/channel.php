<?php
class ChannelHelper extends Helper {
   function display() {
      //This extracting only the name of the menu from the multidimentional array.
      //$content = Set::extract($this->data['Channel'], '{n}.Channel.channel_name'); 
      $ret = '<li>'.implode('</li><li>', $content).'</li>';
      $ret = '<ul>'.$ret.'</il>'
	  $ret = 'dddd'.$ret;
      return $ret;
   }
}
?>