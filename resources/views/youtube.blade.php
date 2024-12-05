@extends('layouts.inicio')
@section('informacion')
    <br>
    <form class="" method="GET">
        <div class="row">
            <div class="col">
                <label for="busqueda">Palabra clave: </label>
                <input type="text" class="form-control" placeholder="Escribe lo que deseas buscar" name="busqueda" required>
            </div>
            <div class="col">
                <label for="max">Máximo de resultados: </label>
                <input type="number" class="form-control" min="1" max="100" value="5" name="max">
                <br><button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>

    </form>
    <br>
    <div class="row">
        <div class="col-lg-6 col-md-6">
        </div>
        <div class="col-6 col-md-6">
         
      </div>
        <?php
    require_once '../googleapi/vendor/autoload.php';

    $tiene_busqueda = isset($_GET['busqueda']) && !empty($_GET['busqueda']);
    $max = isset($_GET['max']) ? (int) $_GET['max'] : 5;

    if ($tiene_busqueda) {
      $DEVELOPER_KEY  = 'AIzaSyCEs829x978oGRsvTKjE-XIez577hWfbmY';

      $client = new Google_Client();
      $client->setApplicationName('UTSelva4A');
      $client->setDeveloperKey($DEVELOPER_KEY);

      $youtube = new Google_Service_YouTube($client);
      $respuesta = $youtube->search->listSearch('id,snippet', array(
        'q' => $_GET['busqueda'],
        'maxResults' => $max,
        'order' => 'date'
      ));

      foreach ($respuesta['items'] as $video) {
        $titulo = $video['snippet']['title'];
        $texto = $video['snippet']['description'];
        $fecha = $video['snippet']['publishedAt'];
        $thumbnails = $video['snippet']['thumbnails'];
        $imagen = $thumbnails['medium']['url'] ?? '';
        $id = $video['id']['videoId'] ?? '';

        if ($id) {
  ?>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <a href="https://www.youtube.com/watch?v=<?php echo $id; ?>" target="_blank">
                        <img src="<?php echo $imagen; ?>" class="card-img" alt="<?php echo htmlspecialchars($titulo); ?>">
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($titulo); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($texto); ?></p>
                        <p class="card-text"><small class="text-muted"><?php echo htmlspecialchars($fecha); ?></small></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
      }
    } else {
  ?>
        <p id="ruta">Escribe tu búsqueda.</p>
        <?php
    }
  ?>
    </div>
@endsection
