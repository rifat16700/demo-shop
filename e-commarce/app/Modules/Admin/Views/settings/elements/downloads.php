<?php
  $form_url = admin_url($controller_name."/store");
  $form_attributes = array('class' => 'form actionForm', 'data-redirect' => current_url(), 'method' => "POST");
?>
<div class="card content">
  <div class="card-header">
    <h3 class="card-title"><i class="fa fa-download"></i> Downloads & Modules Setting</h3>
  </div>
  <?php echo form_open($form_url, $form_attributes); ?>
    <div class="card-body">
      
      <!-- WordPress Plugin -->
      <div class="mb-4 pb-3 border-bottom">
        <h4 class="mb-3 text-primary"><i class="fab fa-wordpress mr-2"></i> WordPress Plugin</h4>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Plugin Name</label>
              <input type="text" name="dl_wp_name" class="form-control" value="<?=get_option('dl_wp_name', 'WordPress Plugin')?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label">Version</label>
              <input type="text" name="dl_wp_ver" class="form-control" value="<?=get_option('dl_wp_ver', 'v1.2.0')?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label">Platform Info</label>
              <input type="text" name="dl_wp_sub" class="form-control" value="<?=get_option('dl_wp_sub', 'WooCommerce')?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Plugin File (ZIP)</label>
              <div class="input-group settings">
                <input type="text" name="dl_wp_file" class="form-control" value="<?=get_option('dl_wp_file')?>">
                <span class="input-group-append">
                  <button class="btn" type="button">
                    <i class="fe fe-upload">
                      <input class="settings_fileupload" type="file" name="files[]" data-type="file">
                    </i>
                  </button> 
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Video Tutorial URL</label>
              <input type="text" name="dl_wp_video" class="form-control" placeholder="https://youtube.com/..." value="<?=get_option('dl_wp_video')?>">
            </div>
          </div>
        </div>
      </div>

      <!-- WHMCS Module -->
      <div class="mb-4 pb-3 border-bottom">
        <h4 class="mb-3 text-success"><i class="fas fa-shopping-cart mr-2"></i> WHMCS Module</h4>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Module Name</label>
              <input type="text" name="dl_whmcs_name" class="form-control" value="<?=get_option('dl_whmcs_name', 'WHMCS Module')?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label">Version</label>
              <input type="text" name="dl_whmcs_ver" class="form-control" value="<?=get_option('dl_whmcs_ver', 'v2.0.1')?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label">Platform Info</label>
              <input type="text" name="dl_whmcs_sub" class="form-control" value="<?=get_option('dl_whmcs_sub', 'Automation')?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Module File (ZIP)</label>
              <div class="input-group settings">
                <input type="text" name="dl_whmcs_file" class="form-control" value="<?=get_option('dl_whmcs_file')?>">
                <span class="input-group-append">
                  <button class="btn" type="button">
                    <i class="fe fe-upload">
                      <input class="settings_fileupload" type="file" name="files[]" data-type="file">
                    </i>
                  </button> 
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Video Tutorial URL</label>
              <input type="text" name="dl_whmcs_video" class="form-control" placeholder="https://youtube.com/..." value="<?=get_option('dl_whmcs_video')?>">
            </div>
          </div>
        </div>
      </div>

      <!-- SMM Panel Script -->
      <div class="mb-4 pb-3 border-bottom">
        <h4 class="mb-3 text-danger"><i class="fas fa-share-alt mr-2"></i> SMM Panel Script</h4>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Script Name</label>
              <input type="text" name="dl_smm_name" class="form-control" value="<?=get_option('dl_smm_name', 'SMM Panel Script')?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label">Version</label>
              <input type="text" name="dl_smm_ver" class="form-control" value="<?=get_option('dl_smm_ver', 'v3.5.0')?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label">Platform Info</label>
              <input type="text" name="dl_smm_sub" class="form-control" value="<?=get_option('dl_smm_sub', 'Perfect Panel')?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Script File (ZIP)</label>
              <div class="input-group settings">
                <input type="text" name="dl_smm_file" class="form-control" value="<?=get_option('dl_smm_file')?>">
                <span class="input-group-append">
                  <button class="btn" type="button">
                    <i class="fe fe-upload">
                      <input class="settings_fileupload" type="file" name="files[]" data-type="file">
                    </i>
                  </button> 
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Video Tutorial URL</label>
              <input type="text" name="dl_smm_video" class="form-control" placeholder="https://youtube.com/..." value="<?=get_option('dl_smm_video')?>">
            </div>
          </div>
        </div>
      </div>

      <!-- Mobile App -->
      <div class="mb-4">
        <h4 class="mb-3 text-info"><i class="fab fa-android mr-2"></i> Mobile App</h4>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">App Name</label>
              <input type="text" name="dl_app_name" class="form-control" value="<?=get_option('dl_app_name', 'Mobile App')?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label">Version</label>
              <input type="text" name="dl_app_ver" class="form-control" value="<?=get_option('dl_app_ver', 'v1.0.5')?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label">Platform Info</label>
              <input type="text" name="dl_app_sub" class="form-control" value="<?=get_option('dl_app_sub', 'SDK Included')?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">App File (APK)</label>
              <div class="input-group settings">
                <input type="text" name="dl_app_file" class="form-control" value="<?=get_option('dl_app_file')?>">
                <span class="input-group-append">
                  <button class="btn" type="button">
                    <i class="fe fe-upload">
                      <input class="settings_fileupload" type="file" name="files[]" data-type="file">
                    </i>
                  </button> 
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Video Tutorial URL</label>
              <input type="text" name="dl_app_video" class="form-control" placeholder="https://youtube.com/..." value="<?=get_option('dl_app_video')?>">
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="card-footer text-end">
      <button class="btn btn-primary btn-min-width text-uppercase"><?=lan("Save")?></button>
    </div>
  <?php echo form_close(); ?>
</div>
