<!doctype html>
<?php
$page_title = "Portfolio toevoegen | Admin";
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
                                <i class="fa fa-pencil-square-o"></i> Portfolio Toevoegen
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
                                        <form class="form-custom float-left" action="" method="POST">
                                            <?php if ( $dataProvider->hasFeedback() ) : ?>
                                                <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                                                    <span><?= $dataProvider->get( 'feedback' ) ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="title">Titel</label>
                                                <input type="text"
                                                       name="title"
                                                       class="form-control"
                                                       id="titel"
                                                       placeholder="Titel"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="url">URL:</label>
                                                <input type="text"
                                                       name="url"
                                                       class="form-control"
                                                       id="url"
                                                       placeholder="URL"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="userId">Student</label>
                                                <select required  class="form-control" name="userId" id="userId">
                                                    <option>Selecteer een student</option>
                                                    <?php foreach ( $dataProvider->get( 'students', [] ) as $studentId => $student ) : ?>
                                                        <option value="<?=$studentId?>"><?= $student->getFirstName() . ' ' . $student->getLastName() ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="themeId">Thema</label>
                                                <select required  class="form-control" name="themeId" id="themeId">
                                                    <option>Selecteer een thema</option>
                                                    <?php foreach ( $dataProvider->get( 'themes', [] ) as $themeId => $theme ) : ?>
                                                        <option value="<?=$themeId?>"><?= $theme->getName() ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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

</body>

<?php include 'scripts.php' ?>

</html>