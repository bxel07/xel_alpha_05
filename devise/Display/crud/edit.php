<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <title> Update Data</title>
</head>
<body>
<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Form Edit Inputan
                </div>
                <div class="card-body">
                    <form action="/update/<?=$value['id'];?>" method="POST">

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="Masukkan judul" class="form-control" value="<?=$value['title'];?>">
                        </div>

                        <div class="form-group">
                            <label>Content</label>
                            <input type="text" name="content" placeholder="Masukkan konten" class="form-control" value="<?=$value['content'];?>">
                        </div>

                        <br>
                        <button type="submit" class="btn btn-success">UPDATE</button>
                        <button type="reset" class="btn btn-warning">RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
</body>
</html>