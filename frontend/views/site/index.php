<?php

/* @var $this yii\web\View */

$this->title = 'Система поиска заявок пользователей';
?>
<script type="text/javascript">
    ymaps.ready(init);
    function init()
    {
        var myMap = new ymaps.Map("map", {
            center: [47.21, 39.63],
            zoom: 7
        });
        var collection = new ymaps.GeoObjectCollection();
        $.get('/data/application.json', function (data) {
            for(var i = 0, len = data.length; i < len; i++) {
            collection.add(new ymaps.Placemark([data[i].lattitude, data[i].longitude], {
                balloonContent : data[i].description,
                hintContent : data[i].name}));
            }
        });
        myMap.geoObjects.add(collection);

    }
</script>
<div class="site-index">
    <div id="map" style="width: 1000px; height: 800px">

    </div>
</div>
