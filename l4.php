<?php
    if ((!isset($_FILES['fileUpload']['tmp_name']))||($_FILES['fileUpload']['error']>0))
    {
     $_FILES['fileUpload']['tmp_name']='links.txt';
    }
?>
<html>
    <head>
    <style>
 body
 {

background-color: #666;
 }
 a{
     color: red;
 }
 div{
     margin-left:10px;
 }
    </style>
</head>
    <body>
       
    <form method="post" enctype = 'multipart/form-data' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="file" class="sbm" name="fileUpload" >
       <input type="submit"/>
</form>

<div>
    
 <?php 


$in=file_get_contents($_FILES['fileUpload']['tmp_name']);


$VARS=array();
$VARS['date']=date("d.m.Y");
$VARS['d']=date("d");
$VARS['m']=date("m");

echo preg_replace('/\n/',"<br />",insertlinks($in));

 ?>
 
</div>
    </body>
</html>
<?php 
function insertlinks($inputString){
    $outString="";  
      $outString=
      preg_replace_callback(
          "((https?:\/)\/(([^\/\s\<\>\{\}]+\/)+)?([^\/\s\<\>\{\}]+)\/?)",
          function($matches){return (String)('<a href="'.$matches[0].'">'.((preg_match_all('/\d/',urldecode($matches[4])))?($matches[0]):($matches[0].';'.urldecode($matches[4])))).'</a>';},
          $inputString);
    return (String)$outString;
}




?>

