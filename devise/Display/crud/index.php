<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Data Table</title>
</head>

<body>

<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Testing Make Table CRUD( Create Read Update Delete)
                </div>
                <div class="card-body">
                    <a href="/store" class="btn btn-md btn-success" style="margin-bottom: 10px">TAMBAH DATA</a>
                    <table class="table table-bordered text-center" id="myTable">
                        <thead>
                        <tr>
                            <th scope="col">NO.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        <?php foreach ($data as $id => $item): ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?= $item['title'];?></td>
                            <td><?= $item['content'];?></td>
                            <td class="text-center">
                                <form action="/delete/<?= htmlspecialchars($item['id']); ?>" method="post">
                                    <!-- Use a button or link to trigger the form submission -->
                                    <a href="/show/<?=$item['id'];?>" class="btn btn-sm btn-primary">Preview</a>
                                    <a href="/edit/<?=$item['id'];?>" class="btn btn-sm btn-warning">EDIT</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</body>
</html>
