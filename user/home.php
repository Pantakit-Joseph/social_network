<?php include "head.php"; ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>social network</title>
    <link rel="stylesheet" href="../assets/bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <script src="../assets/bootstrap5/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/fontawesome/js/all.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">

    <!-- the fileinput plugin styling CSS file -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
     wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script>

    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
     This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script>

    <!-- the main fileinput plugin script JS file -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>

    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/LANG.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/th.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.2.7/js/locales/th.js"></script>
</head>

<body>
    <?php include "nav.php"; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <?php include "../profile.php" ?>
                <?php include "menu.php" ?>
            </div>
            <div class="col-md-6">
                <?php include "../form_post.php" ?>
                <?php include "../show_post.php" ?>
                <!-- <input id="input-id" type="file" class="file" data-preview-file-type="text"> -->
            </div>
            <div class="col-md-3">
                <?php include "show-friend.php" ?>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $(".input-img").fileinput({
                showUpload: false,
                showRemove: true,
                showClose: false,
                browseOnZoneClick: true,
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
                maxFileCount: 10,
                language: "th",
            });
        });
    </script>

</body>

</html>