CREATE TABLE tipo_trabajo
(
	id_tipo_trabajo serial NOT NULL,
	nombre_tipo_trabajo character varying,
	CONSTRAINT id_tipo_trabajo PRIMARY KEY (id_tipo_trabajo)
);
INSERT INTO tipo_trabajo(id_tipo_trabajo,nombre_tipo_trabajo) VALUES('1','PPS'),('2','Pasantía'),('3','Trabajo en Blanco');

CREATE TABLE tipo_dni
(
	id_tipo_dni serial NOT NULL,
	nombre_tipo_dni character varying,
	CONSTRAINT id_tipo_dni PRIMARY KEY (id_tipo_dni)
);



CREATE TABLE alumno
(
	id_alumno serial NOT NULL,
	nombre_alumno character varying,
	apellido_alumno character varying,
	tipo_dni_alumno integer references tipo_dni(id_tipo_dni),
	num_dni_alumno integer,
	direccion_alumno character varying,
	localidad_alumno character varying,
	fecha_nac_alumno character varying,
	caracteristica_cel integer,
	celular_alumno integer,
	caracteristica_fijo integer,
	telefono_alumno integer,
	mail_alumno character varying,
	titulo_secundario character varying,
	usuario_alumno character varying,
	password_alumno character varying,
	privilegios_alumno integer,
	establecimiento_alumno character varying,
	carrera_alumno character varying,
	materias_aprobadas_alumno character varying,
	cursa_anio_alumno character varying,
	promedio_alumno character varying,
	legajo_alumno character varying,
	CONSTRAINT id_alumno PRIMARY KEY (id_alumno)
);

CREATE TABLE empresa
(
	id_empresa serial NOT NULL,
	fecha character varying,
	razon_social character varying,
	direccion_empresa character varying,
	localidad_empresa character varying,
	cp integer,
	telefono_empresa integer,
	fax integer,
	mail_empresa character varying,
	nombre_encargado character varying,
	puesto_encargado character varying,
	tipo_dni_encargado integer references tipo_dni(id_tipo_dni),
	num_dni_encargado integer,
	telefono_encargado integer,
	dia_entrevista character varying,
	hora_entrevista character varying,
	tutor_empresa character varying,
	usuario_empresa character varying,
	password_empresa character varying,
	privilegios_empresa integer,

	CONSTRAINT id_empresa PRIMARY KEY (id_empresa)
);

CREATE TABLE cursos_seminarios
(
	id_cursos_seminarios serial NOT NULL,
	nombre_cursos_seminarios character varying,
	alumno_cs integer references alumno(id_alumno),
	CONSTRAINT TABLE id_cursos_seminarios PRIMARY KEY (id_cursos_seminarios)
);

CREATE TABLE antecedentes_laborales
(
	id_antecedentes_laborales serial NOT NULL,
	nombre_antecedentes_laborales character varying,
	alumno_antecedentes_laborales integer references alumno(id_alumno),
	CONSTRAINT id_antecedentes_laborales PRIMARY KEY (id_antecedentes_laborales)
);

CREATE TABLE conocimientos_pc
(
	id_conocimientos_pc serial NOT NULL,
	nombre_conocimientos_pc character varying,
	alumno_conocimientos_pc integer references alumno(id_alumno),
	CONSTRAINT id_conocimientos_pc PRIMARY KEY (id_conocimientos_pc)
);

CREATE TABLE solicitud
(
	id_solicitud serial NOT NULL,
	empresa_solicitud integer references empresa(id_empresa),
	tipo_trabajo_solicitud integer references tipo_trabajo(id_tipo_trabajo),
	perfil character varying,
	tareas_desempeniar character varying,
	area_empresa character varying,
	cant_horas_diarias integer,
	carga_horaria_semanal integer,
	edad_solicitante integer,
	experiencia character varying,
	otros_conocimientos character varying,
	estimulo character varying,
	otros_beneficios character varying,
	duracion_pasantia character varying,
	cant_pasantes integer,
	CONSTRAINT id_solicitud PRIMARY KEY (id_solicitud)
);
