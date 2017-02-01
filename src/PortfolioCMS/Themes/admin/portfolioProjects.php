<!doctype html>
<?php

$page_title = "Overzicht | Admin";
$pageName = "portfolio";

include 'header.php'; ?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center">
                            <strong>
                                Portfolio van <?= $dataProvider->call( 'student', 'getFirstName' ) . ' ' . $dataProvider->call( 'student', 'getLastName' ) ?>
                            </strong>
                        </h4>

                        <hr class="style-one"/>

                        <br>
                        <h4 class="title text-center">
                            <strong>
                                Projecten van <?= $dataProvider->call( 'student', 'getFirstName' ) . ' ' . $dataProvider->call( 'student', 'getLastName' ) ?>
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <table class="table table-hover table-custom-portfolio">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Naam</th>
                                <th>Description</th>
                                <th>Link</th>
                                <th>imageId</th>
                                <th>Cijfer</th>
                                <th>Cijfer aanpassen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($dataProvider->get( 'projects' ) as $project): ?>
                                <tr>
                                    <td><?= $project->getId() ?></td>
                                    <td><?= $project->getName() ?></td>
                                    <td><?= $project->getDescription() ?></td>
                                    <td><?= $project->getLink() ?></td>
                                    <td><?= $project->getImage()->getId() ?></td>
                                    <td>
                                        <input type="number" class="form-control" name="grade" value="<?= $project->getGrade() ?>">
                                        <input type="hidden" class="form-control" name="projectId" value="<?= $project->getId() ?>">
                                    </td>
                                    <td>
                                        <input class="btn btn-md btn-primary btn-block btn-custom" type="submit" value="Cijfer opslaan"/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
<?php include 'scripts.php' ?>
</body>
</html>
