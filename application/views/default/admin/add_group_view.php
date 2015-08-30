<style type="text/css">
    input[type=checkbox] {
        height: 15px;
        width: 15px;
    }

    td {
        vertical-align: middle!important;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=lang('create_admin_group');?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=lang('group_info');?></div>
            <div class="panel-body">
                <div class="row">
                 <form role="form" action="<?=base_url();?>cms/admin/addGroup" method="post" enctype="multipart/form-data">
                    <div class="col-lg-12" style="padding-left: 200px;">

                        <div class="form-group input-group col-xs-8">
                            <span class="input-group-addon" style="width:150px;"><strong><?=lang('name');?></strong></span>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                         <div class="form-group input-group col-xs-8">
                            <span class="input-group-addon" style="width:150px;"><strong><?=lang('desc');?></strong></span>
                            <textarea class="form-control" rows="3" name="desc"></textarea>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Controllers</th>
                                            <th>Methods </th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

foreach ($controllers as $cont => $methods): ?>
                                        <tr class="odd">
                                            <td>
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="cont_permission[]" type="checkbox" value="<?=$cont;?>" class="check_<?=$cont;?>">
                                                        &nbsp;&nbsp;<strong><?=ucwords($cont);?></strong>
                                                    </label>
                                                        (<a onclick="$('.cont_<?=$cont;?>').show();" href="javascript:void(0);" ><?=lang('show');?></a>
                                                        &nbsp;/&nbsp;<a  onclick="$('.cont_<?=$cont;?>').hide();" href="javascript:void(0);"><?=lang('hide');?></a>)
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                            $(function() {
                                                $('.check_<?=$cont;?>').change(function() {
                                                    if($(this).is(':checked')) {
                                                        $('.cont_<?=$cont;?>').show();
                                                        $('.method_<?=$cont;?>').prop('checked', true);
                                                    } else {
                                                        $('.method_<?=$cont;?>').prop('checked', false);
                                                    }
                                                })

                                            });
                                            </script>
                                            </td>
                                            <td>
                                            <?php

foreach ($methods as $method): ?>
                                                <div class="form-group <?='cont_' . $cont;?>" style="display: none;">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="method_permission[<?=$cont;?>][]" type="checkbox" value="<?=$cont . '/' . $method;?>" class="method_<?=$cont;?>" onchange="methodChecked('<?=$cont;?>')">
                                                        &nbsp;&nbsp;<?=ucwords($method);?>
                                                        (<?=lang('auth_' . $cont . '_' . $method);?>)
                                                    </label>
                                                </div>
                                            </div>
                                            <?php endforeach;?>
                                            </td>
                                            <td><?=lang('auth_' . $cont);?></td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->

                        <button type="submit" class="btn btn-success" style="margin-left: 40%;">
                        <strong><?=strtoupper(lang('submit'));?></strong>
                        </button>
                        <button type="reset" class="btn btn-default"><strong><?=strtoupper(lang('reset'));?></strong></button>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                    </form>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<script type="text/javascript">
    function methodChecked(cont) {
        var checkCont = true;
        $('.method_'+cont).each(function() {
            if(!$(this).is(':checked')) {
                $('.check_'+cont).prop('checked', false);
                checkCont = false;
            }
        });
        if(checkCont) {
            $('.check_'+cont).prop('checked', true);
        }
    }
</script>
