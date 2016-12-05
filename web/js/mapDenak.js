        var map;
        var user;
        var centerControlDiv = document.createElement('div');


        function CenterControl(controlDiv, map, persona) {

          // Set CSS for the control border.
          var firstChild = document.createElement('button');
          firstChild.style.backgroundColor = '#fff';
          firstChild.style.border = 'none';
          firstChild.style.outline = 'none';
          firstChild.style.width = '28px';
          firstChild.style.height = '28px';
          firstChild.style.borderRadius = '2px';
          firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
          firstChild.style.cursor = 'pointer';
          firstChild.style.marginRight = '10px';
          firstChild.style.padding = '0px';
          firstChild.title = 'Your Location';
          controlDiv.appendChild(firstChild);

          var secondChild = document.createElement('div');
          secondChild.style.margin = '5px';
          secondChild.style.width = '18px';
          secondChild.style.height = '18px';
          secondChild.style.backgroundImage = 'url(../../../../../web/img/mylocation-sprite-1x.png)';
          secondChild.style.backgroundSize = '180px 18px';
          secondChild.style.backgroundPosition = '0px 0px';
          secondChild.style.backgroundRepeat = 'no-repeat';
          secondChild.id = 'you_location_img';
          firstChild.appendChild(secondChild);


          // Setup the click event listeners: simply set the map to Chicago.
          firstChild.addEventListener('click', function() {
            map.setZoom(17);
            map.panTo(persona);
          });

        }



        function myMap() {
          //Creando el mapa
          var mapCanvas = document.getElementById("map");
          var mapOptions = {
            streetViewControl: true,
            mapTypeControl: true,
            center: new google.maps.LatLng(43.323832, -1.9768633),
            zoom: 17,
            scrollwheel: false
          };
          var map = new google.maps.Map(mapCanvas, mapOptions);


          //Creando los iconos
          var kupImg = "../../../../../web/img/logoblanco35.png";
          //var kupImg="https://kupelike-oalba.c9users.io/web/img/botellasidra2.png";
          var sagarImg = {
            url: kupImg,
            size: new google.maps.Size(35, 35)
          };

          var perImg = "../../../../../web/img/personaPos.png";
          //var perImg="https://kupelike-oalba.c9users.io/web/img/personaPos.png";
          var persImg = {
            url: perImg,
            size: new google.maps.Size(35, 35)
          };


          // Añadiendo marcadores y Centrando el mapa//////////////////////////////////

          //create empty LatLngBounds object
          var bounds = new google.maps.LatLngBounds();
          var infowindow = new google.maps.InfoWindow();
          var marcadores = [];

         /* { %
            for sagardotegi in sagardotegis %
          }

          var mas = {
            position: {
              lat: {
                {
                  sagardotegi.latitud
                }
              },
              lng: {
                {
                  sagardotegi.longitud
                }
              }
            },
            nombre: "{{ sagardotegi.nombre }}",
            direccion: "{{ sagardotegi.direccion }}"
          };
          marcadores.push(mas);

          { % endfor %
          }*


          for (var i = 0; i < marcadores.length; i++) {

            var nombre = marcadores[i].nombre;
            var direccion = marcadores[i].direccion;
            var lati = marcadores[i].position.lat;
            var longi = marcadores[i].position.lng;
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng(lati, longi),
              map: map,
              title: nombre,
              icon: sagarImg
            });
            (function(marker, nombre) {
              google.maps.event.addListener(marker, 'click', function() {
                //infowindow.setContent('<a href="google.navigation:q='+marcadores[i].position.lat+','+marcadores[i].position.lng+'">'+nombre+'<br>'+direccion+'</a>');
                infowindow.setContent('<a href="google.navigation:q=' + lati + ', ' + longi + '">' + nombre + '<br>' + direccion + '</a>');
                //infowindow.setContent(nombre+'<br>'+direccion);
                infowindow.open(map, marker);
                map.panTo(marker.position);
                //map.setCenter(marker.position);
                //map.setZoom(17);
              });
            })(marker, nombre);

            bounds.extend(marker.position);
          }
          //now fit the map to the newly inclusive bounds
          map.fitBounds(bounds);

          ///////////////////////////////////////////////////////////////////////////


          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var perPos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              var persona = new google.maps.Marker({
                position: perPos,
                map: map,
                title: 'Tu posición.',
                icon: persImg
              });
              var centerControl = new CenterControl(centerControlDiv, map, perPos);
            });
          }
          centerControlDiv.index = 1;
          map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(centerControlDiv);
        }