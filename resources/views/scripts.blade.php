<script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/gh/jerroydmoore/leaflet-button@master/L.Control.Button.js"></script>
<script src='https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js'></script>
<script>
    window.filamentMaps = window.filamentMaps || [];

    L.Popup.prototype._animateZoom = function (e) {
        if (!this._map) {
            return
        }
        var pos = this._map._latLngToNewLayerPoint(this._latlng, e.zoom, e.center),
            anchor = this._getAnchor();
        L.DomUtil.setPosition(this._container, pos.add(anchor));
    }

    L.Marker.prototype._animateZoom = function (opt) {
        if (!this._map) {
            return
        }

        var pos = this._map._latLngToNewLayerPoint(this._latlng, opt.zoom, opt.center).round();
        this._setPos(pos);
    };

    L.MarkerClusterGroup.prototype._unspiderfyZoomAnim = function (zoomDetails) {
        //Wait until the first zoomanim after the user has finished touch-zooming before running the animation
        if (!this._map || L.DomUtil.hasClass(this._map?._mapPane, 'leaflet-touching')) {
            return;
        }

        this._map.off('zoomanim', this._unspiderfyZoomAnim, this);
        this._unspiderfy(zoomDetails);
    };

    L.Tooltip.prototype._updatePosition = function (e) {
        if (!this._map) {
            return
        }

        var pos = this._map.latLngToLayerPoint(this._latlng);
        this._setPosition(pos);
    };

    L.Tooltip.prototype._animateZoom = function (e) {
        if (!this._map) {
            return
        }
        var pos = this._map._latLngToNewLayerPoint(this._latlng, e.zoom, e.center);
        this._setPosition(pos);
    };
</script>
