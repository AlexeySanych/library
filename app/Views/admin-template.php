

<div class="container" style="padding-top: 20px;">

    <div class="row">

        <div class="col-7 d-flex flex-column">

            <table class="table flex-grow-1">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Год</th>
                    <th scope="col">Заказов</th>
                    <th scope="col">Удалить</th>
                </tr>
                </thead>
                <tbody>

                <?php if ($content) : ?>
                <?php foreach($content as $item) :
                    $title = htmlspecialchars( $item['title'], ENT_QUOTES);
                    $author = htmlspecialchars( $item['authors'], ENT_QUOTES);
                    $year = htmlspecialchars( $item['year'], ENT_QUOTES);
                    $clicks = htmlspecialchars( $item['clicks'], ENT_QUOTES);
                    ?>
                    <tr>
                        <td><?= $title ?></td>
                        <td><?= $author ?></td>
                        <td><?= $year ?></td>
                        <td style="text-align: center"><?= $clicks ?></td>
                        <td style="text-align: center; font-weight: bold; color: #dc4242">
                            <form action="http://<?= $_SERVER['SERVER_NAME'] ?>/admin/delete" method="post">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <button class="btn btn-danger">X</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>

            <?php if ($content) : ?>
            <?php if (array_key_exists('page', $content[0])) : ?>
                <div class="row flex-shrink-1">
                    <div class="col">
                        <nav class="justify-content-center">
                            <ul class="pagination justify-content-center">
                                <?php for ($i = 1; $i <= $content[0]['count_pages']; $i++) : ?>
                                    <li class="page-item"><a class="page-link" href="http://<?= $_SERVER['SERVER_NAME'] ?>/admin?page=<?= $i ?>"><?= $i ?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            <?php endif; ?>
            <?php endif; ?>

        </div>

        <div class="col-5" style="border-left: 1px solid #3d3d3d; border-right: 1px solid #3d3d3d">
            <h2 style="text-align: center">Добавить книгу</h2>
            <form class="row" style="padding: 10px" name="add-book" action="admin" method="post" enctype="multipart/form-data">
                <div class="col-7">
                    <input class="mb-3" name="title" type="text" placeholder="название книги" required> <br>
                    <input class="mb-3" name="year" type="number" placeholder="год" required min="1900"> <br>
                    <input class="mb-3" name="pages" type="number" placeholder="кол-во страниц" required> <br>
                    <input class="mb-3" name="isbn" type="text" placeholder="isbn" required> <br>
                    <input name="image" type="file" accept=".jpg"> <br>
                </div>
                <div class="col-5">
                    <input class="mb-3" name="author1" type="text" placeholder="автор 1" required> <br>
                    <input class="mb-3" name="author2" type="text" placeholder="автор 2"> <br>
                    <input class="mb-3" name="author3" type="text" placeholder="автор 3"> <br>
                    <textarea name="description" cols="23" rows="5" required></textarea> <br>
                </div>
                <button type="submit" class="btn btn-success" style="display: block; width: 100px;">Добавить</button>
            </form>
        </div>
    </div>
</div>