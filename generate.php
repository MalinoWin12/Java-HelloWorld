<pre>
<?php

echo "<h2>Membuat public & private key RSA</h2>\n";

//untuk membuat kunci yang lebih panjang coba gmp_random
//$rand1 = gmp_random(1); // mengeluarkan random number dari 0 sampai 1 x limb
//$rand2 = gmp_random(1); // mengeluarkan random number dari 0 sampai 1 x limb

//mencari bilangan random
$rand1=rand(1000,2000);
$rand2=rand(1000,2000);

// mencari bilangan prima selanjutnya dari $rand1 &rand2
$p = gmp_nextprime($rand1); 
$q = gmp_nextprime($rand2);

//menampilkan p & q
echo 'p='.gmp_strval($p) . "\n"; 
echo 'q='.gmp_strval($q). "\n";

//menghitung&menampilkan n=p*q
$n=gmp_mul($p,$q);
echo 'n='.gmp_strval($n). "\n";

//menghitung&menampilkan totient/phi=(p-1)(q-1)
$totient=gmp_mul(gmp_sub($p,1),gmp_sub($q,1));
echo 'totient='.gmp_strval($totient). "\n";

//mencari e, dimana e merupakan coprime dari totient
//e dikatakan coprime dari totient jika gcd/fpb dari e dan totient/phi = 1
for($e=2;$e<100;$e++){  //mencoba perulangan max 100 kali, 
    $gcd = gmp_gcd($e, $totient);
    if(gmp_strval($gcd)=='1')
        break;
}
//menampilkan gcd
echo 'gcd = '.gmp_strval($gcd) . "\n";
//menampilkan e
echo 'e='.gmp_strval($e). "\n";

//cari d
// d.e mod totient =1
// d.e = totient*x + 1
// d.e = totient*1 + 1
// d = (totient *1 + 1)/e

//menghitung&menampilkan d
$i=1;
do{
    $res = gmp_div_qr(gmp_add(gmp_mul($totient,$i),1), $e);
    echo '((totient*'.$i.') + 1) / e='.gmp_strval($res[0])." ; sisa= ".gmp_strval($res[1])."\n";
    $i++;
    if($i==10000) //maksimal percobaan 10000
        break;
}while(gmp_strval($res[1])!='0');
$d=$res[0];
echo 'd='.gmp_strval($d). "\n";

echo "hasil test d.e mod totient = ".gmp_strval(gmp_mod(gmp_mul($d,$e),$totient));

echo "<hr/>\n";
echo "<h2>


Ringkasan</h2>
\n";
echo "Desimal :\n";
echo "n =".gmp_strval($n)."\n";
echo "e =".gmp_strval($e)."\n";
echo "d =".gmp_strval($d)."\n";
echo "Hexadesimal :\n";
echo "n =".gmp_strval($n,16)."\n";
echo "e =".gmp_strval($e,16)."\n";
echo "d =".gmp_strval($d,16)."\n";
echo "Biner :\n";
echo "n =".gmp_strval($n,2)."\n";
echo "e =".gmp_strval($e,2)."\n";
echo "d =".gmp_strval($d,2)."\n";
echo "Basis 36 :\n";
echo "n =".gmp_strval($n,36)."\n";
echo "e =".gmp_strval($e,36)."\n";
echo "d =".gmp_strval($d,36)."\n";
?> 
</pre>