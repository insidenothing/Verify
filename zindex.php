<?
system('rm -f *.jpg');
system('rm -f *.pdf');
$copy = "<li>rm -f *.pdf</li>";
$copy .= "<li>rm -f *.jpg</li>";

if ($_GET[zoom]){
	$zoom=$_GET[zoom];
}else{
	$zoom="70";
}
if ($_GET[zoom2]){
	$zoom2=$_GET[zoom2];
}else{
	$zoom2="1100";
}
if ($_GET[res]){
	$res=$_GET[res];
}else{
	$res="75";
}
if ($_GET[rotation]){
	$rotation=$_GET[rotation];
}else{
	$rotation="0";
}
if ($_GET[aID]){
mysql_connect();
mysql_select_db('core');
$r=@mysql_query("select * from ps_affidavits where affidavitID = '$_GET[aID]'");
$d=mysql_fetch_array($r,MYSQL_ASSOC);
$from = str_replace('http://mdwestserve.com/affidavits/','/data/service/scans/',$d[affidavit]);
$from = str_replace('http://mdwestserve.com/ps/affidavits/','/data/service/scans/',$from);
$copy .= system('cp '.$from.' page.pdf');
$copy .= "<li>$d[method] for $d[packetID]</li>";
$copy .= "<li>cp $from page.pdf</li>";
$error = system('gs -dNOPAUSE -q -r'.$res.' -sDEVICE=jpeg -dBATCH -sOutputFile=page%d.jpg page.pdf', $retval);
$copy .= "<li>gs -dNOPAUSE -q -r$res -sDEVICE=jpeg -dBATCH -sOutputFile=page%d.jpg page.pdf</li>";
$q="update ps_affidavits set gsError = '$error', gsResult = '$retval' where affidavitID = '$_GET[aID]'";
@mysql_query($q);
$copy .= "<li>$q</li>";

$copy .= "<li>affidavit page height: ".$zoom."px</li>";
$copy .= "<li>affidavit page resolution: ".$res."dpi</li>";
$copy .= "<li>signature card height: ".$zoom2."px</li>";
$copy .= "<li>signature card rotation: ".$rotation."&deg;</li>";
}else{
$copy .= "<li>Document package ID Required for analysis! (_GET[aID]) = (core.ps_affidavits.affidavitID)</li>";

}
?>
<script type="text/javascript" src="dom-drag.js"></script>
<table align="center">
<tr><td valign="top">
<div class="sidea">Affidavit Page Height 
	<a href="?zoom2=<?=$zoom2-200;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom2-200;?>px</a>  
	<a href="?zoom2=<?=$zoom2-100;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom2-100;?>px</a> 
	<a href="?zoom2=<?=$zoom2-50;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom2-50;?>px</a> 
	<b><?=$zoom2;?>px</b>  
	<a href="?zoom2=<?=$zoom2+50;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom2+50;?>px</a> 
	<a href="?zoom2=<?=$zoom2+100;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom2+100;?>px</a> 
	<a href="?zoom2=<?=$zoom2+200;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom2+200;?>px</a>
</div>
<div class="sidea">Affidavit Resolution 
	<a href="?res=<?=$res-200;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&aID=<?=$_GET[aID]?>"><?=$res-200;?>dpi</a>  
	<a href="?res=<?=$res-100;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&aID=<?=$_GET[aID]?>"><?=$res-100;?>dpi</a> 
	<a href="?res=<?=$res-50;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&aID=<?=$_GET[aID]?>"><?=$res-50;?>dpi</a> 
	<b><?=$res;?>dpi</b>  
	<a href="?res=<?=$res+50;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&aID=<?=$_GET[aID]?>"><?=$res+50;?>dpi</a> 
	<a href="?res=<?=$res+100;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&aID=<?=$_GET[aID]?>"><?=$res+100;?>dpi</a> 
	<a href="?res=<?=$res+200;?>&rotation=<?=$rotation;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&aID=<?=$_GET[aID]?>"><?=$res+200;?>dpi</a>
</div>
<div class="sidea" style="height:675px; width:900px; overflow:scroll; text-align:center;">

<? if (file_exists('page.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page.jpg" style="position: relative" />
<? 	$copy .= "<li>Rendered page.jpg</li>"; } ?>

<? if (file_exists('page1.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page1.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page1.jpg</li>"; } ?>

<? if (file_exists('page2.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page2.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page2.jpg</li>"; } ?>

<? if (file_exists('page3.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page3.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page3.jpg</li>"; } ?>

<? if (file_exists('page4.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page4.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page4.jpg</li>"; } ?>

<? if (file_exists('page5.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page5.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page5.jpg</li>"; } ?>

<? if (file_exists('page6.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page6.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page6.jpg</li>"; } ?>

<? if (file_exists('page7.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page7.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page7.jpg</li>"; } ?>

<? if (file_exists('page8.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page8.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page8.jpg</li>"; } ?>

<? if (file_exists('page9.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page9.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page9.jpg</li>"; } ?>

<? if (file_exists('page10.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page10.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page10.jpg</li>"; } ?>

<? if (file_exists('page11.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page11.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page11.jpg</li>"; } ?>

<? if (file_exists('page12.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page12.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page12.jpg</li>"; } ?>

<? if (file_exists('page13.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page13.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page13.jpg</li>"; } ?>

<? if (file_exists('page14.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page14.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page14.jpg</li>"; } ?>

<? if (file_exists('page15.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page15.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page15.jpg</li>"; } ?>

<? if (file_exists('page16.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page16.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page16.jpg</li>"; } ?>

<? if (file_exists('page17.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page17.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page17.jpg</li>"; } ?>

<? if (file_exists('page18.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page18.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page18.jpg</li>"; } ?>

<? if (file_exists('page19.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page19.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page19.jpg</li>"; } ?>

<? if (file_exists('page20.jpg')){ ?>
<img height="<?=$zoom2;?>" src="page20.jpg" style="position: relative" />
<? $copy .= "<li>Rendered page20.jpg, Should there be more pages??????</li>"; } ?>

</div>
</td><td valign="top">
<div class="sideb">Signature Card Size
	<a href="?zoom=<?=$zoom-20;?>&rotation=<?=$rotation;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom-20;?>px</a> 
	<a href="?zoom=<?=$zoom-10;?>&rotation=<?=$rotation;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom-10;?>px</a> 
	<a href="?zoom=<?=$zoom-5;?>&rotation=<?=$rotation;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom-5;?>px</a> 
	<b><?=$zoom;?>px</b> 
	<a href="?zoom=<?=$zoom+5;?>&rotation=<?=$rotation;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom+5;?>px</a> 
	<a href="?zoom=<?=$zoom+10;?>&rotation=<?=$rotation;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom+10;?>px</a> 
	<a href="?zoom=<?=$zoom+20;?>&rotation=<?=$rotation;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$zoom+20;?>px</a>
</div>
<div class="sideb">Signature Card Rotation
	<a href="?rotation=<?=$rotation-20;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$rotation-20;?>&deg;</a> 
	<a href="?rotation=<?=$rotation-10;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$rotation-10;?>&deg;</a> 
	<a href="?rotation=<?=$rotation-5;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$rotation-5;?>&deg;</a> 
	<b><?=$rotation;?>&deg;</b> 
	<a href="?rotation=<?=$rotation+5;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$rotation+5;?>&deg;</a> 
	<a href="?rotation=<?=$rotation+10;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$rotation+10;?>&deg;</a> 
	<a href="?rotation=<?=$rotation+20;?>&zoom=<?=$zoom;?>&zoom2=<?=$zoom2;?>&res=<?=$res;?>&aID=<?=$_GET[aID]?>"><?=$rotation+20;?>&deg;</a>
</div>






<div class="sideb" style="text-align:center;">
	<table>
		<tr>
			<td>
	<div id="card1" style="position: relative" class="card"><img height="<?=$zoom;?>" src="card.php?rotate=<?=$rotation;?>" /><br><small>George Bush</small></div>
			</td><td>
	<div id="card2" style="position: relative" class="card"><img height="<?=$zoom;?>" src="card.php?rotate=<?=$rotation;?>" /><br><small>George Bush</small></div>
			</td><td>
	<div id="card3" style="position: relative" class="card"><img height="<?=$zoom;?>" src="card.php?rotate=<?=$rotation;?>" /><br><small>George Bush</small></div>
			</td>
		</tr><tr>	
			<td>
	<div id="card4" style="position: relative" class="card"><img height="<?=$zoom;?>" src="card.php?rotate=<?=$rotation;?>" /><br><small>George Bush</small></div>
			</td><td>
	<div id="card5" style="position: relative" class="card"><img height="<?=$zoom;?>" src="card.php?rotate=<?=$rotation;?>" /><br><small>George Bush</small></div>
			</td><td>
	<div id="card6" style="position: relative" class="card"><img height="<?=$zoom;?>" src="card.php?rotate=<?=$rotation;?>" /><br><small>George Bush</small></div>
			</td>
		</tr>
	</table>
</div>




<script type="text/javascript">
Drag.init(document.getElementById("card1"));
Drag.init(document.getElementById("card2"));
Drag.init(document.getElementById("card3"));
Drag.init(document.getElementById("card4"));
Drag.init(document.getElementById("card5"));
Drag.init(document.getElementById("card6"));
</script>

<div style="text-align:center;"><img src="verified.png" style="position: relative" /></div>


<div class="sidec"><b>Runtime:</b><br><?=$copy;?></div>

<div class="sidec"><b>Errors:</b><br><?=$error;?></div>

<div class="sidec"><b>Ghostscript:</b><br><?=$retval;?></div>
</td></tr></table>
<style>
.sidea { border:solid 2px #FFFF00; }
.sideb { border:solid 2px #FF0000; }
.sidec { border:solid 2px #999999; }
.card { border:solid 1px #000000; text-align:center; }
body { background-color:#000000; }
table { background-color:#cccccc; }
</style>
