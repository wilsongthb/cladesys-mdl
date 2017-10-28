<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresentationsController extends Controller
{
    public function index(){
        return view('presentation', [
            'company_name' => 'CHARISMA NISSI',
            'all_name' => 'CENTRO ODONTOLOGICO CHARISMA',
            'phone_number' => '051364947',
            'cell_phone_number' => '940464847',
            'address' => 'Jr. Tacna 121, 4to Piso Galerias Plaza, Puno, Perú',
            'about_us' => 'En Charisma somos una empresa que brinda servicios odontológicos especializados, con muchos reconocimientos por la excelente calidad en la atención brindada, y qué basa su desarrollo y crecimiento en una sólida cultura de servicio; somos leales a nuestros pacientes en un ambiente de trabajo dinámico y con calidez.',
            'history' => 'En Charisma contamos con un equipo conformado por más de 20 profesionales Especializados, 02 unidades de atención, un sistema administrativo eficiente y estamos preparados para asumir nuevos retos ya que contamos con un servicio reconocido y recomendado, asi como el equipo más dinámico, profesional y objetivo.',
            'vision' => 'Consolidarnos en ser referencia en atención odontológica de calidad, reconocida por los clientes y recomendada como negocio.',
            'mission' => 'Generar una agradable experiencia con nuestro servicio, que incluya excelencia, comodidad y felicidad.',
            'our_values' => "La gran pasión de Charisma es cuidar de la salud bucal de las personas, por lo tanto, lleva a cabo una atención alegre y humana, de una manera sencilla, manteniendo una relación de respeto y transparencia con sus clientes, basado en nuestros 3 valores fundamentales:
            
            - Transparencia
            
            - Compromiso
            
            - Trabajo en Equipo",
            'attributes' => "· Administrador de Unidad, encargado de brindarle el apoyo necesario para prestar un servicio de calidad al cliente; nuestra área de Atención al Paciente.
            
            · Área de atención, conformado por la Recepción, y Bioseguridad,
            
            · Área de servicio, conformado por nuestro equipo de cirujanos dentistas especialistas; y el equipo asistencial
            
            En cada unidad renovamos nuestro compromiso con el paciente, brindandole:
            
            · Accesibilidad
            
            · Confort
            
            · Convivencia
            
            ·  Calidad",
            'our_services' => "· Implantes
            
            · Ortodoncia
            
            · Endodoncia
            
            · Prótesis Dental
            
            · Periodoncia
            
            · Pediatría
            
            · Porcelana
            
            · Odontología General",
            'laboratory' => "· Porcelana
            
            · Prótesis Fija
            
            · Prótesis Removible
            
            · Ortodoncia
            
            · Implantes",
            'recommendation' => 'La higiene dental tiene que formar parte de nuestros hábitos, realizando una limpieza de nuestros dientes al menos dos veces al día. Acuda Charisma, nuestro equipo de especialistas para prevenir futuras enfermedades y mantener una buena higiene bucal.',
            
        ]);
    }
}
