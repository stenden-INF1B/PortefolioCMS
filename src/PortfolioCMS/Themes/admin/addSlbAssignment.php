<!doctype html>
<?php
$page_title = "SLB opdracht toevoegen | Admin";
$pageName = 'portfolio';
include 'header.php';
?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center">
                            <strong>
                                <i class="fa fa-pencil-square-o"></i> Slb Opdracht Toevoegen
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">
                            <a onClick="history.go(-1);">
                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                    <i class="fa fa-arrow-left"></i> Terug
                                </button>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <form class="form-custom float-left" action="" method="POST"
                                              enctype="multipart/form-data">
                                            <?php if ($dataProvider->hasFeedback()) : ?>
                                                <div class="alert alert-<?= $dataProvider->get('feedback-type') ?>">
                                                    <span><?= $dataProvider->get('feedback') ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="name">Naam opdracht</label>
                                                <input type="text"
                                                       name="name"
                                                       class="form-control"
                                                       id="name"
                                                       placeholder="Naam opdracht"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <div class="fileUpload btn btn-md btn-primary btn-custom">
                                                    <span>Selecteer een bestand...</span>
                                                    <input id="uploadBtn" type="file" class="upload" name="slbAssignment"/>
                                                </div>
                                                <input id="uploadFile" class="fileUpload-text" placeholder="" disabled="disabled" />
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 clearfix"><br/></div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-custom">Opslaan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>

<script>
    document.getElementById("uploadBtn").onchange = function () {

        document.getElementById("uploadFile").value = this.value;
    };
</script>

</body>

<?php include 'scripts.php' ?>

</html>