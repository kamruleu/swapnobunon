<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Request-With, Content-Type, Accept, Authorization");

include_once('header.php');



      /*$xprefix = 'RPOS-'.$bin;
      $ztime = date("Y-m-d h:i:s");
      $bizid = 100;
      $stno = 100;
      $bin = $_GET['bin'];
      $ximsenum = 'RPOS-'.$bin.'-000001';
      $xrow = 1;//$_GET['xrow'];
      $xrdin = $_GET['refrin'];
      $xitemcode = $_GET['xitemcode'];
      $xdesc = $_GET['xdesc'];
      $xcat = ''; //$_GET['xcat'];
      $xbrand = ''; //$_GET['xbrand'];
      $xsl = $_GET['xitemcode'];
      $xsup = 'UA000001';//$_GET['xsup'];
      $xcus = 'ABC-789-0001';//$_GET['xcus'];
      $xcusdt = 'Ashraful amin';//$_GET['xcusdt'];
      $xwh = $_GET['rin'];
      $xbranch = $_GET['rin'];
      $zemail = $_GET['rin'];
      $xemail = NULL;//mysqli_real_escape_string($conn, strip_tags($_GET['xemail']));
      $xstdcost = 200;//$_GET['xstdcost'];
      $xstdprice = 250;//$_GET['xmrp'];
      $xqty = 1;//$_GET['xqty'];
      $xsalesprice = 250;//$_GET['xmrp'];
      $xuom =  'Pcs';//$_GET['xsaleunit'];
      $xvatpct = 15;
      $xtxntype = 'Sales';
      $xdocument = 'RPOS-'.$bin.'-000001';
      $xdocumentrow = 1;
      $xstatus = 'Created';
      $xsign = -1;
      $xdate = date("Y-m-d");
      $xyear = date("Y");
      $xper = date("m");
      $xspotcom = 10; //$_GET['xspotcom'];
      $xpoint = 10;//$_GET['xpoint'];
      $xsrctaxpct = 10;

$query =  "insert into imsetxn(xprefix,ximsesl,ztime,bizid,stno,ximsenum,xrow,xrdin,xitemcode,xdesc,xcat,xbrand,xsl,xsup,xcus, xcusdt, xwh, xbranch,  zemail, xemail, xstdcost, xstdprice,xqty,xsalesprice,xuom,xvatpct,xtxntype,xdocument,xdocumentrow,xstatus,xsign,xdate,xyear,xper,xspotcom,xpoint,xsrctaxpct )
                     values('$xprefix','100','$ztime','$bizid','$stno','$ximsenum','$xrow','$xrdin','$xitemcode','$xdesc','$xcat','$xbrand','$xsl','$xsup','$xcus','$xcusdt','$xwh','$xbranch','$zemail','$xemail','$xstdcost','$xstdprice','$xqty','$xsalesprice','$xuom','$xvatpct','$xtxntype','$xdocument','$xdocumentrow','$xstatus','$xsign','$xdate','$xyear','$xper','$xspotcom','$xpoint','$xsrctaxpct')";

  if(mysqli_query($conn, $query))  
      { 
        print'Successful';
      }
      else
      {
        print 'error';
      }*/

$data = json_decode(file_get_contents("php://input"));
 
 if(count($data) > 0)  
 {
      $bin = $data->bin;
      $xprefix = 'RPOS-'.$bin;
      $ztime = date("Y-m-d h:i:s");
      $bizid = 100;
     
      $xwh = $data->rin;
      $ximsenum = $data->odnum;
      $xrow = $data->xrow;
      $xrdin = $data->refrin;

include_once('conect.php'); 

  if (!$db) {
        die('Could not connect to db: ' . mysqli_error());
    }
    else
    {
      $id = $data->id;

      $qr = "SELECT max(stno) FROM `ablstatement`";
      $res = mysqli_query($db,$qr) or die("Cannot execute query");
      while ($row = mysqli_fetch_row($res)) {
    $row_array['stn'] = $row[0];
      }
      $stno = $row_array['stn'];
  $query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive,xsup,xstdcost from seitem where xitemid = '".$id."' order by xitemid DESC";
  $result = mysqli_query($db,$query) or die("Cannot execute query");  


  $json_response = (array());
    
    while ($row = mysqli_fetch_row($result)) {
    
    $row_array['xitemid'] = $row[0];
    $row_array['xitemcode'] = $row[1];
    $row_array['xsource'] = $row[2];
        $row_array['xdesc'] = $row[3];
        $row_array['xlongdesc'] = $row[4];
        $row_array['xcat'] = $row[5];
        $row_array['xbrand'] = $row[6];
        $row_array['xgitem'] = $row[7];
        $row_array['xcitem'] = $row[8];
        $row_array['xunitsale'] = $row[9];
        $row_array['xtypestk'] = $row[10];
        $row_array['xmrp'] = $row[11];
        $row_array['xstdcost'] = $row[12];
        $row_array['xcp'] = $row[13];
        $row_array['xdp'] = $row[14];
        $row_array['xstdprice'] = $row[15];
        $row_array['zactive'] = $row[16];
        $row_array['xsup'] = $row[17];
        $row_array['xstdcost'] = $row[18];
       
    }
    }



      $xitemcode = $row_array['xitemcode'];
      $xdesc = $row_array['xdesc'];
      $xcat = $row_array['xcat'];
      $xbrand = $row_array['xbrand'];
      $xsl = substr($row_array['xitemcode'],0,10);
      $xsup = $row_array['xsup'];
      $xcus = $data->xcus;
      $xcusdt = $data->xcusdt;
      $xbranch = $data->rin;
      $zemail = $data->rin;
      $xemail = NULL;//mysqli_real_escape_string($conn, strip_tags($_GET['xemail']));
      $xstdcost = $row_array['xstdcost'];
      $xstdprice = $row_array['xmrp'];
      $xqty = $data->xqty;
      $xsalesprice = $row_array['xmrp'];
      $xuom =  $row_array['xunitsale'];
      $xvatpct = 15;
      $xtxntype = 'Sales';
      $xdocument = $data->odnum;
      $xdocumentrow = 1;
      $xstatus = 'Created';
      $xsign = -1;
      $xdate = date("Y-m-d");
      $xyear = date("Y");
      $xper = date("m");
      $xspotcom = $row_array['xdp'] * $data->xqty;
      $xpoint = $row_array['xdp'];
      $xsrctaxpct = 10;




if($stno > 0)
{

/**/
  $query =  "insert into imsetxn(xprefix,ztime,bizid,stno,ximsenum,xrow,xrdin,xitemcode,xdesc,xcat,xbrand,xsl,xsup,xcus, xcusdt, xwh, xbranch,  zemail, xemail, xstdcost, xstdprice,xqty,xsalesprice,xuom,xvatpct,xtxntype,xdocument,xdocumentrow,xstatus,xsign,xdate,xyear,xper,xspotcom,xpoint,xsrctaxpct )
                     values('$xprefix','$ztime','$bizid','$stno','$ximsenum','$xrow','$xrdin','$xitemcode','$xdesc','$xcat','$xbrand','$xsl','$xsup','$xcus','$xcusdt','$xwh','$xbranch','$zemail','$xemail','$xstdcost','$xstdprice','$xqty','$xsalesprice','$xuom','$xvatpct','$xtxntype','$xdocument','$xdocumentrow','$xstatus','$xsign','$xdate','$xyear','$xper','$xspotcom','$xpoint','$xsrctaxpct')";
     $json_response = (array());
    if(mysqli_query($db, $query))  
      {  
        $quer =  "insert into imsetxn(xprefix,ximsesl,ztime,bizid,stno,ximsenum,xrow,xrdin,xitemcode,xdesc,xcat,xbrand,xsl,xsup,xcus, xcusdt, xwh, xbranch,  zemail, xemail, xstdcost, xstdprice,xqty,xsalesprice,xuom,xvatpct,xtxntype,xdocument,xdocumentrow,xstatus,xsign,xdate,xyear,xper,xspotcom,xpoint,xsrctaxpct )
                     values('$xprefix','100','$ztime','$bizid','$stno','$ximsenum','$xrow','$xrdin','$xitemcode','$xdesc','$xcat','$xbrand','$xsl','$xsup','$xcus','$xcusdt','$xwh','$xbranch','$zemail','$xemail','$xstdcost','$xstdprice','$xqty','$xsalesprice','$xuom','$xvatpct','$xtxntype','$xdocument','$xdocumentrow','$xstatus','$xsign','$xdate','$xyear','$xper','$xspotcom','$xpoint','$xsrctaxpct')";

            if(mysqli_query($conn, $quer))  
              {
                $row['message'] = "Order Posted Successfully...";
                  array_push($json_response,$row);
              }
              else
              {
                $row['message'] = mysqli_error($conn); 
               array_push($json_response,$row);
              }   

          $row['message'] = "Order Posted Successfully...";
          array_push($json_response,$row);
       echo json_encode($json_response);
        
      }  
      else  
      {  
           $row['message'] = mysqli_error($db); 
       array_push($json_response,$row);
       echo json_encode($json_response);
      }

} 
}
      ?>