<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload de arquivos com PHP</title>
 
    <!-- CDN Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">

        <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    </head>
    <body>
      <div class="container">
        <form name="form" action="gerador-unitario.php" method="post" enctype="multipart/form-data">
           <pre>Texto do certificado, coloque <b>[nome]</b> aonde dejsa inserir o nome do individuo, a tag <b>&lt;b&gt;aqui&gt;/b&gt;</b> deixa palavra que desejar em negrito</pre><br>           
           <textarea name="texto" id="summernote" cols="100" placeholder="Exemplo: Certificamos que <b>[nome]</b> participou da <b>nome da atividade xxxxx</b> no dia xx de xxxxxxx de xxxx, no lugar xxxxx"></textarea>
           <br><br>
           Nome do Arquivo<br>
           <input type="text" name="nome-arquivo">
           <br><br>
           Imagem de Fundo:<br>
           <input type="file" name="fileIMG">
           <br><br>
           <input type="submit" value="Gerar Certificados">
        </form>
      </div>
      <script>
          $('#summernote').summernote({
            toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['color', ['color']],
            ]
          });
      </script>
    </body>
</html>