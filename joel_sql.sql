SELECT * FROM productos;

create table clientes(
	id int(255) NOT NULL AUTO_INCREMENT,
    cedula varchar(13),
	nombres varchar(100),
	apellidos varchar(100),
	email varchar(100),
	direccion varchar(100),
	telefono varchar(10),
	celular varchar(10),
    tipo_cliente varchar(20),
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL,
	PRIMARY KEY (`id`)
);
#alter table empleados add column salario decimal(10,2);
#alter table empleados add column actividad varchar(100);
create table empleados(
	id int(255) NOT NULL AUTO_INCREMENT,
    cedula varchar(13),
	nombres varchar(100),
	apellidos varchar(100),
    salario decimal(10,2),
    actividad varchar(100),
	email varchar(100),
	direccion varchar(100),
    fecha_ingreso datetime,
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE tipos_gastos (
  id int(255) NOT NULL AUTO_INCREMENT,
  descripcion varchar(150) DEFAULT NULL,
  created_at datetime DEFAULT NULL,
  updated_at datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
#drop table sector_lotes;

CREATE TABLE sector_lotes (
  id int(255) NOT NULL AUTO_INCREMENT,
  descripcion varchar(150) DEFAULT NULL,
  data varchar(2), #	'SC' SECTOR; 'LT' LOTE
  codigo_padre int(255), # SI ES DATA='LT' EL CODIGO_PADRE ES AL SECTOR QUE PERTENECE 
  hectareas_area decimal(10,2),
  dualidad_mes varchar(7),
  vigencia tinyint(1), # 1 = VIGENTE; 0detalles_gastos = NO VIGENTE
  created_at datetime DEFAULT NULL,
  updated_at datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
#alter table productos add column tipo_producto varchar(1);

create table productos(
	id int(255) NOT NULL AUTO_INCREMENT,
    descripcion varchar(100),
	tipo_inventario varchar(1), # SI ES tipo_inventario='1' ES PRODUCTO; SI tipo_inventario='2' ES SERVICIO
    tipo_producto varchar(1), # SI ES tipo_producto='1' ES GASTO; SI tipo_producto='2' ES VENTA
    stock decimal(10,2) DEFAULT 0,
	costo decimal(10,2) DEFAULT 0,
    precio_unitario decimal(10,2) DEFAULT 0,
	unidad_medida varchar(10),
    factor decimal(10,2),
    tipo_gasto_id int(255),
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL,
	PRIMARY KEY (`id`),
    KEY fk_productos_tipos_gastos (tipo_gasto_id),
	CONSTRAINT fk_productos_tipos_gastos FOREIGN KEY (tipo_gasto_id) REFERENCES tipos_gastos (id)
);
#drop table detalles_gastos;
#drop table gastos;
create table gastos(
	id int(255) NOT NULL AUTO_INCREMENT,
    comentario varchar(100),
    fecha_documento datetime,
    sector_lote_id int(255),
	total_gasto decimal(10,2),
    user_registro_id bigint(20) unsigned NOT NULL,
    anulado tinyint(1) DEFAULT 0, # 1 = ANULADO; 0 = NO ANULADO
    comentario_anulacion varchar(100),
    user_anula_id bigint(20) unsigned null,
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL,
	PRIMARY KEY (`id`),
    KEY fk_gastos_sector_lotes (sector_lote_id),
	CONSTRAINT fk_gastos_sector_lotes FOREIGN KEY (sector_lote_id) REFERENCES sector_lotes (id),
    CONSTRAINT fk_gastos_users FOREIGN KEY (user_registro_id) REFERENCES users (id)
    #CONSTRAINT fk_gastos_users_anula FOREIGN KEY (user_anula_id) REFERENCES users (id)
);

create table detalles_gastos(
	secuencia int(255),
    gasto_id int(255),
    sector_lote_id int(255),
	producto_id int(255),
    cantidad decimal(10,2),
    hectareas_aplicado decimal(10,2),
	costo decimal(10,2),
	unidad_medida varchar(10),
    factor decimal(10,2),
    total decimal(10,2),
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL,
    KEY fk_detalles_gastos_sector_lotes (sector_lote_id),
	CONSTRAINT fk_detalles_gastos_sector_lotes FOREIGN KEY (sector_lote_id) REFERENCES sector_lotes (id),
    KEY fk_detalles_gastos_productos (producto_id),
	CONSTRAINT fk_detalles_gastos_productos FOREIGN KEY (producto_id) REFERENCES productos (id),
    CONSTRAINT fk_detalles_gastos_gastos FOREIGN KEY (gasto_id) REFERENCES gastos (id)
);
#drop table detalle_produccion;
#drop table produccion;
create table produccion(
	id int(255) NOT NULL AUTO_INCREMENT,
    comentario varchar(100),
    fecha_documento datetime,
    sector_lote_id int(255),
	total_produccion decimal(10,2),
    user_registro_id bigint(20) unsigned NOT NULL,
    anulado tinyint(1) DEFAULT 0, # 1 = ANULADO; 0 = NO ANULADO
    comentario_anulacion varchar(100),
    user_anula_id bigint(20) unsigned null,
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT fk_produccion_sector_lotes FOREIGN KEY (sector_lote_id) REFERENCES sector_lotes (id),
    CONSTRAINT fk_produccion_users FOREIGN KEY (user_registro_id) REFERENCES users (id),
    CONSTRAINT fk_produccion_users_anula FOREIGN KEY (user_anula_id) REFERENCES users (id)
);

create table detalle_produccion(
	secuencia int(255),
    produccion_id int(255),
	producto_id int(255),
    cantidad decimal(10,2),
    unidad_medida varchar(10),
    factor decimal(10,2),
    cajas decimal(10,2),
    total decimal(10,2),
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL,    
	CONSTRAINT fk_detalles_produccion_productos FOREIGN KEY (producto_id) REFERENCES productos (id),
    CONSTRAINT fk_detalles_produccion_produccion FOREIGN KEY (produccion_id) REFERENCES produccion (id)
);
#drop table detalle_ventas;
#drop table ventas;
create table ventas(
	id int(255) NOT NULL AUTO_INCREMENT,
    cliente_id int(255),
    tipo_venta varchar(15),
    comentario varchar(100),
    fecha_documento datetime,
	total_venta decimal(10,2),
    user_registro_id bigint(20) unsigned NOT NULL,
    anulado tinyint(1) DEFAULT 0, # 1 = ANULADO; 0 = NO ANULADO
    comentario_anulacion varchar(100),
    user_anula_id bigint(20) unsigned null,
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL,
	PRIMARY KEY (`id`),
    CONSTRAINT fk_ventas_users FOREIGN KEY (user_registro_id) REFERENCES users (id),
    CONSTRAINT fk_ventas_users_anula FOREIGN KEY (user_anula_id) REFERENCES users (id),
    CONSTRAINT fk_ventas_cliente FOREIGN KEY (cliente_id) REFERENCES clientes (id)
);

create table detalle_ventas(
	secuencia int(255),
    venta_id int(255),
	producto_id int(255),
    cantidad decimal(10,2),
    cajas decimal(10,2),
	precio_unitario decimal(10,2),
	unidad_medida varchar(10),
    factor decimal(10,2),
    total decimal(10,2),
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL,    
	CONSTRAINT fk_detalle_ventas_productos FOREIGN KEY (producto_id) REFERENCES productos (id),
    CONSTRAINT fk_detalle_ventas_gastos FOREIGN KEY (venta_id) REFERENCES ventas (id)
);


create view vw_gastos_ventas as
	select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(   
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,1 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 1 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,1 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 1 and anulado = 0
    ) tmp #ENERO
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,2 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 2 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,2 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 2 and anulado = 0
    ) tmp #FEBRERO
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,3 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 3 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,3 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 3 and anulado = 0
    ) tmp #MARZO
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,4 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 4 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,4 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 4 and anulado = 0
    ) tmp #ABRIL
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,5 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 5 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,5 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 5 and anulado = 0
    ) tmp #MAYO
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,6 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 6 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,6 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 6 and anulado = 0
    ) tmp #JUNIO
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,7 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 7 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,7 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 7 and anulado = 0
    ) tmp #JULIO
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,8 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 8 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,8 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 8 and anulado = 0
    ) tmp #AGOSTO
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,9 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 9 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,9 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 9 and anulado = 0
    ) tmp #SEPTIEMBRE
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,10 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 10 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,10 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 10 and anulado = 0
    ) tmp #OCTUBRE
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,11 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 11 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,11 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 11 and anulado = 0
    ) tmp #NOVIEMBRE
    union all
    select sum(gastos) gastos, sum(ventas) ventas, month, fecha_documento, anio from(
        select ifnull(sum(total_gasto),0) as gastos, 0 ventas,12 month, year(curtime()) anio,fecha_documento from gastos where month(fecha_documento) = 12 and anulado = 0
        union all 
        select 0 gastos,ifnull(sum(total_venta),0) as ventas,12 month, year(curtime()) anio,fecha_documento from ventas where month(fecha_documento) = 12 and anulado = 0
    ) tmp #DICIEMBRE


alter view vw_gastos_produccion as
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,1 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 1 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,1 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 1 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 1 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'ene_feb'
		group by descripcion
) tmp #ENERO 
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,2 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 2 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,2 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 2 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 2 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'ene_feb'
		group by descripcion
) tmp #FEBRERO
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,3 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 3 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,3 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 3 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 3 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'mar_abr'
		group by descripcion
) tmp #MARZO
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,4 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 4 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,4 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 4 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 4 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'mar_abr'
		group by descripcion
) tmp #ABRIL
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,5 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 5 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,5 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 5 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 5 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'may_jun'
		group by descripcion
) tmp #MAYO
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,6 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 6 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,6 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 6 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 6 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'may_jun'
		group by descripcion
) tmp #JUNIO
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,7 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 7 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,7 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 7 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 7 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'jul_ago'
		group by descripcion
) tmp #JULIO
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,8 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 8 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,8 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 8 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 8 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'jul_ago'
		group by descripcion
) tmp #AGOSTO
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,9 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 9 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,9 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 9 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 9 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'sep_oct'
		group by descripcion
) tmp #SEPTIEMBRE
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,10 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 10 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,10 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 10 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 10 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'sep_oct'
		group by descripcion
) tmp #OCTUBRE
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,11 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 11 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,11 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 11 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 11 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'nov_dic'
		group by descripcion
) tmp #NOVIEMBRE
group by nombre_lote
union all
select exist,sum(gastos) gastos, sum(produccion) produccion, month, anio, nombre_lote,dualidad_mes from(
	select 0 exist,ifnull(sum(total_gasto),0) as gastos, 0 produccion,12 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote  from gastos where month(fecha_documento) = 12 and anulado = 0
		group by sector_lote_id
	union all 
	select 0 exist,0 gastos,ifnull(sum(total_produccion),0) as produccion,12 month, year(fecha_documento) anio,
		(select dualidad_mes from sector_lotes where id = sector_lote_id) dualidad_mes,
        (select descripcion from sector_lotes where id = sector_lote_id) nombre_lote from produccion where month(fecha_documento) = 12 and anulado = 0
	group by sector_lote_id
    union all
		select count(id) exist,0 gastos, 0.00 produccion, 12 month, year(curtime()) anio, dualidad_mes, descripcion from sector_lotes where dualidad_mes = 'nov_dic'
		group by descripcion
) tmp #DICIEMBRE
group by nombre_lote
