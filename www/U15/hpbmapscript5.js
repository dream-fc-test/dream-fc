//

// (C) 2010 株式会社ジャストシステム

//

// ***** DO NOT EDIT THIS FILE *****



var lat = new Array(5);
var lng = new Array(5);
var markerwindowinfo = new Array(5);
var markerevent = new Array(5);
var markerlabel = new Array(5);
var markertype = new Array(5);
var markershow = new Array(5);
var firstshown = new Array(5);
var marker = new Array(5);
lat[0] = "34.822180";
lng[0] = "135.476528";
markerwindowinfo[0] = "";
markerlabel[0] = "西脇G";
markerevent[0] = "click";
markertype[0] = "";
markershow[0] = "1";
firstshown[0] = "1";
lat[1] = "34.816508";
lng[1] = "135.474876";
markerwindowinfo[1] = "";
markerlabel[1] = "豊中市立第14中学校";
markerevent[1] = "click";
markertype[1] = "";
markershow[1] = "1";
firstshown[1] = "1";
lat[2] = "34.820930";
lng[2] = "135.478610";
markerwindowinfo[2] = "";
markerlabel[2] = "箕面市立第5中学校";
markerevent[2] = "click";
markertype[2] = "";
markershow[2] = "1";
firstshown[2] = "1";
lat[3] = "34.831181";
lng[3] = "135.480562";
markerwindowinfo[3] = "";
markerlabel[3] = "箕面市立第2中学校";
markerevent[3] = "click";
markertype[3] = "";
markershow[3] = "1";
firstshown[3] = "1";
lat[4] = "34.828539";
lng[4] = "135.475434";
markerwindowinfo[4] = "";
markerlabel[4] = "箕面市立中小学校";
markerevent[4] = "click";
markertype[4] = "";
markershow[4] = "1";
firstshown[4] = "1";

function hpbmaponload() {
	var map = new Y.Map("HPBMAP_20121031114805");
	map.drawMap(new Y.LatLng(34.819203, 135.486828),15,Y.LayerSetId.NORMAL);
	map.removeLayerSet(Y.LayerSetId.B1);
	map.addControl(new Y.ScaleControl());
	map.addControl(new Y.SliderZoomControlVertical());
	map.addControl(new Y.CenterMarkControl({visibleButton:true,visible:false}), new Y.ControlPosition(Y.ControlPosition.TOP_RIGHT, new Y.Size(5, 3)));
	map.addControl(new Y.LayerSetControl(), new Y.ControlPosition(Y.ControlPosition.TOP_RIGHT, new Y.Size(26, 3)));
	for (var i = 0; i <= 5; i++) {
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