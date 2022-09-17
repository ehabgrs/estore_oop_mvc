<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Employee view</title>
  </head>
  <body>
        <div class="container">

                <h4>Insert your employees data</h4>

                  <form method="post" enctype = "application/x-www-form-urlencoded">

                          <p><?= isset($message) ? $message : '' ?></p>

                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= isset($user) ? $user->name : '' ?>" maxlength='50'>
                          </div>

                          <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" min = "20" max= "60" class="form-control" id="age" name="age" value="<?= isset($user) ? $user->age : '' ?>" >
                          </div>

                          <div class="mb-3">
                            <label for="Address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" maxlength='100' value="<?= isset($user) ? $user->address : '' ?>">
                          </div>

                          <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" step="0.01" min="1500" max="9000" class="form-control" id="salary" name="salary" value="<?= isset($user) ? $user->salary : '' ?>" >
                          </div>

                          <div class="mb-3">
                            <label for="tax" class="form-label">Tax</label>
                            <input type="number" step="0.01" min="1" max="15" class="form-control" id="tax" name="tax" value="<?= isset($user) ? $user->tax : '' ?>">
                          </div>

                           <button type="submit" name = "submit" class="btn btn-primary">Submit</button>

                    </form>

        </div>
      
       <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>