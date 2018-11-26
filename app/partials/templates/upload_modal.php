<form action="../controllers/process_upload.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <input type="file" name="upload">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <p id="upload_error" class="my-5"></p>
    </div>
    <input type="submit" value="SUBMIT" class="btn btn-lg btn-outline-success" id="btn_upload">
</form>