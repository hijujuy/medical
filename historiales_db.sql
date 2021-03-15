-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-11-2020 a las 03:01:16
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `historiales_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes_familiares`
--

CREATE TABLE `antecedentes_familiares` (
  `id` int(11) NOT NULL,
  `hta` tinyint(1) NOT NULL DEFAULT 0,
  `iam` tinyint(1) NOT NULL DEFAULT 0,
  `acv_ait` tinyint(1) NOT NULL DEFAULT 0,
  `dislipemia` tinyint(1) NOT NULL DEFAULT 0,
  `diabetes` tinyint(1) NOT NULL DEFAULT 0,
  `enf_celiaca` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `antecedentes_familiares`
--

INSERT INTO `antecedentes_familiares` (`id`, `hta`, `iam`, `acv_ait`, `dislipemia`, `diabetes`, `enf_celiaca`) VALUES
(35, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `circulatorio`
--

CREATE TABLE `circulatorio` (
  `id` int(11) NOT NULL,
  `acv_ait` tinyint(1) NOT NULL DEFAULT 0,
  `aim` tinyint(1) NOT NULL DEFAULT 0,
  `angioplastia_bypass` tinyint(1) NOT NULL DEFAULT 0,
  `ecg` tinyint(1) NOT NULL DEFAULT 0,
  `ecodoppler` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `circulatorio`
--

INSERT INTO `circulatorio` (`id`, `acv_ait`, `aim`, `angioplastia_bypass`, `ecg`, `ecodoppler`) VALUES
(35, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complicaciones_agudas_de_diabetes`
--

CREATE TABLE `complicaciones_agudas_de_diabetes` (
  `id` int(11) NOT NULL,
  `tuvo_episodios` tinyint(1) NOT NULL DEFAULT 0,
  `cantidad_episodios_ultimo_anio` int(11) NOT NULL DEFAULT 0,
  `hipoglucemia_severas` int(11) NOT NULL DEFAULT 0,
  `cetoacidosis` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `complicaciones_agudas_de_diabetes`
--

INSERT INTO `complicaciones_agudas_de_diabetes` (`id`, `tuvo_episodios`, `cantidad_episodios_ultimo_anio`, `hipoglucemia_severas`, `cetoacidosis`) VALUES
(35, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conducta_medica`
--

CREATE TABLE `conducta_medica` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `observacion` varchar(1000) NOT NULL,
  `id_historial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_clinicos`
--

CREATE TABLE `datos_clinicos` (
  `id` int(11) NOT NULL,
  `tabaco` int(11) NOT NULL DEFAULT 0,
  `peso` float NOT NULL DEFAULT 0,
  `imc` float NOT NULL DEFAULT 0,
  `tension_arterial` float NOT NULL DEFAULT 0,
  `perimetro_cintura` float NOT NULL DEFAULT 0,
  `examen_pies` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_laboratorio`
--

CREATE TABLE `datos_laboratorio` (
  `id` int(11) NOT NULL,
  `glucemia` float NOT NULL DEFAULT 0,
  `hba1c` float NOT NULL DEFAULT 0,
  `got` float NOT NULL DEFAULT 0,
  `gpt` float NOT NULL DEFAULT 0,
  `fal` float NOT NULL DEFAULT 0,
  `colesterol_total` float NOT NULL DEFAULT 0,
  `hdl` float NOT NULL DEFAULT 0,
  `ldl` float NOT NULL DEFAULT 0,
  `trigliceridos` float NOT NULL DEFAULT 0,
  `clearence_de_creatinina` float NOT NULL DEFAULT 0,
  `creatinina` float NOT NULL DEFAULT 0,
  `estadio` float NOT NULL DEFAULT 0,
  `proteinuria` float NOT NULL DEFAULT 0,
  `creatininuria` float NOT NULL DEFAULT 0,
  `microalbuminuria` float NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `descripcion`) VALUES
(1, 'DR. MANUEL BELGRANO'),
(2, 'SAN PEDRO DE JUJUY'),
(3, 'LEDESMA'),
(5, 'PERICO'),
(10, 'SUSQUES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticos`
--

CREATE TABLE `diagnosticos` (
  `id` int(11) NOT NULL,
  `glucemia_alterada_en_ayunas` tinyint(1) NOT NULL DEFAULT 0,
  `tolerancia_glucosa_alterada` tinyint(1) NOT NULL DEFAULT 0,
  `diabetes` tinyint(1) NOT NULL DEFAULT 0,
  `diabetes_tiempo_evolucion` int(11) NOT NULL DEFAULT 0,
  `diabetes_tipo` int(11) NOT NULL DEFAULT 1,
  `diabetes_semanas_gestacion` int(11) NOT NULL DEFAULT 0,
  `hipertension_arterial` tinyint(1) NOT NULL DEFAULT 0,
  `hipertension_arterial_tiempo_evolucion` int(11) NOT NULL DEFAULT 0,
  `dislipemia` tinyint(1) NOT NULL DEFAULT 0,
  `preclasificacion_rcvg` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `diagnosticos`
--

INSERT INTO `diagnosticos` (`id`, `glucemia_alterada_en_ayunas`, `tolerancia_glucosa_alterada`, `diabetes`, `diabetes_tiempo_evolucion`, `diabetes_tipo`, `diabetes_semanas_gestacion`, `hipertension_arterial`, `hipertension_arterial_tiempo_evolucion`, `dislipemia`, `preclasificacion_rcvg`) VALUES
(35, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE `enfermedad` (
  `id` int(11) NOT NULL,
  `enfermedad` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`id`, `enfermedad`) VALUES
(1, 'NINGUNA'),
(2, 'TIROIDEA'),
(3, 'REUMATICA'),
(4, 'DIABETES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedades_asociadas`
--

CREATE TABLE `enfermedades_asociadas` (
  `id` int(11) NOT NULL,
  `enfermedad_tiroidea` tinyint(1) NOT NULL DEFAULT 0,
  `enfermedad_tiroidea_tipo` int(11) NOT NULL DEFAULT 0,
  `tbc` tinyint(1) NOT NULL DEFAULT 0,
  `enfermedad_celiaca` tinyint(1) NOT NULL DEFAULT 0,
  `enfermedad_reumatica` tinyint(1) NOT NULL DEFAULT 0,
  `enfermedad_reumatica_tipo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enfermedades_asociadas`
--

INSERT INTO `enfermedades_asociadas` (`id`, `enfermedad_tiroidea`, `enfermedad_tiroidea_tipo`, `tbc`, `enfermedad_celiaca`, `enfermedad_reumatica`, `enfermedad_reumatica_tipo`) VALUES
(35, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermeria`
--

CREATE TABLE `enfermeria` (
  `id` int(11) NOT NULL,
  `consejeria` tinyint(1) NOT NULL DEFAULT 0,
  `curaciones` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enfermeria`
--

INSERT INTO `enfermeria` (`id`, `consejeria`, `curaciones`) VALUES
(35, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--

CREATE TABLE `estado_civil` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_civil`
--

INSERT INTO `estado_civil` (`id`, `descripcion`) VALUES
(1, 'SOLTERO'),
(2, 'CASADO'),
(3, 'U.ESTABLE'),
(4, 'OTRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE `estudio` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudio`
--

INSERT INTO `estudio` (`id`, `descripcion`) VALUES
(1, 'NINGUNO'),
(2, 'PRIMARIO'),
(3, 'SECUNDARIO'),
(4, 'UNIVERSITARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_fisico`
--

CREATE TABLE `examen_fisico` (
  `id` int(11) NOT NULL,
  `peso` float NOT NULL DEFAULT 0,
  `talla` float NOT NULL DEFAULT 0,
  `imc` float NOT NULL DEFAULT 0,
  `perimetro_cintura` float NOT NULL DEFAULT 0,
  `ta_sistolica` float NOT NULL DEFAULT 0,
  `ta_diastolica` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `examen_fisico`
--

INSERT INTO `examen_fisico` (`id`, `peso`, `talla`, `imc`, `perimetro_cintura`, `ta_sistolica`, `ta_diastolica`) VALUES
(35, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factores_de_riesgo_asociados`
--

CREATE TABLE `factores_de_riesgo_asociados` (
  `id` int(11) NOT NULL,
  `obesidad` tinyint(1) NOT NULL DEFAULT 0,
  `sedentarismo` tinyint(1) NOT NULL DEFAULT 0,
  `tabaco` tinyint(1) NOT NULL DEFAULT 0,
  `alcoholismo` tinyint(1) NOT NULL DEFAULT 0,
  `anticoagulantes` tinyint(1) NOT NULL DEFAULT 0,
  `corticoides` tinyint(1) NOT NULL DEFAULT 0,
  `anticonceptivos` tinyint(1) NOT NULL DEFAULT 0,
  `menospausia_prematura` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factores_de_riesgo_asociados`
--

INSERT INTO `factores_de_riesgo_asociados` (`id`, `obesidad`, `sedentarismo`, `tabaco`, `alcoholismo`, `anticoagulantes`, `corticoides`, `anticonceptivos`, `menospausia_prematura`) VALUES
(35, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `descripcion`) VALUES
(1, 'FEMENINO'),
(2, 'MASCULINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `hospital_id`) VALUES
(35, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hospital`
--

INSERT INTO `hospital` (`id`, `descripcion`) VALUES
(1, 'HOSPITAL OSCAR ORIAS'),
(2, 'HOSPITAL PABLO SORIA'),
(3, 'HOSPITAL SAN ROQUE'),
(4, 'HOSPITAL DE NIÑOS JUJUY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmunizaciones`
--

CREATE TABLE `inmunizaciones` (
  `id` int(11) NOT NULL,
  `antigripal` tinyint(1) NOT NULL DEFAULT 0,
  `antineumococo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmunizaciones`
--

INSERT INTO `inmunizaciones` (`id`, `antigripal`, `antineumococo`) VALUES
(35, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `internaciones_relaciondas_con_enfermedad_de_base`
--

CREATE TABLE `internaciones_relaciondas_con_enfermedad_de_base` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `dias` int(11) NOT NULL DEFAULT 0,
  `causas` text NOT NULL,
  `id_historial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id` int(11) NOT NULL,
  `glucemia_en_ayunas` float NOT NULL DEFAULT 0,
  `colesterol_total` float NOT NULL DEFAULT 0,
  `trigliceridos` float NOT NULL DEFAULT 0,
  `iga_total` float NOT NULL DEFAULT 0,
  `ptog_desde` float NOT NULL DEFAULT 0,
  `ptog_hasta` float NOT NULL DEFAULT 0,
  `colesterol_hdl` float NOT NULL DEFAULT 0,
  `got` float NOT NULL DEFAULT 0,
  `gpt` float NOT NULL DEFAULT 0,
  `antitransglutaminasa` float NOT NULL DEFAULT 0,
  `hba1c` float NOT NULL DEFAULT 0,
  `colesterol_ldl` float NOT NULL DEFAULT 0,
  `fal` float NOT NULL DEFAULT 0,
  `creatinina` float NOT NULL DEFAULT 0,
  `clearence_de_creatinina` float NOT NULL DEFAULT 0,
  `fg` float NOT NULL DEFAULT 0,
  `proteinuria` float NOT NULL DEFAULT 0,
  `proteinuria_creatininuria` float NOT NULL DEFAULT 0,
  `urea` float NOT NULL DEFAULT 0,
  `microalbuminuria` float NOT NULL DEFAULT 0,
  `nivel_de_riesgo_cardiovascular_global` int(11) NOT NULL DEFAULT 1,
  `participacion_talleres_autocuidado` tinyint(1) NOT NULL DEFAULT 0,
  `observaciones` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id`, `glucemia_en_ayunas`, `colesterol_total`, `trigliceridos`, `iga_total`, `ptog_desde`, `ptog_hasta`, `colesterol_hdl`, `got`, `gpt`, `antitransglutaminasa`, `hba1c`, `colesterol_ldl`, `fal`, `creatinina`, `clearence_de_creatinina`, `fg`, `proteinuria`, `proteinuria_creatininuria`, `urea`, `microalbuminuria`, `nivel_de_riesgo_cardiovascular_global`, `participacion_talleres_autocuidado`, `observaciones`) VALUES
(35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `departamento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id`, `descripcion`, `codigo_postal`, `departamento_id`) VALUES
(1, 'LIBERTADOR GENERAL SAN MARTIN', '4512', 3),
(2, 'SAN PEDRO DE JUJUY', '5500', 2),
(3, 'SAN SALVADOR DE JUJUY', '4600', 1),
(4, 'LA QUIACA', '4400', 10),
(5, 'YUTO', '4520', 3),
(6, 'LA MENDIETA', '5510', 2),
(7, 'ARENALES', '5534', 2),
(8, 'LOZANO', '1200', 1),
(9, 'YALA', '1300', 1),
(10, 'PERICO', '2300', 5),
(11, 'MONTERRICO', '2310', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `insulina_nph` float NOT NULL DEFAULT 0,
  `insulina_rapida` float NOT NULL DEFAULT 0,
  `metformina` float NOT NULL DEFAULT 0,
  `glibenclamida` float NOT NULL DEFAULT 0,
  `enalapril` float NOT NULL DEFAULT 0,
  `atenolol` float NOT NULL DEFAULT 0,
  `hidroclorotiazida` float NOT NULL DEFAULT 0,
  `aas` float NOT NULL DEFAULT 0,
  `simvastatina` float NOT NULL DEFAULT 0,
  `fenofibrato` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nutricion`
--

CREATE TABLE `nutricion` (
  `id` int(11) NOT NULL,
  `tiene_conocimientos_basicos` tinyint(1) NOT NULL DEFAULT 0,
  `asiste_control` tinyint(1) NOT NULL DEFAULT 0,
  `cumple_plan_de_alimentacion` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nutricion`
--

INSERT INTO `nutricion` (`id`, `tiene_conocimientos_basicos`, `asiste_control`, `cumple_plan_de_alimentacion`) VALUES
(35, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_social`
--

CREATE TABLE `obra_social` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `obra_social`
--

INSERT INTO `obra_social` (`id`, `descripcion`) VALUES
(1, 'NINGUNO'),
(2, 'INC.SALUD'),
(3, 'I.S.J.'),
(4, 'PAMI'),
(5, 'OTRA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `odontologia`
--

CREATE TABLE `odontologia` (
  `id` int(11) NOT NULL,
  `control_odontologico` tinyint(1) NOT NULL DEFAULT 0,
  `enfermedad_periodontal` tinyint(1) NOT NULL DEFAULT 0,
  `flemones` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `odontologia`
--

INSERT INTO `odontologia` (`id`, `control_odontologico`, `enfermedad_periodontal`, `flemones`) VALUES
(35, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oftalmologia`
--

CREATE TABLE `oftalmologia` (
  `id` int(11) NOT NULL,
  `examen_actual` tinyint(1) NOT NULL DEFAULT 0,
  `fondo_de_ojos` tinyint(1) NOT NULL DEFAULT 0,
  `amaurosis` tinyint(1) NOT NULL DEFAULT 0,
  `cataratas` tinyint(1) NOT NULL DEFAULT 0,
  `glaucoma` tinyint(1) NOT NULL DEFAULT 0,
  `maculopatia` tinyint(1) NOT NULL DEFAULT 0,
  `retinopatia` tinyint(1) NOT NULL DEFAULT 0,
  `proliferativa` tinyint(1) NOT NULL DEFAULT 0,
  `no_proliferativa` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `oftalmologia`
--

INSERT INTO `oftalmologia` (`id`, `examen_actual`, `fondo_de_ojos`, `amaurosis`, `cataratas`, `glaucoma`, `maculopatia`, `retinopatia`, `proliferativa`, `no_proliferativa`) VALUES
(35, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero_id` tinyint(1) NOT NULL,
  `estado_civil_id` int(11) NOT NULL,
  `obra_social_id` int(11) NOT NULL,
  `estudio_id` int(11) NOT NULL,
  `domicilio` varchar(300) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `localidad_id` int(11) NOT NULL,
  `departamento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `dni`, `nombre`, `fecha_nacimiento`, `genero_id`, `estado_civil_id`, `obra_social_id`, `estudio_id`, `domicilio`, `telefono`, `localidad_id`, `departamento_id`) VALUES
(35, 11223344, 'PEREZ JUAN', '1990-07-08', 2, 2, 3, 1, 'AV. LIBERTAD 550', '4998876', 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pies`
--

CREATE TABLE `pies` (
  `id` int(11) NOT NULL,
  `examen_actual` tinyint(1) NOT NULL DEFAULT 0,
  `ausencia_de_pulso_pedio` tinyint(1) NOT NULL DEFAULT 0,
  `ausencia_de_relejos` tinyint(1) NOT NULL DEFAULT 0,
  `alteracion_sensibilidad` tinyint(1) NOT NULL DEFAULT 0,
  `claudicacion_interminente` tinyint(1) NOT NULL DEFAULT 0,
  `ulcera` tinyint(1) NOT NULL DEFAULT 0,
  `amputacion` tinyint(1) NOT NULL DEFAULT 0,
  `ecodoppler_periferico` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `psicologia`
--

CREATE TABLE `psicologia` (
  `id` int(11) NOT NULL,
  `realizo_entrevista` tinyint(1) NOT NULL DEFAULT 0,
  `asiste_a_terapia` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `psicologia`
--

INSERT INTO `psicologia` (`id`, `realizo_entrevista`, `asiste_a_terapia`) VALUES
(35, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renal`
--

CREATE TABLE `renal` (
  `id` int(11) NOT NULL,
  `nefropatia` tinyint(1) NOT NULL DEFAULT 0,
  `nefropatia_tipo` tinyint(1) NOT NULL DEFAULT 0,
  `dialisis` tinyint(1) NOT NULL DEFAULT 0,
  `transplante` tinyint(1) NOT NULL DEFAULT 0,
  `ecografia` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `renal`
--

INSERT INTO `renal` (`id`, `nefropatia`, `nefropatia_tipo`, `dialisis`, `transplante`, `ecografia`) VALUES
(35, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `adherencia_al_tratamiento` tinyint(1) NOT NULL DEFAULT 0,
  `ecg` tinyint(1) NOT NULL DEFAULT 0,
  `riesgo_cardiovascular` int(11) NOT NULL DEFAULT 1,
  `automonitoreo` tinyint(1) NOT NULL DEFAULT 0,
  `id_historial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_interconsulta`
--

CREATE TABLE `solicitud_interconsulta` (
  `id` int(11) NOT NULL,
  `cardiologia` tinyint(1) NOT NULL DEFAULT 0,
  `endocrinologia` tinyint(1) NOT NULL DEFAULT 0,
  `nefrologia` tinyint(1) NOT NULL DEFAULT 0,
  `nutricion` tinyint(1) NOT NULL DEFAULT 0,
  `odontologia` tinyint(1) NOT NULL DEFAULT 0,
  `oftalmologia` tinyint(1) NOT NULL DEFAULT 0,
  `psicologia` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud_interconsulta`
--

INSERT INTO `solicitud_interconsulta` (`id`, `cardiologia`, `endocrinologia`, `nefrologia`, `nutricion`, `odontologia`, `oftalmologia`, `psicologia`) VALUES
(35, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_practica`
--

CREATE TABLE `solicitud_practica` (
  `id` int(11) NOT NULL,
  `laboratorios` tinyint(1) NOT NULL DEFAULT 0,
  `laboratorios_observacion` varchar(500) DEFAULT NULL,
  `otros_estudios` tinyint(1) NOT NULL DEFAULT 0,
  `otros_estudios_observacion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud_practica`
--

INSERT INTO `solicitud_practica` (`id`, `laboratorios`, `laboratorios_observacion`, `otros_estudios`, `otros_estudios_observacion`) VALUES
(35, 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_enfermedad`
--

CREATE TABLE `tipos_enfermedad` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `enfermedad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_enfermedad`
--

INSERT INTO `tipos_enfermedad` (`id`, `descripcion`, `enfermedad_id`) VALUES
(1, 'TIPO 1', 4),
(2, 'TIPO 2 INSULINIZADO', 4),
(3, 'HIPOTIROIDISMO', 2),
(4, 'HIPERTIROIDISMO', 2),
(5, 'ARTRITIS', 3),
(6, 'TIPO 2 CON HIPOGLUCEMIANTES', 4),
(7, 'TIPO 2 INSULINIZADO + HO', 4),
(8, 'GESTACIONAL', 4),
(9, 'GESTACIONAL INSULINIZADO', 4),
(10, 'OTRO', 4),
(11, 'ARTROSIS', 3),
(12, 'OSTEOPOROSIS', 3),
(13, 'CANCER DE TIROIDES', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento_actual`
--

CREATE TABLE `tratamiento_actual` (
  `id` int(11) NOT NULL,
  `insulina_nph` float NOT NULL DEFAULT 0,
  `insulina_rapida` float NOT NULL DEFAULT 0,
  `metformina` float NOT NULL DEFAULT 0,
  `glibenclamida` float NOT NULL DEFAULT 0,
  `enalapril` float NOT NULL DEFAULT 0,
  `atenolol` float NOT NULL DEFAULT 0,
  `furosemida` float NOT NULL DEFAULT 0,
  `hidroclorotiazida` float NOT NULL DEFAULT 0,
  `aas` float NOT NULL DEFAULT 0,
  `simvastatina` float NOT NULL DEFAULT 0,
  `fenofibrato` float NOT NULL DEFAULT 0,
  `automonitoreo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tratamiento_actual`
--

INSERT INTO `tratamiento_actual` (`id`, `insulina_nph`, `insulina_rapida`, `metformina`, `glibenclamida`, `enalapril`, `atenolol`, `furosemida`, `hidroclorotiazida`, `aas`, `simvastatina`, `fenofibrato`, `automonitoreo`) VALUES
(35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentes_familiares`
--
ALTER TABLE `antecedentes_familiares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `circulatorio`
--
ALTER TABLE `circulatorio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `complicaciones_agudas_de_diabetes`
--
ALTER TABLE `complicaciones_agudas_de_diabetes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `conducta_medica`
--
ALTER TABLE `conducta_medica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_clinicos`
--
ALTER TABLE `datos_clinicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_laboratorio`
--
ALTER TABLE `datos_laboratorio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enfermedades_asociadas`
--
ALTER TABLE `enfermedades_asociadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enfermeria`
--
ALTER TABLE `enfermeria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen_fisico`
--
ALTER TABLE `examen_fisico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factores_de_riesgo_asociados`
--
ALTER TABLE `factores_de_riesgo_asociados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inmunizaciones`
--
ALTER TABLE `inmunizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `internaciones_relaciondas_con_enfermedad_de_base`
--
ALTER TABLE `internaciones_relaciondas_con_enfermedad_de_base`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento_id` (`departamento_id`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nutricion`
--
ALTER TABLE `nutricion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `odontologia`
--
ALTER TABLE `odontologia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oftalmologia`
--
ALTER TABLE `oftalmologia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pies`
--
ALTER TABLE `pies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `psicologia`
--
ALTER TABLE `psicologia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `renal`
--
ALTER TABLE `renal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_interconsulta`
--
ALTER TABLE `solicitud_interconsulta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_practica`
--
ALTER TABLE `solicitud_practica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_enfermedad`
--
ALTER TABLE `tipos_enfermedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enfermedad_id` (`enfermedad_id`);

--
-- Indices de la tabla `tratamiento_actual`
--
ALTER TABLE `tratamiento_actual`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conducta_medica`
--
ALTER TABLE `conducta_medica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudio`
--
ALTER TABLE `estudio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `internaciones_relaciondas_con_enfermedad_de_base`
--
ALTER TABLE `internaciones_relaciondas_con_enfermedad_de_base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipos_enfermedad`
--
ALTER TABLE `tipos_enfermedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tipos_enfermedad`
--
ALTER TABLE `tipos_enfermedad`
  ADD CONSTRAINT `tipos_enfermedad_ibfk_1` FOREIGN KEY (`enfermedad_id`) REFERENCES `enfermedad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
