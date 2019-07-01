#!/usr/bin/env python
import sys
from sridentify import Sridentify

data = sys.argv[1]

ident = Sridentify()
ident.from_file(data)
print(ident.get_epsg())
