<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ ��������� ������            |
+-------------------------------------+
*/

// ��������� ������������ ����
$SysValue=parse_ini_file("../phpshop/inc/config.ini",1);
  while(list($section,$array)=each($SysValue))
                while(list($key,$value)=each($array))
$SysValue['other'][chr(73).chr(110).chr(105).ucfirst(strtolower($section)).ucfirst(strtolower($key))]=$value;
// ���������� ���� MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db'])or 
@die("".PHPSHOP_error(101,$SysValue['my']['error_tracer'])."");
mysql_select_db($SysValue['connect']['dbase'])or 
@die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");
@mysql_query("SET NAMES 'cp1251'");

function DispSystems()// ����� ��������
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name3'];
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
foreach($row as $k=>$v)
$array[$k]=$v;
@$SysValue['sql']['num']++;
return $array;
}

$System=DispSystems();

// ����� GZIP �����
function gzcompressfile($source,$level=false){ 
   $dest=$source.'.gz'; 
   $mode='wb'.$level; 
   $error=false; 
   if($fp_out=gzopen($dest,$mode)){ 
       if($fp_in=fopen($source,'rb')){ 
           while(!feof($fp_in)) 
               gzwrite($fp_out,fread($fp_in,1024*512)); 
           fclose($fp_in); 
           } 
         else $error=true; 
       gzclose($fp_out); 
	   unlink($source);
	   rename($dest, $source.'.bz2');
       } 
     else $error=true; 
   if($error) return false; 
     else return $dest; 
   } 


if(@$catId == "ALL") $str="";
 elseif(is_numeric(@$catId)) $str=" and category='$catId'";

$sql="select * from ".$SysValue['base']['table_name2']." where enabled='1'".@$str;
$result=mysql_query($sql);
$num=0;
$csv="�������;���;����\n";
while($row = mysql_fetch_array($result))
    {
    $name=$row['name'];
	$price=$row['price'];
	$price=($price+(($price*$System['percent'])/100));
	$uid=$row['uid'];
	$csv.="$uid;$name;$price\n";
	}
	
  $file="base_".date("d_m_y_His").".csv";
  @$fp = fopen("../files/price/".$file, "w+");
  if ($fp) {
  fputs($fp, $csv);
  fclose($fp);
  $sorce="../files/price/".$file;
  }
  // �����  GZIP
  if(@$gzip == "true"){
  gzcompressfile($sorce);
  header("Location: ../files/price/".$file.".bz2");
  }
  else header("Location: ../files/price/".$file);

?>