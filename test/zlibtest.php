<?php
$txt = '111111111122222222222222221111';
$compress = zlib_encode($txt, ZLIB_ENCODING_DEFLATE,9);
print($compress);
print("\n");
print(zlib_decode($compress));
