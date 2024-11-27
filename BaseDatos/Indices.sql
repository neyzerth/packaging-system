show  index from user

--En la tabla tag campo barcode
CREATE UNIQUE INDEX UQ_tag_barcode ON tag(barcode);

--Tabla packaging en campo tag
CREATE UNIQUE INDEX UQ_packaging_tag ON packaging(tag);

--Tabla package en campo tag
CREATE UNIQUE INDEX UQ_package_tag ON package(tag);

--Tabla package en campo tracking_code
--CREATE UNIQUE INDEX UQ_package_tracking_code ON package(tracking_code);

--Tabla product campo name
CREATE UNIQUE INDEX UQ_product_name ON product(name);
