<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=lang('create_admin');?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=lang('account_info');?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12" style="padding-left: 200px;">
                        <form role="form" action="<?=base_url();?>cms/admin/addAdmin" method="post" enctype="multipart/form-data">

                            <div class="form-group input-group col-xs-8">
                                <span class="input-group-addon" style="width:150px;"><strong><?=lang('username');?></strong></span>
                                <input type="text" class="form-control" name="username" pattern="[a-zA-Z0-9]{6,30}" required>
                            </div>

                            <div class="form-group input-group col-xs-8">
                                <span class="input-group-addon" style="width:150px;"><strong><?=lang('email');?></strong></span>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <div class="form-group input-group col-xs-8">
                                <span class="input-group-addon" style="width:150px;"><strong><?=lang('pass');?></strong></span>
                                <input type="password" class="form-control" name="password" pattern=".{6,30}" id="password" required>
                            </div>

                            <div class="form-group input-group col-xs-8">
                                <span class="input-group-addon" style="width:150px;"><strong><?=lang('pass_conf');?></strong></span>
                                <input type="password" class="form-control" name="password_conf" pattern=".{6,30}" data-equalto="password" required>
                            </div>

                            <div class="form-group input-group col-xs-8">
                                <span class="input-group-addon" style="width:150px;"><strong><?=lang('phone');?></strong></span>
                                <input type="text" class="form-control" name="phone" >
                            </div>

                             <div class="form-group input-group col-xs-8">
                                <span class="input-group-addon" style="width:150px;"><strong><?=lang('avatar');?></strong></span>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="form-group input-group col-xs-6">
                                <span class="input-group-addon" style="width:150px;color:red;"><strong><?=lang('root');?></strong></span>
                                        <select class="form-control" name='root'>
                                            <option value='0'><?=strtoupper(lang('no'));?></option>
                                            <option value='1'><?=strtoupper(lang('yes'));?></option>
                                        </select>
                            </div>

                             <div class="form-group input-group col-xs-6">
                                <span class="input-group-addon" style="width:150px;"><strong><?=lang('group');?></strong></span>
                                <select class="form-control" name='group'>
                                            <?php

if ($groups):

    foreach ($groups as $item): ?>
																	                     <option value="<?=$item->id;?>"><?=$item->name;?></option>
																	                     <?php endforeach;endif;?>
                                 </select>
                            </div>

                            <div class="form-group input-group col-xs-6">
                                <span class="input-group-addon" style="width:150px;"><strong><?=lang('status');?></strong></span>
                                    <select class="form-control" name='status'>
                                        <option value="<?=USER_STT_ACTIVED;?>"><?=strtoupper(lang(USER_STT_ACTIVED));?></option>
                                        <option value="<?=USER_STT_INACTIVE;?>"><?=strtoupper(lang(USER_STT_INACTIVE));?></option>
                                        <option value="<?=USER_STT_BLOCKED;?>"><?=strtoupper(lang(USER_STT_BLOCKED));?></option>
                                    </select>
                            </div>



                            <button type="submit" class="btn btn-success" style="margin-left: 200px;">
                            <strong><?=strtoupper(lang('submit'));?></strong>
                            </button>
                            <button type="reset" class="btn btn-default"><strong><?=strtoupper(lang('reset'));?></strong></button>

                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
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