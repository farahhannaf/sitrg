#!/usr/bin/env python
import sys
from geoserver.catalog import Catalog

workspace = sys.argv[1]
datastore = sys.argv[1]
shpname = sys.argv[2].lower()
epsg = 'EPSG:' + sys.argv[3]

catalog = Catalog("http://localhost:2012/geoserver/rest", username='admin', password='geoserver')

ws = catalog.get_workspace(workspace)
ds = catalog.get_store(datastore, ws)
publish = catalog.publish_featuretype(shpname, ds, epsg)
catalog.save(publish)