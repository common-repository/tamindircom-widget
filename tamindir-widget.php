<?php
/*
Plugin Name: Tamindir RSS Bileşeni
Plugin URI: http://www.tamindir.com
Description: Tamindir RSS bileşen desteği kaldırılmıştır. Özel reklam istekleriniz için bizimle iletisim@tamindir.com adresinden irtibata geçebilirsiniz.
Version:3.1.5
Author: Tamindir
Author URI: http://www.tamindir.com
License: All Free
*/

// Sabitler  Eger bir sorun varsa sayfayi yoket.
defined('ABSPATH') or die("Bu bölüme erişim izniniz yok.");
defined("DS") or define("DS", DIRECTORY_SEPARATOR);

/*

define('TAMINDIR', 'http://www.tamindir.com/');
define('REF2', 'tamindir');
define('WEBSITE', $_SERVER['SERVER_NAME']);
define('BLOGURI', get_bloginfo('url'));

// Widget Tanit
add_action('widgets_init','tamindir_widget');
function tamindir_widget() { register_widget('Tamindir'); }

// Ana Sablon
class Tamindir extends WP_Widget {
	  function __construct() {
		  $widget_ops = array('classname'=> 'tamindir_rss','description' => 'Tamindir.com sitesinden içerikleri RSS ile çekiniz.' );
		  $control_ops = array('width' => 520, 'height' => 450);
		  parent::__construct('tamindir', 'Tamindir RSS Bileşeni',$widget_ops, $control_ops);      
	  }
	  var $tamindir_categories = array(
	  	  'populer' => array( 'title' => 'Popüler Programlar', 'titleiki' => 'Programlar', 'direkturl' => 'http://www.tamindir.com', 'seotitle'=>'En Son Programlar' ,'rss' => 'http://cdn.tamindir.com/rss/' ),
		  'rss' => array( 'title' => 'Son Eklenen Programlar', 'titleiki' => 'Programlar', 'direkturl' => 'http://www.tamindir.com', 'seotitle'=>'En Son Programlar' ,'rss' => 'http://www.tamindir.com/rss' ),
		  'video' => array( 'title' => 'Son Videolar', 'titleiki' => 'Videolar', 'direkturl' => 'http://video.tamindir.com', 'seotitle'=>'Video','rss' => 'http://video.tamindir.com/rss' ),
		  'mobil' => array( 'title' => 'Son Mobil Uygulamalar', 'titleiki' => 'Mobil Uygulamalar', 'direkturl' => 'http://www.tamindir.com/mobil/', 'seotitle'=>'Mobil','rss' => 'http://www.tamindir.com/rss/yeniler/mobil' ),
		  'android' => array( 'title' => 'Son Android Uygulamaları','titleiki' => 'Android Uygulamaları', 'direkturl' => 'http://www.tamindir.com/mobil/android/', 'seotitle'=>'Android' ,'rss' => 'http://www.tamindir.com/rss/yeniler/mobil/?etiket=android' ),
		  'mac' => array( 'title' => 'Son Mac Programları','titleiki' => 'Mac Programları', 'direkturl' => 'http://www.tamindir.com/mac/', 'seotitle'=>'Mac OS' ,'rss' => 'http://www.tamindir.com/rss/yeniler/mac' ),
		  'blog' => array( 'title' => 'Son Blog Yazıları','titleiki' => 'Blog Yazıları', 'direkturl' => 'http://blog.tamindir.com', 'seotitle'=>'Blog' ,'rss' => 'http://blog.tamindir.com/rss' ),
		  'haber' => array( 'title' => 'Teknoloji Haberleri','titleiki' => 'Teknoloji Haberleri', 'direkturl' => 'http://www.tamindir.com/haber', 'seotitle'=>'Haber' ,'rss' => 'http://www.tamindir.com/haber/rss' )				  	
	  );
	  function following() {
	  	$url_dogru = parse_url(BLOGURI);
		$url_al = $url_dogru['host'];
		return $url_al;
	  }
	  function filtering($value, $type){
	  	switch ($type){
			case 'url':
				$value = stripslashes($value);
				return $value;
			break;
			case 'number':
			$value = (int) $value;
				return $value;
			break;
			case 'text':
				$value = htmlspecialchars( strip_tags($value), ENT_QUOTES);
				return $value;
			break;
			default:
				return trim($value);
			break;
		}
	  }	
	  
	  function form($instance) {
		  // select box rss kategorileri - selectbox kaç adet yazı - selectbox tipi (yan menü - geniş menü) - css text
		  $default_csstext = '.tamindir{clear:both;overflow:hidden;}'."\n".'.tamindir h2{font-weight:bold;font-size:13px;padding:14px 2px 3px 2px;margin-bottom: 5px;border-bottom:1px dotted #ccc;background:none;}'."\n".'.tamindir h2 span.tam_logo{ float:right; margin-top:-22px;}'."\n".'.tamindir h2 a:link,.tamindir h2 a:visited {display:block;font-size:13px;font-weight:bold;text-decoration:none;background:none;}'."\n".'.tamindir h2 a:hover,.tamindir h2 a:active{display:block;font-size:13px;font-weight:bold;text-decoration:none;background:none;}'."\n".'.tamindir .tindir{margin-top:5px;text-align:left;clear:both;border-bottom:1px dotted #ccc;}'."\n".'.tamindir .tindir img{margin:5px 10px 5px 5px;background:none; float:left;width:32px;height:32px;}'."\n".'.tamindir .tindir p{ margin-top:5px;}'."\n".'.tamindir .tindir a:link,.tamindir .tindir a:visited {display:block;font-size:12px;font-weight:bold;text-decoration:none;background:none;}'."\n".'.tamindir .tindir a:hover,.tamindir .tindir a:active{display:block;font-size:12px;font-weight:bold;text-decoration:none;background:none;}';
		  $video_csstext = '.tamindir{clear:both;overflow:hidden;}'."\n".'.tamindir h2{font-weight:bold;font-size:13px;padding:14px 2px 3px 2px;margin-bottom: 5px;border-bottom:1px dotted #ccc;background:none;}'."\n".'.tamindir h2 span.tam_logo{ float:right; margin-top:-22px;}'."\n".'.tamindir h2 a:link,.tamindir h2 a:visited {display:block;font-size:13px;font-weight:bold;color:#095d96;text-decoration:none;background:none;}'."\n".'.tamindir h2 a:hover,.tamindir h2 a:active{display:block;font-size:13px;font-weight:bold;color: #333;text-decoration:none;background:none;}'."\n".'.tamindir .tindir{float:left;position:relative;width:100px;height:80px;margin-bottom:5px;text-align:left;text-align:center;}'."\n".'.tamindir .tindir img{border:2px solid #D4D4D4;height:56px;width:90px;background:none;}'."\n".'.tamindir .tindir a:link,.tamindir .tindir a:visited {display:block;font-size:10px;font-weight:bold;color:#095d96;text-decoration:none;background:none;}'."\n".'.tamindir .tindir a:hover,.tamindir .tindir a:active{display:block;font-size:10px;font-weight:bold;color: #333;text-decoration:none;background:none;}.tamindir .tindir .videoikon{width:20px;height:20px;position:absolute;right:7px;top:35px;background:url('.plugins_url( "images/video_ikon.png" , __FILE__ ).') no-repeat top left;z-index:999;}';
		  $tamindir_howmany = array('5','6','7','8','9','10','11','12');
		  		  
		  // Form bolumu
		  $defaults = array('tamindirtitle' => 'Tamindir.com', 'rsscategory' => 'rss','resim' => '1', 'detay' => '1', 'rsslimit' => '12', 'csstext' => $default_csstext);
		  $instance = wp_parse_args( (array) $instance, $defaults );
		  
		  // Form Bilgileri
		  $tamindirtitle = esc_attr($instance['tamindirtitle']);
		  $rsscategory = esc_attr($instance['rsscategory']);
		  if(isset($instance['resim'])) { $resimdurum = '1'; } else { $resimdurum = '0'; }
		  if(isset($instance['detay'])) { $detaydurum = '1'; } else { $detaydurum = '0'; }
		  $rsslimit = $this->filtering($instance['rsslimit'], 'number');
		  if($instance['csstext']) {
		  	$csstext = esc_textarea($instance['csstext']);
		  } else if($instance['rsscategory'] === 'video') {
			$csstext = esc_textarea($video_csstext); 	
		  } else {
		 	$csstext = esc_textarea($default_csstext); 	
		  }
		  ?>

<p>
  <label for="<?php echo $this->get_field_id('tamindirtitle'); ?>">Başlık</label>
  <input class="widefat" id="<?php echo $this->get_field_id('tamindirtitle'); ?>" name="<?php echo $this->get_field_name('tamindirtitle'); ?>" type="text" value="<?php echo $tamindirtitle; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('rsscategory'); ?>">Kategori Seçiniz</label>
  <select class="widefat" id="<?php echo $this->get_field_id( 'rsscategory' ); ?>" name="<?php echo $this->get_field_name( 'rsscategory' ); ?>">
    <?php 
				foreach($this->tamindir_categories as $key => $arg)
				{
					if($rsscategory == $key) { $write = ' selected="selected"'; } else { $write = ""; }
					$output = '<option value="'.$key.'"'.$write.'>'.$arg["title"].'</option>';
					echo $output;
				} ?>
  </select>
</p>
<p>
  <input class="checkbox" type="checkbox" <?php echo checked( $instance['resim'], '1' ); ?> id="<?php echo $this->get_field_id('resim'); ?>" name="<?php echo $this->get_field_name('resim'); ?>" />
  <label for="<?php echo $this->get_field_id('resim'); ?>">Resim görünecek mi?</label>
  <br />
  <input class="checkbox" type="checkbox" <?php checked( $instance['detay'], '1' ); ?> id="<?php echo $this->get_field_id('detay'); ?>" name="<?php echo $this->get_field_name('detay'); ?>" />
  <label for="<?php echo $this->get_field_id('detay'); ?>">Kısa açıklama görünecek mi?</label>
  <br />
</p>
<p>
  <label for="<?php echo $this->get_field_id('rsslimit'); ?>">Yazı Adedi</label>
  <select class="widefat" id="<?php echo $this->get_field_id( 'rsslimit' ); ?>" name="<?php echo $this->get_field_name( 'rsslimit' ); ?>">
    <?php 
				foreach($tamindir_howmany as $arg)
				{
					if($rsslimit == $arg) { $write = ' selected="selected"'; } else { $write = ""; }
					$output = '<option value="'.$arg.'"'.$write.'>'.$arg.'</option>';
					echo $output;
				} ?>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('csstext'); ?>">CSS Ayarları</label>
  <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('csstext'); ?>" name="<?php echo $this->get_field_name('csstext'); ?>"><?php echo $csstext; ?></textarea>
</p>
<?php
	  }
  
	  function update($new_instance, $old_instance) {
		  // RSS'in cekilmesi islemleri
		  if($new_instance['rsscategory'] != $old_instance['rsscategory']) {
			  $clientname = REF2.'_'.$rsscategory;
			  $filename = $clientname.'.xml';
			  $cachefile = plugin_dir_path(__FILE__).'xml/'.$filename; // gerçek yolu bulması için ayarlama yapılması gerekiyor.
			  unlink($cachefile);
			  unlink(md5($cachefile).'.spc');
		  }
		  $new_instance['resim'] = $new_instance['resim'] ? '1' : '0';
		  $new_instance['detay'] = $new_instance['detay'] ? '1' : '0';
		  // widgette update edildiğinde mevcut cachefile sıfırlanacak - silinecek.
		  $new_instance = array_map('strip_tags', $new_instance);
		  $instance = wp_parse_args($new_instance, $old_instance);
		  return $instance;
	  }
  
	  function widget($args, $instance) {
		  extract($args);
		 
		  // Bu bölüm widgetin çıktısının olduğu bölüm
		  $tamindirtitle = esc_attr($instance['tamindirtitle']);
		  $rsslimit = $this->filtering($instance['rsslimit'], 'number');
		  $def_css = str_replace('tamindir', $widget_id, esc_textarea($instance['csstext']));
		  $csstext = $def_css;
		  $resimdurum = $instance['resim'];
		  $detaydurum = $instance['detay'];
		  $rsscategory = esc_attr($instance['rsscategory']);
		  if($detaydurum == '1') {
		  	$detay = '&dsec=datr';
		  } else {
		  	$detay = '';
		  }
		  // Default widgets
		  $before_widgets = $before_widget."\n".'<div class="'.$widget_id.'">'."\n";
		  $after_widgets = '</div><!--/tamindir -->'.$after_widget;
		  $addcss = '<style type="text/css"><!-- /*Tamindir.com CSS* /'."\n".$csstext."\n".'-->'."\n".'</style>'."\n";
		  
		  // RSS'in cekilmesi islemleri
		  $clientname = REF2.'_'.$rsscategory;
		  if( 'android' == $rsscategory){
			$clienturl = $this->filtering($this->tamindir_categories[$rsscategory]["rss"].'&limit=12'.$detay.'&'.REF2.'='.WEBSITE.'', 'url');
		  } else if('populer' == $rsscategory){
			$clienturl = $this->filtering($this->tamindir_categories[$rsscategory]["rss"].WEBSITE.'', 'url');
		  } else {
			$clienturl = $this->filtering($this->tamindir_categories[$rsscategory]["rss"].'?limit=12'.$detay.'&'.REF2.'='.WEBSITE.'', 'url');
		  }
		  
		  $filename = $clientname.'.xml';
		  if ($rsscategory == 'video'){
		  	$defaultfile = plugin_dir_path(__FILE__).'xml/tamindir_video_standart.xml'; // varsayılan dosya ismi
		  } else {
		  	$defaultfile = plugin_dir_path(__FILE__).'xml/tamindir_standart.xml'; // varsayılan dosya ismi
		  }
		  $cachefile = plugin_dir_path(__FILE__).'xml/'.$filename; // gerçek yolu bulması için ayarlama yapılması gerekiyor.
		  $cachetime = 1 * 60 * 60; // 1 saatte bir
		  $findtime = time() - $cachetime;
		  if (file_exists($cachefile)) {
		  	$cachefiletime = filemtime($cachefile);
		  } else {
		    $cachefiletime = time();
		  }
	  
		  // $result = 1 ->storedata->true, 2->cachefile->false, 3->simplepie, 4->defaultfile
		  if (file_exists($cachefile) && ($findtime < $cachefiletime)) { 
		  	// dosya var veya cache süresi henüz bitmemis ise
			$this->rsstemplate($cachefile, false, $rsslimit, $csstext, false, $before_widgets, $after_widgets, $addcss,$rsscategory, $defaultfile,$resimdurum);
		  } else {
		  	// dosya yok veya cache süresi dolmuş ise
			if(!function_exists('curl_open')){
				
				// Curl kütüphanesi yüklü ve aktif ise
				$session = curl_init();	
				curl_setopt($session, CURLOPT_URL, $clienturl);
				curl_setopt($session, CURLOPT_HEADER, false);
				curl_setopt($session, CURLOPT_FOLLOWLOCATION, false);
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
				$storedata = curl_exec($session);
				curl_close($session);
				if($storedata) {
					// storedata içi dolu
					$this->rsstemplate($cachefile, $storedata, $rsslimit, $csstext, true, $before_widgets, $after_widgets, $addcss,$rsscategory, $defaultfile,$resimdurum);
				} else {
					// storedata ici bos
					$this->rsstemplate($cachefile, false, $rsslimit, $csstext, false, $before_widgets, $after_widgets, $addcss,$rsscategory, $defaultfile,$resimdurum);
				} // storedata end
			} else { 
				// Curl kütüphanesi kapalı ise 2.yola basvur file_get_contents
				$storedata = file_get_contents($clienturl);
				if($storedata) {
					// storedata içi dolu
					$this->rsstemplate($cachefile, $storedata, $rsslimit, $csstext, true, $before_widgets, $after_widgets, $addcss,$rsscategory, $defaultfile,$resimdurum);
				} else {
					// storedata ici bos
					$this->rsstemplate($cachefile, false, $rsslimit, $csstext, false, $before_widgets, $after_widgets, $addcss,$rsscategory, $defaultfile,$resimdurum);
				} // storedata end
			}
		  }
	  }
	  function rsstemplate($filename, $storedata, $rsslimit, $csstext, $type = true, $before ='', $after = '', $addcss, $rsscategory,$defaultfile,$resimdurum)
	  {
		  echo $before;
		  echo $addcss;
		  if($type) { @file_put_contents($filename,$storedata,FILE_USE_INCLUDE_PATH); }
		  if (file_exists($filename)){ $filename = $filename; } else { $filename = $defaultfile; }
		  $xml = @simplexml_load_file($filename, 'SimpleXMLElement',LIBXML_NOCDATA);
				//'title' => 'Son Eklenen Programlar', 'titleiki' => 'Programlar', 'direkturl' => 'http://www.tamindir.com', 'seotitle'=>'En Son Programlar' ,'rss' => 'http://www.tamindir.com/rss'
				$titleiki = $this->filtering($this->tamindir_categories[$rsscategory]['titleiki'], 'text');
				$seotitle = $this->filtering($this->tamindir_categories[$rsscategory]['seotitle'], 'text');
				$url = $this->filtering($this->tamindir_categories[$rsscategory]['direkturl'], 'url');
				echo '<h2><a target="_blank" href="'.$url.'" title="'.$seotitle.'">'.$titleiki.'</a><span class="tam_logo"><a target="_blank" href="'.TAMINDIR.'" title="indir"><img src="'.plugins_url( "images/tamindir_logo.png" , __FILE__ ).'" alt="" /></a></span></h2>';
				// all posts
				for($i=0; $i<$rsslimit; $i++)
				{	
					  $ptitle 	= $this->filtering($xml->channel->item[$i]->title, 'text');
					  $plink 	= $this->filtering($xml->channel->item[$i]->link, 'url');
					  $pimg = $xml->channel->item[$i]->image->url;
					  if($rsscategory == 'blog' || $rsscategory == 'haber'){
						$desc = strip_tags($xml->channel->item[$i]->description);
						if(strlen($desc) > 70) {
							$pdesc = mb_substr($desc, 0, 69).'...';
						} else {
							$pdesc = $desc;
						}
					  } else {
					  	$pdesc = $this->filtering($xml->channel->item[$i]->description, 'text');
					  }
					  
					  if($resimdurum == '1'){
						  $pimage = $pimg;
						  if($pimage){
							$pthumb = '<img src="'.$pimage.'" alt="" />';
						  } else {
							  $pcontent	= preg_match( '/src="([^"]*)"/i', $pdesc, $pthumb_string);
							  if($pthumb_string) {
								  $pthumb = '<img src="'.$pthumb_string[1].'" alt="" />';
							  } else {
								  $pthumb		= '';
							  }
						  }
					  } else {
					  	$pthumb	= '';
					  }
					  if($rsscategory == 'video') {
					  	$cikti = '<div class="tindir"><div class="videoikon"></div>'.$pthumb.'<a target="_blank" href="'.$plink.'" title="'.$ptitle.'">'.$ptitle.'</a></div>';
					  } else {
					  	$cikti = '<div class="tindir">'.$pthumb.'<a target="_blank" href="'.$plink.'" title="'.$ptitle.'">'.$ptitle.'</a><p>'.$pdesc.'</p></div>';
					  }
					  echo $cikti;
				} // for end
		  echo $after;
	  }
  }
  */
?>
