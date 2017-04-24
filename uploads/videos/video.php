<?php

    $song_name = preg_replace( '#[^-\w]#', '', $_GET['name'] );
    $song_file = "{$_SERVER['DOCUMENT_ROOT']}/yii-logistic/uploads/videos/{$song_name}.mp4";
    echo $song_file;
    if( file_exists( $song_file ) )
    {
      header( 'Cache-Control: public' );
      header( 'Content-Description: File Transfer' );
      header( "Content-Disposition: attachment; filename={$song_file}" );
      header( 'Content-Type: application/mp4' );
      header( 'Content-Transfer-Encoding: binary' );
      readfile( $song_file );
      exit;
    }
    else{
       echo "Không tồn tại"; 
    }
