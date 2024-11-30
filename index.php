<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
</head>
<body class="text-center">
        <h1>Data-Handler</h1>
    <div class="col-md-12 d-flex justify-content-center">
    <form method='post'>
  <div class="form-floating form-group mb-2">
      <input type="text" class="form-control" id="floatingInput" name="Name" aria-describedby="Name" placeholder="Enter Your Name">
      <label for="floatingInput">Name :</label>
  </div>
  <div class="form-floating form-group mb-2">
      <input type="number" class="form-control" id="floatingInput" name="Height" aria-describedby="Height" placeholder="Enter Your Height">
      <label for="floatingInput">Height :</label>
  </div>
  <div class="form-floating form-group mb-2">
      <input type="number" class="form-control" id="floatingInput" name="Weight" aria-describedby="Weight" placeholder="Enter Your Weight">
      <label for="floatingInput">Weight :</label>
  </div>
  <div class="form-floating form-group mb-2">
        <input type="date" class="form-control" id="floatingInputBirthDate" name="BirthDate" placeholder="Enter Your Birth Date">
        <label for="floatingInputBirthDate">Birth Date</label> </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    <?php 
//Get Items Values in Object
if((isset($_POST['Name'])) && !empty($_POST['Name']) &&
(isset($_POST['Height'])) && !empty($_POST['Height']) &&
(isset($_POST['Weight'])) && !empty($_POST['Weight']) &&
(isset($_POST['BirthDate'])) && !empty($_POST['BirthDate']))
{
    $data = (object)[
    'Name' => $_POST['Name'],
    'Height' => $_POST['Height'],
    'Weight' => $_POST['Weight'],
    'BirthDate' => $_POST['BirthDate'],
    'SubmitReq' => date("h:i:sa")
    ];
    //Send Values Into Json Files
    $existingData = [];
    if (file_exists("JsonFile.json")) {
    $jsonContent = file_get_contents("JsonFile.json");
    $existingData = json_decode($jsonContent, true); 
    }
    $existingData[] = $data;
    $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);
    file_put_contents("JsonFile.json", $jsonData);

    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
}
else{
    echo"<p style='color:red;'>Please Fill All Inputs</p>";
}

$JsonContent = file_get_contents("JsonFile.json");
$ExportedData = json_decode($JsonContent, true);
?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Row</th>
      <th scope="col">Name</th>
      <th scope="col">Height</th>
      <th scope="col">Weight</th>
      <th scope="col">BirthDate</th>
      <th scope="col">SubmitReq</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $Counter = 1;
foreach ($ExportedData as $entry) 
    {
    echo "<tr>";
    echo "<th scope='row'>{$Counter}</th>";
    echo "<td>{$entry['Name']}</td>";
    echo "<td>{$entry['Height']}</td>";
    echo "<td>{$entry['Weight']}</td>";
    echo "<td>{$entry['BirthDate']}</td>";
    echo "<td>{$entry['SubmitReq']}</td>";
    echo "</tr>";
    
    $Counter++;
    }
              
?>

  </tbody>
  </table>
</body>
</html>
