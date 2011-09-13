<?php
/**
 * Document the Application Unit Test Reports Initial Page Views
 * 
 * This view is the header for all other views
 *
 * @author DCCS Bakers
 * @version 0.1
 * @package OWCN
 * @subpackage OWCN_View
 * @filesource
 */
?>

<!DOCTYPE html>

<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

 <base href="<?php echo $this->config->item('base_url') ?>" />

 <link rel="stylesheet" type="text/css" href="/www/css/simply_links_without.css">
 <link rel="stylesheet" type="text/css" href="/www/css/template.css">
 <link rel="stylesheet" type="text/css" href="/www/css/custom.css">

 <title>OWCN Resources</title>
</head>

<body class="white">

<div id="page">

<div id="header">
 <div id="logo" onclick="location.href='http://www.owcn.org/';" style="cursor: pointer;"><h1 class="title">Welcome to the Oiled Wildlife Care Network</h1></div>
 <div id="leaderboard">
  <div style="float: left; font-size: 2.5em; padding-top: 15px">
	 <img alt="Oiled Wildlife Care Network" title="" src="/www/img/owcnwhc.jpg" usemap="#Map" border="0" height="68" width="446" />
   <map name="Map" id="Map">
    <area shape="rect" coords="212,42,445,84" href="http://www.wildlifehealthcenter.org" alt="UC Davis Wildlife Health Center" />
    <area shape="rect" coords="-10,0,438,28" href="/" alt="Oiled Wildife Care Network Home" />
   </map>
  </div>
  <div style="float: right; margin-right: 10px; padding-top: 20px"><a href="http://www.vetmed.ucdavis.edu"></a><a href="http://www.vetmed.ucdavis.edu/whc/" title=""><img alt="School of Veterinary Medicine, UC Davis" src="/www/img/whc-ucdavis.png" border="0" height="38" width="149" /></a></div>
 </div>
</div>

<div id="menu">
 <div class="blue">
  <ul class="menu">
	 <li id="current" class="active item1"><a href="http://www.owcn.org/"><span>Home</span></a></li>
	 <li class="parent item211"><a href="/about-us"><span>About Us</span></a></li>
	 <li class="parent item212"><a href="/about-oiled-wildlife"><span>Oiled Wildlife</span></a></li>
	 <li class="parent item213"><a href="/volunteer-info"><span>Volunteer Info</span></a></li>
	 <li class="parent item214"><a href="/research"><span>Research</span></a></li>
	 <li class="parent item215"><a href="/network"><span>Network Members</span></a></li>
	 <li class="item225"><a href="http://owcnblog.wordpress.com" target="_blank"><span>Blog</span></a></li>
	 <li class="item2"><a href="/contact-us"><span>Contact Us</span></a></li>
	</ul>
 </div>
</div>

<div id="splitmenu"></div>
 
<div id="contentholder" class="nocolumns">
  <div id="center">
   <div class="darkbg">
