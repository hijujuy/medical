<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'inicio';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['templates/(:any)'] = "templates/view/$1";

$route['historial/(:num)']['get'] = 'historial_controller/index/$1';
$route['historial']['post'] = 'historial_controller/create';
$route['historial/(:num)']['post'] = 'historial_controller/update/$1';

$route['pacientes']['get'] = 'paciente_controller/index';
$route['pacientes/(:num)']['get'] = 'paciente_controller/find/$1';
$route['pacientes']['post'] = 'paciente_controller/index';
$route['pacientes/(:num)']['post'] = 'paciente_controller/update/$1';

$route['diagnosticos/(:num)']['post'] = 'diagnosticos_controller/update/$1';
$route['enfermedades_asociadas/(:num)']['post'] = 'enfermedades_asociadas_controller/update/$1';
$route['factores_de_riesgo_asociados/(:num)']['post'] = 'factores_de_riesgo_asociados_controller/update/$1';
$route['antecedentes_familiares/(:num)']['post'] = 'antecedentes_familiares_controller/update/$1';
$route['odontologia/(:num)']['post'] = 'odontologia_controller/update/$1';
$route['nutricion/(:num)']['post'] = 'nutricion_controller/update/$1';
$route['psicologia/(:num)']['post'] = 'psicologia_controller/update/$1';
$route['enfermeria/(:num)']['post'] = 'enfermeria_controller/update/$1';
$route['oftalmologia/(:num)']['post'] = 'oftalmologia_controller/update/$1';
$route['circulatorio/(:num)']['post'] = 'circulatorio_controller/update/$1';
$route['renal/(:num)']['post'] = 'renal_controller/update/$1';
$route['examen_fisico/(:num)']['post'] = 'examen_fisico_controller/update/$1';
$route['complicaciones_agudas_de_diabetes/(:num)']['post'] = 'complicaciones_agudas_de_diabetes_controller/update/$1';

$route['laboratorio/(:num)']['post'] = 'laboratorio_controller/update/$1';
$route['laboratorio/(:num)']['get'] = 'laboratorio_controller/index/$1';

$route['tratamiento_actual/(:num)']['post'] = 'tratamiento_actual_controller/update/$1';

$route['conducta_medica/(:num)']['get'] =  'conducta_medica_controller/index/$1';
$route['conducta_medica']['post'] = 'conducta_medica_controller/create';
$route['conducta_medica/(:num)']['post'] = 'conducta_medica_controller/update/$1';

$route['solicitud_interconsulta/(:num)']['post'] = 'solicitud_interconsulta_controller/update/$1';
$route['inmunizaciones/(:num)']['post'] = 'inmunizaciones_controller/update/$1';
$route['solicitud_practica/(:num)']['post'] = 'solicitud_practica_controller/update/$1';

$route['seguimiento/(:num)']['get'] = 'seguimiento_controller/letone/$1';
$route['seguimiento/create/(:num)']['post'] = 'seguimiento_controller/index/$1';
$route['seguimiento/(:num)']['post'] = 'seguimiento_controller/update/$1';

$route['datos_clinicos/(:num)']['get'] = 'datos_clinicos_controller/letone/$1';
$route['datos_clinicos/(:num)']['post'] = 'datos_clinicos_controller/update/$1';

$route['datos_laboratorio/(:num)']['get'] = 'datos_laboratorio_controller/letone/$1';
$route['datos_laboratorio/(:num)']['post'] = 'datos_laboratorio_controller/update/$1';

$route['medicamentos/(:num)']['post'] = 'medicamentos_controller/update/$1';

$route['internaciones_relacionadas_con_enfermedad_de_base/(:num)']['get'] =  'internaciones_relacionadas_con_enfermedad_de_base_controller/index/$1';
$route['internaciones_relacionadas_con_enfermedad_de_base/(:num)']['post'] = 'internaciones_relacionadas_con_enfermedad_de_base_controller/update/$1';
$route['internaciones_relacionadas_con_enfermedad_de_base']['post'] = 'internaciones_relacionadas_con_enfermedad_de_base_controller/create';
$route['internaciones_relacionadas_con_enfermedad_de_base/delete']['post'] = 'internaciones_relacionadas_con_enfermedad_de_base_controller/delete';

$route['obra_social']['get'] = 'obra_social_controller/index';
$route['estado_civil']['get'] = 'estado_civil_controller/index';
$route['departamento']['get'] = 'departamento_controller/index';
$route['localidad']['get'] = 'localidad_controller/index';
$route['enfermedad']['get'] = 'enfermedad_controller/index';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------

$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
*/