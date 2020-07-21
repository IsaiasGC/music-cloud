      <footer class="fixed-bottom">
        <div class="row">
          <div class="col-sm-11 text-center">
            <p id="titulo" ></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-11">
            <audio id="player" tabindex="0" controls>
              <source src="" type="audio/mpeg">
              Su navegador no soporta audio
            </audio>
          </div>
          <div class="col-sm-1">
            <a href="#track" class="icon-art_track" style="font-size: 40px; color: white;" data-toggle="modal"></a>
          </div>
        </div>
      </footer>
      <div id="track" class="modal fade" role="dialog" style="background: #093a56;">
        <div class="modal-dialog">
          <div class="row">
            <div class="col-sm-12 text-center">
              <a href="#" data-dismiss="modal" class="icon-arrow_drop_down" style="font-size: 40px; color: white;"></a>
            </div>
          </div>
        </div>
        <div class="container-fluid">
        <div class="row">
          <div class="col-md">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto"  style="width: 500px; height: 500px;" src="images/Desconocido.jpg" alt="Album" data-holder-rendered="true" id="caratula">
          </div>
          <div class="col-md">
            <div class="text-center">
              <h3 style="color: white;">Lista de reproduccion en curso</h3><br />
            </div>
            <ul class="playlist">
              <li>
                <div class="row">
                  <div class="col-sm-4"><strong>titulo</strong></div>
                  <div class="col-sm-3"><strong>album</strong></div>
                  <div class="col-sm-3"><strong>artista</strong></div>
                  <div class="col-sm-2"><strong>genero</strong></div>
                </div>
              </li>
            </ul>
            <ul id="playlist" class="playlist">
                <!-- <li class="cancion  active">
                  <a href="http://localhost/musiccloud/music/e45188b230ed40-finally_found_you.mp3">
                    <div class="row">
                      <div class="col-sm-4"><p>finally foud you</p></div>
                      <div class="col-sm-3"><p>Sex and Love</p></div>
                      <div class="col-sm-3"><p>Enrique Iglesias</p></div>
                      <div class="col-sm-2"><p>Pop</p></div>
                    </div>
                  </a>
                </li>
                <li class="cancion ">
                  <a href="http://localhost/musiccloud/music/88940369f909e1-Du_hast.mp3">
                    <div class="row">
                      <div class="col-sm-4"><p>Du hast</p></div>
                      <div class="col-sm-3"><p>Mutter</p></div>
                      <div class="col-sm-3"><p>Rammstein</p></div>
                      <div class="col-sm-2"><p>Heavy Metal</p></div>
                    </div>
                  </a>
                </li>
                <li class="cancion ">
                  <a href="http://localhost/musiccloud/music/59ce3935ece118-ich_tu_dir_weh_doh.mp3">
                    <div class="row">
                      <div class="col-sm-4"><p>ich tu dir weh doh</p></div>
                      <div class="col-sm-3"><p>Mutter</p></div>
                      <div class="col-sm-3"><p>Rammstein</p></div>
                      <div class="col-sm-2"><p>Heavy Metal</p></div>
                    </div>
                  </a>
                </li> -->
            </ul>
            <div class="fixed-bottom">
              <div class="text-center">
                <div class="row">
                  <div class="col-sm"></div>
                  <div class="col-sm"><a href="#" id="prev" class="icon-fast_rewind icon"></a></div>
                  <div class="col-sm"><a href="#" id="play" class="icon-play_arrow icon"></a></div>
                  <div class="col-sm"><a href="#" id="next" class="icon-fast_forward icon"></a></div>
                  <div class="col-sm"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="http://localhost/add/jquery-3.3.1.slim.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
    <script src="http://localhost/add/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
    <script src="http://localhost/add/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      init();
      function init(){
          var audio = document.getElementById('player');
          var playlist = document.getElementById('playlist');
          var tracks = playlist.getElementsByTagName('a');
          var titulo = document.getElementById('titulo');
          var play =  document.getElementById('play');
          var prev =  document.getElementById('prev');
          var next =  document.getElementById('next');
          var enlaces = document.getElementsByClassName('cambiar');
          var inicio='<?php echo $_SESSION['playlist']; ?>';

          try{
            var biblioteca = document.getElementById('biblioteca');
            var canciones = biblioteca.getElementsByClassName('escuchar');
            var eliminar = biblioteca.getElementsByClassName('eliminar');
            for(var d in canciones) {
              var link = canciones[d];
              if(typeof link === "function" || typeof link === "number") continue;
              link.addEventListener('click', function(e) {
                e.preventDefault();
                crearPlaylist();
                var tocar = buscarA(this.getAttribute('href'));
                var song = tocar.getAttribute('href');
                run(song, audio, tocar);
              });
            }
            for(var d in eliminar) {
              var link = eliminar[d];
              if(typeof link === "function" || typeof link === "number") continue;
              link.addEventListener('click', function(e) {
                e.preventDefault();
                borrar(this);
              });
            }
          }catch(e){}

          if(inicio.length>0){
            inicio=JSON.parse(inicio);
            cargarPlaylist(inicio);
          }

          audio.volume = 1;
          //audio.play();
          play.addEventListener('click', function(e) {
              e.preventDefault();
              if(this.classList.contains("icon-play_arrow")){
                audio.play();
              }else{
                audio.pause();
              }
          });
          prev.addEventListener('click', function(e) {
              e.preventDefault();
              for(var track=tracks.length-1; track>=0; track--){
                var link = tracks[track];
                var prevTrack = parseInt(track) - 1;
                if(typeof link === "function" || typeof link === "number") continue;
                if(!audio.src) audio.src = tracks[0];
                if(track == 0) prevTrack = tracks.length - 1;
                                                console.log(track+" - "+link.getAttribute('href')+" -> "+audio.src);
                if(link.getAttribute('href') === audio.src) {
                  var prevLink = tracks[prevTrack];
                  run(prevLink.getAttribute('href'), audio, prevLink);
                  break;
                }
              }
          });
          next.addEventListener('click', function(e) {
              e.preventDefault();
              for(var track=0; track<tracks.length; track++){
                var link = tracks[track];
                var nextTrack = parseInt(track) + 1;
                if(typeof link === "function" || typeof link === "number") continue;
                if(!audio.src) audio.src = tracks[0];
                if(track == (tracks.length - 1)) nextTrack = 0;
                                                console.log(track+" - "+link.getAttribute('href')+" -> "+audio.src);
                if(link.getAttribute('href') === audio.src) {
                  var nextLink = tracks[nextTrack];
                  run(nextLink.getAttribute('href'), audio, nextLink);
                  break;
                }
              }
          });
          for(var c in enlaces) {//agregar evento a los links para reproducir los de la playlist
            var link = enlaces[c];
            if(typeof link === "function" || typeof link === "number") continue;
            link.addEventListener('click', function(e) {
              e.preventDefault();
              guardarPlaylist(this.getAttribute('href'));
            });
          }
          for(var track in tracks) {//agregar evento a los links para reproducir los de la playlist
            var link = tracks[track];
            if(typeof link === "function" || typeof link === "number") continue;
            link.addEventListener('click', function(e) {
              e.preventDefault();
              var song = this.getAttribute('href');
              run(song, audio, this);
            });
          }
          audio.addEventListener('ended', function(e) {
              e.preventDefault();
              var ban=true;
              for(var track=0; track<tracks.length; track++){
                var link = tracks[track];
                var nextTrack = parseInt(track) + 1;
                if(typeof link === "function" || typeof link === "number") continue;
                if(!this.src) this.src = tracks[0];
                if(track == (tracks.length - 1)) nextTrack = 0;
                                                console.log(nextTrack+" - "+ban);
                if(link.getAttribute('href') === this.src && ban) {
                  var nextLink = tracks[nextTrack];
                  run(nextLink.getAttribute('href'), audio, nextLink);
                  ban=false;
                }
              }
          });
          audio.addEventListener('pause', function(e) {
              play.classList.remove("icon-pause");
              play.classList.add("icon-play_arrow");
          });
          audio.addEventListener('play', function(e) {
              play.classList.remove("icon-play_arrow");
              play.classList.add("icon-pause");
          });
      }
      function iniciar(){
          var audio = document.getElementById('player');
          var playlist = document.getElementById('playlist');
          var tracks = playlist.getElementsByTagName('a');
          for(var track in tracks) {//agregar evento a los links para reproducir los de la playlist
            var link = tracks[track];
            if(typeof link === "function" || typeof link === "number") continue;
            link.addEventListener('click', function(e) {
              e.preventDefault();
              var song = this.getAttribute('href');
              run(song, audio, this);
            });
          }
      }
      function run(song, audio, link){
              // alert("Tiempo: "+audio.currentTime);
              var parent = link.parentElement;
              var datos = parent.getElementsByTagName('p');
              var titulo = document.getElementById('titulo');
              var caratula = document.getElementById('caratula');
              titulo.textContent=datos[0].innerText+" - "+datos[2].innerText;
              //quitar el active de todos los elementos de la lista
              var items = parent.parentElement.getElementsByTagName('li');
              var param={cancion: song};
              for(var item in items) {
                if(items[item].classList)
                  items[item].classList.remove("active");
              }
              //agregar active a este elemento
              parent.classList.add("active");
              $.ajax({
                    url: 'caratula.php',
                    data: param,
                    type: 'post',
                    success: function(response){
                      // alert(response);
                      caratula.src="data:image/jpeg;base64,"+response;
                    },
                    error: function(xhr, status) {
                      alert('Disculpe, existió un problema');
                    }
              });
              //tocar la cancion
              audio.src = song;
              audio.load();
              audio.play();
              // audio.currentTime=160.604;
      }
      function eliminarPlaylist(){
        var playlist = document.getElementById('playlist');
        while(playlist.hasChildNodes()){
          playlist.removeChild(playlist.firstChild);
        }
      }
      function buscarA(ref){
        var playlist = document.getElementById('playlist');
        var tracks = playlist.getElementsByTagName('a');
        for(var i =0; i<tracks.length; i++){
          if(ref==tracks[i].href){
            return tracks[i];
          }
        }
        return null;
      }
      function cargarPlaylist(canciones){
        eliminarPlaylist();
        var playlist = document.getElementById('playlist');
        var audio = document.getElementById('player');
        var reproducir="";
        var minuto=0;
        for (var i=0; i<canciones.length; i++) {
          var li = document.createElement("LI");
          li.classList.add("cancion");
          var a = document.createElement("A");
          a.href=canciones[i].url;

          var divr = document.createElement("DIV");
          divr.classList.add("row");

          var div = document.createElement("DIV");
          div.classList.add("col-sm-4");
          var p = document.createElement("P");
          var t = document.createTextNode(canciones[i].cancion);
          p.appendChild(t);
          div.appendChild(p);
          divr.appendChild(div);

          div = document.createElement("DIV");
          div.classList.add("col-sm-3");
          var p = document.createElement("P");
          var t = document.createTextNode(canciones[i].album);
          p.appendChild(t);
          div.appendChild(p);
          divr.appendChild(div);

          div = document.createElement("DIV");
          div.classList.add("col-sm-3");
          var p = document.createElement("P");
          var t = document.createTextNode(canciones[i].artista);
          p.appendChild(t);
          div.appendChild(p);
          divr.appendChild(div);

          div = document.createElement("DIV");
          div.classList.add("col-sm-2");
          var p = document.createElement("P");
          var t = document.createTextNode(canciones[i].genero);
          p.appendChild(t);
          div.appendChild(p);
          divr.appendChild(div);

          a.appendChild(divr);
          li.appendChild(a);
          playlist.appendChild(li);
          if(canciones[i].activa){
            li.classList.add("active");
            reproducir=canciones[i].url;
            minuto=canciones[i].min;
          }
        }
        if(reproducir.length>0){
          var link=buscarA(reproducir);
          run(reproducir, audio, link);
          audio.currentTime=minuto;
        }
      }
      function crearPlaylist(){
        eliminarPlaylist();
        var playlist = document.getElementById('playlist');
        var biblioteca = document.getElementById('biblioteca');
        var elementos = biblioteca.getElementsByClassName('cancion');
        var canciones = biblioteca.getElementsByClassName('escuchar');
        for (var d =0; d<elementos.length; d++) {
        // for(var d in elementos){
          var datos = elementos[d].getElementsByTagName('p');

          var li = document.createElement("LI");
          li.classList.add("cancion");
          var a = document.createElement("A");
          a.href=canciones[d].href;

          var divr = document.createElement("DIV");
          divr.classList.add("row");

          var div = document.createElement("DIV");
          div.classList.add("col-sm-4");
          var p = document.createElement("P");
          var t = document.createTextNode(datos[0].innerText);
          p.appendChild(t);
          div.appendChild(p);
          divr.appendChild(div);

          div = document.createElement("DIV");
          div.classList.add("col-sm-3");
          var p = document.createElement("P");
          var t = document.createTextNode(datos[1].innerText);
          p.appendChild(t);
          div.appendChild(p);
          divr.appendChild(div);

          div = document.createElement("DIV");
          div.classList.add("col-sm-3");
          var p = document.createElement("P");
          var t = document.createTextNode(datos[2].innerText);
          p.appendChild(t);
          div.appendChild(p);
          divr.appendChild(div);

          div = document.createElement("DIV");
          div.classList.add("col-sm-2");
          var p = document.createElement("P");
          var t = document.createTextNode(datos[3].innerText);
          p.appendChild(t);
          div.appendChild(p);
          divr.appendChild(div);

          a.appendChild(divr);
          li.appendChild(a);
          playlist.appendChild(li);
        }
        iniciar();
      }
      function ontenerPlaylist(){
          var audio = document.getElementById('player');
          var playlist = document.getElementById('playlist');
          var tracks = playlist.getElementsByTagName('a');
          var canciones = [];
          for (var i=0; i<tracks.length; i++) {
            var padre = tracks[i].parentElement;
            var datos = padre.getElementsByTagName('p');
            var ac = padre.classList.contains('active');
            var m = 0;
            if(ac){
              m=audio.currentTime;
            }
            var c = {url: tracks[i].getAttribute('href'), cancion: datos[0].innerText, album: datos[1].innerText, artista: datos[2].innerText, genero: datos[3].innerText, activa: ac, min: m};
            canciones.push(c);
          }
          var list=JSON.stringify(canciones);
          return list+"";
      }
      function guardarPlaylist(link){
          var param={canciones: ontenerPlaylist()};
          $.ajax({
                    url: 'guardar.php',
                    data: param,
                    type: 'post',
                    success: function(response){
                      location.href = link;
                    },
                    error: function(xhr, status) {
                      alert('Disculpe, existió un problema');
                    }
          });
      }
      function borrar(link){
          var param={cancion: link.getAttribute('href')};
          $.ajax({
                    url: 'eliminar.php',
                    data: param,
                    type: 'post',
                    success: function(response){
                      alert(response);
                      var item=$(link).parentsUntil("li");
                      item.remove();
                    },
                    error: function(xhr, status) {
                      alert('Disculpe, existió un problema');
                    }
          });
      }
    </script>
  </body>
</html>