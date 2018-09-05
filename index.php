<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>iByzt</title>
    <!-- Jquery & Fontawesome included -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  </head>
  <body>
    <!-- PHP Codes -->
    <?php
    // Calculate file size
    function filesize_formatted($path)
    {
        $size = filesize($path);
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    // list current directory
    function pathList($path){
      // Take paths
      $files = glob($path);
    ?>
    <ul>
      <?php
      // loop all paths
      foreach ($files as $file) {
      ?>
      <!-- if it's a folder then add class -->
      <li class="<?php echo is_dir($file) ? 'has-file' : null ?>">
        <div>
          <!-- if it's a folder then add folder icon. if it's not a folder, then add a file icon -->
          <i class="fas <?php echo is_dir($file) ? 'fa-folder' : 'fa-file' ?>"></i>
          <!-- write file name -->
          <?php echo $file; ?>
          <!-- if it's a folder then add a folder icon. if it's not a folder then execute filesize_formatted function -->
          <?php echo is_dir($file) ? '<i class="fas fa-angle-down"></i>' : ' <small>( ' . filesize_formatted($file) . ' )</small>' ?>
        </div>
        <!-- if it's a folder then execute listPath function again with current path -->
        <?php if(is_dir($file)) pathList($file . '/*'); ?>
      </li>
      <?php
      //END FOREACH
      }
      ?>
    </ul>
    <?php
    // END LISTPATH FUNCTİON
    }
    ?>

    <?php
      // Execute php codes
      pathList('*')
    ?>

    <!-- Toggle script -->
    <script>
      $(function(){
        $('.has-file > div').on('click', function(){
          $(this).next('ul').slideToggle()
          $('.fa-angle-down', this).toggleClass('fa-angle-up')
        })
      })
    </script>

    <!-- Style -->
    <style>
      ul,li{
        padding: 0;
        margin: 0;
        line-height: 26px;
        list-style-type: none;
      }
      ul ul{
        -webkit-padding-start: 20px;
        display: none;
      }
      li{
        background-color: #095ea6;
        color: #fff;
        margin: 2px 0px;
        padding: 6px;
        border-radius: 4px;
      }
      span{
        margin: auto 4px;
      }
    </style>
  </body>
</html>
