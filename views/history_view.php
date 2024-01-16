<!DOCTYPE html>
<html lang="ja">
<head>
<?php require_once("_head_view.php")?>
</head>
<body>
    <header>
    <?php require("_header_view.php")?>
    </header>

    <main class="container py-4">
        <?php require("_message_view.php")?>
        <div class="row mt-3">
            <div class="col-md-6">
                <h3>Learning history</h3>
                
                <hr>
            <ul class="list-group">
                
                <?php foreach($histories as $history) { ?>    
                    <li class="list-group-item">
                        <a href="../app/detail.php?course_id=<?= h($history["course_id"]) ?>&section_id=<?= h($history["section_id"]) ?>">
                            <?= h($history["course_title"])?> - Section <?= h($history["section_no"])?> : <?= h($history["section_title"])?> <?= h($history["created_at"])?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            </div>
        </div>
    </main>
    <footer class="footer bg-secondary text-white">
<?php require_once("_footer_view.php");?>
    </footer>
</body>
</html>