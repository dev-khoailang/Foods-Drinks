<style type="text/css">
    td, th {
        text-align: center!important;
        vertical-align: middle!important;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=lang('group');?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <a href="<?=base_url();?>cms/admin/addGroup" class="btn btn-success" style="margin-left: 45%;"><span class="glyphicon glyphicon-plus"><?=strtoupper(lang('add'));?></span></a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <?php

if ($groups): ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?=strtoupper(lang('id'));?></th>
                                <th><?=lang('name');?></th>
                                <th><?=lang('desc');?></th>
                                <th><?=lang('action');?></th>
                                <th><?=lang('create_time');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

foreach ($groups as $group): ?>
                            <tr>
                                <td><?=$group->id;?></td>
                                <td><?=$group->name;?></td>
                                <td><?=$group->desc;?></td>
                                <td><a href="<?=base_url();?>cms/admin/editGroup/<?=$group->id;?>" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a></td>
                                <td><?=date('Y-m-d H:i:s', $group->created_time);?></td>
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
