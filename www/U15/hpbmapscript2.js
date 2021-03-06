//

// (C) 2010 株式会社ジャストシステム

//

// ***** DO NOT EDIT THIS FILE *****



var lat = new Array(2);
var lng = new Array(2);
var markerwindowinfo = new Array(2);
var markerevent = new Array(2);
var markerlabel = new Array(2);
var markertype = new Array(2);
var markershow = new Array(2);
var firstshown = new Array(2);
var marker = new Array(2);
lat[0] = "34.831058";
lng[0] = "135.480541";
markerwindowinfo[0] = "";
markerlabel[0] = "箕面市立第2中学校";
markerevent[0] = "click";
markertype[0] = "";
markershow[0] = "1";
firstshown[0] = "1";
lat[1] = "34.828627";
lng[1] = "135.475048";
markerwindowinfo[1] = "";
markerlabel[1] = "箕面市立中小学校";
markerevent[1] = "click";
markertype[1] = "";
markershow[1] = "1";
firstshown[1] = "1";

function hpbmaponload() {
	var map = new Y.Map("HPBMAP_20121031111202");
	map.drawMap(new Y.LatLng(34.828099, 135.475048),16,Y.LayerSetId.NORMAL);
	map.removeLayerSet(Y.LayerSetId.B1);
	map.addControl(new Y.ScaleControl());
	map.addControl(new Y.SliderZoomControlVertical());
	map.addControl(new Y.CenterMarkControl({visibleButton:true,visible:false}), new Y.ControlPosition(Y.ControlPosition.TOP_RIGHT, new Y.Size(5, 3)));
	map.addControl(new Y.LayerSetControl(), new Y.ControlPosition(Y.ControlPosition.TOP_RIGHT, new Y.Size(26, 3)));
	for (var i = 0; i <= 2; i++) {
		if(firstshown[i] == 1){
			var marker;
			if(null != markertype[i] && 0 < markertype[i].length){
				var icon = new Y.Icon(markertype[i]);
				marker = new Y.Marker(new Y.LatLng(lat[i],lng[i]), {title:markerwindowinfo[i],icon:icon});
			}else{
				marker = new Y.Marker(new Y.LatLng(lat[i],lng[i]), {title:markerwindowinfo[i]});
			}
			map.addFeature(marker);
			if(markershow[i] == 1 && 0 < markerlabel[i].length){
				map.addFeature(new Y.Label(new Y.LatLng(lat[i],lng[i]), markerlabel[i]));
			}
		}
	}
	return map;
}