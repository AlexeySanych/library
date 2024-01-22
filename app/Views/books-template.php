<?php if ($content) : ?>
<div class="row">
    <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <?php foreach($content as $item) :
            $id = htmlspecialchars($item['id'], ENT_QUOTES);
            $title = htmlspecialchars($item['title'], ENT_QUOTES);
            $author = htmlspecialchars($item['authors'], ENT_QUOTES);
            ?>
            <div data-book-id="<?= $id ?>" class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
                <div class="book">
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/book/<?= $id ?>"><img src="http://<?= $_SERVER['SERVER_NAME'] ?>/img/<?= $id ?>.jpg" alt="<?= $title ?>">
                        <div data-title="<?= $title ?>" class="blockI" style="height: 46px;">
                            <div data-book-title="<?= $title ?>" class="title size_text"><?= $title ?></div>
                            <div data-book-author="<?= $author ?>" class="author"><?php
                                echo $author;
                                ?></div>
                        </div>
                    </a>
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/book/<?= $id ?>">
                        <button type="button" class="details btn btn-success">Читать</button>
                    </a>
                </div>
            </div>
        <?php endforeach;?>

    </div>
</div>

<?php if (array_key_exists('page', $content[0])) : ?>
    <div class="row">
        <div class="col">
            <nav class="justify-content-center">
                <ul class="pagination justify-content-center">
                    <?php if ($content[0]['page'] > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="http://<?= $_SERVER['SERVER_NAME'] ?>/?page=<?= ($content[0]['page'] - 1) > 0 ? $content[0]['page'] - 1 : 1 ?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="page-item"><a class="page-link" href="#"><?= $content[0]['page'] ?></a></li>
                    <?php if ($content[0]['page'] + 1 <= $content[0]['count_pages']) : ?>
                        <li class="page-item">
                            <a class="page-link" href="http://<?= $_SERVER['SERVER_NAME'] ?>/?page=<?= $content[0]['page'] + 1; ?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
<?php endif; ?>
<?php endif; ?>