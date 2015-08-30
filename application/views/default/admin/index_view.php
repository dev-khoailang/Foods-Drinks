<style type="text/css">
    td, th {
        text-align: center!important;
        vertical-align: middle!important;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=lang('administrators');?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <a href="<?=base_url();?>cms/admin/addAdmin" class="btn btn-success" style="margin-left: 45%;"><span class="glyphicon glyphicon-plus"><?=strtoupper(lang('add'));?></span></a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <?php

if ($admins): ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?=strtoupper(lang('id'));?></th>
                                <th><?=lang('avatar');?></th>
                                <th><?=lang('username');?></th>
                                <th><?=lang('email');?></th>
                                <th><?=lang('action');?></th>
                                <th><?=strtoupper(lang('root'));?></th>
                                <th><?=lang('status');?></th>
                                <th><?=lang('create_time');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

foreach ($admins as $admin): ?>
                            <tr>
                                <td><?=$admin->id;?></td>
                                <td><img src="<?=loadImage($admin->avatar);?>" height="80" width="80" /></td>
                                <td><?=$admin->username;?></td>
                                <td><?=$admin->email;?></td>
                                <td>
                                <a href="<?=base_url();?>cms/admin/editAdmin/<?=$admin->id;?>" class="btn btn-info">
                                <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a href="javascript:void(0);" class="btn<?=$admin->status == USER_STT_BLOCKED ? ' btn-danger' : ' btn-default';?>" onclick="blockAdmin(<?=$admin->id;?>);" title="<?=lang('block');?>">
                                <span class="glyphicon glyphicon-lock"></span>
                                </a>
                                </td>
                                <td><?=$admin->root;?></td>
                                <td><?=$admin->status;?></td>
                                <td><?=date('Y-m-d H:i:s', $admin->created_time);?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <?php endif;?>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

    <?php

if ($pagination): ?>
    <div class="col-sm-6">
    <div class="dataTables_info" role="status" aria-live="polite">Showing <?=$start;?> to <?=$start + $limit;?> of <?=$total;?> entries</div></div>
    <div class="col-sm-6">
    <div class="paging_simple_numbers">
    <ul class="pagination">
    <?=$pagination;?>
    </ul>
    </div>
    </div>
    <?php endif;?>
    <!-- /.col-lg-16 -->
</div>
<!-- /.row -->
