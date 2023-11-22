<?php
session_start();
$path='./';
$to_path='/';
require($path.'include/logincheck.php');
    $mapset='<!DOCTYPE html>
<head>    
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    
        <script>
            L_NO_TOUCH = false;
            L_DISABLE_3D = false;
        </script>
    
    <style>html, body {width: 100%;height: 100%;margin: 0;padding: 0;}</style>
    <style>#map {position:absolute;top:0;bottom:0;right:0;left:0;}</style>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.6.0/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/python-visualization/folium/folium/templates/leaflet.awesome.rotate.min.css"/>
    
            <meta name="viewport" content="width=device-width,
                initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <style>
                #map_68aaa0fbcc30e4cd400662e4a01f47e5 {
                    position: relative;
                    width: 100.0%;
                    height: 100.0%;
                    left: 0.0%;
                    top: 0.0%;
                }
            </style>
        
</head>
<body>    
    
            <div class="folium-map" id="map_68aaa0fbcc30e4cd400662e4a01f47e5" ></div>
        
</body>
<script>    
    
            var map_68aaa0fbcc30e4cd400662e4a01f47e5 = L.map(
                "map_68aaa0fbcc30e4cd400662e4a01f47e5",
                {
                    center: [35.681039712152774, 139.76462203312525],
                    crs: L.CRS.EPSG3857,
                    zoom: 10,
                    zoomControl: true,
                    preferCanvas: false,
                }
            );

            

        
    
            var tile_layer_1a0b35665d580630632b239439003b64 = L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                {"attribution": "Data by \u0026copy; \u003ca href=\"http://openstreetmap.org\"\u003eOpenStreetMap\u003c/a\u003e, under \u003ca href=\"http://www.openstreetmap.org/copyright\"\u003eODbL\u003c/a\u003e.", "detectRetina": false, "maxNativeZoom": 18, "maxZoom": 18, "minZoom": 0, "noWrap": false, "opacity": 1, "subdomains": "abc", "tms": false}
            ).addTo(map_68aaa0fbcc30e4cd400662e4a01f47e5);
        
</script>'
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8"> 
    <title>Jinryu</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="<?php echo $path; ?>icon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
<?php include($path.'include/header.css'); ?>
        body{
            margin:0;
            font-family:initial;
        }
        .form1{
            max-width:100%;            
        }
        .flex2 > * {
            margin:min(20px);
        }
        .under{
            position:relative;
        }
        .over{
            position: absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
        }
        .over_word{
            font-size:min(5ex);
        }
        .blur{
            filter:blur(3px);
        }
        .pointer-events{
            pointer-events:none;
        }
        input[type="number"]::-webkit-outer-spin-button, 
        input[type="number"]::-webkit-inner-spin-button { 
            -webkit-appearance: none;
            -moz-appearance:textfield;
            margin: 0;
        } 
        .form-label{
            margin-bottom:0
        }
        .button{
            margin-bottom:10px
        }
        .iframe{
            width:100%;
            height:100%;
        }
        .under{
            height:450px;
            height:calc(100vh - 40px - var(--header_height));
            max-height:600px;
        }
        @media screen and (min-width:761px) {
            .flex2{
                display: flex;
                margin-left:10px;
                margin-right:10px;
            }
            .flex2 > *{
                margin-left:10px;
                margin-right:10px;
            }
            .form1{
                min-width:251px;
                max-width:251px;
            }
            .under{
                width:100%;
                max-height:initial;
            }
        }
    </style>
</head>
<body>
<?php include($path.'include/header.php'); ?>
    <div class='main'>
        <div class='flex2'>
            <div id='under' class='under'>
                <iframe id='map' class='iframe' srcdoc='<?php echo $mapset;?>' style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <form class='form1' id='form1' onsubmit="push();getapi();return false;">
                <div class="mb-3">
                    <label for="latitude" class="form-label">緯度</label>
                    <input name='lat' type="number" min="-90" max="90" step='0.0000000000000001' class="form-control input1" id="latitude" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">経度</label>
                    <input name='lon' type="number" min="-180" max="180" step='0.0000000000000001' class="form-control input1" id="longitude" required>
                </div>
                <div class="mb-3">
                    <label for="radius" class="form-label">検索半径(m)</label>
                    <input name="rad" type="number" min="0" step="1" class="form-control input1" id="radius" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">No.</label>
                    <input name="number" type="number" min="1" step="1" class="form-control input1" id="number" required>
                </div>
                <input id='button1' class='btn btn-secondary input1 button' type="submit" value="決定">
                <input id='button2' class='btn btn-secondary input1 button' type="button" value="現在地取得" onclick="Geolocation()">
            </form>
        </div>
    </div>
    <script>
        const url = new URL(window.location.href);
        const params = url.searchParams;
        let request_n = 1;
        let bach_n = 0;
        const form = document.getElementById('form1');
        const under = document.getElementById('under');
        const over = document.createElement('p');
        const map = document.getElementById('map');
        const button1 = document.getElementById('button1');
        const original_srcdoc = map.srcdoc;
        over.textContent = '更新中'
        over.classList.add('over','over_word');

        const ans=document.createElement('p');
        const ans_error=document.createElement('span');
        ans_error.classList.add('text-danger');
        const br=document.createElement('br');

        form.latitude.value=params.get('lat');
        form.longitude.value=params.get('lon');
        form.radius.value=params.get('rad');
        form.number.value=params.get('no');

        if (params.get('no')!==null && params.get('lat')!==null && params.get('lon')!==null && params.get('rad')!==null) {
            getapi();
        }

        function Geolocation() {
            navigator.geolocation.getCurrentPosition((position)=> {
                form.latitude.value = position.coords.latitude;
                form.longitude.value = position.coords.longitude;
            });
        }

        function end() {
            for (var radio of document.getElementsByClassName('input1')) {
                radio.disabled=false;
            }
            map.classList.remove('blur');
            map.tabIndex='0';
            map.classList.remove('pointer-events');
            over.remove();
        }

        function push() {
            request_n = 2;
        }

        function getapi() {
            if (request_n == 2)  {
                history.pushState('','','?lat='+form.latitude.value+'&lon='+form.longitude.value+'&rad='+form.radius.value+'&no='+form.number.value);
            } else if (request_n == 1) {
                history.replaceState('','','?lat='+form.latitude.value+'&lon='+form.longitude.value+'&rad='+form.radius.value+'&no='+form.number.value);
            }
            bach_n=0;
            for (var radio of document.getElementsByClassName('input1')) {
                radio.disabled=true;
            }
            map.classList.add('pointer-events');
            map.tabIndex='-1';
            map.classList.add('blur');
            under.appendChild(over);
            fetch('hub.php?lat='+form.latitude.value+'&lon='+form.longitude.value+'&rad='+form.radius.value+'&no='+form.number.value)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    end();
                    map.srcdoc=unescape_html(data['html']);
                    if (Number(data['maxno'])==0){
                        ans.classList.add('text-danger');
                        ans.textContent='範囲内にデータが存在しません。';
                        button1.before(ans);
                    } else {
                        ans.classList.remove('text-danger');
                        ans.textContent='検索範囲データ数：'+data['maxno'];
                        button1.before(ans);
                        if (Number(form.number.value) > Number(data['maxno'])) {
                            ans.appendChild(br);
                            ans_error.textContent='No.がデータ範囲外です。';
                            ans.appendChild(ans_error);
                        }
                    }
                })
                .catch(error => {
                    end();
                    alert("失敗しました");
                });
        }

        function unescape_html (string) {
            if(typeof string !== 'string') {
                return string;
            }
            return string.replace(/&amp;|&#x27;|&#x60;|&quot;|&lt;|&gt;/g, function(match) {
                return {
                '&amp;':'&',
                '&#x27;':"'",
                '&#x60;':'`',
                '&quot;':'"',
                '&lt;':'<',
                '&gt;':'>',
                }[match]
            });
        }
        
    window.addEventListener("popstate", (e) => {
        if (bach_n!=1) {
            var old_url = new URL(window.location.href);
            var old_params = old_url.searchParams;
            form.latitude.value=old_params.get('lat');
            form.longitude.value=old_params.get('lon');
            form.radius.value=old_params.get('rad');
            form.number.value=old_params.get('no');
            if (form.number.value!=='' && form.latitude.value!=='' && form.longitude.value!=='' && form.radius.value!=='') {
                request_n = 3;
                getapi();
            } else {
                map.srcdoc = original_srcdoc;
                ans.remove();
                ans_error.remove();
            }
        }
    })
    </script>
</body>
</html>