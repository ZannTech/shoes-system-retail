<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Fetch & Insert Basic App Info</h4>
        <form class="mt-4 fetchappbasic" action="<?php echo $siteurl.'/admin/inc/fetch_in_app_basic.php'; ?>" method="POST" >
            <span class="display_error"></span>
            <input type="hidden" name="actionType" value="add-app-basic">
            <div class="form-group">
                <input type="url" name="app_url" class="form-control app_url" placeholder="https://www.apkmirror.com/apk/gumi-inc/brave-frontier/">
            </div>
            <div class="form-group">
                <input type="submit" value="FETCH" name="fetchappbasic" class="btn btn-success" id="fbtn">
            </div>
        </form>
    </div>
    </div>
    </div>
</div>