<?php
$hasil=null;
$time=null;
if(!empty($_POST['dekrip'])){
    $time_start = microtime(true);//menghitung waktu awal eksekusi
    $n=$_POST['n'];
    $d=$_POST['d'];
    //pesan enkripsi dipecah menjadi array dengan batasan "."
    $teks=explode(".",$_POST['teks']);
    foreach($teks as $nilai){
        //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
        $hasil.=chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n)));
    }
    $time_end = microtime(true); //menghitung waktu akhir eksekusi dekripsi
    $time = $time_end - $time_start; //total waktu untuk dekripsi
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">  
    <head>  
        <title>Dekripsi rsa</title>  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">
            input,label{
                display:block;
            }
            textarea{
                font-family: Helvetica, Arial;
                line-height: 1.1em;
                font-size:15pt;
                text-align:left;            
                width:800px;
                height:400px;
            }
            #hasil{
                padding:20px;
                background:gray;
                color:lightgreen;
                font-family:monospace;
            }
        </style>
    </head>  
    <body>
        <h2>membutuhkan waktu <?php echo $time; ?> untuk dekripsi</h2>
<?php
        if($hasil){
            echo "<textarea id=\"hasil\">".$hasil."</textarea>";
        }
        ?>
        <form id="enkripsi" name="enkripsi" method="post">
            <textarea name="teks" id="teks"></textarea>
            <label for="n">n (desimal)=</label><input type="text" name="n" id="n" size="30" value="" />
            <label for="d">d (desimal)=</label><input type="text" name="d" id="d" size="10" value="" />
            <input type="submit" name="dekrip" id="dekrip" value="dekrip"/>
        </form>
</body>
</html>