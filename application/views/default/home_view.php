
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=loadAssets('bower_components/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=loadAssets('bower_components/metisMenu/dist/metisMenu.min.css');?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?=loadAssets('dist/css/timeline.css');?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?=loadAssets('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?=loadAssets('bower_components/datatables-responsive/css/dataTables.responsive.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=loadAssets('dist/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!-- <link href="<?=loadAssets('bower_components/morrisjs/morris.css');?>" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="<?=loadAssets('bower_components/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="<?=loadAssets('bower_components/jquery/dist/jquery.min.js');?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Depop</a>
            </div>
            <!-- /.navbar-header -->
            <?=$header;?>
            <!-- /.navbar-top-links -->
            <?=$navbar;?>
            <!-- /.navbar-static-side -->

        </nav>

        <div id="page-wrapper">
            <?php

if ($success): ?>
         <div class="panel-body">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$success;?>
                <?=$alertUrl ? '<a href="' . $alertUrl . '" class="alert-link">' . $alertText . '</a>.' : '';?>
            </div>
        </div>
            <?php endif;?>
            <?php

if ($error): ?>
         <div class="panel-body">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$error;?>
            </div>
        </div>
            <?php endif;?>

        <?=$body;?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=loadAssets('bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=loadAssets('bower_components/metisMenu/dist/metisMenu.min.js');?>"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=loadAssets('bower_components/raphael/raphael-min.js');?>"></script>
    <!-- <script src="<?=loadAssets('bower_components/morrisjs/morris.min.js');?>"></script> -->
    <!-- <script src="<?=loadAssets('js/morris-data.js');?>"></script> -->

    <!-- DataTables JavaScript -->
    <script src="<?=loadAssets('bower_components/datatables/media/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=loadAssets('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js');?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=loadAssets('dist/js/sb-admin-2.js');?>"></script>

</body>

</html>
